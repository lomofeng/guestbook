<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Home\Model\MessageViewModel;
class UserController extends Controller {
    //注册表单
    public function register()
    {
        $this->display();
    }
    //注册处理
    public function do_register()
    {
        $username =I('username');
        $password = I('password');
        $repassword = I('repassword');
        if(empty($username)){
            $this->error('用户名不能为空');
        }
        if(empty($password)){
            $this->error('密码不能为空');
        }
        if($repassword!=$password){
            $this->error('确认密码错误');
        }
        //检查用户是否注册过
        $model = new Model('User');
        $user = $model->where(array('username'=>$username))->find();
        if(!empty($user)){
            $this->error('该用户已经注册');
        }
        $data = array(
            'username'=>$username,
            'password'=>md5($password),
            'createdAt'=>time()
        );
        if(!($model->create($data)&&$model->add($data))){
            $this->error('注册失败'.$model->getError());
        }
        $this->success('注册成功,请登录',U('login'));
    }
    //用户登录
    public function login()
    {
        $this->display();
    }
    //用户登录处理
    public function do_login()
    {
        $username = I('username');
        $password = I('password');
        $model = M('User');
        $user = $model->where(array('username'=>$username))->find();
        //var_dump($user);die;
        if(empty($user)||$user['password']!=md5($password)){
            $this->error('账号或密码错误',U('login'));
        }
        //写入session
        session('user.userId',$user['userid']);
        session('user.username',$user['username']);
        //跳转首页
        $this->redirect('Index/index');
    }
    public function logout()
    {
        if(!session('user.userId')){
            $this->error('请登录');
        }
        session_destroy();
        $this -> success('退出登录成功',U('Index/index'));
    }
}