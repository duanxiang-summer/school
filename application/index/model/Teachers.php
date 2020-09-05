<?php
namespace app\index\model;
use think\Model;
class Teachers extends Model{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_teachers';
	protected $pk = 'teachers_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 一对一外教表
	 */
	public function teachers()
	{
		return $this->find()->toArray();
	}
	
}