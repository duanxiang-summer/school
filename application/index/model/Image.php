<?php
namespace app\index\model;
use think\Model;
class Image extends Model
{
	// �������������ݱ�����ǰ׺��
	protected $table = 'think_image';
	protected $pk = 'image_id';
	protected $resultSetType = 'collection';
	/**
	 * ��ѯ�����ֲ�ͼ
	 * @param $state int �����ж��豸������ʾ��Ӧ���ֲ�ͼ
	 */
	public function image($state)
	{
		$info = $this->where('image_state',$state)->select();
		return $info = $info->toArray();
	}
}