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
	 * �ֻ�����ҳ
	 */
	public function index()
	{	
		//ʵ������ҳ�ֲ�ͼģ����
		$image = new Image();
		$image = $image->image('0');
		
		//ʵ����Teachersģ������
		$tea = new Teachers();
		$tea = $tea->teachers();
		
		//ʵ����Retģ����
		$ret = new Ret();
		$ret = $ret->indexList();
		
		//���pcҳ��
		$this->assign('lun',$image);
		$this->assign('tea',$tea);
		$this->assign('ret',$ret);
		return $this->fetch('mobile/index');
	}
	
	/**
	 * ��������
	 */
	public function aboutWe()
	{
		return $this->fetch('mobile/about-us');
	}
	
	/**
	 * ��ϵ����
	 */
	public function contactWe()
	{
		return $this->fetch('mobile/contact');
	}
	
	/**
	 * ��ѧ��ɫ
	 * ȫ�����ʱ��ѧ
	 */
	public function teaching()
	{
		return $this->fetch('mobile/teaching');
	}
	
	/**
	 * ��ѧ��ɫ
	 * ����ʽ�����1��1
	 * ò�����˸����ҳ�棬���ԲŻ�������Ǹ��������ͬһ��ģ��
	 */
	public function teachingA()
	{
		return $this->fetch('mobile/teaching');
	}
	
	/**
	 * ��ѧ��ɫ
	 * ���Ի������ʩ��
	 */
	public function teachingB()
	{
		return $this->fetch('mobile/teaching-b');
	}
	
	/**
	 * ��ѧ��ɫ
	 * ��ʦ�̣�����Ч��
	 */
	public function teachingC()
	{
		return $this->fetch('mobile/teaching-a');
	}
	
	/**
	 * ������Ѷ
	 */
	public function information()
	{
		return $this->fetch('mobile/news');
	}
	
	/**
	 * ��������
	 */
	public function news()
	{
		return $this->fetch('mobile/news-detail');
	}
}