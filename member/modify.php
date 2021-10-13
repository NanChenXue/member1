<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员注册管理系统</title>
</head>
<style>
    h1 {
        text-align: center
    }

    .current {
        color:: darkgreen
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

    h2 a:hover {
        color: #dc143c
    }

    .main {
        width: 50%;
        margin: 0 auto;
    }

    .main table {
        width: 100%
    }

    /* .main table tr td:first-child {
         text-align: center
     }

     .main table tr td:nth-child(2) {
         text-align: center
     }*/
    .main table .red {
        color: red;
    }
</style>
<body>
<?php
    include_once 'nav.php';
    include_once 'conn.php';
    $sql="select * from userinfo where userinfo='".$_SESSION['loggedUsername']."'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        $info=mysqli_fetch_array($result);//抓取从数据集中 得到数组
        $fav=explode(",",$info['fav']);//将字符串以指定的分割符分割成数组
        //print_r($fav);

    }
    else{
        die("未找到用户!");
    }
?>
<div class="main">
    <form action="postModify.php" method="post" onsubmit="return Check()">
        <table style="border-collapse: collapse" border="1" bordercolor="gray"
               cellpadding="10" cellspacing="0" onSubmit="return Validator.Validate(this,2)">
            <tr>
                <td align="right">用户名</td>
                <td align="left"><input type="text" name="username" readonly value="<?php echo $info['userinfo'];?>"></td>

                <!--dataType="English" msg="用户名必须为英文字母" require="false"-->
            </tr>
            <tr>
                <td align="right">密码</td>
                <td align="left"><input type="password" name="pw" placeholder="不修改密码请留空"></td>
            </tr>
            <tr>
                <td align="right">确认密码</td>
                <td align="left"><input type="password" name="cpw" placeholder="不修改密码请留空"></td>
            </tr>
            <tr>
                <td align="right">信箱</td>
                <td align="left"><input type="text" name="email" value="<?php echo $info['email'];?>"></td>
                <!--                dataType="Email" msg="信箱格式不正确"-->
            </tr>
            <tr>
                <td align="right">性别</td>
                <td align="left">
                    <input type="radio" name="sex" value="0" <?php if(!$info['userinfo']){echo "checked";}?>>男
                    <input type="radio" name="sex" value="1" <?php if($info['userinfo']){?>checked<?php}?>>女
                </td>
            </tr>
            <tr>
                <td align="right">爱好</td>
                <td align="left">
                    <input type="checkbox" name="fav[]" <?php if(in_array('听音乐',$fav))
                        echo 'checked';?> value="听音乐">听音乐
<!--                    判断数组里是否有该元素-->
                    <input type="checkbox" name="fav[]" value="玩游戏" <?php if(in_array('玩游戏',$fav))
                        echo 'checked';?>>玩游戏
                    <input type="checkbox" name="fav[]" value="打游戏" <?php if(in_array('打游戏',$fav))
                        echo 'checked';?>>打游戏
                </td>
            </tr>
            <tr>
                <td><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
        </table>
    </form>
</div>
</body>
<!--<script src="js.js" type="text/javascript"></script>-->
<script>
    function Check(){
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();
        let email = document.getElementsByName('email')[0].value.trim();
        //用户名必填
        /*if (username.length==0){
            alert("用户名必须填写");
            return false;
        }*/
       /* let usernameRge=/^[a-zA-Z0-9]{3,10}$/;
        if(!usernameRge.test(username)){
            alert('用户名必填，且只能是大小写字符构成，长度为3到10个字符！')
            return false;
        }*/
        let pwReg=/^[a-zA-Z0-9_*]{6,10}$/;
        if(pw.length>0){
            if(!pwReg.test(pw)){
                alert("密码必填且只能为大小写字母和数字，以及#、_构成，长度为6到10个字符");
                return false;
            }
            else{
                if(pw!=cpw){
                    alert("密码和确认密码必须相同！");
                    return false;
                }
            }
        }
        let emailReg=/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
        if(email.length>0) {
            if (!emailReg.test(email)) {
                alert("邮箱格式必须正确！")
                return false;
            }
        }
        return true;
    }
</script>
</html>
