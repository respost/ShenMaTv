<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$userid=$_COOKIE[uid];
if($userid==null){
	echo "<script>location.href='login.php'</script>";
	exit;
}else{
	//����������
	$id=$_POST[id];
	$content=$_POST[content];
	$phone=$_POST[phone];
	$email=$_POST[email];
	if($id&&$content&&$phone&&$email){
		$type="(`id`, `content`, `phone`, `email`,`uid`) VALUES (null,'$content','$phone','$email','$id')"; 
		dbinsert(uboidea,$type);
		echo msglayerurl("�ύ�ɹ���",8,"/user/");
	}else{
		echo msglayer("�ύʧ��",8);		
	}
//��ѯ�û���Ϣ
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);	
?>
<!DOCTYPE html>
<html>
<head>
<title>��Ա����-�������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script language="javascript" src="/js/Comm.js"></script>
<?php include_once('../include/css.php'); ?> 
<style>
.feed_box{
	background: #fff;
	padding:3%;;
}
.feed_box a{
	color: #17bd88;
    font-style: normal;
}
.promt{font-size:10px;text-indent: 20px;line-height: 20px;}
.regwrong{background:url(../images/reg_icon_wrong.png) 0 4px no-repeat; color:#F00;}
.regok{background:url(../images/reg_icon_ok.png) 0 4px no-repeat; color:#096;}
.aui-flexView {
    width: 100%;
    height: 100%;
    margin: 0 auto;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}
.aui-view-box {
    padding: 1rem;
}
.aui-view-box-item h2 {
    font-size: 0.8rem;
    color: #484848;
    padding: 0.5rem 0;
}
.aui-view-box-item textarea {
    background: #f4f4f4;
    border-radius: 5px;
    padding: 0.8rem;
    border: none;
    width: 100%;
    font-size: 0.8rem;
    resize: none;
    height: 8rem;
}
.aui-view-box-item input {
    background: #f4f4f4;
    border-radius: 5px;
    padding: 0.8rem;
    border: none;
    width: 100%;
    font-size: 0.8rem;
    resize: none;
    margin: 0.3rem 0;
}
.info {
    color: #bdbdbd;
    font-size: 0.8rem;
    padding-bottom: 1rem;
}
.aui-btn-submit button {
    text-align: center;
    position: relative;
    border: none;
    pointer-events: auto;
    width: 100%;
    display: block;
    font-size: 0.8rem;
    height: 3rem;
    line-height: 3rem;
    margin-top: 0.5rem;
    border-radius: 50px;
    background: #17bd88;
    color: #fff;
}
</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">�������</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="��������Ƶ�ؼ���" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>����
</button>
</div>
</form>
</div>
<?php include_once('../include/nav_s.php'); ?>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1></h1>
</header>
<section class="feed_box" style="margin-top: 2.2%;"> 
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
			<form id="Form1" method="post" action="" style="padding:0 10px;" onSubmit="return CheckForm();" target="msgubotj">
				<input name="id" type="hidden" value="<?php echo $neirong[id]?>">
                <div class="aui-view-box">
                    <div class="aui-view-box-item" style="position: relative;">
                        <h2>�����������:</h2>
                        <textarea name="content" id="content" placeholder="��������������,������200������" ></textarea>
						<p class="textarea-numberbar" style="position: absolute;right: 5px;bottom: 0;"><em class="textarea-length">0</em>/200</p>
						<p id="content_promt" class="promt"></p>
                    </div>
                    <div class="aui-view-box-item">
                        <h2>������ϵ��ʽ:</h2>
                        <input name="phone" type="text" value="<?php echo $neirong[tel]; ?>" placeholder="����绰����"><p id="phone_promt" class="promt"></p>
                        <input name="email" type="text" value="<?php echo $neirong[email]; ?>" placeholder="�����������"><p id="email_promt" class="promt"></p>
                    </div>
                    <div class="aui-view-box-item">
                        <p class="info">����������ϵ��ʽ���Ա������˽������ʱ�����ͽ����������������ϵ���߿ͷ���</p>
                    </div>
                    <div class="aui-btn-submit">
                        <button type="submit" id="submit">�ύ����</button>
                    </div>
				</div>
			</form>
			<div style="clear: both;"></div>
			<p align="center" style="font-size:13px;">���������ˣ���� <a href="https://wpa.qq.com/msgrd?v=3&uin=240034502&site=qqq&menu=yes" target="_blank";>���߿ͷ�</a> </p>         
</section>
<script language="javascript">
	//��������ʱ�������ַ�����
    $("#content").bind('input propertychange',function () {
        var content=$(this).val();
        $(".textarea-length").html(content.length);
		if(content.length>=200){
			$("#content_promt").show();
			$("#content_promt").addClass("regwrong").removeClass("regok");
			$("#content_promt").html("�������ݳ��Ȳ��ܳ���200");
		}else{
			$("#content_promt").hide();
		}
    });
	function CheckForm()
	{		
		if(!CheckContent())
			return false;
		if(!checkPhone())
			return false;
		if(!checkEmail())
			return false;
	}
	//��֤����
	function CheckContent(){
		var content=Form1.content.value;
		var regContent=/\S/;
		if(regContent.test(content)==false){
			$("#content_promt").show();
			$("#content_promt").addClass("regwrong").removeClass("regok");
			$("#content_promt").html("����������ݲ���Ϊ�գ�");
			return false;
		}else{
			if(content.length>=200){
			$("#content_promt").show();
			$("#content_promt").addClass("regwrong").removeClass("regok");
			$("#content_promt").html("�������ݳ��Ȳ��ܳ���200");
			return false;
			}else{
				$("#content_promt").hide();
				$("#content_promt").addClass("regok").removeClass("regwrong");
				return true;
			}
		}
		
	}
	//��֤����
	function checkEmail(){
		var email=Form1.email.value;
		var regEmail=/^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;
		if(regEmail.test(email)==false){
			$("#email_promt").show();
			$("#email_promt").addClass("regwrong").removeClass("regok");
			$("#email_promt").html("�����ʽ����ȷ�����磺qs@mail.com");
			return false;
		}else{
			$("#email_promt").hide();
			return true;
		}
	}
	//��֤�ֻ�
	function checkPhone(){
		var phone=Form1.phone.value;
		var regPhone=/^1[0-9]{10}$/;	
		if(regPhone.test(phone)==false){
			$("#phone_promt").show();
			$("#phone_promt").addClass("regwrong").removeClass("regok");
			$("#phone_promt").html("�ֻ�����ֻ����1��ͷ��11λ����");
			return false;
		}else{
			$("#phone_promt").hide();
			return true;
		}
	}
</script>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 