  //首页ajax,检测session页面刷新时,是否有用户登录,有就修改成用户名
  $(document).ready(function(){
     //设置一个全局变量,这样用于,ajax检查用户有没有登录
     window.login=null;
     $.ajax({
      type:'get',
      dataType:'json',
      url:'/index.php/Home/Index/ajaxChkLogin',
      success:function(value){
          //判断用户id是否存在
          //说明用户已经登录,用js判断用户登录,在隐藏评论功能时会用到
          if(value.id){
            window.login=value.id;
          }
          var login_info=$('.login_info');
          if(value!='-1'){
            login_info.html('您好，'+value.username+' <a href="/index.php/Home/Index/logout">退出</a>');   
          } else{
            login_info.html('您好，欢迎来到京西！[<a href="/index.php/Home/Index/login">登录</a>] [<a href="/index.php/Home/Index/regist">免费注册</a>] ');  
          }
        }
      });  
     
     
     
   });
