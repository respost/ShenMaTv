<?
//ɾ��Ŀ¼
//��������wm_chiefԭ������Ҫת�أ���ע����������Դ(http://www.phome.net)
class  del_path
{
function  wm_chief_delpath($del_path)
{
if(!file_exists($del_path))//Ŀ��Ŀ¼����������
{echo"Directory not found.";return  false;}
$hand=@opendir($del_path);
$i=0;
while($file=@readdir($hand))
{$i++;
if ($file!="."&&$file!="..")
	{
   //Ŀ¼
if(is_dir($del_path."/".$file))
{
$del_s_path=$del_path."/".$file;
$this->wm_chief_delpath($del_s_path);
}
else
{
$del_file=$del_path."/".$file;
$this->wm_chief_file($del_file);
}
	}
}
@closedir($hand);
$this->wm_chief_path($del_path);
return  true;
}
//ɾ���ļ�
function  wm_chief_file($del_file)
{
@unlink($del_file);
}
//ɾ��Ŀ¼
function  wm_chief_path($del_path)
{
@rmdir($del_path);
}
}
//��������wm_chiefԭ������Ҫת�أ���ע����������Դ(http://www.phome.net)
?>