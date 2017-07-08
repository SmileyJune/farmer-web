<?php

	session_start();
    date_default_timezone_set("PRC");//设置时区
    error_reporting(E_ALL ^E_NOTICE);//错误机制

    $conn = mysql_connect("localhost","root","root");//连接数据库
    mysql_select_db("famer");//连接数据库
    mysql_query("SET NAMES UTF8");//设置查询数据库编码

    $pre_ ="pre_";

    include("extends_helper.php");//包含辅助文件

?>