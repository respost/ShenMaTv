/***
 * 漫画原创在线表情编辑器Jquery插件
 * 编写时间：2012年10月13号
 * 支持原创 关注JquerySchool
 * http://www.jq-school.com
 * version:manhuaHtmlArea.1.0.js
***/
$(function() {
	$.fn.manhuaHtmlArea = function(options) {
		var defaults = {
			Event : "click",	//响应的事件
			Left : 0,			//表情层显示偏移元素左边的位置
			Top : 22,			//表情层显示偏移元素上边的位置
			id : "content"  	//内容插件表单的ID
		};
		var options = $.extend(defaults,options);
		var bid = parseInt(Math.random()*100000);	
		$("body").prepend("<div id='showAddFacePic"+bid+"'class='addons layer-emotions'><b class='tri-b'></b><b class='tri-t'></b><div class='layer-tab clearfix'><a id='close"+bid+"' class='close' href='javascript:void(0)'></a><span>常用表情</span></div><div class='layer-content'><ul id='emotions"+bid+"' class='emotions clearfix'><li><img src='/images/faces/smilea.gif' addFacesPic='[呵呵]' alt='呵呵' title='呵呵'/></li><li><img src='/images/faces/tootha.gif' addFacesPic='[嘻嘻]' alt='嘻嘻' title='嘻嘻'/></li><li><img src='/images/faces/laugh.gif' addFacesPic='[哈哈]' alt='哈哈' title='哈哈'/></li><li><img src='/images/faces/tza.gif' addFacesPic='[可爱]' alt='可爱' title='可爱'/></li><li><img src='/images/faces/kl.gif' addFacesPic='[可怜]' alt='可怜' title='可怜'/></li><li><img src='/images/faces/kbsa.gif' addFacesPic='[挖鼻屎]' alt='挖鼻屎' title='挖鼻屎'/></li><li><img src='/images/faces/cj.gif' addFacesPic='[吃惊]' alt='吃惊' title='吃惊'/></li><li><img src='/images/faces/shamea.gif' addFacesPic='[害羞]' alt='害羞' title='害羞'/></li><li><img src='/images/faces/zy.gif' addFacesPic='[挤眼]' alt='挤眼' title='挤眼'/></li><li><img src='/images/faces/bz.gif' addFacesPic='[闭嘴]' alt='闭嘴' title='闭嘴'/></li><li><img src='/images/faces/bs2.gif' addFacesPic='[鄙视]' alt='鄙视' title='鄙视'/></li><li><img src='/images/faces/lovea.gif' addFacesPic='[爱你]' alt='爱你' title='爱你'/></li><li><img src='/images/faces/sada.gif' addFacesPic='[泪]' alt='泪' title='泪'/></li><li><img src='/images/faces/heia.gif' addFacesPic='[偷笑]' alt='偷笑' title='偷笑'/></li><li><img src='/images/faces/qq.gif' addFacesPic='[亲亲]' alt='亲亲' title='亲亲'/></li><li><img src='/images/faces/sb.gif' addFacesPic='[生病]' alt='生病' title='生病'/></li><li><img src='/images/faces/mb.gif' addFacesPic='[太开心]' alt='太开心' title='太开心'/></li><li><img src='/images/faces/ldln.gif' addFacesPic='[懒得理你]' alt='懒得理你' title='懒得理你'/></li><li><img src='/images/faces/yhh.gif' addFacesPic='[右哼哼]' alt='右哼哼' title='右哼哼'/></li><li><img src='/images/faces/zhh.gif' addFacesPic='[左哼哼]' alt='左哼哼' title='左哼哼'/></li><li><img src='/images/faces/x.gif' addFacesPic='[嘘]' alt='嘘' title='嘘'/></li><li><img src='/images/faces/cry.gif' addFacesPic='[衰]' alt='衰' title='衰'/></li><li><img src='/images/faces/wq.gif' addFacesPic='[委屈]' alt='委屈' title='委屈'/></li><li><img src='/images/faces/t.gif' addFacesPic='[吐]' alt='吐' title='吐'/></li><li><img src='/images/faces/k.gif' addFacesPic='[打哈气]' alt='打哈气' title='打哈气'/></li><li><img src='/images/faces/bba.gif' addFacesPic='[抱抱]' alt='抱抱' title='抱抱'/></li><li><img src='/images/faces/angrya.gif' addFacesPic='[怒]' alt='怒' title='怒'/></li><li><img src='/images/faces/yw.gif' addFacesPic='[疑问]' alt='疑问' title='疑问'/></li><li><img src='/images/faces/cza.gif' addFacesPic='[馋嘴]' alt='馋嘴' title='馋嘴'/></li><li><img src='/images/faces/88.gif' addFacesPic='[拜拜]' alt='拜拜' title='拜拜'/></li><li><img src='/images/faces/sk.gif' addFacesPic='[思考]' alt='思考' title='思考'/></li><li><img src='/images/faces/sweata.gif' addFacesPic='[汗]' alt='汗' title='汗'/></li><li><img src='/images/faces/sleepya.gif' addFacesPic='[困]' alt='困' title='困'/></li><li><img src='/images/faces/sleepa.gif' addFacesPic='[睡觉]' alt='睡觉' title='睡觉'/></li><li><img src='/images/faces/money.gif' addFacesPic='[钱]' alt='钱' title='钱'/></li><li><img src='/images/faces/sw.gif' addFacesPic='[失望]' alt='失望' title='失望'/></li><li><img src='/images/faces/cool.gif' addFacesPic='[酷]' alt='酷' title='酷'/></li><li><img src='/images/faces/hsa.gif' addFacesPic='[花心]' alt='花心' title='花心'/></li><li><img src='/images/faces/hatea.gif' addFacesPic='[哼]' alt='哼' title='哼'/></li><li><img src='/images/faces/gza.gif' addFacesPic='[鼓掌]' alt='鼓掌' title='鼓掌'/></li><li><img src='/images/faces/dizzya.gif' addFacesPic='[晕]' alt='晕' title='晕'/></li><li><img src='/images/faces/bs.gif' addFacesPic='[悲伤]' alt='悲伤' title='悲伤'/></li><li><img src='/images/faces/crazya.gif' addFacesPic='[抓狂]' alt='抓狂' title='抓狂'/></li><li><img src='/images/faces/h.gif' addFacesPic='[黑线]' alt='黑线' title='黑线'/></li><li><img src='/images/faces/yx.gif' addFacesPic='[阴险]' alt='阴险' title='阴险'/></li><li><img src='/images/faces/nm.gif' addFacesPic='[怒骂]' alt='怒骂' title='怒骂'/></li><li><img src='/images/faces/hearta.gif' addFacesPic='[心]' alt='心' title='心'/></li><li><img src='/images/faces/unheart.gif' addFacesPic='[伤心]' alt='伤心' title='伤心'/></li></ul></div></div>");	
		var $btn = $(this);
		var $biaoqing = $("#showAddFacePic"+bid);	
		var $emotions = $("#emotions"+bid+" li img");
		var $close = $("#close"+bid);
		var $input = $("#"+options.id);
		//表情点击事件
		$emotions.die().click(function(){
			 $biaoqing.hide();
			 $input.die().insertContent($(this).attr("addFacesPic"));			 
		});		
		//关闭表情层
		$close.click(function(){
			 $biaoqing.hide();			 	 
		});
		$biaoqing.hover(function(){$biaoqing.show();},function(){$biaoqing.hide();	});
		//选择表情按钮触发事件
		$btn.live(options.Event,function(e){						
		  var iof = $(this).offset();
		  var w = $(this).width();
		  var h = $(this).height();
		  $biaoqing.css({ "left" : iof.left+options.Left,"top" : iof.top+options.Top });
		  $biaoqing.show();		  
		});			
	};
	
	//代替表情内容
	$.fn.extend({
		replaceContent : function(content){
		content = content.replace("[呵呵]","<img src='/images/faces/smilea.gif' addFacesPic='[呵呵]' alt='呵呵' title='呵呵'/>").replace("[嘻嘻]","<img src='/images/faces/tootha.gif' addFacesPic='[嘻嘻]' alt='嘻嘻' title='嘻嘻'/>").replace("[哈哈]","<img src='/images/faces/laugh.gif' addFacesPic='[哈哈]' alt='哈哈' title='哈哈'/>").replace("[可爱]","<img src='/images/faces/tza.gif' addFacesPic='[可爱]' alt='可爱' title='可爱'/>").replace("[可怜]","<img src='/images/faces/kl.gif' addFacesPic='[可怜]' alt='可怜' title='可怜'/>").replace("[挖鼻屎]","<img src='/images/faces/kbsa.gif' addFacesPic='[挖鼻屎]' alt='挖鼻屎' title='挖鼻屎'/>").replace("[吃惊]","<img src='/images/faces/cj.gif' addFacesPic='[吃惊]' alt='吃惊' title='吃惊'/>").replace("[害羞]","<img src='/images/faces/shamea.gif' addFacesPic='[害羞]' alt='害羞' title='害羞'/>").replace("[挤眼]","<img src='/images/faces/zy.gif' addFacesPic='[挤眼]' alt='挤眼' title='挤眼'/>").replace("[闭嘴]","<img src='/images/faces/bz.gif' addFacesPic='[闭嘴]' alt='闭嘴' title='闭嘴'/>").replace("[鄙视]","<img src='/images/faces/bs2.gif' addFacesPic='[鄙视]' alt='鄙视' title='鄙视'/>").replace("[爱你]","<img src='/images/faces/lovea.gif' addFacesPic='[爱你]' alt='爱你' title='爱你'/>").replace("[泪]","<img src='/images/faces/sada.gif' addFacesPic='[泪]' alt='泪' title='泪'/>").replace("[偷笑]","<img src='/images/faces/heia.gif' addFacesPic='[偷笑]' alt='偷笑' title='偷笑'/>").replace("[亲亲]","<img src='/images/faces/qq.gif' addFacesPic='[亲亲]' alt='亲亲' title='亲亲'/>").replace("[生病]","<img src='/images/faces/sb.gif' addFacesPic='[生病]' alt='生病' title='生病'/>").replace("[太开心]","<img src='/images/faces/mb.gif' addFacesPic='[太开心]' alt='太开心' title='太开心'/>").replace("[懒得理你]","<img src='/images/faces/ldln.gif' addFacesPic='[懒得理你]' alt='懒得理你' title='懒得理你'/>").replace("[右哼哼]","<img src='/images/faces/yhh.gif' addFacesPic='[右哼哼]' alt='右哼哼' title='右哼哼'/>").replace("[左哼哼]","<img src='/images/faces/zhh.gif' addFacesPic='[左哼哼]' alt='左哼哼' title='左哼哼'/>").replace("[嘘]","<img src='/images/faces/x.gif' addFacesPic='[嘘]' alt='嘘' title='嘘'/>").replace("[衰]","<img src='/images/faces/cry.gif' addFacesPic='[衰]' alt='衰' title='衰'/>").replace("[委屈]","<img src='/images/faces/wq.gif' addFacesPic='[委屈]' alt='委屈' title='委屈'/>").replace("[吐]","<img src='/images/faces/t.gif' addFacesPic='[吐]' alt='吐' title='吐'/>").replace("[打哈气]","<img src='/images/faces/k.gif' addFacesPic='[打哈气]' alt='打哈气' title='打哈气'/>").replace("[抱抱]","<img src='/images/faces/bba.gif' addFacesPic='[抱抱]' alt='抱抱' title='抱抱'/>").replace("[怒]","<img src='/images/faces/angrya.gif' addFacesPic='[怒]' alt='怒' title='怒'/>").replace("[疑问]","<img src='/images/faces/yw.gif' addFacesPic='[疑问]' alt='疑问' title='疑问'/>").replace("[馋嘴]","<img src='/images/faces/cza.gif' addFacesPic='[馋嘴]' alt='馋嘴' title='馋嘴'/>").replace("[拜拜]","<img src='/images/faces/88.gif' addFacesPic='[拜拜]' alt='拜拜' title='拜拜'/>").replace("[思考]","<img src='/images/faces/sk.gif' addFacesPic='[思考]' alt='思考' title='思考'/>").replace("[汗]","<img src='/images/faces/sweata.gif' addFacesPic='[汗]' alt='汗' title='汗'/>").replace("[困]","<img src='/images/faces/sleepya.gif' addFacesPic='[困]' alt='困' title='困'/>").replace("[睡觉]","<img src='/images/faces/sleepa.gif' addFacesPic='[睡觉]' alt='睡觉' title='睡觉'/>").replace("[钱]","<img src='/images/faces/money.gif' addFacesPic='[钱]' alt='钱' title='钱'/>").replace("[失望]","<img src='/images/faces/sw.gif' addFacesPic='[失望]' alt='失望' title='失望'/>").replace("[酷]","<img src='/images/faces/cool.gif' addFacesPic='[酷]' alt='酷' title='酷'/>").replace("[花心]","<img src='/images/faces/hsa.gif' addFacesPic='[花心]' alt='花心' title='花心'/>").replace("[哼]","<img src='/images/faces/hatea.gif' addFacesPic='[哼]' alt='哼' title='哼'/>").replace("[鼓掌]","<img src='/images/faces/gza.gif' addFacesPic='[鼓掌]' alt='鼓掌' title='鼓掌'/>").replace("[晕]","<img src='/images/faces/dizzya.gif' addFacesPic='[晕]' alt='晕' title='晕'/>").replace("[悲伤]","<img src='/images/faces/bs.gif' addFacesPic='[悲伤]' alt='悲伤' title='悲伤'/>").replace("[抓狂]","<img src='/images/faces/crazya.gif' addFacesPic='[抓狂]' alt='抓狂' title='抓狂'/>").replace("[黑线]","<img src='/images/faces/h.gif' addFacesPic='[黑线]' alt='黑线' title='黑线'/>").replace("[阴险]","<img src='/images/faces/yx.gif' addFacesPic='[阴险]' alt='阴险' title='阴险'/>").replace("[怒骂]","<img src='/images/faces/nm.gif' addFacesPic='[怒骂]' alt='怒骂' title='怒骂'/>").replace("[心]","<img src='/images/faces/hearta.gif' addFacesPic='[心]' alt='心' title='心'/>").replace("[伤心]","<img src='/images/faces/unheart.gif' addFacesPic='[伤心]' alt='伤心' title='伤心'/>");
		$(this).html(content);
		}		
	})	
	//插入光标处的插件
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
