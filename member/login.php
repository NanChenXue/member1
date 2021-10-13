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
    <title>会员登录</title>
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

    /*.main table tr td:first-child {*/
    /*    text-align: center*/
    /*}*/

    /*.main table tr td:nth-child(2) {*/
    /*    text-align: center*/
    /*}*/
    .main table .red {
        color: red;
    }
</style>
<body>
<?php include_once 'nav.php';?>
<div class="main">
    <form action="postLogin.php" method="post">
        <table style="border-collapse: collapse" border="1" bordercolor="gray"
               cellpadding="10" cellspacing="0" >
<!--        onSubmit="return Validator.Validate(this,2)-->
        <tr>
            <td align="right">用户名</td>
            <td align="left"><input type="text" name="username">
                <span class="red">*</span>
            </td>

            <!--dataType="English" msg="用户名必须为英文字母" require="false"-->
        </tr>
        <tr>
            <td align="right">密码</td>
            <td align="left"><input type="password" name="pw">
                <span class="red">*</span>
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
<script>
    function check(){
        let username = document.getElementsByName('username')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw=document.getElementsByName('cpw')[0].value.trim();
        //用户名验证
        let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
        if(!usernameReg.test(username)){
            alert('用户名必填，且只能大小写字符和数字构成，长度为3到10个字符！');
            return false;
        }
        let pwReg = /^[a-zA-Z0-9_*]{6,10}$/;
        if(!pwReg.test(pw)){
            alert('密码必填，且只能大小写字符和数字，以及*、_构成，长度为6到10个字符！');
            return false;
        }
        return true;
    }
</script>
</html>
