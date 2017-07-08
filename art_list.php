<?php 
    include("include/init.php");
    include("common_data.php");

    $art_id = isset($_GET['article_id']) ? $_GET['article_id'] : 1;
    //var_dump($art_id);exit;
    $current = isset($_GET['page']) ? $_GET['page'] : 1;//获取当前页

    $sql = "SELECT COUNT(*) AS c FROM {$pre_}article WHERE artcate_id = $art_id";
    //echo $sql;exit;
    $count = getOne($sql);
    //var_dump($count);exit;

    $limit = 5;
    $size = 4;

    $page_str = page($current,$count['c'],$limit,$size,"scott");
    //var_dump($page_str);exit;

    $start = ($current-1)*$limit;

    $sql = "SELECT * FROM {$pre_}article WHERE artcate_id=$art_id ORDER BY article_id DESC LIMIT $start,$limit";
    $art_list = getAll($sql);

    //查询列表页的景区介绍
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
    <title>景区介绍 - 农夫乐园官网</title>
    <link rel="stylesheet" href="static/css/fontello.css">
    <!--[if IE 7]><link rel="stylesheet" href="static/css/fontello-ie7.css"><![endif]-->
    <link rel="stylesheet" href="static/css/css.css" />
    <link rel="stylesheet" href="static/css/wuxie.css" />
    <link rel="stylesheet" href="static/css/page.css" />
     <script type="text/javascript" src="static/js/jquery-1.8.2.min.js"></script>
    
</head>
<body class="index_bg">
    <?php include("header.php");?>
    
<div class="banner_intro" style="background: url('static/images/201603301357517461691.jpg') no-repeat center bottom;"></div><div class="content_bg">
    <div class="content flx content_news content_news_list">
        <div class="ct_main">
            <div class="intro_tit flx">
                <h2 class="f24 n lt"><i class="icon-doc-text-inv f30 fb"></i>景区介绍 </h2>
            </div>

            <div class="news_list">
            <?php foreach($art_list as $item) {?>
                <dl class="flx">
                    <dt><a href="art_detail.php?article_id=<?php echo $item['article_id'];?>" target="_blank"><img src="<?php echo $item['article_img'];?>" width="182" height="110" /></a></dt>
                    <dd class="fa_blue">
                        <a href="art_detail.php?article_id=<?php echo $item['article_id'];?>" target="_blank" class=" f14"><?php echo $item['article_title'];?></a>
                        <span class="news_time db g9"><?php echo date("Y-m-d H:i:s",$item['article_time']);?></span>
                        <div class="news_text"><?php echo str_cut($item['article_desc'],0,150);?></div>
                    </dd>
                </dl>
            <?php }?>
            </div>
            
            <div class="page">
               <?php echo $page_str;?>
            </div>
     </div>
        <div class="ct_right">
            <div class="rt_tit"><h3>景区介绍</h3></div>
            <div class="ct_nav_box">
            <?php foreach($art_intro as $item) {?>
                <a href="art_detail.php?article_id=<?php echo $item['article_id'];?>" class="db">
                    <dl class="flx">
                        <dt class="lt"><img src="<?php echo $item['article_img'];?>" width="70" height="60" /></dt>
                        <dd class="lt">
                            <strong class="db"><?php echo $item['article_title'];?></strong>
                            <span class="g9 db"><?php echo $item['article_desc'];?></span>
                        </dd>
                    </dl>
                </a>
            <?php }?>
             </div>
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