<?php
namespace Home\Model;
use Think\Model;

class ArticleModel extends Model{
    
    public function get_article(){
         $articleCat=M('articleCat');
       $articleCats= $articleCat->select();
       // var_dump($articleCats);
        
        
        
        
        
        
        
    }
    
    
    
    
    
    
    
    
}