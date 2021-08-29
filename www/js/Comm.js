// JavaScript Document

//---------模拟VB函数Begin-----------------
function left(str , length)
{
	return str.substr(0 , length);
}
function mid(str , start , length)
{
	var from = (start < 1)?0:start-1;
	return str.substring(from , from+length);
}
function right(str , length)
{
	var strlen = str.length;
	return mid(str , strlen-length+1 , length);
}
function ltrim(strString)
{
	for(var i=0;i<strString.length;i++)
		if(strString.charAt(i)!=' ' && strString.charAt(i)!='　')
			break;
	return mid(strString,i+1,strString.length);
}
function rtrim(strString)
{
	for(var i=strString.length-1;i>0;i--)
		if(strString.charAt(i)!=' ' && strString.charAt(i)!='　')
			break;
	return left(strString,i+1);
}
 function trim(strString)
{
	return rtrim(ltrim(strString));
}
//---------模拟VB函数End-------------------

var constExcluedStr = "'";

function isParentElementVisible( objElement )
{
	if( typeof( objElement.parentElement ) == "undefined"  || objElement.parentElement.tagName == "HTML")
		return true
	if( objElement.parentElement.style.display.toLowerCase() == "none")
		return false
	else
		return isParentElementVisible( objElement.parentElement ) 
}
	
function isElementVisible( objElement )
{
	if( objElement.style.display.toLowerCase() == "none"  || objElement.type.toLowerCase() == "hidden" )
		return false
	else
	{
		if( isParentElementVisible( objElement ) )
			return true
		else
			return false
	}
}
	
function isAvailString(strToValidate,strExcludedStr)
{ 
	for(var i=0;i < strToValidate.length ; i++)
	{
		if(typeof(strExcludedStr)!="undefined")
		{ 
			if(strExcludedStr.charAt(0) == "^")
			{
				if (strExcludedStr.substring(1,strExcludedStr.length).indexOf(strToValidate.charAt(i)) == -1)
				{
					return false;
				}
			}
			else
			{
				if (strExcludedStr.indexOf(strToValidate.charAt(i)) != -1)
				{
					return false;
				}
			}		
		}
		else
		{
			if (constExcluedStr.indexOf(strToValidate.charAt(i)) != -1)
			{
				return false;
			}
		}
	}
	return true ;
}

//---------检查字符长度及合法性------------
function checkLength(strFieldName,strLabel,strMinLen,strMaxLen,strExcludedStr)
{	
	var thisField = document.getElementsByName(strFieldName);
	var fieldValue;
	for(var i=0;i<thisField.length;i++)
	{
		fieldValue = trim(thisField[i].value);
		if(strMinLen==1 && fieldValue.length<strMinLen)	
		{
			alert("<"+strLabel+">必须填写！")
			if( isElementVisible( thisField[i] ) )	
				thisField[i].focus();
			return false;
		}	
		if(fieldValue.length<strMinLen)
		{
			alert("<"+strLabel+">至少输入 "+strMinLen+" 个字符。");
			if( isElementVisible( thisField[i] ) )	
				thisField[i].focus();
			return (false);
		}
		if(fieldValue.length>strMaxLen)	
		{
			alert("<"+strLabel+">至多输入 "+strMaxLen+" 个字符。");
			if( isElementVisible( thisField[i] ) )
				thisField[i].focus();
			return (false);
		}
		if(typeof(strExcludedStr)!="undefined")	
		{
			if( !isAvailString(fieldValue,strExcludedStr))
			{
				if(strExcludedStr.charAt(0)!="^")
					alert("<"+strLabel+">不能含有如下任一字符：\n\n\t" + strExcludedStr);
				else
					alert("<"+strLabel+">只能含有如下任一字符：\n\n\t" + strExcludedStr.substring(1,strExcludedStr.length));
				if( isElementVisible( thisField[i] ) )
					thisField[i].focus();
				return (false);				
			}	
		}
		else
		{
			if(!isAvailString(fieldValue))
			{
				alert("<"+strLabel+">不能含有如下任一字符：\n\n\t" + constExcluedStr);
				if( isElementVisible( thisField[i] ) )
					thisField[i].focus();
				return (false);				
			}	
		}			
	}
	return (true);
}

/*该函数用于检查整个页面上的strFieldName指定的域是否为整型,
最后一个参数表示比较范围:1、开区间；2、闭区间；3、左开右闭；4、左闭右开。取值分别是
"()"、"[]"、"(]"、"[)"
不定义此参数表示闭区间
*/
function checkInteger(strFieldName,strLabel,strMin,strMax,strRangeFlag)
{
	var thisField = document.getElementsByName(strFieldName);
	for(var k=0;k<thisField.length;k++)
	{
		var checkStr=trim(thisField[k].value);
		if(checkStr!="")
		{
			if(isNaN(checkStr))	
			{
				alert("<"+strLabel+">只能输入数字。");
				if( isElementVisible( thisField[k] ) )
					thisField[k].focus();
				return (false);
			}
			if( typeof( strRangeFlag ) == "undefined" || strRangeFlag == "[]" || ( strRangeFlag != "[)" && strRangeFlag != "(]" && strRangeFlag != "()" ) )
			{
				if ( strMin!="*" && !(parseInt(checkStr) >= parseInt(strMin)) )
				{
					alert("请在<"+strLabel+">中输入值大于或等于["+strMin+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) <= parseInt(strMax)) )
				{
					alert("请在<"+strLabel+">中输入值小于或等于["+strMax+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else if( strRangeFlag == "[)" )
			{
				if ( strMin!="*" && !(parseInt(checkStr) >= parseInt(strMin)) )
				{
					alert("请在<"+strLabel+">中输入值大于或等于["+strMin+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) < parseInt(strMax)) )
				{
					alert("请在<"+strLabel+">中输入值小于["+strMax+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else if( strRangeFlag == "(]" )
			{
				if ( strMin!="*" && !(parseInt(checkStr) > parseInt(strMin)) )
				{
					alert("请在<"+strLabel+">中输入值大于["+strMin+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) <= parseInt(strMax)) )
				{
					alert("请在<"+strLabel+">中输入值小于或等于["+strMax+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else
			{
				if ( strMin!="*" && !(parseInt(checkStr) > parseInt(strMin)) )
				{
					alert("请在<"+strLabel+">中输入值大于["+strMin+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) < parseInt(strMax)) )
				{
					alert("请在<"+strLabel+">中输入值小于["+strMax+"]的整数。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
		}	
	}
	return (true);
}

/*该函数用于检查整个页面上的strFieldName指定的域是否为数字型
最后一个参数表示比较范围:1、开区间；2、闭区间；3、左开右闭；4、左闭右开。取值分别是
"()"、"[]"、"(]"、"[)"
不定义此参数表示闭区间
*/
function checkFloat(strFieldName,strLabel,strMin,strMax,strRangeFlag)
{	
	var thisField = document.getElementsByName(strFieldName);
	for(var k=0;k<thisField.length;k++)	{
		var checkStr=trim(thisField[k].value);
		if(checkStr!=""){
			 if(isNaN(checkStr))			{
				alert("在<"+strLabel+">中，只能输入数字。");
				if( isElementVisible( thisField[k] ) )
					thisField[k].focus();
				return (false);
			}

			if( typeof( strRangeFlag ) == "undefined" || strRangeFlag == "[]" || ( strRangeFlag != "[)" && strRangeFlag != "(]" && strRangeFlag != "()" ) ){
				if ( strMin!="*" && !(parseFloat(checkStr) >= parseFloat(strMin)) ){
					alert("请在<"+strLabel+">中输入值大于或等于["+strMin+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) <= parseFloat(strMax)) )	{
					alert("请在<"+strLabel+">中输入值小于或等于["+strMax+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else if( strRangeFlag == "[)" ){
				if ( strMin!="*" && !(parseFloat(checkStr) >= parseFloat(strMin)) ){
					alert("请在<"+strLabel+">中输入值大于或等于["+strMin+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) < parseFloat(strMax)) )	{
					alert("请在<"+strLabel+">中输入值小于["+strMax+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else if( strRangeFlag == "(]" ){
				if ( strMin!="*" && !(parseFloat(checkStr) > parseFloat(strMin)) ){
					alert("请在<"+strLabel+">中输入值大于["+strMin+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) <= parseFloat(strMax)) )	{
					alert("请在<"+strLabel+">中输入值小于或等于["+strMax+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else{
				if ( strMin!="*" && !(parseFloat(checkStr) > parseFloat(strMin)) ){
					alert("请在<"+strLabel+">中输入值大于["+strMin+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) < parseFloat(strMax)) )	{
					alert("请在<"+strLabel+">中输入值小于["+strMax+"]的数值。");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}
		}	
	}
	return (true);
}

//该函数用于检查某表单域是否为有效日期
//strMin=0时，该域可以为空
function checkDateTime(strFieldName,strLabel,strMin)
{
	var thisField = document.getElementsByName(strFieldName);
		for(var k = 0;k<thisField.length;k++)
		{
			var checkStr = trim(thisField[k].value);
			if(checkStr!="")
			{
				if(!isProperDate(checkStr))
				{
					alert("在<"+strLabel+">中的值不是有效的日期值(yyyy-m[m]-d[d])。");
					thisField[k].focus();
					return (false);
				}
				//因为在数据库中，datetime类型的数据有其日期的范围，故加此校验，以防止出错 Begin
				if( IsDateBefore( checkStr, "1753-1-1" ) )
				{
					alert("在<"+strLabel+">中的日期不能小于1753-1-1") ;
					thisField[k].focus();
					return (false);
				}
				if( IsDateAfter( checkStr, "9999-12-31" ) )
				{
					alert("在<"+strLabel+">中的日期不能大于9999-12-31") ;
					thisField[k].focus();
					return (false);
				}
				//因为在数据库中，datetime类型的数据有其日期的范围，故加此校验，以防止出错 end
			} 
			if((checkStr == "") && (parseInt(strMin) != 0))
			{
				alert("请在<"+strLabel+">中输入有效的日期值(yyyy-m[m]-d[d])。");
				thisField[k].focus();
				return (false);
			}
		}
	return (true);
}

//是否为正确电子邮件
function checkEmail(strFieldName,Lable)
{
	var thisField = document.getElementsByName(strFieldName);
	var i,j ;
	for(var k=0;k<thisField.length;k++)
	{
		var str=trim(thisField[k].value);
		if(str=="")
			continue;
	
		i=str.indexOf("@");
		if (i<=1)
		{
			alert("<"+Lable+">输入不正确！")
			thisField[k].focus();
			return false;
		}
		else
		{
			str_tmp=str.substring(i,str.length);
			j=str_tmp.indexOf(".");
			if (j<=1 || j==str_tmp.length-1)
			{
				alert("<"+Lable+">输入不正确！")
				thisField[k].focus();
				return false;
			}
		}
	}
	return true;
}