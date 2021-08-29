
var bloghost="";
var cookiespath="/";
var str00="";



//*********************************************************
// Ŀ�ģ�    ȫѡ
// ���룺    ��
// ���أ�    ��
//*********************************************************
function BatchSelectAll() {
	var aryChecks = document.getElementsByTagName("input");

	for (var i = 0; i < aryChecks.length; i++){
		if((aryChecks[i].type=="checkbox")&&(aryChecks[i].id.indexOf("edt")!==-1)){
			if(aryChecks[i].checked==true){
				aryChecks[i].checked=false;
			}
			else{
				aryChecks[i].checked=true;
			};
		}
	}
}
//*********************************************************




//*********************************************************
// Ŀ�ģ�    
// ���룺    ��
// ���أ�    ��
//*********************************************************
function BatchDeleteAll(objEdit) {

	objEdit=document.getElementById(objEdit);
	objEdit.value="";
	var aryChecks = document.getElementsByTagName("input");
	for (var i = 0; i < aryChecks.length; i++){
		if((aryChecks[i].type=="checkbox")&&(aryChecks[i].id.indexOf("edt")!==-1)){
			if(aryChecks[i].checked){
				objEdit.value=aryChecks[i].value+","+objEdit.value;
			}
		}
	}

}
//*********************************************************








//*********************************************************
// Ŀ�ģ�    ActiveLeftMenu
// ���룺    ��
// ���أ�    ��
//*********************************************************
function ActiveLeftMenu(name){

	name="#"+name;
	$("#leftmenu li").removeClass("on");
	$(name).parent().addClass("on");
	var s=$(name).children("span").css("background-image");
	if(s!==undefined){
		s=s.replace("1.png","2.png");
		$(name).children("span").css("background-image",s);
	}

}
//*********************************************************




//*********************************************************
// Ŀ�ģ�    ActiveTopMenu
// ���룺    ��
// ���أ�    ��
//*********************************************************
function ActiveTopMenu(name){

	name="#"+name;
	$("#topmenu li").removeClass("on");
	$(name).addClass("on");

}
//*********************************************************





//*********************************************************
// Ŀ�ģ�    ��������
// ���룺    ��
// ���أ�    ��
//*********************************************************
function bmx2table(){
	var class_=new Array("color2","color3","color4");
	var j=$("table tr:has(th)").addClass("color1");
    $("table").each(function(){
 		if(j.length==0){class_[1]="color2";class_[0]="color3";} 
		$(this).find("tr:not(:has(th)):even").removeClass(class_[0]).addClass(class_[1]);
		$(this).find("tr:not(:has(th)):odd").removeClass(class_[1]).addClass(class_[0]);
	})
	$("tr:not(:has(th))").mouseover(function(){$(this).addClass(class_[2])}).mouseout(function(){$(this).removeClass(class_[2])}); 
}; 
//*********************************************************





//*********************************************************
// Ŀ�ģ�    ������������
// ���룺    ��
// ���أ�    ��
//*********************************************************
function Batch2Tip(s){$("#batch p").html(s)}
function BatchContinue(){$("#batch p").before("<iframe style='width:20px;height:20px;' frameborder='0' scrolling='no' src='http://help.zzfhw.com/zb_system/cmd.asp?act=batch'></iframe>");$("#batch img").remove();}
function BatchBegin(){};
function BatchEnd(){};
function BatchNotify(){notify($("#batch p").html())}
function BatchCancel(){$("#batch iframe").remove();$("#batch p").before("<iframe style='width:20px;height:20px;' frameborder='0' scrolling='no' src='http://help.zzfhw.com/zb_system/cmd.asp?act=batch&cancel=true'></iframe>");};
//*********************************************************




//*********************************************************
// Ŀ�ģ�    CheckBox
// ���룺    ��
// ���أ�    ��
//*********************************************************
function changeCheckValue(obj){

	$(obj).toggleClass('imgcheck-on');

	if($(obj).hasClass('imgcheck-on')){
		$(obj).prev('input').val('True');
	}else{
		$(obj).prev('input').val('False');
	}

}
//*********************************************************




//*********************************************************
// Ŀ�ģ�    Notifications
// ���룺    ��
// ���أ�    ��
//*********************************************************
function notify(s){
	if (window.webkitNotifications) {
		if (window.webkitNotifications.checkPermission() == 0) {
			var zb_notifications = window.webkitNotifications.createNotification('http://help.zzfhw.com/zb_system/IMAGE/ADMIN/logo-16.png', 'Z-Blog��ʾ', s);
			zb_notifications.show();
			zb_notifications.onclick = function() {top.focus(),this.cancel();}
			zb_notifications.replaceId = 'Meteoric';
			setTimeout(function(){zb_notifications.cancel()},5000);
		} else {
			window.webkitNotifications.requestPermission(notify);
		}
	} 
}
//*********************************************************



function statistic(s){
	$("#statloading").show();
	$("#updatatime").hide();
	$.get("c_statistic.asp"+s,{},
		function(data){
			$("#tbStatistic").html(data);
			bmx2table();
			$("#statloading").hide();
			$("#updatatime").show();
		}
	);
}

function updateinfo(s){
	$("#infoloading").show();
	$.get("c_updateinfo.asp"+s,{},
		function(data){
			$("#tdUpdateInfo").html(data);
			$("#infoloading").hide();
		}
	);
}





//*********************************************************
// Ŀ�ģ�    
//*********************************************************
$(document).ready(function(){ 

	// Content box tabs:
	$('.content-box .content-box-content div.tab-content').hide(); // Hide the content divs
	$('ul.content-box-tabs li a.default-tab').addClass('current'); // Add the class "current" to the default tab
	$('.content-box-content div.default-tab').show(); // Show the div with class "default-tab"

	$('.content-box ul.content-box-tabs li a').click( // When a tab is clicked...
		function() { 
			$(this).parent().siblings().find("a").removeClass('current'); // Remove "current" class from all tabs
			$(this).addClass('current'); // Add class "current" to clicked tab
			var currentTab = $(this).attr('href'); // Set variable "currentTab" to the value of href of clicked tab
			$(currentTab).siblings().hide(); // Hide all content divs
			$(currentTab).show(); // Show the content div with the id equal to the id of clicked tab
			return false; 
		}
	);

	//�����߻����
	bmx2table();

	if($('.SubMenu').find('span').length>0){
		//if($('#leftmenu').find('li.on').length>0){
		//	$('#leftmenu li.on').after('<li class="sub">'+$('.SubMenu').html()+'</li>');
		//}else{
			$('.SubMenu').show();
		//}
	}
	
	//checkbox
	if(!(($.browser.msie)&&($.browser.version)=='6.0')){
		$('input.checkbox').css("display","none");
		$('input.checkbox[value="True"]').after('<span class="imgcheck imgcheck-on"></span>');
		$('input.checkbox[value!="True"]').after('<span class="imgcheck"></span>');
	}else{
		$('input.checkbox').attr('readonly','readonly');
		$('input.checkbox').css('cursor','pointer');
		$('input.checkbox').click(function(){  if($(this).val()=='True'){$(this).val('False')}else{$(this).val('True')} })
	}

	$('span.imgcheck').click(function(){changeCheckValue(this)})

	//batch
	$("#batch a").bind("click", function(){ BatchContinue();$("#batch p").html(" �������ڽ�����,���Ժ�......");});

	$(".SubMenu span.m-right").parent().css({"float":"right"});

});

