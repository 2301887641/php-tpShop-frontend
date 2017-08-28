<?php

namespace Home\Model;

use Think\Model;

class CategoryModel extends Model {

    //将前台的3级分类取出
    public function get_category_tree() {

        $articleCats = $this->where('parent_id=0')->select();

        foreach ($articleCats as $k => $a) {

            $articleCats[$k]['children'] = $this->where('parent_id=' . $a['id'])->select();
            foreach ($articleCats[$k]['children'] as $kk => $aa) {

                $articleCats[$k]['children'][$kk]['children'] = $this->where('parent_id=' . $aa['id'])->select();
            }
        }

        return $articleCats;
    }

 //取出这个大类下所有子分类的id
    public function get_cat_by_recname($catname, $parent_id = 0) {
        $sql = "select id,cat_name from sh_category where parent_id=$parent_id and id in(select goods_id from sh_recommend_item where rec_id=(select id from sh_recommend
 where rec_name='$catname' and rec_type='分类'))";
        return $this->query($sql);
    }
    
//递归树查找分类id的子级id,第三个参数特别的重要,因为会产生重复
    public function get_category($cat_id = 0, $clear = false) {//递归查找子分类id,区别于分类,这个只找id
        $data = $this->select();
        return $this->get_tree($data, $cat_id, $clear);
    }

    public function get_tree($data, $parent_id = 0, $clear = false) {
        static $arr = array();
        if ($clear)
            $arr = array();
        foreach ($data as $d) {
            if ($d['parent_id'] == $parent_id) {
                $arr[] = $d['id'];
                $this->get_tree($data, $d['id']);
            }
        }

        return $arr;
    }

}
