using System;
using System.Collections.Generic;
using System.Text;

namespace qihoo
{
    /// <summary>
    /// 目标:以http://www.qihoo.com/wenda.php?kw=win7&do=search&area=2&src=bbs为例，采集该列表地址，并采集该页的预览地址
    /// 分析:预览是以post的方式去请求地址的。我们需要在列表页时将post的参数组合生成内容页地址，在内容页请求时，使用插件改变请求的http头信息，去得到Post的结果
    /// 实现:采集规则中列表中要设置组合，得到内内容页地址，然后使用插件的ChangeHtml方法，修改Html代码，得到POST的结果
    /// </summary>
    public class search : LeWell.Api.ISuperJob, LeWell.Api.ILocoySpider
    {

        #region ISuperJob 成员

        public void ChangeArticle(int level, Dictionary<string, List<string>> dic, string pageurl, string html)
        {
            //不操作
        }

        public string ChangeHtml(int level, string originalHtml, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response, string pageurl)
        {
            string data = pageurl;
            if (!data.Contains("?")) throw new Exception("请输入正确的网址");
            data = data.Split('?')[1];
            System.Net.HttpWebRequest hwr = (System.Net.HttpWebRequest)System.Net.HttpWebRequest.Create("http://www.qihoo.com/search/getSnap");
            hwr.Method = "POST";
            hwr.Referer = "http://www.qihoo.com/";
            hwr.ContentType = "application/x-www-form-urlencoded; charset=UTF-8";
            hwr.ServicePoint.Expect100Continue = false;
            byte[] binarydata = System.Text.Encoding.UTF8.GetBytes(data);
            hwr.ContentLength = binarydata.Length;
            hwr.AllowWriteStreamBuffering = true;
            System.IO.Stream sw = hwr.GetRequestStream();
            sw.Write(binarydata, 0, binarydata.Length);
            if (sw != null) { sw.Close(); }

            System.Net.HttpWebResponse res = (System.Net.HttpWebResponse)hwr.GetResponse();
            byte[] bt=new byte[ res.ContentLength];
            System.IO.StreamReader sr = new System.IO.StreamReader(res.GetResponseStream(),System.Text.Encoding.UTF8);
            return sr.ReadToEnd();
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
            //无处理
        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
            //不处理
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

        public string  EndJob(bool handstop,string jobname, string jobid, int url, int content, int post, object job)
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