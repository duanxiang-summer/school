<?php
namespace app\index\model;
use think\Model;
class Slogan extends Model
{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_slogan';
	protected $pk = 'slogan_id';
	protected $resultSetType = 'collection';
	
	/**
	 * �ײ���˾��Ϣ
	 */
	public function company()
	{
		return $this->find()->toArray();
	}
}