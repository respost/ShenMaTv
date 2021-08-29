using System;
using System.Collections.Generic;
using System.Text;
using System.Text.RegularExpressions;

namespace 爱帮电话号码
{
    /// <summary>
    /// 爱帮网的电话号码是以css的方式进行显示的，我们需要提取css中有用的电话号码
    /// </summary>
    public class phonenum:LeWell.Api.ILocoySpider,LeWell.Api.ISuperJob
    {
        private static string lastModified = "";
        private static List<string> cssTemp = new List<string>();
        private List<string> getCss()
        {
            string cssurl = "http://i2.aibangjuxin.com/css11122120/Biz_1.css";
            System.Net.HttpWebRequest request = (System.Net.HttpWebRequest)System.Net.HttpWebRequest.Create(cssurl);//css样式地址，可能改变
            request.Method = "HEAD";
            System.Net.HttpWebResponse response = (System.Net.HttpWebResponse)request.GetResponse();
            string lm = response.LastModified.ToString();
            if (lm != lastModified)
            {
                System.Net.HttpWebRequest request2 = (System.Net.HttpWebRequest)System.Net.HttpWebRequest.Create(cssurl);
                System.Net.HttpWebResponse response2 = (System.Net.HttpWebResponse)request2.GetResponse();
                System.IO.StreamReader sr = new System.IO.StreamReader(response2.GetResponseStream());
                string str = sr.ReadToEnd();
                Match m = Regex.Match(str, "Confusion\\.css - \\*/([\\s\\S]+?)\\{");
                if (m.Success)
                {
                    cssTemp.Clear();
                    string[] cs = m.Result("$1").Trim().Split(',');
                    foreach (string s in cs) cssTemp.Add(s.TrimStart('.'));
                }
                lastModified = lm;
            }
            return cssTemp;
        }

        #region ILocoySpider 成员

        public void ChangeResultDic(Dictionary<string, string> dic)
        {
            if (!dic.ContainsKey("电话号码")) return;
            List<string> css = getCss();
            string num = dic["电话号码"];

            string result = "";
            System.Text.RegularExpressions.MatchCollection mc = Regex.Matches(num, "<span class='([^<]*?)'>([^<]*?)</span>");
            if (mc.Count > 0)
            {
                foreach (Match item in mc)
                {
                    string c = item.Result("$1");
                    if (css.Contains(c))
                    {
                        result += item.Result("$2");
                    }
                }
            }
            else return;
            dic["电话号码"] = result;
        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
            
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

        #region ISuperJob 成员

        public void ChangeArticle(int level, Dictionary<string, List<string>> dic, string pageurl, string html)
        {
            
        }

        public string ChangeHtml(int level, string originalHtml, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response, string pageurl)
        {
            return originalHtml;
        }

        public void ChangeWebRequest(int level, ref System.Net.HttpWebRequest request)
        {

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

        public bool UseGetPageUrl
        {
            get { return false; }
        }

        #endregion

        #region ICloneable 成员

        public object Clone()
        {
            return null;
        }

        #endregion

        #region IDisposable 成员

        public void Dispose()
        {
            
        }

        #endregion

        #region ISuperJob 成员


        public bool UseGetPagesUrl
        {
            get { return false; }
        }

        #endregion


        #region ILocoySpider 成员


        public void ChangeSaveFiles(Dictionary<string, Dictionary<string, KeyValuePair<string, string>>> fieldandfiles, Dictionary<string, string> dic)
        {

        }

        public string EndJob(bool handstop,string jobname, string jobid, int url, int content, int post, object job)
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
