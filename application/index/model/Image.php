<?php
namespace app\index\model;
use think\Model;
class Image extends Model
{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_image';
	protected $pk = 'image_id';
	protected $resultSetType = 'collection';
	/**
	 * 查询所有轮播图
	 * @param $state int 用于判断设备类型显示相应的轮播图
	 */
	public function image($state)
	{
		$info = $this->where('image_state',$state)->select();
		return $info = $info->toArray();
	}
}