<?php

namespace Home\Model;

use Think\Model;

class AdModel extends Model {

    //获取一个广告位上的广告,通过广告id
    public function get_ad($ad_id) {
        $adPos = M('adPos');
        $adPoss = $adPos->find($ad_id);//取出id=$ad_id的信息
        $html = '';
        $ads = $this->where("is_on='是' and pos_id=" . $ad_id)->find();
        //如果是图片格式直接返回这个图片字符串
        if ($ads['ad_type'] == '图片') {
            if (strpos('http://', $ads['link']) != 0)
                $links = '';
            else
                $links = 'http://' . $ads['link'];
            $html = '<a href="' . $links . '"><img width="' . $adPoss['pos_width'] . '" height="' . $adPoss['pos_height'] . '" src="' . URL_PATH . '/' . $ads['img_url'] . '"></a>';
        }else {//否则返回动画字符串
            $adInfo = M('adInfo');
            static $v=0;//定义一个静态变量,用来区分多个ul的class,否则轮播会错误
            $adInfos = $adInfo->where('ad_id=' . $ads['id'])->select();
            $html.='<div style="position:relative;overflow:hidden;width:' . $adPoss['pos_width'] . 'px;height:' . $adPoss['pos_height'] . 'px"><ul style="position:absolute;width:' . count($adInfos) * $adPoss['pos_width'] . 'px; height:' . $adPoss['pos_height'] . 'px" class="left_move'.++$v.'">';
            foreach ($adInfos as $a) {
                if (strpos('http://', $a['link']) != 0)
                    $links = '';
                else
                    $links = 'http://' . $a['link'];
                $html.='<li style="float:left;"><a href="' . $links . '"><img width="' . $adPoss['pos_width'] . '" height=' . $adPoss['pos_height'] . ' src="' . URL_PATH . '/' . $a['img_url'] . '"></a></li>';
            }


            $html.='</ul>';
            //下面这个ul
             $html.='<ul style="position:absolute;bottom:5%;right:5%;">';
            for($i=1;$i<=count($adInfos);$i++){
                
             $html.='<li style="background-color:#c30;color:#fff;text-align:center;width:22px;height:22px;line-height:22px;-webkit-border-radius:22px;float:left;margin:5px;">'.$i.'</li>';   
            }
            $html.='</ul></div>';
            $html.='<script>
		(function(){
                var j=1;
		var k=' . count($adInfos) . ';
		var q=setInterval(function(){	
                $(".left_move'.$v.'").animate({ 
		 "left":-(' . $adPoss['pos_width'] . '*j)+"px"
                 },500);
                if(++j >=k)
                j=0;
                },3000)})()</script>';
           
            
        }
        return $html;
    }

}
