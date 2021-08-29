// JavaScript Document

//---------ģ��VB����Begin-----------------
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
		if(strString.charAt(i)!=' ' && strString.charAt(i)!='��')
			break;
	return mid(strString,i+1,strString.length);
}
function rtrim(strString)
{
	for(var i=strString.length-1;i>0;i--)
		if(strString.charAt(i)!=' ' && strString.charAt(i)!='��')
			break;
	return left(strString,i+1);
}
 function trim(strString)
{
	return rtrim(ltrim(strString));
}
//---------ģ��VB����End-------------------

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

//---------����ַ����ȼ��Ϸ���------------
function checkLength(strFieldName,strLabel,strMinLen,strMaxLen,strExcludedStr)
{	
	var thisField = document.getElementsByName(strFieldName);
	var fieldValue;
	for(var i=0;i<thisField.length;i++)
	{
		fieldValue = trim(thisField[i].value);
		if(strMinLen==1 && fieldValue.length<strMinLen)	
		{
			alert("<"+strLabel+">������д��")
			if( isElementVisible( thisField[i] ) )	
				thisField[i].focus();
			return false;
		}	
		if(fieldValue.length<strMinLen)
		{
			alert("<"+strLabel+">�������� "+strMinLen+" ���ַ���");
			if( isElementVisible( thisField[i] ) )	
				thisField[i].focus();
			return (false);
		}
		if(fieldValue.length>strMaxLen)	
		{
			alert("<"+strLabel+">�������� "+strMaxLen+" ���ַ���");
			if( isElementVisible( thisField[i] ) )
				thisField[i].focus();
			return (false);
		}
		if(typeof(strExcludedStr)!="undefined")	
		{
			if( !isAvailString(fieldValue,strExcludedStr))
			{
				if(strExcludedStr.charAt(0)!="^")
					alert("<"+strLabel+">���ܺ���������һ�ַ���\n\n\t" + strExcludedStr);
				else
					alert("<"+strLabel+">ֻ�ܺ���������һ�ַ���\n\n\t" + strExcludedStr.substring(1,strExcludedStr.length));
				if( isElementVisible( thisField[i] ) )
					thisField[i].focus();
				return (false);				
			}	
		}
		else
		{
			if(!isAvailString(fieldValue))
			{
				alert("<"+strLabel+">���ܺ���������һ�ַ���\n\n\t" + constExcluedStr);
				if( isElementVisible( thisField[i] ) )
					thisField[i].focus();
				return (false);				
			}	
		}			
	}
	return (true);
}

/*�ú������ڼ������ҳ���ϵ�strFieldNameָ�������Ƿ�Ϊ����,
���һ��������ʾ�ȽϷ�Χ:1�������䣻2�������䣻3�����ұգ�4������ҿ���ȡֵ�ֱ���
"()"��"[]"��"(]"��"[)"
������˲�����ʾ������
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
				alert("<"+strLabel+">ֻ���������֡�");
				if( isElementVisible( thisField[k] ) )
					thisField[k].focus();
				return (false);
			}
			if( typeof( strRangeFlag ) == "undefined" || strRangeFlag == "[]" || ( strRangeFlag != "[)" && strRangeFlag != "(]" && strRangeFlag != "()" ) )
			{
				if ( strMin!="*" && !(parseInt(checkStr) >= parseInt(strMin)) )
				{
					alert("����<"+strLabel+">������ֵ���ڻ����["+strMin+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) <= parseInt(strMax)) )
				{
					alert("����<"+strLabel+">������ֵС�ڻ����["+strMax+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else if( strRangeFlag == "[)" )
			{
				if ( strMin!="*" && !(parseInt(checkStr) >= parseInt(strMin)) )
				{
					alert("����<"+strLabel+">������ֵ���ڻ����["+strMin+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) < parseInt(strMax)) )
				{
					alert("����<"+strLabel+">������ֵС��["+strMax+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else if( strRangeFlag == "(]" )
			{
				if ( strMin!="*" && !(parseInt(checkStr) > parseInt(strMin)) )
				{
					alert("����<"+strLabel+">������ֵ����["+strMin+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) <= parseInt(strMax)) )
				{
					alert("����<"+strLabel+">������ֵС�ڻ����["+strMax+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
			else
			{
				if ( strMin!="*" && !(parseInt(checkStr) > parseInt(strMin)) )
				{
					alert("����<"+strLabel+">������ֵ����["+strMin+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}			
				if (strMax!="*" && !(parseInt(checkStr) < parseInt(strMax)) )
				{
					alert("����<"+strLabel+">������ֵС��["+strMax+"]��������");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}
			}
		}	
	}
	return (true);
}

/*�ú������ڼ������ҳ���ϵ�strFieldNameָ�������Ƿ�Ϊ������
���һ��������ʾ�ȽϷ�Χ:1�������䣻2�������䣻3�����ұգ�4������ҿ���ȡֵ�ֱ���
"()"��"[]"��"(]"��"[)"
������˲�����ʾ������
*/
function checkFloat(strFieldName,strLabel,strMin,strMax,strRangeFlag)
{	
	var thisField = document.getElementsByName(strFieldName);
	for(var k=0;k<thisField.length;k++)	{
		var checkStr=trim(thisField[k].value);
		if(checkStr!=""){
			 if(isNaN(checkStr))			{
				alert("��<"+strLabel+">�У�ֻ���������֡�");
				if( isElementVisible( thisField[k] ) )
					thisField[k].focus();
				return (false);
			}

			if( typeof( strRangeFlag ) == "undefined" || strRangeFlag == "[]" || ( strRangeFlag != "[)" && strRangeFlag != "(]" && strRangeFlag != "()" ) ){
				if ( strMin!="*" && !(parseFloat(checkStr) >= parseFloat(strMin)) ){
					alert("����<"+strLabel+">������ֵ���ڻ����["+strMin+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) <= parseFloat(strMax)) )	{
					alert("����<"+strLabel+">������ֵС�ڻ����["+strMax+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else if( strRangeFlag == "[)" ){
				if ( strMin!="*" && !(parseFloat(checkStr) >= parseFloat(strMin)) ){
					alert("����<"+strLabel+">������ֵ���ڻ����["+strMin+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) < parseFloat(strMax)) )	{
					alert("����<"+strLabel+">������ֵС��["+strMax+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else if( strRangeFlag == "(]" ){
				if ( strMin!="*" && !(parseFloat(checkStr) > parseFloat(strMin)) ){
					alert("����<"+strLabel+">������ֵ����["+strMin+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) <= parseFloat(strMax)) )	{
					alert("����<"+strLabel+">������ֵС�ڻ����["+strMax+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}else{
				if ( strMin!="*" && !(parseFloat(checkStr) > parseFloat(strMin)) ){
					alert("����<"+strLabel+">������ֵ����["+strMin+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
				if (strMax!="*" && !(parseFloat(checkStr) < parseFloat(strMax)) )	{
					alert("����<"+strLabel+">������ֵС��["+strMax+"]����ֵ��");
					if( isElementVisible( thisField[k] ) )
						thisField[k].focus();
					return (false);
				}				
			}
		}	
	}
	return (true);
}

//�ú������ڼ��ĳ�����Ƿ�Ϊ��Ч����
//strMin=0ʱ���������Ϊ��
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
					alert("��<"+strLabel+">�е�ֵ������Ч������ֵ(yyyy-m[m]-d[d])��");
					thisField[k].focus();
					return (false);
				}
				//��Ϊ�����ݿ��У�datetime���͵������������ڵķ�Χ���ʼӴ�У�飬�Է�ֹ���� Begin
				if( IsDateBefore( checkStr, "1753-1-1" ) )
				{
					alert("��<"+strLabel+">�е����ڲ���С��1753-1-1") ;
					thisField[k].focus();
					return (false);
				}
				if( IsDateAfter( checkStr, "9999-12-31" ) )
				{
					alert("��<"+strLabel+">�е����ڲ��ܴ���9999-12-31") ;
					thisField[k].focus();
					return (false);
				}
				//��Ϊ�����ݿ��У�datetime���͵������������ڵķ�Χ���ʼӴ�У�飬�Է�ֹ���� end
			} 
			if((checkStr == "") && (parseInt(strMin) != 0))
			{
				alert("����<"+strLabel+">��������Ч������ֵ(yyyy-m[m]-d[d])��");
				thisField[k].focus();
				return (false);
			}
		}
	return (true);
}

//�Ƿ�Ϊ��ȷ�����ʼ�
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
			alert("<"+Lable+">���벻��ȷ��")
			thisField[k].focus();
			return false;
		}
		else
		{
			str_tmp=str.substring(i,str.length);
			j=str_tmp.indexOf(".");
			if (j<=1 || j==str_tmp.length-1)
			{
				alert("<"+Lable+">���벻��ȷ��")
				thisField[k].focus();
				return false;
			}
		}
	}
	return true;
}