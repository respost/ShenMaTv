<?php
//-------------- �û���غ��� ----------------

//�Ƿ��½
function islogin($uname='',$urnd=''){
	global $set_username,$set_outtime;
	$username=$uname?$uname:getcvar('bakusername');
	$rnd=$urnd?$urnd:getcvar('bakrnd');
	if(empty($username)||empty($rnd))
	{
		printerror("NotLogin","index.php");
	}
	if($username<>$set_username)
	{
		printerror("NotLogin","index.php");
	}
	Ebak_CHCookieRnd($username,$rnd);
	$time=time();
	if($time-getcvar('baklogintime')>$set_outtime*60)
	{
		printerror("OutLogintime","index.php");
	}
	esetcookie("baklogintime",$time,0);
	$lr['username']=$username;
	$lr['rnd']=$rnd;
	return $lr;
}

//����COOKIE��֤
function Ebak_SCookieRnd($username,$rnd){
	global $set_loginrnd;
	$ckpass=md5(md5($rnd.$set_loginrnd).'-'.$rnd.'-'.$username.'-');
	esetcookie("loginebakckpass",$ckpass,0);
}

//��֤COOKIE��֤
function Ebak_CHCookieRnd($username,$rnd){
	global $set_loginrnd;
	$ckpass=md5(md5($rnd.$set_loginrnd).'-'.$rnd.'-'.$username.'-');
	if($ckpass<>getcvar('loginebakckpass'))
	{
		printerror("NotLogin","index.php");
	}
}

//�˳�ϵͳ
function LoginOut(){
	esetcookie("bakusername","",0);
	esetcookie("bakrnd","",0);
	esetcookie("loginebakckpass","",0);
	esetcookie("baklogintime","",0);
	printerror("ExitSuccess","index.php");
}

//��½ϵͳ
function login($lusername,$lpassword,$key,$lifetime=0){
	global $set_username,$set_password,$set_loginauth,$set_loginkey;
	if(empty($lusername)||empty($lpassword))
	{
		printerror("EmptyLoginUser","index.php");
	}
	//��֤��
	if(!$set_loginkey)
	{
		if($key<>getcvar('checkkey')||empty($key))
		{
			printerror("FailLoginKey","index.php");
		}
	}
	if(md5($lusername)<>md5($set_username)||md5($lpassword)<>$set_password)
	{
		printerror("ErrorUser","index.php");
	}
	//��֤��
	if($set_loginauth&&$set_loginauth!=$_POST['loginauth'])
	{
		printerror("ErrorLoginAuth","index.php");
	}
	$logintime=time();
	$rnd=make_password(12);
	$s1=esetcookie("bakusername",$lusername,0);
	$s2=esetcookie("bakrnd",$rnd,0);
	$s3=esetcookie("baklogintime",$logintime,0);
	Ebak_SCookieRnd($lusername,$rnd);
	if(!$s1||!$s2)
	{
		printerror("NotOpenCookie","index.php");
	}
	printerror("LoginSuccess","admin.php");
}


//-------------- ���ú��� ----------------

//������ʾ
function printerror($error="",$gotourl="",$ecms=0){
	global $empire,$public_r,$editor;
	if($editor==1){$a="../";}
	elseif($editor==2){$a="../../";}
	elseif($editor==3){$a="../../../";}
	else{$a="";}
	if(strstr($gotourl,"(")||empty($gotourl))
	{
		$gotourl_js="history.go(-1)";
		$gotourl="javascript:history.go(-1)";
	}
	else
	{$gotourl_js="self.location.href='$gotourl';";}
	if(empty($error))
	{$error="DbError";}
	if($ecms==0)
	{
		@include $a.LoadLang("m.php");
		$error=$message_r[$error];
		@include $a.LoadAdminTemp('message.php');
	}
	elseif($ecms==9)//�����Ի���
	{
		@include $a.LoadLang("m.php");
		$error=$message_r[$error];
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
	}
	exit();
}

//�ַ���ȡ
function sub_str($title,$lengh){
	if(strlen($title)>$lengh)
	{
		$pp=2;
		$len=strlen($title);
		if($len%2<>0)
		{$pp=1;}
		$title=substr($title,0,$lengh-$pp);
		$title=$title.' ��';
	}
	return $title;
}

//ȡ���ļ���չ��
function GetFiletype($filename){
	$filer=explode(".",$filename);
	$count=count($filer)-1;
	return strtolower(".".$filer[$count]);
}

//�ַ���ȡ����2
function sub($Modi_Str,$start,$length,$mode = false){ 
	$n = 0;
	for($i=0;$i<$start;$i++){ 
		if(ord(substr($Modi_Str,$i,1))>0xa0){
			if($mode){
				$start++;
				$i++;
			}
			$n++;
		}
	}
	if(!$mode)$start = $start + $n%2;
	$The_length = $start+$length;
	for($i=$start;$i<$The_length;$i++){ 
		if(ord(substr($Modi_Str,$i,1))>0xa0){ 
			$The_Str.=substr($Modi_Str,$i,2); 
			$i++;
			if($mode) $The_length++;
		}else{ 
			$The_Str.=substr($Modi_Str,$i,1); 
		}
	}
	return $The_Str;
}

//ȡ�������
function make_password($pw_length){
	$low_ascii_bound=50;
	$upper_ascii_bound=122;
	$notuse=array(58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
	while($i<$pw_length)
	{
		mt_srand((double)microtime()*1000000);
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}

//ɾ���ļ�
function DelFiletext($filename){
	@unlink($filename);
}

//ȡ���ļ�����
function ReadFiletext($filepath){
	$htmlfp=@fopen($filepath,"r");
	while($data=@fread($htmlfp,1000))
	{
		$string.=$data;
	}
	@fclose($htmlfp);
	return $string;
}

//д�ļ�
function WriteFiletext($filepath,$string){
	global $filechmod;
	$string=stripSlashes($string);
	$fp=@fopen($filepath,"w");
	@fputs($fp,$string);
	@fclose($fp);
	if(empty($filechmod))
	{
		@chmod($filepath,0777);
	}
}

//д�ļ�
function WriteFiletext_n($filepath,$string){
	global $filechmod;
	$fp=@fopen($filepath,"w");
	@fputs($fp,$string);
	@fclose($fp);
	if(empty($filechmod))
	{
		@chmod($filepath,0777);
	}
}

//����Ŀ¼����
function DoMkdir($path){
	global $public_r;
	//����������
	if(!file_exists($path))
	{
		//��ȫģʽ
		if($public_r[phpmode])
		{
			$pr[0]=$path;
			FtpMkdir($ftpid,$pr);
			$mk=1;
		}
		else
		{
			$mk=@mkdir($path,0777);
		}
		@chmod($path,0777);
		if(empty($mk))
		{
			printerror("NotMkdir","history.go(-1)");
		}
	}
	return true;
}

//�滻Ŀ¼ֵ
function RepPathStr($path){
	$path=str_replace("\\","",$path);
	$path=str_replace("/","",$path);
	return $path;
}

//ʱ��ת��
function ToChangeUseTime($time){
	global $fun_r;
	$usetime=time()-$time;
	if($usetime<60)
	{
		$tstr=$usetime.$fun_r['TimeSecond'];
	}
	else
	{
		$usetime=round($usetime/60);
		$tstr=$usetime.$fun_r['TimeMinute'];
	}
	return $tstr;
}

//ת����С
function Ebak_ChangeSize($size){
	if($size<1024)
	{
		$str=$size." B";
	}
	elseif($size<1024*1024)
	{
		$str=round($size/1024,2)." KB";
	}
	elseif($size<1024*1024*1024)
	{
		$str=round($size/(1024*1024),2)." MB";
	}
	else
	{
		$str=round($size/(1024*1024*1024),2)." GB";
	}
	return $str;
}

//ɾ��Ŀ¼����
function DelPath($DelPath){
	include("class/delpath.php");
	$wm_chief=new del_path();
	$wm_chief_ok=$wm_chief->wm_chief_delpath($DelPath);
	return $wm_chief_ok;
}

//���Ŀ¼
function ZipFile($path,$zipname){
	global $bakpath,$bakzippath;
	@include("class/phpzip.inc.php");
	$z=new PHPZip(); //�½���һ��zip����
    $z->Zip($bakpath."/".$path,$bakzippath."/".$zipname); //���ָ��Ŀ¼
}

//ѹ��Ŀ¼
function Ebak_Dozip($path){
	global $bakpath,$bakzippath;
	if(strstr($path,".."))
	{printerror("DelPathNotExists","history.go(-1)",9);}
	if(empty($path))
	{
		printerror("DelPathNotExists","history.go(-1)",9);
    }
	$mypath=$bakpath."/".$path;
	if(!file_exists($mypath))
	{
		printerror("DelPathNotExists","history.go(-1)",9);
	}
	$zipname=$path.".zip";
	ZipFile($path,$zipname);
	echo"<script>self.location.href='DownZip.php?f=$zipname&p=$path';</script>";
}

//ȥ��adds
function Ebak_ClearAddsData($data){
	$magic_quotes_gpc=@get_magic_quotes_gpc();
	if($magic_quotes_gpc)
	{
		$data=stripSlashes($data);
	}
	return $data;
}


//-------------- ���ݿ⺯�� ----------------

//--------------����
//��ʹ������
function Ebak_DoEbak($add){
	global $empire,$bakpath,$fun_r,$phome_db_ver;
	$dbname=RepPostVar($add['mydbname']);
	if(empty($dbname))
	{
		printerror("NotChangeDb","history.go(-1)");
	}
	$tablename=$add['tablename'];
	$count=count($tablename);
	if(empty($count))
	{
		printerror("EmptyChangeTb","history.go(-1)");
	}
	$add['baktype']=(int)$add['baktype'];
	$add['filesize']=(int)$add['filesize'];
	$add['bakline']=(int)$add['bakline'];
	$add['autoauf']=(int)$add['autoauf'];
	if((!$add['filesize']&&!$add['baktype'])||(!$add['bakline']&&$add['baktype']))
	{
		printerror("EmptyBakFilesize","history.go(-1)");
	}
	//Ŀ¼��
	if(empty($add['mypath']))
	{
		$add['mypath']=$dbname."_".date("YmdHis");
	}
    DoMkdir($bakpath."/".$add['mypath']);
	//����˵���ļ�
	$readme=$add['readme'];
	$rfile=$bakpath."/".$add['mypath']."/readme.txt";
	$readme.="\r\n\r\nBaktime: ".date("Y-m-d H:i:s");
	WriteFiletext_n($rfile,$readme);

	$b_table="";
	$d_table="";
	for($i=0;$i<$count;$i++)
	{
		$b_table.=$tablename[$i].",";
		$d_table.="\$tb[".$tablename[$i]."]=0;\r\n";
    }
	//ȥ�����һ��,
	$b_table=substr($b_table,0,strlen($b_table)-1);
	$bakstru=(int)$add['bakstru'];
	$bakstrufour=(int)$add['bakstrufour'];
	$beover=(int)$add['beover'];
	$waitbaktime=(int)$add['waitbaktime'];
	$bakdatatype=(int)$add['bakdatatype'];
	if($add['insertf']=='insert')
	{
		$insertf='insert';
	}
	else
	{
		$insertf='replace';
	}
	if($phome_db_ver=='4.0'&&$add['dbchar']=='auto')
	{
		$add['dbchar']='';
	}
	$string="<?php
	\$b_table=\"".$b_table."\";
	".$d_table."
	\$b_baktype=".$add['baktype'].";
	\$b_filesize=".$add['filesize'].";
	\$b_bakline=".$add['bakline'].";
	\$b_autoauf=".$add['autoauf'].";
	\$b_dbname=\"".$dbname."\";
	\$b_stru=".$bakstru.";
	\$b_strufour=".$bakstrufour.";
	\$b_dbchar=\"".addslashes($add['dbchar'])."\";
	\$b_beover=".$beover.";
	\$b_insertf=\"".addslashes($insertf)."\";
	\$b_autofield=\",".addslashes($add['autofield']).",\";
	\$b_bakdatatype=".$bakdatatype.";
	?>";
	$cfile=$bakpath."/".$add['mypath']."/config.php";
	WriteFiletext_n($cfile,$string);
	if($add['baktype'])
	{
		$phome='BakExeT';
	}
	else
	{
		$phome='BakExe';
	}
	echo $fun_r['StartToBak']."<script>self.location.href='phomebak.php?phome=$phome&t=0&s=0&p=0&mypath=$add[mypath]&waitbaktime=$waitbaktime';</script>";
	exit();
}

//ִ�б���(���ļ���С)
function Ebak_BakExe($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$stime=0){
	global $empire,$bakpath,$limittype,$fun_r;
	if(empty($mypath))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$waitbaktime=(int)$_GET['waitbaktime'];
	if(empty($stime))
	{
		$stime=time();
	}
	$header="<?php
require(\"../../inc/header.php\");
";
	$footer="
require(\"../../inc/footer.php\");
?>";
	$btb=explode(",",$b_table);
	$count=count($btb);
	$t=(int)$t;
	$s=(int)$s;
	$p=(int)$p;
	//�������
	if($t>=$count)
	{
		echo"<script>alert('".$fun_r['BakSuccess']."\\n\\n".$fun_r['TotalUseTime'].ToChangeUseTime($stime)."');self.location.href='ChangeDb.php';</script>";
		exit();
    }
	$dumpsql=Ebak_ReturnVer();
	//ѡ�����ݿ�
	$u=$empire->query("use `$b_dbname`");
	//����
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//�ܼ�¼��
			$num=$limittype?-1:$status_r['Rows'];
		}
		else
		{
			$collation=$_GET['collation'];
			DoSetDbChar($collation);
			$num=(int)$alltotal;
		}
		$dumpsql.=Ebak_ReturnSetNames($collation);
	}
	else
	{
		DoSetDbChar($b_dbchar);
		if(empty($s))
		{
			//�ܼ�¼��
			if($limittype)
			{
				$num=-1;
			}
			else
			{
				$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
				$num=$status_r['Rows'];
			}
		}
		else
		{
			$num=(int)$alltotal;
		}
	}
	//�������ݿ�ṹ
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$num");
	//ȡ���ֶ���
	if(empty($fnum))
	{
		$return_fr=Ebak_ReturnTbfield($b_dbname,$btb[$t],$b_autofield);
		$fieldnum=$return_fr['num'];
		$noautof=$return_fr['autof'];
	}
	else
	{
		$fieldnum=$fnum;
		$noautof=$thenof;
	}
	//��������
	$inf='';
	if($b_beover==1)
	{
		$inf='('.Ebak_ReturnInTbfield($b_dbname,$btb[$t]).')';
	}
	//ʮ������
	$hexf='';
	if($b_bakdatatype==1)
	{
		$hexf=Ebak_ReturnInStrTbfield($b_dbname,$btb[$t]);
	}
	$b=0;
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$s++;
		$dumpsql.="E_D(\"".$b_insertf." into `".$btb[$t]."`".$inf." values(";
		$first=1;
		for($i=0;$i<$fieldnum;$i++)
		{
			//���ֶ�
			if(empty($first))
			{
				$dumpsql.=',';
			}
			else
			{
				$first=0;
			}
			$myi=$i+1;
			if(!isset($r[$i])||strstr($noautof,','.$myi.','))
			{
				$dumpsql.='NULL';
			}
			else
			{
				$dumpsql.=Ebak_ReSqlFtext($r[$i],$b_bakdatatype,$myi,$hexf);
			}
		}
		$dumpsql.=");\");\r\n";
		//�Ƿ񳬹�����
		if(strlen($dumpsql)>=$b_filesize*1024)
		{
			$p++;
			$sfile=$path."/".$btb[$t]."_".$p.".php";
			$dumpsql=$header.$dumpsql.$footer;
			WriteFiletext_n($sfile,$dumpsql);
			$empire->free($sql);
			//echo $fun_r['BakOneDataSuccess'].Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phomebak.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime';</script>";

			echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phomebak.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">".$fun_r['BakOneDataSuccess'].Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
			exit();
		}
	}
	//���һ������
	if(empty($p)||$b==1)
	{
		$p++;
		$sfile=$path."/".$btb[$t]."_".$p.".php";
		$dumpsql=$header.$dumpsql.$footer;
		WriteFiletext_n($sfile,$dumpsql);
	}
	Ebak_RepFilenum($p,$btb[$t],$path);
	$t++;
	$empire->free($sql);
	//������һ����
	//echo $fun_r['OneTableBakSuccOne'].$btb[$t].$fun_r['OneTableBakSuccTwo']."<script>self.location.href='phomebak.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phomebak.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$fun_r['OneTableBakSuccOne'].$btb[$t-1].$fun_r['OneTableBakSuccTwo'];
	exit();
}

//ִ�б��ݣ�����¼��
function Ebak_BakExeT($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$auf='',$aufval=0,$stime=0){
	global $empire,$bakpath,$limittype,$fun_r;
	if(empty($mypath))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$waitbaktime=(int)$_GET['waitbaktime'];
	if(empty($stime))
	{
		$stime=time();
	}
	$header="<?php
require(\"../../inc/header.php\");
";
	$footer="
require(\"../../inc/footer.php\");
?>";
	$btb=explode(",",$b_table);
	$count=count($btb);
	$t=(int)$t;
	$s=(int)$s;
	$p=(int)$p;
	//�������
	if($t>=$count)
	{
		echo"<script>alert('".$fun_r['BakSuccess']."\\n\\n".$fun_r['TotalUseTime'].ToChangeUseTime($stime)."');self.location.href='ChangeDb.php';</script>";
		exit();
    }
	$dumpsql=Ebak_ReturnVer();
	//ѡ�����ݿ�
	$u=$empire->query("use `$b_dbname`");
	//����
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//�ܼ�¼��
			$num=$limittype?-1:$status_r['Rows'];
		}
		else
		{
			$collation=$_GET['collation'];
			DoSetDbChar($collation);
			$num=(int)$alltotal;
		}
		$dumpsql.=Ebak_ReturnSetNames($collation);
	}
	else
	{
		DoSetDbChar($b_dbchar);
		if(empty($s))
		{
			//�ܼ�¼��
			if($limittype)
			{
				$num=-1;
			}
			else
			{
				$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
				$num=$status_r['Rows'];
			}
		}
		else
		{
			$num=(int)$alltotal;
		}
	}
	//�������ݿ�ṹ
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	//ȡ���ֶ���
	if(empty($fnum))
	{
		$return_fr=Ebak_ReturnTbfield($b_dbname,$btb[$t],$b_autofield);
		$fieldnum=$return_fr['num'];
		$noautof=$return_fr['autof'];
		$auf=$return_fr['auf'];
	}
	else
	{
		$fieldnum=$fnum;
		$noautof=$thenof;
	}
	//�Զ�ʶ��������
	$aufval=(int)$aufval;
	if($b_autoauf==1&&$auf)
	{
		$sql=$empire->query("select * from `".$btb[$t]."` where ".$auf.">".$aufval." order by ".$auf." limit $b_bakline");
	}
	else
	{
		$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$b_bakline");
	}
	//��������
	$inf='';
	if($b_beover==1)
	{
		$inf='('.Ebak_ReturnInTbfield($b_dbname,$btb[$t]).')';
	}
	//ʮ������
	$hexf='';
	if($b_bakdatatype==1)
	{
		$hexf=Ebak_ReturnInStrTbfield($b_dbname,$btb[$t]);
	}
	$b=0;
	while($r=$empire->fetch($sql))
	{
		if($auf)
		{
			$lastaufval=$r[$auf];
		}
		$b=1;
		$s++;
		$dumpsql.="E_D(\"".$b_insertf." into `".$btb[$t]."`".$inf." values(";
		$first=1;
		for($i=0;$i<$fieldnum;$i++)
		{
			//���ֶ�
			if(empty($first))
			{
				$dumpsql.=',';
			}
			else
			{
				$first=0;
			}
			$myi=$i+1;
			if(!isset($r[$i])||strstr($noautof,','.$myi.','))
			{
				$dumpsql.='NULL';
			}
			else
			{
				$dumpsql.=Ebak_ReSqlFtext($r[$i],$b_bakdatatype,$myi,$hexf);
			}
		}
		$dumpsql.=");\");\r\n";
	}
	if(empty($b))
	{
		//���һ������
		if(empty($p))
		{
			$p++;
			$sfile=$path."/".$btb[$t]."_".$p.".php";
			$dumpsql=$header.$dumpsql.$footer;
			WriteFiletext_n($sfile,$dumpsql);
		}
		Ebak_RepFilenum($p,$btb[$t],$path);
		$t++;
		$empire->free($sql);
		//������һ����
		//echo $fun_r['OneTableBakSuccOne'].$btb[$t].$fun_r['OneTableBakSuccTwo']."<script>self.location.href='phomebak.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

		echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phomebak.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$fun_r['OneTableBakSuccOne'].$btb[$t-1].$fun_r['OneTableBakSuccTwo'];
		exit();
	}
	//������һ��
	$p++;
	$sfile=$path."/".$btb[$t]."_".$p.".php";
	$dumpsql=$header.$dumpsql.$footer;
	WriteFiletext_n($sfile,$dumpsql);
	$empire->free($sql);
	//echo $fun_r['BakOneDataSuccess'].Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phomebak.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phomebak.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">".$fun_r['BakOneDataSuccess'].Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
	exit();
}

//������ݽ�����
function Ebak_EchoBakSt($tbname,$tbnum,$tb,$rnum,$r){
	$table=($tb+1).'/'.$tbnum;
	$record=$r;
	if($rnum!=-1)
	{
		$record=$r.'/'.$rnum;
	}
	?>
	<br><br>
	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
		<tr><td height="25">Table Name&nbsp;:&nbsp;<b><?=$tbname?></b></td></tr>
		<tr><td height="25">Table&nbsp;:&nbsp;<b><?=$table?></b></td></tr>
		<tr><td height="25">Record&nbsp;:&nbsp;<b><?=$record?></b></td></tr>
	</table><br><br>
	<?
}

//����ָ�������
function Ebak_EchoReDataSt($tbname,$tbnum,$tb,$pnum,$p){
	$table=($tb+1).'/'.$tbnum;
	$record=$p.'/'.$pnum;
	?>
	<br><br>
	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
		<tr><td height="25">Table Name&nbsp;:&nbsp;<b><?=$tbname?></b></td></tr>
		<tr><td height="25">Table&nbsp;:&nbsp;<b><?=$table?></b></td></tr>
		<tr><td height="25">File&nbsp;:&nbsp;<b><?=$record?></b></td></tr>
	</table><br><br>
	<?
}

//ȡ�ñ��¼��
function Ebak_GetTotal($dbname,$tbname){
	global $empire;
	/*
	$tr=$empire->fetch1("select count(*) AS total from ".$btb[$t]);
	$num=$tr[total];
	*/
	$tr=$empire->fetch1("SHOW TABLE STATUS LIKE '".$tbname."';");
	return $tr;
}

//�����ַ���set
function Ebak_GetSetChar($char){
	global $empire;
	if(empty($char))
	{
		return '';
	}
	$r=$empire->fetch1("SHOW COLLATION LIKE '".$char."';");
	return $r['Charset'];
}

//���ر��ֶ���Ϣ
function Ebak_ReturnTbfield($dbname,$tbname,$autofield){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$i=0;//�ֶ���
	$autof=",";//ȥ�������ֶ��б�
	$f='';//�����ֶ���
	while($r=$empire->fetch($sql))
	{
		$i++;
		if(strstr($autofield,",".$tbname.".".$r[Field].","))
		{
			$autof.=$i.",";
	    }
		if($r['Extra']=='auto_increment')
		{
			$f=$r['Field'];
		}
    }
	$return_r['num']=$i;
	$return_r['autof']=$autof;
	$return_r['auf']=$f;
	return $return_r;
}

//���ز����ֶ�
function Ebak_ReturnInTbfield($dbname,$tbname){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$f='';
	$dh='';
	while($r=$empire->fetch($sql))
	{
		$f.=$dh.'`'.$r['Field'].'`';
		$dh=',';
    }
	return $f;
}

//�����ַ��ֶ�
function Ebak_ReturnInStrTbfield($dbname,$tbname){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$i=0;
	$f='';
	$dh='';
	while($r=$empire->fetch($sql))
	{
		$i++;
		if(!(stristr($r[Type],'char')||stristr($r[Type],'text')))
		{
			continue;
		}
		$f.=$dh.$i;
		$dh=',';
    }
	if($f)
	{
		$f=','.$f.',';
	}
	return $f;
}

//�ַ�����
function escape_str($str){
	$str=mysql_escape_string($str);
	$str=str_replace('\\\'','\'\'',$str);
	$str=str_replace("\\\\","\\\\\\\\",$str);
	$str=str_replace('$','\$',$str);
	return $str;
}

//�����ֶ�����
function Ebak_ReSqlFtext($str,$bakdatatype,$i,$tbstrf){
	if($bakdatatype==1&&!empty($str)&&strstr($tbstrf,','.$i.','))
	{
		$restr='0x'.bin2hex($str);
	}
	else
	{
		$restr='\''.escape_str($str).'\'';
	}
	return $restr;
}

//�滻�ļ���
function Ebak_RepFilenum($p,$table,$path){
	if(empty($p))
	{$p=0;}
	$file=$path."/config.php";
	$text=ReadFiletext($file);
	$rep1="\$tb[".$table."]=0;";
	$rep2="\$tb[".$table."]=".$p.";";
	$text=str_replace($rep1,$rep2,$text);
	WriteFiletext_n($file,$text);
}

//ִ��SQL
function E_D($sql){
	global $empire;
	$empire->query($sql);
}

//������
function E_C($sql){
	global $empire;
	$empire->query(Ebak_AddDbchar($sql));
}

//תΪMysql4.0��ʽ
function Ebak_ToMysqlFour($query){
	$exp="ENGINE=";
	if(!strstr($query,$exp))
	{
		return $query;
	}
	$exp1=" ";
	$r=explode($exp,$query);
	//ȡ�ñ�����
	$r1=explode($exp1,$r[1]);
	$returnquery=$r[0]."TYPE=".$r1[0];
	return $returnquery;
}

//�������ݿ�ṹ
function Ebak_Returnstru($table,$strufour){
	global $empire;
	$dumpsql.="E_D(\"DROP TABLE IF EXISTS `".$table."`;\");\r\n";
	//��������
	$usql=$empire->query("SET SQL_QUOTE_SHOW_CREATE=1;");
	//���ݱ�ṹ
	$r=$empire->fetch1("SHOW CREATE TABLE `$table`;");
	$create=str_replace("\"","\\\"",$r[1]);
	//תΪ4.0��ʽ
	if($strufour)
	{
		$create=Ebak_ToMysqlFour($create);
	}
	$dumpsql.="E_C(\"".$create."\");\r\n";
	return $dumpsql;
}

//�������ñ���
function Ebak_ReturnSetNames($char){
	if(empty($char))
	{
		return '';
	}
	$dumpsql="DoSetDbChar('".$char."');\r\n";
	return $dumpsql;
}

//ȥ���ֶ��еı���
function Ebak_ReplaceFieldChar($sql){
	global $phome_db_ver;
	if($phome_db_ver=='4.0'&&strstr($sql,' character set '))
	{
		$preg_str="/ character set (.+?) collate (.+?) /is";
		$sql=preg_replace($preg_str,' ',$sql);
	}
	return $sql;
}

//�ӱ���
function Ebak_AddDbchar($sql){
	global $phome_db_ver,$phome_db_char,$b_dbchar;
	//�ӱ���
	if($phome_db_ver>='4.1'&&!strstr($sql,'ENGINE=')&&($phome_db_char||$b_dbchar)&&$b_dbchar!='auto')
	{
		$dbcharset=$b_dbchar?$b_dbchar:$phome_db_char;
		$sql=Ebak_DoCreateTable($sql,$phome_db_ver,$dbcharset);
	}
	elseif($phome_db_ver=='4.0'&&strstr($sql,'ENGINE='))
	{
		$sql=Ebak_ToMysqlFour($sql);
	}
	//ȥ���ֶ��еı���
	$sql=Ebak_ReplaceFieldChar($sql);
	return $sql;
}

//����
function Ebak_DoCreateTable($sql,$mysqlver,$dbcharset){
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU","\\2",$sql));
	$type=in_array($type,array('MYISAM','HEAP'))?$type:'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU","\\1",$sql).
		($mysqlver>='4.1'?" ENGINE=$type DEFAULT CHARSET=$dbcharset":" TYPE=$type");
}

//���ذ�Ȩ��Ϣ
function Ebak_ReturnVer(){
	$string="
/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

";
	return $string;
}

//��������
function Ebak_ReData($add,$mypath){
	global $empire,$bakpath;
	if(empty($mypath)||empty($add[mydbname]))
	{
		printerror("EmptyReData","history.go(-1)");
	}
	$path=$bakpath."/".$mypath;
	if(!file_exists($path))
	{
		printerror("PathNotExists","history.go(-1)");
    }
	@include($path."/config.php");
	if(empty($b_table))
	{
		printerror("FailBakVar","history.go(-1)");
	}
	$waitbaktime=(int)$add['waitbaktime'];
	$btb=explode(",",$b_table);
	$nfile=$path."/".$btb[0]."_1.php?t=0&p=0&mydbname=$add[mydbname]&mypath=$mypath&waitbaktime=$waitbaktime";
	Header("Location:$nfile");
	exit();
}

//����SQL
function Ebak_DoRunQuery($sql,$mydbchar,$mydbver){
	$sql=str_replace("\r","\n",$sql);
	$ret=array();
	$num=0;
	foreach(explode(";\n",trim($sql)) as $query)
	{
		$queries=explode("\n",trim($query));
		foreach($queries as $query)
		{
			$ret[$num].=$query[0]=='#'||$query[0].$query[1]=='--'?'':$query;
		}
		$num++;
	}
	unset($sql);
	foreach($ret as $query)
	{
		$query=trim($query);
		if($query)
		{
			if(substr($query,0,12)=='CREATE TABLE')
			{
				mysql_query(Ebak_DoCreateTable($query,$mydbver,$mydbchar)) or die(mysql_error()."<br>".$query);
			}
			else
			{
				mysql_query($query) or die(mysql_error()."<br>".$query);
			}
		}
	}
}

//�ϴ��ļ�
function Ebak_DoTranFile($file,$newfile){
	$cp=@move_uploaded_file($file,$newfile);
	return $cp;
}

//�����Ƿ����
function Ebak_HaveFun($fun){
	if(function_exists($fun))
	{
		$word=1;
	}
	else
	{
		$word=0;
	}
	return $word;
}

//�Ƿ�֧��ICONV��
function Ebak_GetIconv(){
	$can=Ebak_HaveFun("iconv");
	return $can;
}

//����ת��
function Ebak_ChangeChar($str,$oldchar,$newchar){
	//�Ƿ�֧��iconv
	if(!Ebak_HaveFun("iconv"))
	{
		return $str;
	}
	if(!empty($newchar))
	{
		$str=iconv($oldchar,$newchar,$str);
	}
	return $str;
}

//��������Ŀ¼
function Ebak_ReturnLang(){
	global $ebaklang,$langcharr;
	$count=count($langcharr);
	$l='';
	for($i=0;$i<$count;$i++)
	{
		$f=explode(',',$langcharr[$i]);
		if(!file_exists('lang/'.$f[0]))
		{
			continue;
		}
		$select='';
		if($f[0]==$ebaklang)
		{
			$select=' selected';
		}
		$l.="<option value='".$i."'".$select.">".$f[2]." (".$f[1].")</option>";
	}
	return $l;
}

//ѡ������
function Ebak_ChangeLanguage($add){
	global $langcharr;
	$l=(int)$add['l'];
	if($langcharr[$l])
	{
		$lifetime=time()+365*24*3600;
		esetcookie('loginlangid',$l,$lifetime);
	}
	if(!$add['from'])
	{
		$add['from']='index.php';
	}
	echo"<script>parent.location.href='$add[from]';</script>";
	exit();
}

//�������ݿ�����б�
function Ebak_ReturnDbCharList($dbchar){
	global $dbcharr;
	$count=count($dbcharr);
	$c='';
	for($i=0;$i<$count;$i++)
	{
		$select='';
		if($dbcharr[$i]==$dbchar)
		{
			$select=' selected';
		}
		$c.="<option value='".$dbcharr[$i]."'".$select.">".$dbcharr[$i]."</option>";
	}
	return $c;
}

//����ת�򱸷�ҳ��
function Ebak_SetGotoBak($file){
	if(strstr($file,'.')||strstr($file,'/')||strstr($file,"\\"))
	{
		printerror("FailSetSavename","history.go(-1)");
	}
	@include('setsave/'.$file);
	Header("Location:ChangeTable.php?mydbname=$dmydbname&savefilename=$file");
	exit();
}

//ת��ָ�ҳ��
function Ebak_PathGotoRedata($path){
	global $bakpath;
	if(strstr($path,".."))
	{printerror("NotChangeDelPath","history.go(-1)");}
	if(!trim($path))
	{printerror("NotChangeDelPath","history.go(-1)");}
	$repath=$bakpath."/".$path;
	if(!file_exists($repath))
	{
		printerror("DelPathNotExists","history.go(-1)");
    }
	@include $repath.'/config.php';
	Header("Location:ReData.php?mydbname=$b_dbname&mypath=$path");
	exit();
}

//�滻�ַ�
function Ebak_RepInfoZZ($text,$exp,$enews=0){
	$text=str_replace("*","(.*?)",$text);
	$text=str_replace("[!--".$exp."--]","(.*?)",$text);
	//$text=str_replace("\\","\\\\",$text);
	//$text=str_replace("^","\^",$text);
	//$text=str_replace("\"","\"",$text);
	$text=str_replace("/","\/",$text);
	$text="/".$text."/is";
	return $text;
}

//�����滻��Ϣ
function Ebak_DoRepFiletextZz($oldword,$newword,$text){
	$zztext=Ebak_RepInfoZZ($oldword,"empire-bak-wm.chief-phome",0);
	$text=preg_replace($zztext,$newword,$text);
	return $text;
}
?>