<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Ret extends Model
{
	// 设置完整的数据表（包含前缀）
	protected $table = 'think_ret';
	protected $pk = 'ret_id';
	protected $resultSetType = 'collection';
	
	/**
	 * 首页学校资讯显示
	 */
	public function indexList()
	{
		return $this->field(['ret_id','ret_image','ret_title','ret_content'])
					->where('ret_state',0)
					->limit('0',3)
					->select()
					->toArray();
	}
	
	/**
	 * 教育资讯显示
	 * @param $ret_state int 标识位（用于区分学校资讯和教育新闻）
	 * @param $offset int 数据起始查询位置
	 * @param $num int 数据显示条数
	 */
	public function news($ret_state,$offset,$num)
	{	
		//替换条件
		$where = "";
		//全部资讯
		if($ret_state==0){
			$where = "";
		}
		//学校资讯
		if($ret_state==1){
			$where = "ret_state=0";
		}
		//教育新闻
		if($ret_state==2){
			$where = "ret_state=1";
		}
		$list = $this->where($where)->order('ret_date','desc')->limit($offset,$num)->select()->toArray();
		return $list;
	}
	
	/**
	 * 数据总条数
	 * @param $ret_state int 标识位（用于区分学校资讯和教育新闻）
	 */
	public function infoAll($ret_state)
	{	
		$info = $this->where('ret_state',$ret_state)->select();
		$total = $info->count($info);	//数据总条数
		return $total;
	}
	
	/**
	 * 置顶推荐资讯
	 */
	public function recommend()
	{
		return $this->field(['ret_id','ret_title'])->order('ret_read','desc')->limit(3)->select()->toArray();
	}
	
	/**
	 * 资讯推荐（搜索）
	 */
	public function search($search)
	{	
		if(!$search){
			$where = "";
		}else{
			$where = "ret_title like '%{$search}%'";
		}
		return $this->field(['ret_id','ret_title'])->where('ret_title','like',"%{$search}%")->order('ret_date','desc')->limit(4)->select()->toArray();
	}
	
	
	/**
	 * 资讯详情
	 * @param $ret_id int 资讯id
	 */
	public function detail($ret_id)
	{	
		$this->where('ret_id',$ret_id)->setInc('ret_read',1);
		return $this->where('ret_id',$ret_id)->find();
	}
}