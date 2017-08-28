<?php
/**
 * 邮件发送函数
 */
    function sendMail($to, $title, $content) {
     
        Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"尊敬的客户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        return $mail->Send();
    }

//计算运费函数,最终没讲
    function getYunFei($company,$province,$city,$area,$weight){

    }

//获取原get上的变量并用新的变量替换,用于页面中调用
//这样在商品搜索页面中点击销量、价格、评论时od参数不会重复传递
    function inUrl($name,$value){
    //如果有新的值就加进去,原来的值就覆盖掉    
        $_GET[$name]=$value;
        $str='';
        //拼接get信息
        foreach ($_GET as $key => $value) {
            $str.='/'.$key.'/'.$value;
        }
        return $str;

    }



















?>