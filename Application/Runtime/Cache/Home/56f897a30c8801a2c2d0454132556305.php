<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发表留言</title>
</head>
<body>
<h1>发表留言</h1>
<form action="/index.php/Home/Index/do_post" method="post">
    <lavel for="content">请留言</lavel><br>
    <textarea name="content" id="content" rows="4" maxlength="100" required></textarea><br>
    <button>发表</button>
    <button type="reset">重置</button>
</form>
<p><a href="/index.php/Home/Index/index">首页</a></p>
</body>
</html>