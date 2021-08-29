<?php 
if($_COOKIE[uid]==null){
echo "<script>alert('会员已失效请重新登录!');location.href='index.php'</script>";
exit;
}
$uploaddir = "../d/";//设置文件保存目录 注意包含/ 
$type=array("jpg","gif","bmp","jpeg","png","mp4");//设置允许上传文件的类型 
$patch="admin/";//程序所在路径 
$p=$_POST[id];
//获取文件后缀名函数 
function fileext($filename) 
{ 
return substr(strrchr($filename, '.'), 1); 
} 
//生成随机文件名函数 
function random($length) 
{ 
$hash = ''; 
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 
$max = strlen($chars) - 1; 
mt_srand((double)microtime() * 1000000); 
for($i = 0; $i < $length; $i++) 
{ 
$hash .= $chars[mt_rand(0, $max)]; 
} 
return $hash; 
} 

$a=strtolower(fileext($_FILES['fm_file']['name'])); 
//判断文件类型 
if(!in_array(strtolower(fileext($_FILES['fm_file']['name'])),$type)) 
{ 
$text=implode(",",$type); 

} 
//生成目标文件的文件名 
else{ 
$filename=explode(".",$_FILES['fm_file']['name']); 
do 
{ 

$filename[0]=random(12); //设置随机数长度 
$name=implode(".",$filename); 
$uploadfile2=$uploaddir.$name; 
$uploadfile="d/".$name; 


} 

while(file_exists($uploadfile2)); 

if (move_uploaded_file($_FILES['fm_file']['tmp_name'],$uploadfile2)) 
{ 
if(is_uploaded_file($_FILES['fm_file']['tmp_name'])) 
{ 

echo "上传失败!"; 
} 
else 
{//输出图片预览 

} 
} 
}

?> 