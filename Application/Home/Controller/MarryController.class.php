<?php
namespace Home\Controller;
use Think\Controller;
class MarryController extends Controller{
    public function index(){
    	// $where = $_GET['gtype'] ? $_GET['gtype'] : '婚庆';

        // var_dump($_GET);die;
    	$marry = M('marry');
        //设置条件
        
        $where = isset($_GET['gtype']) ? 'gtype= "'.$_GET['gtype'].'"' : 'gtype="婚庆"';

        


        switch ($_GET['gtype']) {
            case '婚庆':
                $stype = ['婚庆公司','婚车租赁','婚宴酒店','彩妆造型','婚庆用品','司仪','婚礼跟拍','婚纱礼服','珠宝首饰'];
                break;
            case '摄影摄像':
                $stype = ['婚纱摄影','写真/艺术照','儿童摄影','商业摄影','摄像录像','彩扩冲印','相框相册制作'];
                break;
            case '礼仪庆典':
                $stype = ['庆典公司','演出表演','场地布置','展览展会','活动策划','礼仪模特'];

                break;
            case '婚车租赁':
                $stype = ['婚庆公司','婚车租赁','婚宴酒店','彩妆造型','婚庆用品','司仪','婚礼跟拍','婚纱礼服','珠宝首饰'];
                break;
            case '婚纱摄影':
                $stype = ['婚纱摄影','写真/艺术照','儿童摄影','商业摄影','摄像录像','彩扩冲印','相框相册制作'];
                break;
            case '儿童摄影':
                $stype = ['婚纱摄影','写真/艺术照','儿童摄影','商业摄影','摄像录像','彩扩冲印','相框相册制作'];
                break;

            default:
                
                $stype = ['婚庆公司','婚车租赁','婚宴酒店','彩妆造型','婚庆用品','司仪','婚礼跟拍','婚纱礼服','珠宝首饰'];
                break;

        }
        // 页面a链接传值
        $price1 = $_GET['price1'];
        $price2 = $_GET['price2'];
        $price = isset($_GET['price1'])? 'and price > '.$price1.' and price <'.$price2 : '';

        // var_dump($price);
        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '婚庆';
        $stp = isset($_GET['stype']) ? ' and stype= "'.$_GET['stype'].'"' : '';


        $link = M('link');
        $link = $link->limit(11)->select();
        // var_dump($link);die;

        foreach ($link as $key => $value) {
                $link[$key]['pic'] = json_decode($link[$key]['pic']);

                // var_dump($marry[$key]['pic']);
        }

        $num = I('get.num');
        if(empty($num)) {
            $num =11;
        }
        //获取总数
        $count = $marry->where($where.$stp.$price)->count();
        //创建分页对象
        $page = new \Think\Page($count, $num);// 实例化分页类
        //获取页码字符串
        $pages = $page->show();
        //获取limit参数
        $limit = $page->firstRow.','.$page->listRows;
        //读取数据
        $marry=$marry->limit($limit)->where($where.$stp.$price)->select();

        foreach ($marry as $key => $value) {
                $marry[$key]['pic'] = json_decode($marry[$key]['pic']);

                // var_dump($marry[$key]['pic']);
        }

        $this->assign('pages', $pages);
        $this->assign('num',$num);

        $this->assign('gtype',$gtp);
        $this->assign('link',$link);
        $this->assign('stype',$stype);
        $this->assign('marry',$marry);
    	$this->display();
    }

    public function gettips(){
        //创建对象
        $tips = M('cartips');

        //获取总数
        $count = $tips->count();

        //创建分页对象
        $page = new \Think\Page($count, 5);

        //获取页码字符串
        $pages = $page->show();

        //获取limit参数
        $limit = $page->firstRow.','.$page->listRows;

        //读取数据
        $res = $tips->limit($limit)->select();

        //返回数据
        echo json_encode($res);
    }



     public function detail()
        {
        //获取id
        $id = I('get.id');
        
        //读取信息
        $info = M('marry')->find($id);
        $uid = $info['uid'];
        $use = M('user')->find($uid);
        $info['pic']=json_decode($info['pic']);
        $info['show_time'] = date('Y-m-d H',$info['show_time']);
        //分配变量

        // var_dump($use);die;
        // var_dump($info['pic']);die;
        $more = M('marry')->limit(6)->select();
        foreach ($more as $key => $value) {
            $more[$key]['pic'] = json_decode($more[$key]['pic']);
        }

        $order = M('order');
        $arr['seller'] = array('eq',$use['username']);
        $orders = $order->where($arr)->count();
        // var_dump($orders);die;
        $this->assign('orders',$orders);
        $this->assign('more',$more);
        $this->assign('user',$use);
        $this->assign('info', $info);
       
        //解析模板
        $this->display();
    }




    public function doBuy(){
        // var_dump($_POST);
        $user = M('user');
        //开启事务
        M()->startTrans();

        $buyer = I('post.buyer');
        $seller = I('post.seller');
        //买家扣除定金
        $arr['username'] = array('eq',$buyer);

        $bInfo  = $user->where($arr)->find();
        // var_dump($bInfo['money']);

        $bmoney = $bInfo['money'] - I('post.money');
        $bId = $bInfo['id'];

        // var_dump($bmoney);die;
        $bArr = array('id'=>$bId,'money'=>$bmoney);
        // var_dump($bId);die;
        $bResult = $user->save($bArr);
        // echo $user->_sql();die;


        //卖家收到定金
        $srr['username'] = array('eq',$seller);

        $sInfo  = $user->where($srr)->find();
        // var_dump($sInfo['money']);die;

        $smoney = $sInfo['money'] + I('post.money');
        $sId = $sInfo['id'];

        // var_dump($smoney);die;
        $sArr = array('id'=>$sId,'money'=>$smoney);

        $sResult = $user->save($sArr);


        // 订单表插入数据
        $order = M('order');
        $oArr = array('buyer'=>$buyer,'seller'=>$seller,'bTel'=>I('post.bTel'),'sTel'=>I('post.sTel'),'company'=>I('post.company'));
        $oResult = $order->add($oArr);



        // // 执行事务
        if($bResult && $sResult && $oArr){
            //插入成功 提交事务
            M()->commit();
            $this->ajaxReturn(1);
        }else{
            //插入失败 回滚
            M()->rollback();
            $this->ajaxReturn(0);
        }

    }


    public function checkUser(){
        //创建模型
        $user = M('user');
        //读取数据库
        $where['username'] = array('eq',I('post.buyer'));
        $info = $user->where($where)->find();
        $money = $info['money'];
        //判断结果
        if(empty($info)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn($money);
        }
    }


    public function shop(){
        $uid = I('get.uid');
        // echo 1;
        $this->display();
    }

    public function shop1(){
        $id = I('get.uid');
        //读取信息
        $info = M('marry')->find($id);
        $uid = $info['uid'];
        $use = M('user')->find($uid);
        // var_dump($use);
        $seller = $use['username'];

        $order = M('order');
        $where['seller'] = array('eq',$seller);
        $orders = $order->where($where)->select();
        // var_dump($orders[50]);

        
        
        $this->assign('orders',$orders);

        $this->display();
    }

}