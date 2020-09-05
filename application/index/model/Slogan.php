<?php
namespace app\index\model;
use think\Model;
class Slogan extends Model
{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_slogan';
	protected $pk = 'slogan_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 底部公司信息
	 */
	public function company()
	{
		return $this->find()->toArray();
	}
}