using System;
using System.Collections.Generic;
using System.Text;

namespace 下载文件重命名
{
    public class Rename:LeWell.Api.ISuperJob,LeWell.Api.ILocoySpider
    {

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
            return html;
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
            throw new NotImplementedException();
        }

        #endregion

        #region ILocoySpider 成员

        public void ChangeResultDic(Dictionary<string, string> dic)
        {
           
        }

        /// <summary>
        /// 用标题给文件命名
        /// </summary>
        /// <param name="fieldandfiles"></param>
        /// <param name="dic"></param>
        public void ChangeSaveFiles(Dictionary<string, Dictionary<string, KeyValuePair<string, string>>> fieldandfiles, Dictionary<string, string> dic)
        {
            if (fieldandfiles.Count == 0 && dic.ContainsKey("标题") && dic["标题"] != "") return;
            string[] labels = new string[fieldandfiles.Count];
            fieldandfiles.Keys.CopyTo(labels, 0);
            int i = 1;
            foreach (string lb in labels)
            {
                Dictionary<string, KeyValuePair<string, string>> kv = fieldandfiles[lb];
                Dictionary<string, KeyValuePair<string, string>> newfile = new Dictionary<string, KeyValuePair<string, string>>();
                //真实地址，保存地地址，替换地址
                foreach (KeyValuePair<string, KeyValuePair<string, string>> files in kv)
                {
                    string filename, replace, ext, save, dir, nreplace;
                    ext = System.IO.Path.GetExtension(files.Value.Key);
                    filename = System.IO.Path.GetFileNameWithoutExtension(files.Value.Key);
                    replace = files.Value.Value;
                    dir = System.IO.Path.GetDirectoryName(files.Value.Key);
                    string title = removepath(dic["标题"]);
                    if (fieldandfiles.Count == 1 && kv.Count == 1)
                    {
                        save = dir + "\\" + title + ext;
                    }
                    else
                    {
                        save = dir + "\\" + title + "_" + i.ToString() + ext;
                    }
                    i++;
                    nreplace = System.IO.Path.GetDirectoryName(replace) + "\\" + System.IO.Path.GetFileName(save);
                    if (dic[lb] != "") dic[lb] = dic[lb].Replace(replace, nreplace);
                    newfile.Add(files.Key, new KeyValuePair<string, string>(save, nreplace));
                }
                fieldandfiles[lb] = newfile;
            }
        }

        private string removepath(string fname)
        {
            foreach (char c in System.IO.Path.GetInvalidFileNameChars())
            {
                fname = fname.Replace(c.ToString(), "");
            }
            return fname;
        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
           
        }

        public string EndJob(bool handstop,string jobname, string jobid, int url, int content, int post, object job)
        {
            return null;
        }

        public List<KeyValuePair<string, Dictionary<string, string>>> GetStepUrls(string html, string areaStart, string areaEnd, string urlStyle, string urlCombine, string allow, string forbidden)
        {
            return null;
        }

        public List<string> MakeStartAddress(string urlData, string useragent, string refer, System.Net.CookieCollection cookie)
        {
            return null;
        }

        public string StartJob()
        {
            return null;
        }

        public bool UseChangeSaveFiles
        {
            get { return true; }
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
    }
}
