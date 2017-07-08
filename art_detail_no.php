<?php 

    include("include/init.php");
    include("common_data.php");
    $article_id = isset($_GET['article_id']) ? $_GET['article_id'] :0;//接收点击a标签传过来的参数
    if(!$article_id){
        show_msg("您访问的页面不存在","index.php");
        exit;
    }
    
    $sql = "SELECT * FROM {$pre_}article WHERE article_id = $article_id";
    $art_content = getOne($sql);
    //var_dump($art_content);exit;
    
    //查询图文
    $sql = "SELECT * FROM {$pre_}article WHERE artcate_id = 1 ORDER BY article_id DESC LIMIT 7 ";
    $art_intro = getAll($sql);

    //查询联系我们
    $sql = "SELECT * FROM {$pre_}settings WHERE set_id BETWEEN 25 AND 30";
    $art_info = getAll($sql);

?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $art_content['article_title'];?> - 农夫乐园官网</title>
    <link rel="stylesheet" href="static/css/fontello.css">
    <!--[if IE 7]><link rel="stylesheet" href="static/css/fontello-ie7.css"><![endif]-->
    <link rel="stylesheet" href="static/css/css.css" />
    <link rel="stylesheet" href="static/css/wuxie.css" />
    <script type="text/javascript" src="static/js/jquery-1.8.2.min.js"></script>
    
</head>
<body class="index_bg">

    <?php include("header.php");?>

<div class="banner_intro" style="background: url('static/images/201603301357517461691.jpg') no-repeat center bottom;"></div><div class="content_bg">
    <div class="content flx">
        <div class="ct_main">
            <div class="intro_main_tit"><h2><?php echo $art_content['article_title'];?></h2></div>
            <div class="intro_main_tips">
                <div class="intro_main_essay_text">
                   <?php echo $art_content['article_content'];?>
                </div>
            </div>
        </div>
        <div class="ct_right">
            <div class="rt_tit"><h3>联系我们</h3></div>
            <div class="contact_view">
                <ul>
                <?php foreach($art_info as $item) {?>
                    <li><i class=""></i><?php echo $item['set_value'];?></li>
                <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
    
    <?php include("footer.php");?>
   
    <script>
        $(document).ready(function () {
            $(".nav ul li").hover(function () {
                $(this).addClass("nav_clo");
            }, function () {
                $(this).removeClass("nav_clo");
            });

            $(".contact_view li").each(function(e){
                switch(e){
                    case 0:
                        $(this).find("i").eq(0).addClass("icon-phone");
                        break;
                    case 1:
                        $(this).find("i").eq(0).addClass("icon-fax");
                        break;
                    case 2:
                        $(this).find("i").eq(0).addClass("icon-mail");
                        break;
                    case 3:
                        $(this).find("i").eq(0).addClass("icon-qq");
                        break;
                    case 4:
                        $(this).find("i").eq(0).addClass("icon-wechat");
                        break;
                    case 5:
                        $(this).find("i").eq(0).addClass("icon-location");
                        break;
                } 
            });
        });
    </script>
    
</body>

</html>