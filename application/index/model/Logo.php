<?php
namespace app\index\model;
use think\Model;
class Logo extends Model
{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_logo';
	protected $pk = 'logo_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 查询Logo
	 */
	public function Logo()
	{
		return $this->find();
	}
}