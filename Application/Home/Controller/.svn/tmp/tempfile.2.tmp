<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    

     public function login(){
        // $code = getCode();
        // var_dump($code);die;
        session('id',null);
        session('username',null);
  		$this->display();
    }

     public function code(){
     	$code = getCode();
     }

    //登陆处理   账号登陆
    public function doLogin()
    {
        // var_dump($_POST);die;
        //创建模型
        $user = M('user');
        //读取数据库
        $where['username'] = array('eq',I('post.username'));
        $where['pwd'] = array('eq',I('post.password'));



        $info = $user->where($where)->find();
        //判断结果

        // var_dump($info);die;

        if(empty($info)){
            // $this->error('用户名或者是密码错误', U('Home/User/login'),3);
            $this->redirect('Home/User/login',array('cate_id' => 2), 2, '用户名或密码错误,即将返回...');
        }else{
            //写入session  session('id')
            if(I('post.remember')){
                session("remember"."{$info['id']}",I('post.remember'),3600*24*2);
                // echo session('"remember"."{$info[\'username\']}"');die;
            }
            session('id',$info['id']);
            session('id',$info['id']);
            session('username',$info['username']);
            $this->assign('username',session('username'));
            // $this->success('登陆成功', U('Home/Index/index'),3);
            
            if(!empty($_POST['url'])){
                $this->redirect($_POST['url'],array('cate_id' => 2), 2, '登陆成功,请稍后...');
            }else{
                $this->redirect('Home/Index/index',array('cate_id' => 2), 2, '登陆成功,请稍后...');
            }
        }
    }


    // 退出登录
    public function tuichu(){
        session('id',null);
        session('username',null);
        $this->display('Index/index');
    }


    public function dotelLogin(){
        // var_dump($_POST);
        //创建模型
        $user = M('user');
        //读取数据库
        $where['tel'] = array('eq',I('post.telphone'));
        $info = $user->where($where)->find();
        //判断结果
        if(empty($info)){
            $this->error('用户名或者是密码错误', U('Home/User/login'),3);
        }else{
            session('id',$info['id']);
      
            session('username',$info['username']);
            $this->assign('username',session('username'));
            $this->success('登陆成功', U('Home/Index/index'),3);
        }

    }

    public function checkTel(){
         //创建模型
        $user = M('user');
        //读取数据库
        $where['tel'] = array('eq',I('post.tel'));
        $info = $user->where($where)->find();
        //判断结果
        if(empty($info)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }


    public function select()
    {
        $username = I('post.username');
    // 创建模型
        $user = M('user');
        $where['username'] = array('eq',$username);
        $info = $user->where($where)->find();
        // echo remember"."{$info['id']};die;
        if(session("remember"."{$info['id']}")){

            

            $detail1 = 'Y ';
            $detail = $detail1.$info['pwd'];
            
            
        }
        echo $detail;
    }


   





     //获取验证碼
    public function send()
    {
        $to = I('post.phone');
        // var_dump($to);die;
        // var_dump($_POST);die;
        session_start();
        $code = rand(100000,999999);
        //存入session
        session('code',$code);
        session('phone',$to);
        $_SESSION['code'] = $code;
        $_SESSION['telephone'] = $to;


        // reg.exec()   正则匹配的结果
        // var_dump($to);
        // var_dump($_POST);
        // var_dump($code);
        // die;
        $res = sendMessage($to,$code);
        // echo $res;die;
        if($res){
                // $this->assign('$code',$session('code'));
                $code = json_encode(session('code'));
                // $this->ajaxReturn(1);
                // return $code;
                $this->ajaxReturn($code);
            
        }else{
                // echo 212323;
                $this->ajaxReturn(0);
          
        }
    }


    public function check(){
        // alert(1345);
        $ucode = I('get.ucode');
        // var_dump($ucode);die;
        if(check_verify($ucode)){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }


    // 密码找回
     public function passRecycle(){
        $this->display();
    }




    public function register(){
       $this->display();
    }

    public function checkUser(){
        //创建模型
        $user = M('user');
        //读取数据库
        $where['username'] = array('eq',I('post.username'));
        $info = $user->where($where)->find();
        //判断结果
        if(empty($info)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }


    public function doRegister(){
        // var_dump($_POST);die;

        //开启事务
        M()->startTrans();

        $user = M('user');//创建对象
        $_POST['status'] = 1;//
        $_POST['isdelete'] = 0;//是否删除
        $_POST['pwd'] = $_POST['password'];//密码加密
        //过滤字段
        $user->create();
        $uid = $user->add();


        //实例化详情表对象
        $detail = M('user_detail');

        $_POST['uid'] = $uid;//用户id
        $_POST['rtime'] = time();//注册时间

        //过滤字段
        $detail->create();

        //插入详情表
        $res = $detail->add();

        if($uid && $res){
            //插入成功 提交事务
            M()->commit();
            $this->success('注册成功', U('Home/User/login'),3);
        }else{
            //插入失败 回滚
            M()->rollback();
            $this->success('注册失败', U('Home/User/register'),3);
        }

    }


    public function doRecycle(){
        // var_dump($_POST);
        $code = rSend();
        var_dump($code);
    }

    

    public function uInfoSelect(){
        // var_dump($_POST);
        $tel = I('post.tel');
        $where = ' tel = '.$tel;
        $user = M('user');
        $info = $user->where($where)->select();
        // echo $user->_sql();die;
        $info = json_encode($info);
        if($info){
            $this->ajaxReturn($info);
        }else{
            $this->ajaxReturn(0);
        }
    }

    public function doReset(){
        // var_dump($_POST);die;
       $username = $_POST['username'];
       $password = $_POST['password'];
       $id = $_POST['id'];

       $user = M('user');

       $arr = array('id'=>$id,'username'=>$username,'pwd'=>$password);

       $res = $user->save($arr);
       // echo $user->_sql();die;
       // var_dump($res);

        $this->redirect('Home/User/login',array('cate_id' => 2), 0, '修改成功,请稍后...');
        
    }
}