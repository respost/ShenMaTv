<?php 
if($_COOKIE[uid]==null){
echo "<script>alert('��Ա��ʧЧ�����µ�¼!');location.href='index.php'</script>";
exit;
}
$uploaddir = "../d/";//�����ļ�����Ŀ¼ ע�����/ 
$type=array("jpg","gif","bmp","jpeg","png","mp4");//���������ϴ��ļ������� 
$patch="admin/";//��������·�� 
$p=$_POST[id];
//��ȡ�ļ���׺������ 
function fileext($filename) 
{ 
return substr(strrchr($filename, '.'), 1); 
} 
//��������ļ������� 
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
//�ж��ļ����� 
if(!in_array(strtolower(fileext($_FILES['fm_file']['name'])),$type)) 
{ 
$text=implode(",",$type); 

} 
//����Ŀ���ļ����ļ��� 
else{ 
$filename=explode(".",$_FILES['fm_file']['name']); 
do 
{ 

$filename[0]=random(12); //������������� 
$name=implode(".",$filename); 
$uploadfile2=$uploaddir.$name; 
$uploadfile="d/".$name; 


} 

while(file_exists($uploadfile2)); 

if (move_uploaded_file($_FILES['fm_file']['tmp_name'],$uploadfile2)) 
{ 
if(is_uploaded_file($_FILES['fm_file']['tmp_name'])) 
{ 

echo "�ϴ�ʧ��!"; 
} 
else 
{//���ͼƬԤ�� 

} 
} 
}

?> 