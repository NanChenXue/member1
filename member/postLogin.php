<?php
session_start();
//验证输入的用户名和密码是否正确
//第一步 连接数据库
$conn=mysqli_connect("localhost","root",'',"member") or die("数据库服务器连接失败!");
//第二步 指定字符集
mysqli_query($conn,"set names utf8");
//第三步 获取用户填写的用户名和密码
$username=trim($_POST['username']);
$pw=trim($_POST['pw']);
//第四步 判断用户名和密码是否正确
if(!strlen($username) || !strlen($pw)){
    echo "<script>alert('用户名和密码必须填写');history.back();</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('用户名必填，且只能大小写字符和数字构成，长度为3到10个字符！');history.back();</script>";
        exit;
    }
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
        echo "<script>alert('密码必填，且只能大小写字符和数字，以及*、_构成，长度为6到10个字符！');history.back();</script>";
        exit;
    }
}



$sql="select * from userinfo where userinfo='$username' and pw='".md5($pw)."'";
$result=mysqli_query($conn,$sql);
$n=mysqli_num_rows($result);
if($n){
    $_SESSION['loggedUsername']=$username;
    //判断是不是管理员
    $info=mysqli_fetch_array($result);
    if($info['admin']){
        $_SESSION['isAdmin']=1;
    }
    else{
        $_SESSION['isAdmin']=0;
    }
    echo "<script>alert('登陆成功！')</script>";
}
else{
    unset($_SESSION['loggedUsername']);//销毁session对象  session_destory()销毁系统中所有session对象
    unnset($_SESSION['isAdmin']);
//    $_SESSION['loggedUsername']='';
    echo "<script>alert('登陆失败！');history.back();</script>";
}