<?php
include_once 'checkAdmin.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员管理系统</title>
</head>
<style>
    .main {
        width: 80%;
        margin: 0 auto;
        text-align: center;
    }

    h1 {
        text-align: center
    }

    h2 {
        text-align: center;
        font-size: 18px
    }

    h2 a {
        margin-right: 15px;
        color: blue;
        text-decoration: none;
    }

    h2 a:last-child {
        margin-right: 0;
    }

    h2 a:hover {
        color: crimson
    }
</style>
<body>
<div class="main">
    <?php
     include_once 'nav.php';
     include_once 'conn.php';
     $sql="select *  from userinfo order by id desc ";
     $result=mysqli_query($conn,$sql);

    ?>
    <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" align="center" width="90%">
        <tr>
            <td>序号</td>
            <td>用户名</td>
            <td>性别</td>
            <td>信箱</td>
            <td>爱好</td>
            <td>是否管理员</td>
            <td>操作</td>

        <?php
        $i=1;
        while ($info=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $info['username']; ?></td>
            <td><?php echo $info['sex']? '男':'女'; ?></td>
            <td><?php echo $info['email']; ?></td>
            <td><?php echo $info['fav']; ?></td>
            <td><?php echo $info['admin'] ?'是':'否'; ?></td>
            <td>操作</td>
        </tr>
        <?php
        $i++;
        }
        ?>

</div>
</body>
</html>

