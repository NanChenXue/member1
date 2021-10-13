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
<?php include_once 'nav.php';?>
<div class="main">
    <form action="postReg.php" method="post" onsubmit="return Check()">
        <table style="border-collapse: collapse" border="1" bordercolor="gray"
               cellpadding="10" cellspacing="0">
            <tr>
                <td align="right">用户名</td>
                <td align="left"><input type="text" name="username">
                    <span class="red">*</span>
                </td>

                <!--dataType="English" msg="用户名必须为英文字母" require="false"-->
            </tr>
            <tr>
                <td align="right">密码</td>
                <td align="left"><input type="password" name="pw" >
                    <span class="red">*</span>
                </td>
            </tr>
            <tr>
                <td align="right">确认密码</td>
                <td align="left"><input type="password" name="cpw">
                    <span class="red">*</span>
                </td>
            </tr>
            <tr>
                <td align="right">信箱</td>
                <td align="left"><input type="text" name="email"></td>
                <!--                dataType="Email" msg="信箱格式不正确"-->
            </tr>
            <tr>
                <td align="right">性别</td>
                <td align="left">
                    <input type="radio" name="sex" value="0" checked>男
                    <input type="radio" name="sex" value="1">女
                </td>
            </tr>
            <tr>
                <td align="right">爱好</td>
                <td align="left">
                    <input type="checkbox" name="fav[]" value="听音乐">听音乐
                    <input type="checkbox" name="fav[]" value="玩游戏">玩游戏
                    <input type="checkbox" name="fav[]" value="打游戏">打游戏
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
        let username = document.getElementsByName('username')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();
        let email = document.getElementsByName('email')[0].value.trim();
        //用户名必填
        /*if (username.length==0){
            alert("用户名必须填写");
            return false;
        }*/
        let usernameRge=/^[a-zA-Z0-9]{3,10}$/;
        if(!usernameRge.test(username)){
            alert('用户名必填，且只能是大小写字符构成，长度为3到10个字符！')
            return false;
        }
        let pwReg=/^[a-zA-Z0-9_*]{6,10}$/;
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
        return true;
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
