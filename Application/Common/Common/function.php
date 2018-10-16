<?php 
	
	//发送短信  http://www.xiaohigh.com/sendMessage/index.php?to=18311422275&code=5211314&class=117&web=%E5%B0%8Fhigh
	function sendMessage($to,$content){
		//创建curl对象 类前面添加上命名空间
		$curl = new \Org\Util\Curl;
		//发起请求 网址是强哥的,class=117相当于默认秘钥(要用时找强哥要) C()是获取配置文件里面的内容的 也可以设置配置
		$res = $curl->get("http://www.xiaohigh.com/sendMessage/index.php?to={$to}&code={$content}&class=117&web=".C('title'));

		//解析结果
		$res = json_decode($res);
		if($res->resp->respCode == '000000'){
			return true;
		}else{
			return false;
		}
		
	}

	function getCode(){
		$Verify =     new \Think\Verify();
		$Verify->fontSize = 30;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->entry();
	}

	function check_verify($code, $id = ''){  
	  $verify = new \Think\Verify();    
	  return $verify->check($code, $id);
	}

	//  jcqloveme@163.com----19880801lrx
		// jcqshx@163.com----duanpengfei
		// jcqwangyang@163.com----401899935
		// jcrgq@163.com----6207239
		// jcrlb9401@163.com----xst712819
		// jcrz1228@163.com----88400916
		// jcs2007312027@163.com----881227
		// jcs479141609@163.com----jcs666
		// jcs495705122@163.com----495705122
		// jcs6222139@163.com----jcs19870620
		// jcsaisai@163.com----jc554812
		// jcsgtx@163.com----2218236
		// jcshishi@163.com----1987915723
		// jcshuijiao@163.com----123456
		// jcsjitjl@163.com----13753689855
		// jcskin@163.com----6669870
		// jcsmsy@163.com----3975339753
		// jcsshen@163.com----shenshen
		// jcsuhl@163.com----19330425
		// jcsw04001@163.com----19897575
		// jcswy1980@163.com----1355299
		// jcsyubin@163.com----5828859
		// jct6556671@163.com----6556671

		// jctchy@163.com----tchy2122944
		// jctl8864921@163.com----jctl469884468
		// jctmy131@163.com----jctmy130
		// jctq4@163.com----123456
		// jctwys@163.com----lhwjzwhf
		// jcuicui0923@163.com----729488331
		// jcw1975@163.com----5781963380
		// jcw20cs@163.com----jcwjcw
		// jcw322@163.com----2263421
		// jcw_888@163.com----520123
		// jcwb520@163.com----823240
		// jcwdtx@163.com----198677
		// jcwhuanghai@163.com----guizuonan
		// jcwmsm@163.com----jinceng
		// jcwolaopo@163.com----jinchen503
		// jcwq1025@163.com----6259010
		// jcwq315@163.com----86027315DGX
		// jcwx9999@163.com----jcwx8888
		// jcwytt@163.com----123456
		// jcwz4010@163.com----jr08040325
		// jcx0062@163.com----235689
		// jcx1128@163.com----jcx7608
		// jcx12345678@163.com----19830306
		// jcx19830623@163.com----123400

		// jcx19870324@163.com----19870324
		// jcx3008@163.com----gonzo0113
	//发送邮件  $to 给某个邮箱发送  $content发送的内容  $title邮件的标题
	function sendMail($to, $content, $title){
		//实例化对象
        $mail=new \Org\Util\PHPMailer();

        $mail->CharSet = "utf-8";  //设置采用utf8中文编码
        $mail->IsSMTP();                    //设置采用SMTP方式发送邮件
        $mail->Host = "smtp.qq.com";    //设置邮件服务器的地址
        $mail->Port = 25;                           //设置邮件服务器的端口，默认为25  如果需要使用google邮箱的话 使用443
        $mail->From = C('mailUsername');  //设置发件人的邮箱地址
        $mail->FromName = "我的小站";                       //设置发件人的姓名
        $mail->SMTPAuth = true;                                    //设置SMTP是否需要密码验证，true表示需要
        $mail->Username = C('mailUsername');//
        $mail->Password = C('mailPass');
        $mail->Subject = $title;     //设置邮件的标题
        $mail->AltBody = "text/html";         // optional, comment out and test

        $mail->Body = $content;
        $mail->IsHTML(true);            //设置内容是否为html类型
		//$mail->WordWrap = 50;           //设置每行的字符数
        $mail->AddReplyTo(C('mailUsername'), "我的小站");     //设置回复的收件人的地址

        $mail->AddAddress(trim($to), $name);     //设置收件的地址
        if (!$mail->Send()) {                    //发送邮件
            echo '发送失败:'.$mail->ErrorInfo;
        } else {
           echo "发送成功";
       } 
	}
	


 ?>