<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言列表</title>
    <style type="text/css">
        .content{
            border: 1px solid #999999;
            margin: 10px 0px;
            padding: 6px;
            width: 60%;
        }
        .content span{
            color: blue;
            margin-right: 5px;
        }
    </style>
</head>
<body>
<h1>留言列表</h1>
<div>
    <?php if(empty($_SESSION['user']['username'])): ?><a href="<?php echo U('User/login');?>">登录</a>
        <a href="<?php echo U('User/register');?>">注册</a>
        <?php else: ?>
        欢迎您！<?php echo ($_SESSION['user']['username']); ?>
        <a href="/index.php/Home/Index/post"><strong>发表留言</strong></a>
        <a href="<?php echo U('User/logout');?>">退出登录</a><?php endif; ?>
</div>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="content">
    <span><?php echo ($v["content"]); ?></span><br>
    留言者：<span><?php echo ($v["username"]); ?></span>
    留言时间：<span><?php echo (date('Y-m-d H:i:s',$v["createdat"])); ?><span>
    <?php if(($_SESSION['user']['userId']) == $v["userid"]): ?><a href="<?php echo U('delete?id='.$v['messageid']);?>" onclick="return confirm('确定删除此条信息？')">删除</a><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<p><span><?php echo ($page); ?></span></p>
</body>
</html>