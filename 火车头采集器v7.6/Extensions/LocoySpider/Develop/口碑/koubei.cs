using System;
using System.Collections.Generic;
using System.Text;
using System.Drawing;

namespace koubei
{
    /// <summary>
    /// 该图片识别是采用样本逐一对比的方式进行识别
    /// </summary>
    public class KoubeiCap : LeWell.Api.ILocoySpider, LeWell.Api.ISuperJob
    {
        #region ILocoySpider 成员

        public void ChangeResultDic(Dictionary<string, string> dic)
        {

        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {

        }
        public bool UseGetPagesUrl {
            get {
                return false;
            }
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

        public void ChangeArticle(int level, Dictionary<string, List<String>> dic, string pageurl, string html)
        {
            if (dic.ContainsKey("手机号码") && dic["手机号码"][0].StartsWith("http://"))
            {
                System.Net.HttpWebRequest request = (System.Net.HttpWebRequest)System.Net.HttpWebRequest.Create(dic["手机号码"][0]);
                request.Method = "GET";
                System.Net.HttpWebResponse response = (System.Net.HttpWebResponse)request.GetResponse();

                System.IO.Stream sm = response.GetResponseStream();
                try
                {
                    System.Drawing.Image img = System.Drawing.Image.FromStream(sm);
                    dic["手机号码"][0] = Ocr3.Process((Bitmap)img);
                }
                catch
                {
                }
            }
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
            return this.MemberwiseClone();
        }

        #endregion

        #region IDisposable 成员

        public void Dispose()
        {

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
