<?php
error_reporting(0); 
include_once("config.php");
include("../config/conn.php");
include("../config/common.php");
$type="where id='1'";
$wzpeizhi=queryall(wzpeizhi,$type);
$kl=$wzpeizhi[kl];
$uboid=$_POST["uboid"];//�̻�ID��
$ubozt=$_POST["ubozt"];//֧��״̬ 1Ϊ�ɹ�
$ubodingdan=$_POST["ubodingdan"];//ƽ̨������
$ubobz=$_POST["ubobz"];//��ע��Ϣ
$ubomoney=$_POST["ubomoney"];//֧�����
$ubosj=$_POST["ubosj"];//֧��ʱ��
$ubodes=$_POST["ubodes"];//��Ʒ����
$ubosign=$_POST["ubosign"];//��֤
$pid=$_POST["pid"];//�ƹ�����ʹ��
$uid=$_POST["uid"];//�ƹ�����ʹ��
$jb=$ubomoney*100;
date_default_timezone_set('PRC');
$shijian=date("Y-m-d H:i:s" ,time());
$ubosj=date("Y-m-d");
$preEncodeStr=$ubozt.$uboid.$ubodingdan.$ubomoney.$ubokey;
$newsign=md5($preEncodeStr);
if($newsign==$ubosign){
if($ubozt=="1") { 
echo "success";//֧���ɹ�
$type="where userid='$ubobz'";
$user=queryall(uboip,$type);
if($user){
$type="ms='��Ա1',jb='$jb'  where userid='$ubobz'";
upalldt(uboip,$type);
}
if($kl=="0"){
$type="where userid='$pid'";
$klks=queryall(ubouser,$type);
$ns=$klks[kl2];
if($klks){
$cs=$klks[kl]-1;
if($cs=="1"){
if($ubomoney< 9 && $ubomoney>0){
//������
$type="kl='$cs' where userid='$pid'";
upalldt(ubouser,$type);
//д�Լ������ݿ�
$type="where ddh='$ubodingdan'";
$rowdbselect=queryall(dingdan,$type);
if(!$rowdbselect){
//��ȡ�������ֳɱ���
//������д��
$type="where userid='$pid'";
$pidsj=queryall(ubouser,$type);
//
if ($pidsj){
$pidmoney=($ubomoney*$pidsj[fencheng])/100;
//��IDд��
$type="where userid='$uid'";
$uidpd=queryall(ubouid,$type);
if ($uidpd){
$uidmoney=($pidmoney*$uidpd[fc])/100;
}else{
$uidmoney="0";
}
///////////////////////////////////////////////////////////
$sql = "SELECT shijian FROM ubotj WHERE pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$query = mysql_query($sql);
$rows=mysql_fetch_array($query);
$type="WHERE  pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$duqu=queryall(ubotj,$type);
$pidmoney2=$duqu[pidmoney]+$pidmoney;
$uidmoney2=$duqu[uidmoney]+$uidmoney;
if ($rows) {
mysql_query("UPDATE  ubotj set pidmoney='$pidmoney2',uidmoney='$uidmoney2' where shijian='$ubosj' and pid='$pid' and uid='$uid' "); 
}else {
mysql_query("insert into ubotj set pid='$pid',shijian='$ubosj',pidmoney='$pidmoney',uidmoney='$uidmoney',uid='$uid'"); 
}
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//д�Լ������ݿ�

}else{
//����
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','�����ɹ�','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(kllist,$type);
}
$type="kl='$ns' where userid='$pid'";
upalldt(ubouser,$type);
}else{
//������
$type="kl='$cs' where userid='$pid'";
upalldt(ubouser,$type);
//д�Լ������ݿ�
$type="where ddh='$ubodingdan'";
$rowdbselect=queryall(dingdan,$type);
if(!$rowdbselect){
//��ȡ�������ֳɱ���
//������д��
$type="where userid='$pid'";
$pidsj=queryall(ubouser,$type);
//
if ($pidsj){
$pidmoney=($ubomoney*$pidsj[fencheng])/100;
//��IDд��
$type="where userid='$uid'";
$uidpd=queryall(ubouid,$type);
if ($uidpd){
$uidmoney=($pidmoney*$uidpd[fc])/100;
}else{
$uidmoney="0";
}
///////////////////////////////////////////////////////////
$sql = "SELECT shijian FROM ubotj WHERE pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$query = mysql_query($sql);
$rows=mysql_fetch_array($query);
$type="WHERE  pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$duqu=queryall(ubotj,$type);
$pidmoney2=$duqu[pidmoney]+$pidmoney;
$uidmoney2=$duqu[uidmoney]+$uidmoney;
if ($rows) {
mysql_query("UPDATE  ubotj set pidmoney='$pidmoney2',uidmoney='$uidmoney2' where shijian='$ubosj' and pid='$pid' and uid='$uid' "); 
}else {
mysql_query("insert into ubotj set pid='$pid',shijian='$ubosj',pidmoney='$pidmoney',uidmoney='$uidmoney',uid='$uid'"); 
}
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//д�Լ������ݿ�
}
//�û�ID������ �򲻿�
}else{
//������
//д�Լ������ݿ�
$type="where ddh='$ubodingdan'";
$rowdbselect=queryall(dingdan,$type);
if(!$rowdbselect){
//��ȡ�������ֳɱ���
//������д��
$type="where userid='$pid'";
$pidsj=queryall(ubouser,$type);
//
if ($pidsj){
$pidmoney=($ubomoney*$pidsj[fencheng])/100;
//��IDд��
$type="where userid='$uid'";
$uidpd=queryall(ubouid,$type);
if ($uidpd){
$uidmoney=($pidmoney*$uidpd[fc])/100;
}else{
$uidmoney="0";
}
///////////////////////////////////////////////////////////
$sql = "SELECT shijian FROM ubotj WHERE pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$query = mysql_query($sql);
$rows=mysql_fetch_array($query);
$type="WHERE  pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$duqu=queryall(ubotj,$type);
$pidmoney2=$duqu[pidmoney]+$pidmoney;
$uidmoney2=$duqu[uidmoney]+$uidmoney;
if ($rows) {
mysql_query("UPDATE  ubotj set pidmoney='$pidmoney2',uidmoney='$uidmoney2' where shijian='$ubosj' and pid='$pid' and uid='$uid' "); 
}else {
mysql_query("insert into ubotj set pid='$pid',shijian='$ubosj',pidmoney='$pidmoney',uidmoney='$uidmoney',uid='$uid'"); 
}
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//д�Լ������ݿ�
}

//��������δ����
}else{
//������
//д�Լ������ݿ�
$type="where ddh='$ubodingdan'";
$rowdbselect=queryall(dingdan,$type);
if(!$rowdbselect){
//��ȡ�������ֳɱ���
//������д��
$type="where userid='$pid'";
$pidsj=queryall(ubouser,$type);
//
if ($pidsj){
$pidmoney=($ubomoney*$pidsj[fencheng])/100;
//��IDд��
$type="where userid='$uid'";
$uidpd=queryall(ubouid,$type);
if ($uidpd){
$uidmoney=($pidmoney*$uidpd[fc])/100;
}else{
$uidmoney="0";
}
///////////////////////////////////////////////////////////
$sql = "SELECT shijian FROM ubotj WHERE pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$query = mysql_query($sql);
$rows=mysql_fetch_array($query);
$type="WHERE  pid='$pid' and  uid='$uid' and  shijian='$ubosj'";
$duqu=queryall(ubotj,$type);
$pidmoney2=$duqu[pidmoney]+$pidmoney;
$uidmoney2=$duqu[uidmoney]+$uidmoney;
if ($rows) {
mysql_query("UPDATE  ubotj set pidmoney='$pidmoney2',uidmoney='$uidmoney2' where shijian='$ubosj' and pid='$pid' and uid='$uid' "); 
}else {
mysql_query("insert into ubotj set pid='$pid',shijian='$ubosj',pidmoney='$pidmoney',uidmoney='$uidmoney',uid='$uid'"); 
}
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
$type="(`id`, `ddh`, `ddzt`, `money`, `des`, `pid`,`uid`,`shijian`) VALUES (null,'$ubodingdan','SUCCESS','$ubomoney','$ubodes','$pid','$uid','$shijian')"; 
dbinsert(dingdan,$type);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//д�Լ������ݿ�
}
//�жϽ���
}else{
echo "����ʧ��";//֧��ʧ��
}
}else{ 
echo "ǩ������";//��֤ʧ��
}
?>