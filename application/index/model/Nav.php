<?php
namespace app\index\model;
use think\Model;
class Nav extends Model
{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_nav';
	protected $pk = 'nav_id';
	protected $resultSetType = 'collection';
	/**
	 * ��ѯ��ѧ��ɫ�б�
	 */
	public function nav()
	{
		return $this->where('nav_state',0)->select()->toArray();
	}
	
	/**
	 * ��ѯ������ѯ�б�
	 */
	public function navTwo()
	{
		return $this->field(['nav_id','nav_name','nav_src'])->where('nav_state',1)->select()->toArray();
	}
}