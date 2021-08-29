using System;
using System.Collections.Generic;
using System.Text;

namespace 生成分页地址
{
    /// <summary>
    /// 有的网站使用多种模板显示分页地址，这种情况下我们要获取分页地址就非常困难了。不过我们可以通过插件的功能，自己编写程序判断并生成分页的地址，
    /// 然后让采集器//////获取到。我们的例子如下
    ///本次测试的网址：
    ///http://www.diyifanwen.com/fanwen/lunwenzhidao/1141715512857992.htm
    ///http://www.diyifanwen.com/fanwen/zhuchici/20101011222334115874624.htm
    /// </summary>
    public class Pages:LeWell.Api.ISuperJob,LeWell.Api.ILocoySpider
    {
     

        #region ISuperJob 成员

        public void ChangeArticle(int level, Dictionary<string, List<string>> dic, string pageurl, string html)
        {
           //
        }

        public string ChangeHtml(int level, string originalHtml, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response, string pageurl)
        {
            return originalHtml;
        }

        public void ChangeWebRequest(int level, ref System.Net.HttpWebRequest request)
        {
            //
        }

        public string GetMultPageUrl(string multPageName, string pageurl, string html, string multPageStyle, string multPageCombine)
        {
            return null;
        }

        public List<string> GetPagesUrl(int level, string pageurl, string html, string pagesStyle, string pagesCombine)
        {
            List<string> urls = new List<string>();
            if (level == 0)
            {
                //对于这种基本没规律的分页，我们无法判断分页的区域，也无法直接得知其总分页数，该怎么办呢？经分析可以得知，分页的规律是在原网址后加上分页页码，如 默认页是1141715512857992.htm，则分页是 1141715512857992_2.htm 。因为这个分页是全部列出的，我们就有办法了：可以去循环查找是否有分页地址存在，有存在则说明有这个分页，然后我们生成存在的网页地址即可。
                string filename = System.IO.Path.GetFileNameWithoutExtension(pageurl);
                for (int i = 2; i < 100; i++)
                {
                    string url = filename + "_" + i.ToString() + ".htm";
                    if (html.Contains(url))
                    {
                        urls.Add(pageurl.Substring(0, pageurl.LastIndexOf("/")) + "/" + url);
                    }
                    else break;
                }
            }
            return urls;
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
            //
        }

        #endregion

        #region ILocoySpider 成员

        public void ChangeResultDic(Dictionary<string, string> dic)
        {
           //
        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
            //
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
