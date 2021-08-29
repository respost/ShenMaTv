using System;
using System.Collections.Generic;
using System.Text;
using System.Drawing;
using System.IO;
using System.Drawing.Imaging;
using _58验证码;
 

namespace _58
{
    class Ocr3
    {
        static Dictionary<string, List<Point>> match = new Dictionary<string, List<Point>>();
        //每个特征字符
        static string[] codes = new string[] { "0", "8", "4", "6", "5", "7", "2", "9", "1", "3" };
        //每个特征字符的大小
        static Dictionary<string, Size> codeSize = new Dictionary<string, Size>();

        static List<Point> Tranlate(List<Point> ps, int x, int y)
        {
            List<Point> news = new List<Point>();

            foreach (var item in ps)
            {
                news.Add(new Point(item.X+x,item.Y+y));
            }
            return news;
        }

        /// <summary>
        /// 将资源初始化
        /// </summary>
        static Ocr3()
        {
            for (int i = 0; i < 10; i++)
            {
                object obj = Resources.ResourceManager.GetObject("_" + i.ToString(), Resources.Culture);
                Bitmap bmp = (Bitmap)obj;
                //先搞成黑色
                Threshold2Value(bmp, 100);
                List<Point> points = GetWordPoint(bmp);
                match.Add(i.ToString(), points);
                codeSize.Add(i.ToString(), CalculateSize(points));
            }
        }

        public static Size CalculateSize(List<Point> item)
        {
            int x1 = int.MaxValue;
            int x2 = int.MinValue;
            int y1 = int.MaxValue;
            int y2 = int.MinValue;
            //求字符宽度和高度
            for (int i = 0; i < item.Count; i++)
            {
                if (item[i].X < x1)
                {
                    x1 = item[i].X;
                }
                if (item[i].X > x2)
                {
                    x2 = item[i].X;
                }
                if (item[i].Y < y1)
                {
                    y1 = item[i].Y;
                }
                if (item[i].Y > y2)
                {
                    y2 = item[i].Y;
                }
            }
            return new Size(x2 - x1 + 1, y2 - y1 + 1);
        }

        /// <summary>
        /// 会产生graphics异常的PixelFormat
        /// </summary>
        private static PixelFormat[] indexedPixelFormats = { PixelFormat.Undefined, PixelFormat.DontCare,
PixelFormat.Format16bppArgb1555, PixelFormat.Format1bppIndexed, PixelFormat.Format4bppIndexed,
PixelFormat.Format8bppIndexed
    };

        /// <summary>
        /// 判断图片的PixelFormat 是否在 引发异常的 PixelFormat 之中
        /// </summary>
        /// <param name="imgPixelFormat">原图片的PixelFormat</param>
        /// <returns></returns>
        private static bool IsPixelFormatIndexed(PixelFormat imgPixelFormat)
        {
            foreach (PixelFormat pf in indexedPixelFormats)
            {
                if (pf.Equals(imgPixelFormat)) return true;
            }

            return false;
        }

        /// <summary>
        /// 将一个字符的矩阵在原图中匹配
        /// 前提是字符的大小，角度不变
        /// </summary>
        public static string Process(Bitmap bmp)
        {
            if (IsPixelFormatIndexed(bmp.PixelFormat))
            {
                Bitmap newbmp = new Bitmap(bmp.Width, bmp.Height, PixelFormat.Format24bppRgb);
                using (Graphics g = Graphics.FromImage(newbmp))
                {
                    g.InterpolationMode = System.Drawing.Drawing2D.InterpolationMode.HighQualityBicubic;
                    g.SmoothingMode = System.Drawing.Drawing2D.SmoothingMode.HighQuality;
                    g.CompositingQuality = System.Drawing.Drawing2D.CompositingQuality.HighQuality;
                    g.DrawImage(bmp, 0, 0);
                }
                bmp = newbmp;
            }
            //给原图二值化
            Threshold2Value(bmp, 100);
           
            List<int> locationX = new List<int>();
            StringBuilder sb = new StringBuilder(15);
          
            int[,] matrix = new int[bmp.Width, bmp.Height];
            //转换成矩阵
            for (int i = 0; i < bmp.Width; i++)
            {
                for (int j = 0; j < bmp.Height; j++)
                {
                    Color c = bmp.GetPixel(i, j);
                    if (c.R == 0 && c.G == 0 && c.B == 0)
                    {
                        matrix[i, j] = 1;
                    }
                }
            }
            for (int i = 0; i < bmp.Width; i++)//X方向位移
            {
                for (int j = 0; j < bmp.Height; j++)//y方向位移
                {
                    string targetchar = null;
                    foreach (var code in codes)//每个字符
                    {
                        if (i < bmp.Width - codeSize[code].Width &&
                            j < bmp.Height - codeSize[code].Height &&
                            ComparePixel(matrix, i, j, code)) //比较
                        {
                            if (code == "3" &&   //3和8高度重合，如果3匹配到，则在拿8试试，如果成功，则说明是8
                                ComparePixel(matrix, i + 1, j, "8"))
                            {
                                targetchar = "8";
                                i++;
                            }
                            else
                            {
                                targetchar = code;
                            }
                        }
                    }
                    if (targetchar != null)
                    {
                        if (targetchar == "4")//4和1重合度太高，所以X+1
                        {
                            i++;
                        }
                        sb.Append(targetchar);
                        break;
                    }
                }
            }
            return sb.ToString();
        }
    
        static bool ComparePixel(int[,] matrix, int x, int y, string code)
        {
            float _c = match[code].Count;
            float _a = 0.0F;
            int breakC = 0;

            foreach (var item in match[code])
            {
                if (breakC > 5)
                {
                    return false;
                }
                if (matrix[item.X + x, item.Y + y] != 1)
                {
                    breakC++;
                }
                else
                {
                    _a++;

                }
            }
            float sorce = _a / _c;
            if (code == "1" && sorce < 0.95)
            {
                return false;
            }
            if (sorce > 0.8)
            {
                return true;
            }
            return false;

        }
        /// <summary>
        /// 去图形边框
        /// </summary>
        /// <param name="borderWidth"></param>
        public static Bitmap ClearPicBorder(Bitmap bmp, int borderWidth)
        {

            for (int i = 0; i < bmp.Height; i++)
            {
                for (int j = 0; j < bmp.Width; j++)
                {
                    if (i < borderWidth || j < borderWidth || j > bmp.Width - 1 - borderWidth || i > bmp.Height - 1 - borderWidth)
                        bmp.SetPixel(j, i, Color.FromArgb(255, 255, 255));
                }
            }
            return bmp;
        }
        /// <summary>
        /// 读取特征字符图片的点（相对于0位置）
        /// </summary>
        /// <param name="bmp"></param>
        /// <returns></returns>
        public static List<Point> GetWordPoint(Bitmap bmp)
        {
            Bitmap _b = new Bitmap(bmp);


            List<Point> WordPoint = GetBlackPixels(_b);
       
            int x1 = int.MaxValue;
            int x2 = int.MinValue;
            int y1 = int.MaxValue;
            int y2 = int.MinValue;
            //求字符宽度和高度
            for (int i = 0; i < WordPoint.Count; i++)
            {
                if (WordPoint[i].X < x1)
                {
                    x1 = WordPoint[i].X;
                }
                if (WordPoint[i].X > x2)
                {
                    x2 = WordPoint[i].X;
                }
                if (WordPoint[i].Y < y1)
                {
                    y1 = WordPoint[i].Y;
                }
                if (WordPoint[i].Y > y2)
                {
                    y2 = WordPoint[i].Y;
                }
            }
            //Bitmap bmpChar = new Bitmap(x2 - x1 + 1, y2 - y1 + 1);
            List<Point> newPoints = new List<Point>();
            foreach (var it in WordPoint)
            {
                newPoints.Add(new Point(it.X - x1, it.Y - y1));//
                //bmpChar.SetPixel(it.X - x1, it.Y - y1, Color.Black);
            }
            //int[,] PixelMap = new int[bmpChar.Width,bmpChar.Height];
            ////将坐标转换成特征码  //转换有误，应该用二维数据，而不是一维
            ////for (int i = 0; i < PixelMap.Length; i++)
            ////{
            ////    PixelMap[i] = 0;
            ////}
            //foreach (var p in newPoints)
            //{
            //    PixelMap[p.X,p.Y] = 1;
            //}
            //StringBuilder sb = new StringBuilder(200);
            //for (int i = 0; i < bmpChar.Width; i++)
            //{
            //    for (int j = 0; j < bmpChar.Height; j++)
            //    {
            //        sb.Append(PixelMap[i, j].ToString());
            //    }
            //}
            //dictBmp.Add(new KeyValuePair<string, Bitmap>(sb.ToString(), bmpChar));

            return newPoints;
        }

        /// <summary>
        /// 获取特征字图黑点坐标
        /// </summary>
        public static List<Point> GetBlackPixels(Bitmap bmp)
        {
            List<Point> BlackPixel = new List<Point>();
            for (int i = 0; i < bmp.Width; i++)
            {
                for (int j = 0; j < bmp.Height; j++)
                {
                    Point point = new Point(i, j);
                    Color c = bmp.GetPixel(i, j);
                    if (c.R == 0 && c.G == 0 && c.B == 0)//黑色
                    {
                        BlackPixel.Add(new Point(i, j));
                    }
                }
            }
            return BlackPixel;
        }



        /// <summary>
        /// 去图形边框
        /// </summary>
        /// <param name="borderWidth"></param>
        public static void CutBorder(Bitmap bmpobj, int _topsize, int _bottomsize, int _leftsize, int _rightsize)
        {
            if (_leftsize + _rightsize > bmpobj.Width || _topsize + _bottomsize > bmpobj.Height) return;//边框太宽直接返回

            Rectangle rec = new Rectangle(0, 0, bmpobj.Width, bmpobj.Height);
            BitmapData bmpData = bmpobj.LockBits(rec, ImageLockMode.ReadWrite, PixelFormat.Format24bppRgb);// PixelFormat.Format32bppPArgb); bmpobj.PixelFormat
            IntPtr scan0 = bmpData.Scan0;
            int pixelSize = System.Drawing.Image.GetPixelFormatSize(bmpData.PixelFormat) / 8;
            int stride = bmpData.Stride;
            int offset = stride - bmpobj.Width * pixelSize;

            unsafe
            {
                byte* ptr = (byte*)(bmpData.Scan0);
                for (int i = 0; i < bmpData.Height; i++)
                {
                    for (int j = 0; j < bmpData.Width; j++)
                    {
                        if (i < _topsize || i > bmpobj.Height - 1 - _bottomsize || j < _leftsize || j > bmpobj.Width - 1 - _rightsize)
                        {
                            ptr = (byte*)(bmpData.Scan0) + i * bmpData.Stride + j * 3;

                            *ptr = 255;
                            ptr++;
                            *ptr = 255;
                            ptr++;
                            *ptr = 255;
                        }
                    }
                    ptr += offset;
                }
            }
            bmpobj.UnlockBits(bmpData);
        }



        /// <summary>
        /// 二值化处理
        /// </summary>
        /// <param name="dgGrayValue">灰度阙值</param>
        public static void Threshold2Value(Bitmap bmpobj, int DgGrayValue)
        {

            Rectangle rec = new Rectangle(0, 0, bmpobj.Width, bmpobj.Height);
            BitmapData bmpData = bmpobj.LockBits(rec, ImageLockMode.ReadWrite, PixelFormat.Format24bppRgb);// PixelFormat.Format32bppPArgb); bmpobj.PixelFormat
            IntPtr scan0 = bmpData.Scan0;
            int pixelSize = System.Drawing.Image.GetPixelFormatSize(bmpData.PixelFormat) / 8;
            int stride = bmpData.Stride;
            int offset = stride - bmpobj.Width * pixelSize;

            unsafe
            {
                byte* ptr = (byte*)(bmpData.Scan0);
                for (int y = 0; y < bmpobj.Height; y++)
                {
                    //ushort* ptr = (ushort*)(basePtr + stride * y);

                    // for each pixel
                    for (int x = 0; x < bmpobj.Width; x++)
                    {
                        ptr = (byte*)(bmpData.Scan0) + y * bmpData.Stride + x * pixelSize;


                        int b = *ptr;
                        int g = *(ptr + 1);
                        int r = *(ptr + 2);

                        int grayValue = GetGrayNumColor(Color.FromArgb(r, g, b));

                        *ptr = *(ptr + 1) = *(ptr + 2) = (byte)((grayValue >= DgGrayValue) ? 255 : 0);
                    }
                    ptr += offset;
                }
            }
            bmpobj.UnlockBits(bmpData);

        }
        /// <summary>
        /// 根据RGB，计算灰度值
        /// </summary>
        /// <param name="posClr">Color值</param>
        /// <returns>灰度值，整型</returns>
        public static int GetGrayNumColor(System.Drawing.Color posClr)
        {
            return (posClr.R * 19595 + posClr.G * 38469 + posClr.B * 7472) >> 16;
        }

    }
}
