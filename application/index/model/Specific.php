<?php
namespace app\index\model;
use think\Model;
class Specific extends Model{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_specific';
	protected $pk = 'specific_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 个性化教学表
	 */
	public function spe()
	{
		return $this->select()->toArray();
	}
}