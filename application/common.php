<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
namespace app;
use think\Controller;
use think\Request;
use app\index\model\Nav;
use app\index\model\Logo;
use app\index\model\Slogan;
class Common extends Controller{
	protected $navOne;	//教学特色列表
	protected $navTwo;	//教育资讯列表
	protected $logo;	//logo图
	protected $slogan;	//底部资料
	//自动查询公共数据
	protected function _initialize()
	{
		//实例化Logo模型类
		$logo = new Logo();
		$this->logo = $logo->logo();
		
		//实例化导航栏模型类
		$nav = new Nav();
		$this->navOne = $nav->nav();
		$this->navTwo = $nav->navTwo();
		
		//实例化Slogan模型类
		$slo = new Slogan();
		$this->slogan = $slo->company();
		
		//调用公共数据
		$this->assigns();
	}
	
	//公共的渲染数据
	function assigns()
	{	
		$navOne = $this->navOne;
		$navTwo = $this->navTwo;
		$logo = $this->logo;
		$slogan = $this->slogan;
		$this->assign('nav',$navOne);
		$this->assign('navTwo',$navTwo);
		$this->assign('logo',$logo);
		$this->assign('slo',$slogan);
	}
	
	//判断是否设备类型
	function ismobile()
	{
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	        return true;
			
	    //此条摘自TPM智能切换模板引擎，适合TPM开发
	    if (isset ($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT'])
	        return true;
			
	    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset ($_SERVER['HTTP_VIA']))
	        //找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
			
	    //判断手机发送的客户端标志,兼容性有待提高
	    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
	        $clientkeywords = array(
	            'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'
	        );
			
	        //从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
	            return true;
	        }
	    }
		
	    //协议法，因为有可能不准确，放到最后判断
	    if (isset ($_SERVER['HTTP_ACCEPT'])) {
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
	            return true;
	        }
	    }
	    return false;
	}
}
