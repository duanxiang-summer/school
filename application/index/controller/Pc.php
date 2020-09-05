<?php
namespace app\index\controller;
use app\Common;
use app\index\model\Image;
use app\index\model\Teachers;
use app\index\model\Ret;
use app\index\model\Weather;
use app\index\model\Specific;
use think\Db;
use think\Request;
class Pc extends Common
{
	/**
	 * 电脑端首页
	 */
	public function index()
	{
		//实例化首页轮播图模型类
		$image = new Image();
		$image = $image->image('0');
		
		//实例化Teachers模型类类
		$tea = new Teachers();
		$tea = $tea->teachers();
		
		//实例化Ret模型类
		$ret = new Ret();
		$ret = $ret->indexList();
		
		//输出pc页面
		$this->assign('lun',$image);
		$this->assign('tea',$tea);
		$this->assign('ret',$ret);
		return $this->fetch('pc/index');
	}
	/**
	 * 关于我们
	 */
	public function aboutWe()
	{
		$tea = new Teachers();
		$one = $tea->teachers();
		$ret = Ret::field(['ret_id','ret_image','ret_title'])->order('ret_read','desc')->limit(3)->select()->toArray();
		$this->assign('tea',$one);
		$this->assign('ret',$ret);
		return $this->fetch('pc/about-us');
	}
	
	/**
	 * 联系我们
	 */
	public function contactWe()
	{
		$info = Db::table('think_contact')->find();
		$this->assign('content',$info);
		return $this->fetch('pc/contact');
	}
	
	/**
	 * 教学特色
	 * 全天候，随时可学
	 */
	public function teaching()
	{
		$wea = new Weather();
		$wea = $wea->wea();
		$this->assign('wea',$wea);
		return $this->fetch('pc/teaching');
	}
	
	/**
	 * 教学特色
	 * 沉浸式，外教1对1
	 */
	public function teachingA()
	{	
		//实例化Teachers模型类类
		$tea = new Teachers();
		$tea = $tea->teachers();
		$this->assign('tea',$tea);
		return $this->fetch('pc/teaching-a');
	}
	
	/**
	 * 教学特色
	 * 个性化，因材施教
	 */
	public function teachingB()
	{	
		//实例化Specific模型类
		$spe = new Specific();
		$spe = $spe->spe();
		$this->assign('spe',$spe);
		return $this->fetch('pc/teaching-b');
	}
	
	/**
	 * 教学特色
	 * 名师教，保障效果
	 */
	public function teachingC()
	{	
		// return $this->fetch('pc/teaching-c');
		echo  "这个网站缺少页面";
	}
	
	/**
	 * 学校资讯
	 */
	public function information()
	{	
		$ret = new Ret();
		if (Request::instance()->isAjax()){
			$search = input('post.search');
			$info = $ret->search($search);
			return json_encode($info);
		}
		$page=isset($_GET['page'])? $_GET['page']:1;	//接收页码数
		
		$ret_state = input('ret_state');	//接收标识位
		if(!$ret_state){
			$ret_state = 0;
		}
		$total = $ret->infoAll($ret_state);	//获取数据总条数
		$tui = $ret->recommend();
		$num = 2;	//每页显示的数据
		$pagenum=ceil($total/$num);	//获取总页数
		$offset=(intval($page)-intval(1))*$num; 	//起始查询位置
		if($page<=1){
			$page=1;
		}
		if($page>$pagenum){
			$page=$pagenum;
		}
		$ret = $ret->news($ret_state,$offset,$num);	//查询分页数据
		$show = "";
		for($i=1;$i<=$pagenum;$i++){
		       $show.="<a href='/index.php/index/Pc/information?ret_state={$ret_state}&page=".$i."'>$i</a>";
		}
		$jian = intval($page)-intval(1);	//上一页
		if($jian<1){
			$jian =1;
		}
		$jia = intval($page)+intval(1);		//下一页
		$p = [$jian,$jia];
		$this->assign('p',$p);
		$this->assign('show',$show);
		$this->assign('pa',$ret);
		$this->assign('ret_state',$ret_state);
		$this->assign('news',$ret);
		$this->assign('tui',$tui);
		return $this->fetch('pc/news');
	}
	
	/**
	 * 学校资讯详情
	 */
	public function news()
	{	
		$ret_id = input('ret_id');
		$detail = new Ret();
		$tui = $detail->recommend();
		$detail = $detail->detail($ret_id);
		if (Request::instance()->isAjax()){
			$search = input('post.search');
			$detail = new Ret();
			$info = $detail->search($search);
			return json_encode($info);
		}
		$this->assign('tui',$tui);
		$this->assign('detail',$detail);
		return $this->fetch('pc/news-detail');
	}
}