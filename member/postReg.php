<?php
#获取前端的数据
header("Content-Type:text/html;charset:utf-8");
$username=trim($_POST['userinfo']);
$pw=trim($_POST['pw']);
$cpw=trim($_POST['cpw']);
$email=$_POST['email'];
$sex=$_POST['sex'];
$fav=implode(",",$_POST['fav']);


//include_once "conn.php";//链接数据库

#将数据导入数据库
#第一步 连接数据库
$conn=mysqli_connect("localhost","root",'');
#第二步 选择数据库
mysqli_select_db($conn,"member");
#第三步 指定字符集
mysqli_query($conn,"set names utf8");
#进行必要的验证 判断用户名和密码必须输入 以及两次密码必须一致
if(empty($username) or empty($pw)) {
    echo "<script>alert('用户名或密码必须输入！');history.back();</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('用户名必填，且只能是大小写字符构成，长度为3到10个字符！！');history.back();</script>";
        exit;
     }

    }
if($pw!=$cpw){
    echo "<script>alert('密码必须一致！');history.back();</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
        echo "<script>alert('密码必填且只能为大小写字母和数字，以及#、_构成，长度为6到10个字符');history.back();</script>";
        exit;
    }
}
if(!empty($email)){
    if(!preg_match('/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/',$email)){
        echo "<script>alert('邮箱格式必须正确');history.back();</script>";
        exit;
    }
}


#判断当前用户名是否存在
$sql="select * from userinfo where userinfo='$username'";//查询语句
$result=mysqli_query($conn,$sql);//返回结果集
$num=mysqli_num_rows($result);//判断表里是否有用户名
if($num){ //如果num=1 说明表里有相同的用户名 弹出弹框提示用户
    echo "<script>alert('此用户名已经被占用!');history.back();</script>";
    exit;
}
//else{//说明用户名没有被占用 则插入到数据库中
//    $sql = "insert into userinfo(userinfo,pw,cpw,email,sex,fav)
//values ('$username','$pw','$cpw','$email','$sex','$fav')";
//    $result=mysqli_query($conn,$sql);//执行查询语句
//   /* mysqli_error($conn);//输入错误提示
//    exit;*/
//    if($result){
//        echo "<script>alert('注册成功！'); location.href='index.php';</script>";
//    }
//    else {
//        echo "<script>alert('注册失败！'); history.back();</script>";
//    }
//}


#第四步 完成数据库的基本操作 插入数据
$sqlString="insert into userinfo (userinfo,pw,cpw,email,sex,fav)
values ('$username','". md5($pw)."','".md5($cpw)."','$email','$sex','$fav')";
$result=mysqli_query($conn,$sqlString);
if($result){
    echo "<script>alert('数据插入成功！');location.href='index.php';</script>";
}
else{
    echo "<script>alert('数据插入失败！');history.back();</script>";
}


//echo "您输入的用户名是：" . $username ."<br>";
//echo "您输入的密码是：" . $pw ."<br>";
//echo "您输入的确认密码是：" . $cpw ."<br>";
//echo "您输入的信箱是：" . $email ."<br>";
//echo "您输入的性别是：" . $sex ."<br>";
//echo "您输入的爱好：" . $fav ."<br>";




#将数据导入数据库
#第一步 连接数据库
#$conn=mysqli_connect("localhost","root",'');
#第二步 选择数据库
#mysqli_select_db($conn,"member");
#第三步 指定字符集
#mysqli_query($conn,"set names utf8");

