<?php
namespace app\index\model;
use think\Model;
class Weather extends Model{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_weather';
	protected $pk = 'weather_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 全天候教学表
	 */
	public function wea()
	{
		return $this->select()->toArray();
	}
}