<?php
namespace Home\Controller;
use Home\Model\MessageViewModel;
use Think\Controller;
use Think\Model;
use Think\Page;
class IndexController extends Controller {
    //验证登录
    public function checkLogin()
    {
     if(!session('user.userId')){
        $this->error('请登录',U('User/login'));
     }
    }
    //留言列表
    public function index()
    {
        //$this->checkLogin();
        $model= new MessageViewModel();
        $count = $model->count();
        $page = new Page($count,5);
        $show = $page->show();
        $list = $model->order('messageId desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function post()
    {
        $this->checkLogin();
        $this->display();
    }
    public function do_post()
    {
        $this->checkLogin();
        $content = I('content');
        if(empty($content)){
            $this->error('留言不能为空');
        }
        if(mb_substr($content,'utf-8') >100){
            $this->error('留言字数不能大于100');
        }
        $model = M('Message');
        $userId = session('user.userId');
        $data = array(
          'content'=>$content,
            'createdAt'=>time(),
            'userId'=>$userId
        );
        $message = $model->create($data);
        $message = $model->add($data);
        if(!$message){
            $this->error('留言失败');
        }
        $this->success('留言成功',U('Index/index'));
    }
    public function delete()
    {
        $id = I('id');
        if(empty($id)){
            $this->error('缺少参数');
        }
        $this->checkLogin();
        $model=M('Message');
        if(!$model->where(array('messageId'=>$id,'userId'=>session('user.userId')))->delete()){
            $this->error('删除失败');
        }
        $this->success('删除成功',U('index'));
    }
}