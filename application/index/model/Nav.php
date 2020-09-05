<?php
namespace app\index\model;
use think\Model;
class Nav extends Model
{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_nav';
	protected $pk = 'nav_id';
	protected $resultSetType = 'collection';
	/**
	 * 查询教学特色列表
	 */
	public function nav()
	{
		return $this->where('nav_state',0)->select()->toArray();
	}
	
	/**
	 * 查询教育咨询列表
	 */
	public function navTwo()
	{
		return $this->field(['nav_id','nav_name','nav_src'])->where('nav_state',1)->select()->toArray();
	}
}