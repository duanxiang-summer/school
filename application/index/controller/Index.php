<?php
namespace app\index\controller;
use app\Common;
class Index extends Common
{	
	/**
	 * 根据用户的设备类型跳转相应类型的网站
	 */
    public function index()
	{
		//判断是否为手机端页面
		if($this->ismobile()){
			//重定向手机端页面
			return redirect('/index.php/index/Mobile/index');
		}else{
			//重定向电脑端页面
			return redirect('/index.php/index/Pc/index');
		}
	}
}
