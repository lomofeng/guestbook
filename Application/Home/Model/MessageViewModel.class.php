<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/16
 * Time: 12:56
 */
namespace Home\Model;
use Think\Model\ViewModel;
class MessageViewModel extends ViewModel{
    public $viewFields = array(
      'Message'=>array('messageId','content','createdAt'),
        'User'=>array('userId','username','_on'=>'User.userId=Message.userId')
    );
}