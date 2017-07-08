<?php
    include("include/init.php");
    include("common_data.php");

    $product_id = isset($_GET['product_id']) ? $_GET['product_id']:0;//获取每页产品传过来的id
    if(!$product_id){
        show_msg("请重新选择产品","product_list.php");//如果不存在该产品就返回
        exit();
    }

    $sql = "SELECT COUNT(*) as c FROM {$pre_}order WHERE product_id = $product_id";//统计该产品的销量
    $pro_count = getOne($sql);



    //对景区票进行单独查询
    $sql = "SELECT * FROM {$pre_}product WHERE product_id = $product_id";
    $pro_one = getOne($sql);
    
   
    $pro_promise = $pro_one['product_promise'];//服务承诺循环
    $pro_promise = explode(",", $pro_promise);


?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $pro_one['product_name']?>（景区现付） - 农夫乐园官网</title>
    <link rel="stylesheet" href="static/css/fontello.css">
    <!--[if IE 7]><link rel="stylesheet" href="static/css/fontello-ie7.css"><![endif]-->
    <link rel="stylesheet" href="static/css/css.css" />
    <link rel="stylesheet" href="static/css/wuxie.css" />
    <script type="text/javascript" src="static/js/jquery-1.8.2.min.js"></script>
    
</head>
<body class="index_bg">
    <?php include("header.php");?>
    
<div class="banner_intro" style="background: url('static/images/201603301357517461691.jpg') no-repeat center bottom;"></div><div class="content_bg">
    <div class="content flx content_news">
        <div class="ticket_view bgwh">
            <div class="bread g9 fa_g9"><a href="index.php">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<?php echo $pro_one['product_name']?>（景区现付）</div>
            <div class="view_tit flx mt20">
                <h1 class="f24 yhei n lt"><?php echo $pro_one['product_name']?>（景区现付）</h1>
                <div class="rt flx">
                    <span class="yhei f14 lt">
                        <span class="fo">￥</span>
                        <strong class="f28 fo"><?php echo $pro_one['product_price']?></strong>
                        <span class="g9"></span>
                    </span>
                    <input class="btn bgorange bbo2 lt ml10" type="button" onclick="window.location.href='order.php?product_id=<?php echo $pro_one['product_id'];?>'" value="立刻订购">
                </div>
            </div>
            <div class="view_box1 flx mt20 bgwh">
                <div class="view_photo lt rel">
                    <ul class="rel">
                        <li class="banner_img"><img src="<?php echo $pro_one['product_img']?>" width="400" height="240" alt=""></li>
                      </ul>
                   
                </div>
                <div class="view_info lt">
                    <ul class="yhei f14">
                        <li class="flx">
                            <em class="lt g9">服务承诺</em>
                            <span class="flx lt">
                            <?php foreach($pro_promise as $item) {?>
                                <em class="lt flx vs_01"><b class="icon wh16 bc_i lt"></b><?php echo $item;?></em>
                            <?php }?>
                            </span>
                        </li>
                        <li><em class="g9">累计销量</em><span><?php echo $pro_count['c']?> 笔</span></li>
                        <li><em class="g9">景点地址</em><span><?php echo $pro_one['product_address'];?></span></li>
                        <li><em class="g9">营业时间</em><span><?php echo $pro_one['product_date'];?></span></li>
                    </ul>
                    <div class="view_info_map yhei f14 flx"><a href="#Traffic" class="flx rt"><b class="icon bc_i wh16 lt"></b>查看地图</a></div>
                </div>
            </div>
            <?php echo $pro_one['product_content']?>
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
        });
    </script>
    
</body>

</html>