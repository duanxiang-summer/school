<?php
namespace app\index\model;
use think\Model;
class Specific extends Model{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_specific';
	protected $pk = 'specific_id';
	protected $resultSetType = 'collection';
	
	/**
	 * ���Ի���ѧ��
	 */
	public function spe()
	{
		return $this->select()->toArray();
	}
}