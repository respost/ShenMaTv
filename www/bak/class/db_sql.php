<?php
class mysqlquery
{
	var $sql;//sql���ִ�н��
	var $query;//sql���
	var $num;//���ؼ�¼��
	var $r;//��������
	var $id;//�������ݿ�id��
	//ִ��mysql_query()���
	function query($query)
	{
		$this->sql=mysql_query($query) or die(mysql_error()."<br>".$query);
		return $this->sql;
	}
	//ִ��mysql_query()���2
	function query1($query)
	{
		$this->sql=mysql_query($query);
		return $this->sql;
	}
	//ִ��mysql_fetch_array()
	function fetch($sql)//�˷����Ĳ�����$sql����sql���ִ�н��
	{
		$this->r=mysql_fetch_array($sql);
		return $this->r;
	}
	//ִ��fetchone(mysql_fetch_array())
	//�˷�����fetch()��������:1���˷����Ĳ�����$query����sql��� 
	//2���˷�������while(),for()���ݿ�ָ�벻���Զ����ƣ���fetch()�����Զ����ơ�
	function fetch1($query)
	{
		$this->sql=$this->query($query);
		$this->r=mysql_fetch_array($this->sql);
		return $this->r;
	}
	//ִ��mysql_num_rows()
	function num($query)//����Ĳ�����$query����sql���
	{
		$this->sql=$this->query($query);
		$this->num=mysql_num_rows($this->sql);
		return $this->num;
	}
	//ִ��numone(mysql_num_rows())
	//�˷�����num()�������ǣ�1���˷����Ĳ�����$sql����sql����ִ�н����
	function num1($sql)
	{
		$this->num=mysql_num_rows($sql);
		return $this->num;
	}
	//ִ��numone(mysql_num_rows())
	//ͳ�Ƽ�¼��
	function gettotal($query)
	{
		$this->r=$this->fetch1($query);
		return $this->r['total'];
	}
	//ִ��free(mysql_result_free())
	//�˷����Ĳ�����$sql����sql����ִ�н����ֻ�����õ�mysql_fetch_array���������
	function free($sql)
	{
		mysql_free_result($sql);
	}
	//ִ��seek(mysql_data_seek())
	//�˷����Ĳ�����$sql����sql����ִ�н��,$pitΪִ��ָ���ƫ����
	function seek($sql,$pit)
	{
		mysql_data_seek($sql,$pit);
	}
	//ִ��id(mysql_insert_id())
	function lastid()//ȡ�����һ��ִ��mysql���ݿ�id��
	{
		$this->id=mysql_insert_id();
		return $this->id;
	}
}
?>