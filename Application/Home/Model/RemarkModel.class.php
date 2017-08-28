<?php
namespace Home\Model;
use Think\Model;

class RemarkModel extends Model{
protected $_validate=array(
    array('star','require','评分不能为空',1,),
    array('content','require','评论内容不能为空',1),
    array('goods_id','require','缺少选择商品',1),
    //这个表单字段不在remark表中,也可以这样验证
    array('yx_name','require','印象内容不能为空',1,),
);

public function _before_insert(&$data, $options) {
$data['addtime']=date('Y-m-d H:i:s');
 if(session('id'))
 $data['member_id']=session('id');
 }
}

