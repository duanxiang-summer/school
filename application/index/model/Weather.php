<?php
namespace app\index\model;
use think\Model;
class Weather extends Model{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_weather';
	protected $pk = 'weather_id';
	protected $resultSetType = 'collection';
	
	/**
	 * ȫ����ѧ��
	 */
	public function wea()
	{
		return $this->select()->toArray();
	}
}