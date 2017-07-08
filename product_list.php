<?php
    include("include/init.php");
    include("common_data.php");

    $current = isset($_GET['page']) ? $_GET['page']:1;

    $sql = "SELECT COUNT(*) AS c FROM {$pre_}product";
    $count = getOne($sql);

    $limit = 5;
    $size = 4;

    $str_page = page($current,$count['c'],$limit,$size,"scott");

    $start = ($current-1)*$limit;

    $sql = "SELECT * FROM {$pre_}product ORDER BY product_id DESC LIMIT $start,$limit";
    $pro_list = getAll($sql);


    //查询联系我们
    $sql = "SELECT * FROM {$pre_}settings WHERE set_id BETWEEN 25 AND 30";
    $art_info = getAll($sql);

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $pro_list[0]['product_name'];?> - 农夫乐园官网</title>
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
    <div class="content flx content_news">
        <div class="ct_main">
            <div class="intro_tit flx">
                <h2 class="f24 n lt"><i class="icon-ticket f30 fb"></i>门票预订</h2>
            </div>

            <div class="news_list">
            <?php foreach($pro_list as $item) {?>
                <dl class="flx">
                    <dt><a href="product_detail.php?product_id=<?php echo $item['product_id'];?>"><img src="<?php echo $item['product_img'];?>" width="182" height="110" /></a></dt>
                    <dd class="fa_blue rel">
                        <a href="product_detail.php?product_id=<?php echo $item['product_id'];?>" class="f14"><?php echo $item['product_name'];?>（景区现付）</a>
                        <span class="news_time db"><span>优惠价：<strong class="f14 fo">￥<?php echo $item['product_price'];?></strong></span><em class="g9 ml20">市场价：￥120.00</em></span>
                        <div class="news_text"><?php echo str_cut($item['product_desc'],0,150);?></div>
                        <a href="product_detail.php?product_id=<?php echo $item['product_id'];?>" class="order_list_btn">预订</a>
                    </dd>
                </dl>
            <?php }?>
            </div>
            
<div class="page">
    <?php echo $str_page;?>
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

                    <div class="rt_tit"><h3>关注我们</h3></div>
                    <div class="follow_view flx">
                        <img src="static/images/201603291531255264616.jpg" width="165" height="165" class="lt" />
                        <img src="static/images/ap02.png" width="124" height="80" class="lt follow_text" />
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