<?php
#将数据导入数据库
#第一步 连接数据库
$conn=mysqli_connect("localhost","root",'');
#第二步 选择数据库
mysqli_select_db($conn,"member");
#第三步 指定字符集
mysqli_query($conn,"set names utf8");