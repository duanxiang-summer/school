<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Ret extends Model
{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_ret';
	protected $pk = 'ret_id';
	protected $resultSetType = 'collection';
	
	/**
	 * ��ҳѧУ��Ѷ��ʾ
	 */
	public function indexList()
	{
		return $this->field(['ret_id','ret_image','ret_title','ret_content'])
					->where('ret_state',0)
					->limit('0',3)
					->select()
					->toArray();
	}
	
	/**
	 * ������Ѷ��ʾ
	 * @param $ret_state int ��ʶλ����������ѧУ��Ѷ�ͽ������ţ�
	 * @param $offset int ������ʼ��ѯλ��
	 * @param $num int ������ʾ����
	 */
	public function news($ret_state,$offset,$num)
	{	
		//�滻����
		$where = "";
		//ȫ����Ѷ
		if($ret_state==0){
			$where = "";
		}
		//ѧУ��Ѷ
		if($ret_state==1){
			$where = "ret_state=0";
		}
		//��������
		if($ret_state==2){
			$where = "ret_state=1";
		}
		$list = $this->where($where)->order('ret_date','desc')->limit($offset,$num)->select()->toArray();
		return $list;
	}
	
	/**
	 * ����������
	 * @param $ret_state int ��ʶλ����������ѧУ��Ѷ�ͽ������ţ�
	 */
	public function infoAll($ret_state)
	{	
		$info = $this->where('ret_state',$ret_state)->select();
		$total = $info->count($info);	//����������
		return $total;
	}
	
	/**
	 * �ö��Ƽ���Ѷ
	 */
	public function recommend()
	{
		return $this->field(['ret_id','ret_title'])->order('ret_read','desc')->limit(3)->select()->toArray();
	}
	
	/**
	 * ��Ѷ�Ƽ���������
	 */
	public function search($search)
	{	
		if(!$search){
			$where = "";
		}else{
			$where = "ret_title like '%{$search}%'";
		}
		return $this->field(['ret_id','ret_title'])->where('ret_title','like',"%{$search}%")->order('ret_date','desc')->limit(4)->select()->toArray();
	}
	
	
	/**
	 * ��Ѷ����
	 * @param $ret_id int ��Ѷid
	 */
	public function detail($ret_id)
	{	
		$this->where('ret_id',$ret_id)->setInc('ret_read',1);
		return $this->where('ret_id',$ret_id)->find();
	}
}