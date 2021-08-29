using System;
using System.Collections.Generic;
using System.Text;

namespace youdao
{
    /// <summary>
    /// 有道翻译地址：http://fanyi.youdao.com/translate
    /// 有道翻译最多可以翻译2万字的文章，如果超出，需要分段请求，最后合并。
    /// 实现：使用算法，将html代码中的<a href=''>b</a>中的<>转换成另一种有道不会翻译的代码，，如数字（确保不重复），然后发给有道后，翻译完成后，再替换回来。这使用
    /// 插件中的 ChangeResultDic ,按标签名，对指定的标签进行翻译
    /// </summary>
    public class translate : LeWell.Api.ISuperJob, LeWell.Api.ILocoySpider
    {
        #region ISuperJob 成员

        public void ChangeArticle(int level, Dictionary<string, List<string>> dic, string pageurl, string html)
        {
            //不操作
        }

        public string ChangeHtml(int level, string originalHtml, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response, string pageurl)
        {
            return originalHtml;
        }

        public void ChangeWebRequest(int level, ref System.Net.HttpWebRequest request)
        {
            //不操作
        }

        public string GetMultPageUrl(string multPageName, string pageurl, string html, string multPageStyle, string multPageCombine)
        {
            return null;
        }

        public List<string> GetPagesUrl(int level, string pageurl, string html, string pagesStyle, string pagesCombine)
        {
            return null;
        }

        public bool UseChangeWebRequest
        {
            get { return false; }
        }

        public bool UseGetMultPageUrl
        {
            get { return false; }
        }

        public bool UseGetPagesUrl
        {
            get { return false; }
        }

        #endregion

        #region ICloneable 成员

        public object Clone()
        {
            return this.MemberwiseClone();
        }

        #endregion

        #region IDisposable 成员

        public void Dispose()
        {
            //不操作
        }

        #endregion

        #region ILocoySpider 成员


        public void ChangeResultDic(Dictionary<string, string> dic)
        {
            //按标签名，有道翻译是设置方向

            if (!dic.ContainsKey("内容") && !dic.ContainsKey("翻译标签")) return;

            string fangxiang = "ZH_CN2EN";
            if (dic.ContainsKey("翻译方向")) fangxiang = dic["翻译方向"];

            string[] labels = new string[] { "内容" };
            if (dic.ContainsKey("翻译标签")) labels = dic["翻译标签"].Split(',');

            foreach (string lb in labels)
            {
                string content = dic[lb];
                if (string.IsNullOrEmpty(content) || content.Trim().Length == 0) return;//空值不处理

                //○$用这个符号将结果分开
                if (content.Contains("<") || content.Contains(">"))
                {
                    System.Collections.Generic.Dictionary<string, string> htmls = new Dictionary<string, string>();
                    System.Text.RegularExpressions.MatchCollection mc = System.Text.RegularExpressions.Regex.Matches(content, "<[^>]*?>");
                    int last = 0;
                    StringBuilder sb = new StringBuilder();
                    for (int i = 0; i < mc.Count; i++)
                    {
                        System.Text.RegularExpressions.Match m = mc[i];
                        if (m.Index > 0) sb.Append(content.Substring(last, m.Index - last));
                        last = m.Index + m.Length;
                        htmls.Add("78945" + i.ToString() + "54739", m.Value);
                        sb.Append("78945" + i.ToString() + "54739");
                    }
                    dic[lb] = fanYi(sb.ToString(), htmls,fangxiang);
                }
                else
                {
                    dic[lb] = fanYi(content, new Dictionary<string, string>(), fangxiang);//没有html代码的直接翻译
                }
            }
        }

        private string fanYi(string content, System.Collections.Generic.Dictionary<string, string> dic, string fx)
        {
            //先进行长度的判断
            if (content.Length < 20000)
            {
                content = request(content, fx);
            }
            else
            {
                StringBuilder sb = new StringBuilder();
                int c2 = int.Parse(Math.Ceiling(content.Length / 20000.0).ToString());
                for (int i = 0; i < c2; i++)
                {
                    string s = (c2 - 1 == i) ? content.Substring(i * 20000, content.Length % 20000) : content.Substring(i * 20000, 20000);
                    sb.Append(request(s, fx));
                }

                content = sb.ToString();
            }

            foreach (KeyValuePair<string, string> kv in dic)
            {
                if (content != "") content = content.Replace(kv.Key, kv.Value);
            }
            return content;
        }

        private string request(string content, string fx)
        {
            //同时只允许一个请求
            lock (lkhttp)
            {
                System.IO.Stream srequest = null;
                System.IO.Stream sresponse = null;
                try
                {
                    System.Net.HttpWebRequest request = (System.Net.HttpWebRequest)System.Net.HttpWebRequest.Create("http://fanyi.youdao.com/translate");
                    request.Method = "POST";
                    request.Referer = "http://fanyi.youdao.com/";
                    string poststr = "type=" + fx + "&i=" + System.Web.HttpUtility.UrlEncode(content, Encoding.UTF8) + "&doctype=json&xmlVersion=1.4&keyfrom=fanyi.web&ue=UTF-8&typoResult=true&flag=false";/*+content+*/
                    byte[] postbyte = Encoding.UTF8.GetBytes(poststr);
                    request.ContentLength = postbyte.Length;
                    request.ContentType = "application/x-www-form-urlencoded";
                    srequest = request.GetRequestStream();
                    srequest.Write(postbyte, 0, postbyte.Length);
                    System.Net.HttpWebResponse response = (System.Net.HttpWebResponse)request.GetResponse();
                    sresponse = response.GetResponseStream();

                    System.IO.StreamReader sr = new System.IO.StreamReader(sresponse);
                    content = sr.ReadToEnd();

                    StringBuilder sb = new StringBuilder();
                    System.Text.RegularExpressions.MatchCollection m = System.Text.RegularExpressions.Regex.Matches(content, "\"tgt\":\"([\\s\\S]*?)\"\\}");
                    if (m.Count > 0)
                    {
                        for (int i = 0; i < m.Count; i++)
                        {
                            sb.Append(m[i].Result("$1").Replace("\\\"", "\""));
                        }
                    }
                    content = sb.ToString();

                    sr.Close();

                    System.Threading.Thread.Sleep(1000);//暂停时间
                }
                catch (Exception)
                {

                    throw;
                }
                finally
                {
                    if (sresponse != null) sresponse.Close();
                    if (srequest != null) srequest.Close();
                }
                return content;
            }
        }

        private static object lkhttp = new object();

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
            //不操作
        }

        public List<KeyValuePair<string, Dictionary<string, string>>> GetStepUrls(string html, string areaStart, string areaEnd, string urlStyle, string urlCombine, string allow, string forbidden)
        {
            return null;
        }

        public List<string> MakeStartAddress(string urlData, string useragent, string refer, System.Net.CookieCollection cookie)
        {
            return null;
        }

        public bool UseGetStepUrls
        {
            get { return false; }
        }

        public bool UseMakeStartAddress
        {
            get { return false; }
        }

        #endregion


        #region ILocoySpider 成员


        public void ChangeSaveFiles(Dictionary<string, Dictionary<string, KeyValuePair<string, string>>> fieldandfiles, Dictionary<string, string> dic)
        {

        }

        public string EndJob(bool handstop, string jobname, string jobid, int url, int content, int post, object job)
        {
            return null;
        }

        public string StartJob()
        {
            return null;
        }

        public bool UseChangeSaveFiles
        {
            get { return false; }
        }

        #endregion
    }
}
