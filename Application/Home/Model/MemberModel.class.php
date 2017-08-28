<?php
namespace Home\Model;
use Think\Model;

class MemberModel extends Model{
    //现在的表单验证规则,应用到了3处地方.
    //1.首先是会员注册时 2.会员登录时 3.会员找回密码
    //所以,必须区分开3个表单的验证,下面每一项验证规则都需要,检查是否需要第6个参数来区分两个表单,不填第6个参数,则3个表单都验证
    //会员注册第6个参数是1,因为是新添加
    //会员登录第6个参数是4,这个是4是我们自己定义的,区别于其他的
    //会员找回密码第6个参数是5,这个5是我们自己定义的,区别于其他的
    protected $_validate=array(
    //只在注册时验证
    array('mustCheck','require','必须同意注册协议',1,'regex',1),
    //只在注册时验证
    array('checkcode','require','验证码不能为空',1,'regex',1),
    //只在会员登录时验证
    array('checkcode','require','验证码不能为空',1,'regex',4),
    //只在注册时验证
    array('checkcode','_chkCode','验证码不正确',1,'callback',1),
    //只在会员登录时验证
    array('checkcode','_chkCode','验证码不正确',1,'callback',4),
    //3个表单都需要验证
    array('username','require','用户名不能为空'),
    //只在注册时验证
    array('email','require','邮箱不能为空',1,'regex',1),
    //只在会员找回密码验证
    array('email','require','邮箱不能为空',1,'regex',5),
    //只在注册时验证 
    array('password','require','密码不能为空',1,'regex',1),
    //只在会员登录时验证
    array('password','require','密码不能为空',1,'regex',4),
    //只在注册时验证
    array('username',"/^[\w\x80-\xff]{3,15}$/",'用户名格式不正确',1,'regex',1),
    //只在会员登录时验证
    array('username',"/^[\w\x80-\xff]{3,15}$/",'用户名格式不正确',1,'regex',4),

   //只在注册时验证
    array('rpassword','password','两次输入密码必须相同',1,'confirm',1),
    //只在注册时验证
    array('username','','帐号名称已经存在',1,'unique',1),
   //只在注册时验证
    array('email','email','必须是Email格式',1,'regex',1),//email格式可以
   //只在注册时验证
    array('email','','邮箱已经存在',1,'unique',1),

    //下面的第6个参数为2的,表示是修改表单,这是用户忘记密码时的验证,当时根据自己的思路来的
    array('password','require','新密码不能为空',1,'regex',2),
    array('rpassword','require','确认密码不能为空',1,'regex',2),
    array('rpassword','password','两次输入密码必须相同',1,'confirm',2),
    array('password','6,12','密码长度不能小于6位',1,'length',2),

        );

//会员注册时,验证码的验证
    public function _chkCode($code){
      $verify = new \Think\Verify();  
      return $verify->check($code);
  }

  //在插入数据库请给会员表的密码加密,生成一个邮箱验证的唯一码,并生成时间  
  protected function _before_insert(&$data,$options){
   $data['password']=  md5($data['password']);
   $data['email_chk_str']=  md5(uniqid());
   $data['addtime']=date('Y-m-d H:i:s');
}

 //发送邮件功能
public function send_email($email_address,$title,$content){
 sendMail($email_address,$title,$content);  
}

  //插入完数据后,直接发送邮件到注册的邮箱  
protected function _after_insert($data, $options) {
   $content=$data['username']." ,你好,感谢您的注册，请阅读以下内容<br/>,尊敬的".$data['username'].",点击以下链接完成注册:<br/><a href=http://www.jdd.com/index.php/Home/Index/chkReg/sn/".$data['email_chk_str'].">http://www.jdd.com/index.php/Home/Index/chkReg/sn/".$data['email_chk_str']."</a><br/> 您已经注册成为百度云网盘资源下载论坛的会员，下资源xiazy.com专注精致分享，精品资源天天有，每天期待您的到来，欢迎推荐您的好友一起加入！ 官方QQ群：371179161 荣誉会员QQ群：333014370 站长QQ：2011820123 如果您有什么疑问可以联系管理员，Email: 2011820123@qq.com 下资源<br/>".date('Y-m-d H:i:s');
   return $this->send_email($data['email'],'[百度云网盘资源下载论坛] '.$data['username'].'，您好，感谢您的注册，请阅读以下内容',$content);
}

   //会员登录时,检查用户名密码,登录方法  
public function login(){
     //先将密码保存起来,一会儿会清空
   $password=$this->password;
     //先在数据库中检查用户名是否存在
   if($info=$this->where("username='".$this->username."'")->find()){
        //在比较密码是否相同 
       if($info['password']==md5($password)){
           session('id',$info['id']);
           session('username',$info['username']);
             //判断用户是否勾选了'保存登录信息'
           if(I('post.remember')){
             //将用户名进行加密    
               $data_username=\Think\Crypt::encrypt($info['username'],C('Des_key'));    
             //将密码进行加密
               $data_password=\Think\Crypt::encrypt($password,C('Des_key'));    
             //保存时间为当前时间加上一个月的时间
               $data_time=time()+30*24*3600;
             //将用户名和密码加密并写入到cookie中 
//第一个参数为name,第二个参数为数据,第三个参数为保存时间,第四个参数为保存路径,一般为根目录整个网站都可以读取,第5个参数是跨域名,如
//一个网站多个域名,www.shop.com和img.shop.com,定义一个cookie那么其他的域名下是读不了的.要想2域名都能读取需要设置第5个参数为'.shop.com'             
               setcookie('username',$data_username,$data_time,'/');
               setcookie('password',$data_password,$data_time,'/');
           }
             //当会员登录成功后,计算当前会员的级别以及折扣率,并存到session中去
           $memberLevel=M('memberLevel');
           //取出当前会员在会员级别表中对应的级别这一行的信息
           $member_info=$memberLevel->where($info['integral']." between num_bottom and num_top")->find();
           //将会员级别和折扣率存到session中
            session('level_id',$member_info['id']);
            session('level_rate',$member_info['rate']);
           return true;  
       }
   }
   return false;
}   

//会员忘记密码的数据校验,按自己的思路实现的
//返回值解释:返回-1表示用户名检测错误,直接显示用户名或邮箱错误
 //返回-2表示邮箱检测错误,直接显示用户名或邮箱错误
public function chekEmail(){
   $email=$this->email;
     //先检查用户名,数据库中是否存在
   $user=$this->where('username="'.$this->username.'"')->find();
   if($user!==null){
     //然后检查邮箱地址是否正确
       if($user['email']==$email){
     //检查下邮箱是否已经验证过,没验证的需要验证下        
        if($user['email_checked']=='已验证'){
           $str=md5(uniqid());
           $this->where('id="'.$user['id'].'"')->save(array('email_chk_str'=>$str));
           $content="取回密码说明<br>".$user['username']."这封信是由 下资源 发送的。<br/>您收到这封邮件，是由于这个邮箱地址在 下资源 被登记为用户邮箱， 且该用户请求使用 Email 密码重置功能所致。<br/>";
           $content.="----------------------------------------------------------------------<br/>";
           $content.='重要！<br/>';
           $content.='----------------------------------------------------------------------<br/>';
           $content.='如果您没有提交密码重置的请求或不是 下资源 的注册用户，请立即忽略 并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的 内容。<br/>';
           $content.='----------------------------------------------------------------------<br/>密码重置说明<br/>----------------------------------------------------------------------<br/>';
           $content.='您只需在提交请求后的三天内，通过点击下面的链接重置您的密码：<br/><a href="http://www.jdd.com/index.php/Home/Index/change_password/email_chk_str/'.$str.'">http://www.jdd.com/index.php/Home/Index/forgetpassword/change_password/'.$str.'</a><br/>(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)<br>';    
           $content.='在上面的链接所打开的页面中输入新的密码后提交，您即可使用新的密码登录网站了。您可以在用户控制面板中随时修改您的密码<br/>';
           $content.='本请求提交者的 IP 为 119.162.55.213<br/>';
           $content.='此致<br/>下资源 管理团队. http://www.xiazy.net/';
           return $this->send_email($user['email'],'[百度云网盘资源下载论坛] 取回密码说明',$content);
       }else{
        $content=$user['username']." ,你好,感谢您的注册，请阅读以下内容<br/>,尊敬的".$user['username'].",点击以下链接完成注册:<br/><a href=http://www.jdd.com/index.php/Home/Index/chkReg/sn/".$user['email_chk_str'].">http://www.jdd.com/index.php/Home/Index/chkReg/sn/".$user['email_chk_str']."</a><br/> 您已经注册成为百度云网盘资源下载论坛的会员，下资源xiazy.com专注精致分享，精品资源天天有，每天期待您的到来，欢迎推荐您的好友一起加入！ 官方QQ群：371179161 荣誉会员QQ群：333014370 站长QQ：2011820123 如果您有什么疑问可以联系管理员，Email: 2011820123@qq.com 下资源<br/>".date('Y-m-d H:i:s');
        return $this->send_email($user['email'],'[百度云网盘资源下载论坛] '.$user['username'].'，您好，感谢您的注册，请阅读以下内容',$content);
    }
}else{
   return -2;
}
}else{
   return -1;
}    
}



}
