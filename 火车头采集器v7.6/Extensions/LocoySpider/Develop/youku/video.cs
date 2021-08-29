using System;
using System.Collections.Generic;
using System.Text;
using Newtonsoft.Json;

namespace YouKu
{
    public class Class1 : LeWell.Api.ILocoySpider, LeWell.Api.ISuperJob
    {
        #region ILocoySpider 成员

        public static string ConvertHex(string value)
        {
            string str = string.Empty;
            try
            {
                while (Convert.ToUInt32(value) > 0x10)
                {
                    int num = int.Parse(value);
                    int num2 = num % 0x10;
                    str = GetHexChar(num2.ToString()) + str;
                    value = Math.Floor(Convert.ToDouble((int)(num / 0x10))).ToString();
                }
                return (GetHexChar(value) + str);
            }
            catch
            {
                return "###Valid Value!###";
            }
        }

        public string getFileId(string flvdata, int segindex, RandomProxy rand)
        {
            string str = rand.cg_fun(flvdata);
            string str2 = rand.cg_fun(flvdata).Substring(0, 8);
            string str3 = segindex.ToString("X2");
            if (str3.Length == 1)
            {
                str3 = "0" + str3;
            }
            str3 = str3.ToUpper();
            string str4 = str.Substring(10, str.Length - 10);
            return (str2 + str3 + str4);
        }

        public static string GetHexChar(string value)
        {
            switch (value)
            {
                case "10":
                    return "A";

                case "11":
                    return "B";

                case "12":
                    return "C";

                case "13":
                    return "D";

                case "14":
                    return "E";

                case "15":
                    return "F";
            }
            return value;
        }



        string Run(string str)
        {
            string flv = "";
            try
            {
                JavaScriptObject obj2 = (JavaScriptObject)JavaScriptConvert.DeserializeObject(str);
                JavaScriptArray array = (JavaScriptArray)obj2["data"];
                Dictionary<string, object> dictionary = (Dictionary<string, object>)array[0];
                string flvdata = "";
                string key1 = "";
                string key2 = "";
                string str6 = "";
                int seed = 0;
                Dictionary<string, object> segs = null;
                foreach (KeyValuePair<string, object> pair in dictionary)
                {
                    if (pair.Key == "streamfileids")
                    {
                        flvdata = ((Dictionary<string, object>)pair.Value)["flv"].ToString();
                    }
                    else
                    {
                        if (pair.Key == "key1")
                        {
                            key1 = pair.Value.ToString();
                            continue;
                        }
                        if (pair.Key == "key2")
                        {
                            key2 = pair.Value.ToString();
                            continue;
                        }
                        if (pair.Key == "seed")
                        {
                            seed = Convert.ToInt32(pair.Value);
                            continue;
                        }
                        if (pair.Key == "segs")
                        {
                            segs = (Dictionary<string, object>)pair.Value;
                        }
                    }
                }
                object flv_segs = null;
                foreach (KeyValuePair<string, object> pair2 in segs)
                {
                    if (pair2.Key == "flv")
                    {
                        flv_segs = pair2.Value;
                        break;
                    }
                }
                List<object> flv_list = (List<object>)flv_segs;
                List<string> key_list = new List<string>();
                int times = 0;
                foreach (object obj4 in flv_list)
                {
                    Dictionary<string, object> dictionary3 = (Dictionary<string, object>)obj4;
                    foreach (KeyValuePair<string, object> pair3 in dictionary3)
                    {
                        if (pair3.Key == "seconds")
                        {
                            times += int.Parse((string)pair3.Value);
                        }
                        if (pair3.Key == "k")
                        {
                            key_list.Add(pair3.Value as string);
                        }
                    }
                }
                //  totalSecond = times.ToString();
                int count = flv_list.Count;
                string str7 = Convert.ToString((long)(Convert.ToInt32(key1, 0x10) ^ ((long)0xa55aa5a5L)), 0x10).Substring(8, 8);
                for (int i = 0; i < 8; i++)
                {
                    if (str7.StartsWith("0"))
                    {
                        str7 = str7.Substring(1, str7.Length - 1);
                    }
                }
                string text1 = key2 + str7;
                int num5 = new Random().Next(0x2328);
                DateTime now = DateTime.Now;
                DateTime time = new DateTime(0x7b2, 1, 1);
                TimeSpan span = (TimeSpan)(DateTime.Now - time);
                long num6 = Convert.ToInt64((double)((span.TotalMilliseconds * 1000.0) / 1000.0));
                int milliseconds = span.Milliseconds;
                str6 = num6.ToString() + ((0x3e8 + milliseconds)).ToString() + (num5 + 0x3e8);
                RandomProxy rand = new RandomProxy(seed);
                StringBuilder builder = new StringBuilder();

                //只下载第一个分段
                for (int j = 0; j < count; j++)
                {
                    string str8 = "";
                    if (j < 0x10)
                    {
                        str8 = "0";
                    }
                    str8 = str8 + ConvertHex(j.ToString());
                    string str9 = this.getFileId(flvdata, j, rand);
                    builder.AppendFormat("http://f.youku.com/player/getFlvPath/sid/{0}_{1}/st/flv/fileid/{2}?K={3}#||#", new object[] { str6, str8, str9, key_list[j] });
                }
                flv = builder.ToString().Substring(0, builder.Length - 4);
            }
            catch
            {
                flv = "无法完成JSON ==> JavaScriptConvert.DeserializeObject的转换，可能目标网站编码已经改变";
            }
            return flv;
        }

        public void ChangeResultDic(Dictionary<string, string> dic)
        {
            //throw new NotImplementedException();
        }

        public string ChangeStepHtml(string pageurl, string html, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response)
        {
            return html;
            //throw new NotImplementedException();
        }

        public void ChangeStepRequest(ref System.Net.HttpWebRequest request)
        {
            //throw new NotImplementedException();
        }

        public List<KeyValuePair<string, Dictionary<string, string>>> GetStepUrls(string html, string areaStart, string areaEnd, string urlStyle, string urlCombine, string allow, string forbidden)
        {
            //throw new NotImplementedException();
            return new List<KeyValuePair<string, Dictionary<string, string>>>();
        }


        public List<string> MakeStartAddress(string urlData, string useragent, string refer, System.Net.CookieCollection cookie)
        {
            return new List<string>();
            //throw new NotImplementedException();
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
            if (dic.ContainsKey("flv") && dic["flv"].Count > 0)
            {
                dic["flv"][0] = Run(dic["flv"][0]);
            }
        }

        public string ChangeHtml(int level, string originalHtml, System.Net.WebHeaderCollection request, System.Net.WebHeaderCollection response, string pageurl)
        {
            return originalHtml;
            //throw new NotImplementedException();
        }

        public void ChangeWebRequest(int level, ref System.Net.HttpWebRequest request)
        {
            // throw new NotImplementedException();
        }

        public string GetMultPageUrl(string multPageName, string pageurl, string html, string multPageStyle, string multPageCombine)
        {
            return "";
            //throw new NotImplementedException();
        }

        public List<string> GetPagesUrl(int level, string pageurl, string html, string pagesStyle, string pagesCombine)
        {
            return new List<string>();
            // throw new NotImplementedException();
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
            //return;
            //throw new NotImplementedException();
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

        public string  StartJob()
        {
            return null;
        }

        public bool UseChangeSaveFiles
        {
            get { return false; }
        }

        #endregion
    }


    public class RandomProxy
    {
        // Fields
        private string cg_str = "";
        private int randomSeed;

        // Methods
        public RandomProxy(int seed)
        {
            this.randomSeed = seed;
            this.cg_hun();
        }

        public string cg_fun(string b)
        {
            string[] strArray = b.Split(new char[] { '*' });
            string str = "";
            for (int i = 0; i < (strArray.Length - 1); i++)
            {
                str = str + this.cg_str.Substring(Convert.ToInt32(strArray[i]), 1);
            }
            return str;
        }

        private void cg_hun()
        {
            string str = @"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/\:._-1234567890";
            int length = str.Length;
            int startIndex = 0;
            for (int i = 0; i < length; i++)
            {
                startIndex = Convert.ToInt32((double)((this.ran() * Convert.ToDouble(str.Length)) * 1000.0)) / 0x3e8;
                this.cg_str = this.cg_str + str.Substring(startIndex, 1);
                if (startIndex == 0)
                {
                    str = str.Substring(1, str.Length - 1);
                }
                else if (startIndex == str.Length)
                {
                    str = str.Substring(0, str.Length - 1);
                }
                else
                {
                    str = str.Substring(0, startIndex) + str.Substring(startIndex + 1, (str.Length - startIndex) - 1);
                }
            }
        }

        private double ran()
        {
            this.randomSeed = ((this.randomSeed * 0xd3) + 0x754f) % 0x10000;
            return (((double)this.randomSeed) / 65536.0);
        }
    }
}
