<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>视频上传</title>
    <link rel="stylesheet" type="text/css" href="../../css/webuploader.css" />
    <link rel="stylesheet" type="text/css" href="./style.css" />
</head>
<body>
    <div id="wrapper">
        <div id="container">
            <!--头部，视频选择和格式选择-->

            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将视频拖到这里，单次最多可选10个</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div><div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="boot">视频最多上传数10个，视频单个文件最大300M，仅限视频格式MP4、Fiv。</div>
    <script src="require.js" data-main="app.js"></script>
</body>
</html>