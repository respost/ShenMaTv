/***
 * ����ԭ�����߱���༭��Jquery���
 * ��дʱ�䣺2012��10��13��
 * ֧��ԭ�� ��עJquerySchool
 * http://www.jq-school.com
 * version:manhuaHtmlArea.1.0.js
***/
$(function() {
	$.fn.manhuaHtmlArea = function(options) {
		var defaults = {
			Event : "click",	//��Ӧ���¼�
			Left : 0,			//�������ʾƫ��Ԫ����ߵ�λ��
			Top : 22,			//�������ʾƫ��Ԫ���ϱߵ�λ��
			id : "content"  	//���ݲ������ID
		};
		var options = $.extend(defaults,options);
		var bid = parseInt(Math.random()*100000);	
		$("body").prepend("<div id='showAddFacePic"+bid+"'class='addons layer-emotions'><b class='tri-b'></b><b class='tri-t'></b><div class='layer-tab clearfix'><a id='close"+bid+"' class='close' href='javascript:void(0)'></a><span>���ñ���</span></div><div class='layer-content'><ul id='emotions"+bid+"' class='emotions clearfix'><li><img src='/images/faces/smilea.gif' addFacesPic='[�Ǻ�]' alt='�Ǻ�' title='�Ǻ�'/></li><li><img src='/images/faces/tootha.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/laugh.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/tza.gif' addFacesPic='[�ɰ�]' alt='�ɰ�' title='�ɰ�'/></li><li><img src='/images/faces/kl.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/kbsa.gif' addFacesPic='[�ڱ�ʺ]' alt='�ڱ�ʺ' title='�ڱ�ʺ'/></li><li><img src='/images/faces/cj.gif' addFacesPic='[�Ծ�]' alt='�Ծ�' title='�Ծ�'/></li><li><img src='/images/faces/shamea.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/zy.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/bz.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/bs2.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/lovea.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/sada.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/heia.gif' addFacesPic='[͵Ц]' alt='͵Ц' title='͵Ц'/></li><li><img src='/images/faces/qq.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/sb.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/mb.gif' addFacesPic='[̫����]' alt='̫����' title='̫����'/></li><li><img src='/images/faces/ldln.gif' addFacesPic='[��������]' alt='��������' title='��������'/></li><li><img src='/images/faces/yhh.gif' addFacesPic='[�Һߺ�]' alt='�Һߺ�' title='�Һߺ�'/></li><li><img src='/images/faces/zhh.gif' addFacesPic='[��ߺ�]' alt='��ߺ�' title='��ߺ�'/></li><li><img src='/images/faces/x.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/cry.gif' addFacesPic='[˥]' alt='˥' title='˥'/></li><li><img src='/images/faces/wq.gif' addFacesPic='[ί��]' alt='ί��' title='ί��'/></li><li><img src='/images/faces/t.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/k.gif' addFacesPic='[�����]' alt='�����' title='�����'/></li><li><img src='/images/faces/bba.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/angrya.gif' addFacesPic='[ŭ]' alt='ŭ' title='ŭ'/></li><li><img src='/images/faces/yw.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/cza.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/88.gif' addFacesPic='[�ݰ�]' alt='�ݰ�' title='�ݰ�'/></li><li><img src='/images/faces/sk.gif' addFacesPic='[˼��]' alt='˼��' title='˼��'/></li><li><img src='/images/faces/sweata.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/sleepya.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/sleepa.gif' addFacesPic='[˯��]' alt='˯��' title='˯��'/></li><li><img src='/images/faces/money.gif' addFacesPic='[Ǯ]' alt='Ǯ' title='Ǯ'/></li><li><img src='/images/faces/sw.gif' addFacesPic='[ʧ��]' alt='ʧ��' title='ʧ��'/></li><li><img src='/images/faces/cool.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/hsa.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/hatea.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/gza.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/dizzya.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/bs.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/crazya.gif' addFacesPic='[ץ��]' alt='ץ��' title='ץ��'/></li><li><img src='/images/faces/h.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/yx.gif' addFacesPic='[����]' alt='����' title='����'/></li><li><img src='/images/faces/nm.gif' addFacesPic='[ŭ��]' alt='ŭ��' title='ŭ��'/></li><li><img src='/images/faces/hearta.gif' addFacesPic='[��]' alt='��' title='��'/></li><li><img src='/images/faces/unheart.gif' addFacesPic='[����]' alt='����' title='����'/></li></ul></div></div>");	
		var $btn = $(this);
		var $biaoqing = $("#showAddFacePic"+bid);	
		var $emotions = $("#emotions"+bid+" li img");
		var $close = $("#close"+bid);
		var $input = $("#"+options.id);
		//�������¼�
		$emotions.die().click(function(){
			 $biaoqing.hide();
			 $input.die().insertContent($(this).attr("addFacesPic"));			 
		});		
		//�رձ����
		$close.click(function(){
			 $biaoqing.hide();			 	 
		});
		$biaoqing.hover(function(){$biaoqing.show();},function(){$biaoqing.hide();	});
		//ѡ����鰴ť�����¼�
		$btn.live(options.Event,function(e){						
		  var iof = $(this).offset();
		  var w = $(this).width();
		  var h = $(this).height();
		  $biaoqing.css({ "left" : iof.left+options.Left,"top" : iof.top+options.Top });
		  $biaoqing.show();		  
		});			
	};
	
	//�����������
	$.fn.extend({
		replaceContent : function(content){
		content = content.replace("[�Ǻ�]","<img src='/images/faces/smilea.gif' addFacesPic='[�Ǻ�]' alt='�Ǻ�' title='�Ǻ�'/>").replace("[����]","<img src='/images/faces/tootha.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/laugh.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[�ɰ�]","<img src='/images/faces/tza.gif' addFacesPic='[�ɰ�]' alt='�ɰ�' title='�ɰ�'/>").replace("[����]","<img src='/images/faces/kl.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[�ڱ�ʺ]","<img src='/images/faces/kbsa.gif' addFacesPic='[�ڱ�ʺ]' alt='�ڱ�ʺ' title='�ڱ�ʺ'/>").replace("[�Ծ�]","<img src='/images/faces/cj.gif' addFacesPic='[�Ծ�]' alt='�Ծ�' title='�Ծ�'/>").replace("[����]","<img src='/images/faces/shamea.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/zy.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/bz.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/bs2.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/lovea.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[��]","<img src='/images/faces/sada.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[͵Ц]","<img src='/images/faces/heia.gif' addFacesPic='[͵Ц]' alt='͵Ц' title='͵Ц'/>").replace("[����]","<img src='/images/faces/qq.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/sb.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[̫����]","<img src='/images/faces/mb.gif' addFacesPic='[̫����]' alt='̫����' title='̫����'/>").replace("[��������]","<img src='/images/faces/ldln.gif' addFacesPic='[��������]' alt='��������' title='��������'/>").replace("[�Һߺ�]","<img src='/images/faces/yhh.gif' addFacesPic='[�Һߺ�]' alt='�Һߺ�' title='�Һߺ�'/>").replace("[��ߺ�]","<img src='/images/faces/zhh.gif' addFacesPic='[��ߺ�]' alt='��ߺ�' title='��ߺ�'/>").replace("[��]","<img src='/images/faces/x.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[˥]","<img src='/images/faces/cry.gif' addFacesPic='[˥]' alt='˥' title='˥'/>").replace("[ί��]","<img src='/images/faces/wq.gif' addFacesPic='[ί��]' alt='ί��' title='ί��'/>").replace("[��]","<img src='/images/faces/t.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[�����]","<img src='/images/faces/k.gif' addFacesPic='[�����]' alt='�����' title='�����'/>").replace("[����]","<img src='/images/faces/bba.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[ŭ]","<img src='/images/faces/angrya.gif' addFacesPic='[ŭ]' alt='ŭ' title='ŭ'/>").replace("[����]","<img src='/images/faces/yw.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/cza.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[�ݰ�]","<img src='/images/faces/88.gif' addFacesPic='[�ݰ�]' alt='�ݰ�' title='�ݰ�'/>").replace("[˼��]","<img src='/images/faces/sk.gif' addFacesPic='[˼��]' alt='˼��' title='˼��'/>").replace("[��]","<img src='/images/faces/sweata.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[��]","<img src='/images/faces/sleepya.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[˯��]","<img src='/images/faces/sleepa.gif' addFacesPic='[˯��]' alt='˯��' title='˯��'/>").replace("[Ǯ]","<img src='/images/faces/money.gif' addFacesPic='[Ǯ]' alt='Ǯ' title='Ǯ'/>").replace("[ʧ��]","<img src='/images/faces/sw.gif' addFacesPic='[ʧ��]' alt='ʧ��' title='ʧ��'/>").replace("[��]","<img src='/images/faces/cool.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[����]","<img src='/images/faces/hsa.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[��]","<img src='/images/faces/hatea.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[����]","<img src='/images/faces/gza.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[��]","<img src='/images/faces/dizzya.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[����]","<img src='/images/faces/bs.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[ץ��]","<img src='/images/faces/crazya.gif' addFacesPic='[ץ��]' alt='ץ��' title='ץ��'/>").replace("[����]","<img src='/images/faces/h.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[����]","<img src='/images/faces/yx.gif' addFacesPic='[����]' alt='����' title='����'/>").replace("[ŭ��]","<img src='/images/faces/nm.gif' addFacesPic='[ŭ��]' alt='ŭ��' title='ŭ��'/>").replace("[��]","<img src='/images/faces/hearta.gif' addFacesPic='[��]' alt='��' title='��'/>").replace("[����]","<img src='/images/faces/unheart.gif' addFacesPic='[����]' alt='����' title='����'/>");
		$(this).html(content);
		}		
	})	
	//�����괦�Ĳ��
	$.fn.extend({  
		insertContent : function(myValue, t) {  
			var $t = $(this)[0];  
			if (document.selection) {  
				this.focus();  
				var sel = document.selection.createRange();  
				sel.text = myValue;  
				this.focus();  
				sel.moveStart('character', -l);  
				var wee = sel.text.length;  
				if (arguments.length == 2) {  
				var l = $t.value.length;  
				sel.moveEnd("character", wee + t);  
				t <= 0 ? sel.moveStart("character", wee - 2 * t	- myValue.length) : sel.moveStart("character", wee - t - myValue.length);  
				sel.select();  
				}  
			} else if ($t.selectionStart || $t.selectionStart == '0') {  
				var startPos = $t.selectionStart;  
				var endPos = $t.selectionEnd;  
				var scrollTop = $t.scrollTop;  
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos,$t.value.length);  
				this.focus();  
				$t.selectionStart = startPos + myValue.length;  
				$t.selectionEnd = startPos + myValue.length;  
				$t.scrollTop = scrollTop;  
				if (arguments.length == 2) { 
					$t.setSelectionRange(startPos - t,$t.selectionEnd + t);  
					this.focus(); 
				}  
			} else {                              
				this.value += myValue;                              
				this.focus();  
			}  
		}  
	})  
});
