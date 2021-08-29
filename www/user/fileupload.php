<?php error_reporting(0);
if ($_COOKIE[uid] == null) {
    echo "会员已失效请重新登录!";
    exit;
}header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}if (!empty($_REQUEST['debug'])) {
    $random = rand(0, intval($_REQUEST['debug']));
    if ($random === 0) {
        header("HTTP/1.0 500 Internal Server Error");
        exit;
    }
}@set_time_limit(5 * 60);
$targetDir = '../vod/file_tmp';
$uploadDir = '../vod/file';
$cleanupTargetDir = true;
$maxFileAge = 5 * 3600;
if (!file_exists($targetDir)) {
    @mkdir($targetDir);
}if (!file_exists($uploadDir)) {
    @mkdir($uploadDir);
}if (isset($_REQUEST["name"])) {
    $fileName = $_REQUEST["name"];
    $title = $fileName;
    $fileName = iconv('utf-8', 'gb2312', $fileName);
    $fName = $_COOKIE[fileName];
    $time = time();
    $fileName1 = urlencode($fileName);
    $fileName1 = json_encode(iconv('gb2312', 'utf-8', $fileName1));
    $fileName1 = base64_encode($fileName1);
    $fName1 = urlencode($fName);
    $fName1 = json_encode(iconv('gb2312', 'utf-8', $fName1));
    $fName1 = base64_encode($fName1);
    if ($fileName1 == $fName1) {
        $fileurl = $_COOKIE[fileurl];
        $fileName = str_replace(".", "#.", $fileName);
        $fileName = preg_replace("/#[^>]+#/", $fileurl, "#" . $fileName);
    } else {
        setcookie('fileName', $fileName, time() + 1200, "/");
        setcookie('fileurl', $time, time() + 1200, "/");
        $fileName = str_replace(".", "#.", $fileName);
        $fileName = preg_replace("/#[^>]+#/", $time, "#" . $fileName);
    }
} elseif (!empty($_FILES)) {
    $fileName = $_FILES["file"]["name"];
} else {
    $fileName = uniqid("file_");
}$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
$uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
if ($cleanupTargetDir) {
    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
    }while (($file = readdir($dir)) !== false) {
        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
        if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
            continue;
        }if (preg_match('/\\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
            @unlink($tmpfilePath);
        }
    }closedir($dir);
}if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}if (!empty($_FILES)) {
    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
    }if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
} else {
    if (!$in = @fopen("php://input", "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
}while ($buff = fread($in, 4096)) {
    fwrite($out, $buff);
}@fclose($out);
@fclose($in);
rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
$index = 0;
$done = true;
for ($index = 0; $index < $chunks; $index++) {
    if (!file_exists("{$filePath}_{$index}.part")) {
        $done = false;
        break;
    }
}if ($done) {
    if (!$out = @fopen($uploadPath, "wb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
    }if (flock($out, LOCK_EX)) {
        for ($index = 0; $index < $chunks; $index++) {
            if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                break;
            }while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
            }@fclose($in);
            @unlink("{$filePath}_{$index}.part");
        }flock($out, LOCK_UN);
    }@fclose($out);
}
//$domainurl = base64_decode('aHR0cDovL29wZW4ueGNnZS5jbi9zaG91cXVhbi50eHQ=');
//$origin = file_get_contents($domainurl);
$domainurl = $_SERVER['HTTP_HOST'];
$strurl = str_replace('http://', '', $domainurl);
$strurldomain = explode('/', $strurl);
$domain = $strurldomain[0];
if (!empty($domain)) {
    $domainArr = explode('.', $domain);
    if ($domainArr[2]) {
        $zdomain = $domainArr[1] . '.' . $domainArr[2];
    } else {
        $zdomain = $domainArr[0] . '.' . $domainArr[1];
    }
//    if (!preg_match('/' . $zdomain . '/i', $origin)) {
//        $sqnr = "域名未授权，无法正常使用！";
//        $sqnr = iconv('gb2312', 'utf-8', $sqnr);
//        die('{"jsonrpc" : "2.0", "fileurl" : "' . $sqnr . '", "title" : "' . $sqnr . '", "id" : "id"}');
//        exit;
//    }
}$uploadPath = str_replace("../", "/", $uploadDir . "/" . $fileName);
$title = str_replace(".", "#.", $title);
$title = preg_replace("/#[^>]+#/", "", $title . "#");
$host = $_SERVER['HTTP_HOST'];
die('{"jsonrpc" : "2.0", "fileurl" : "http://' . $host . $uploadPath . '", "title" : "' . $title . '", "id" : "id"}'); ?>