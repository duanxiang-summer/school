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
class Mobile extends Common
{	
	/**
	 * 手机端首页
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
		return $this->fetch('mobile/index');
	}
	
	/**
	 * 关于我们
	 */
	public function aboutWe()
	{
		return $this->fetch('mobile/about-us');
	}
	
	/**
	 * 联系我们
	 */
	public function contactWe()
	{
		return $this->fetch('mobile/contact');
	}
	
	/**
	 * 教学特色
	 * 全天候，随时可学
	 */
	public function teaching()
	{
		return $this->fetch('mobile/teaching');
	}
	
	/**
	 * 教学特色
	 * 沉浸式，外教1对1
	 * 貌似少了个这个页面，所以才会和上面那个方法输出同一个模板
	 */
	public function teachingA()
	{
		return $this->fetch('mobile/teaching');
	}
	
	/**
	 * 教学特色
	 * 个性化，因材施教
	 */
	public function teachingB()
	{
		return $this->fetch('mobile/teaching-b');
	}
	
	/**
	 * 教学特色
	 * 名师教，保障效果
	 */
	public function teachingC()
	{
		return $this->fetch('mobile/teaching-a');
	}
	
	/**
	 * 教育资讯
	 */
	public function information()
	{
		return $this->fetch('mobile/news');
	}
	
	/**
	 * 教育新闻
	 */
	public function news()
	{
		return $this->fetch('mobile/news-detail');
	}
}