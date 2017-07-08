<?php
	include("include/init.php");
	include("common_data.php");

	//查询景区展示
	$sql = "SELECT * FROM {$pre_}nav WHERE parent_id = 1 LIMIT 7";
	$nav_two = getAll($sql);

	//查询景区介绍图文
	$sql = "SELECT * FROM {$pre_}article WHERE article_id IN(3,4,58,59,60)";
	$art_intro = getAll($sql);

	//查询景区资讯
	$sql = "SELECT * FROM {$pre_}article AS article LEFT JOIN {$pre_}article_cate AS cate ON article.artcate_id = cate.artcate_id WHERE article.artcate_id = 2 LIMIT 3";
	$art_list = getAll($sql);

	//查询门票预订
	$sql = "SELECT * FROM {$pre_}product LIMIT 5";
	$art_product = getAll($sql);
	
	//查询景区美图
	$sql = "SELECT * FROM {$pre_}article WHERE artcate_id = 3 LIMIT 5";
	$art_play = getAll($sql);
	
	//查询关于我们
	$sql = "SELECT * FROM {$pre_}settings WHERE set_id BETWEEN 25 AND 30";
	$sql_set = getAll($sql);
	
	//查询交通指南
	$sql = "SELECT * FROM {$pre_}article WHERE article_id=57";
	$art_map = getOne($sql);
    //var_dump($art_map);exit;
	
	//查询二维码和qq输出
	$sql = "SELECT * FROM {$pre_}settings WHERE set_id IN(28,31)";
	$art_code = getAll($sql);
	
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>首页 - 农夫乐园官网</title>
    <link rel="stylesheet" href="static/css/fontello.css">
    <!--[if IE 7]><link rel="stylesheet" href="static/css/fontello-ie7.css"><![endif]-->
    <link rel="stylesheet" href="static/css/css.css" />
    <link rel="stylesheet" href="static/css/wuxie.css" />
    <script type="text/javascript" src="static/js/jquery-1.8.2.min.js"></script>
    <style>
		.photo_view ul li img{
			width: 560px;
		}
		.photo_view ul li:nth-child(3) img,
		.photo_view ul li:nth-child(4) img{
			width: 275px;
		}
    </style>
</head>
<body class="index_bg">
   
    <?php include("header.php");?>

<div class="banner">
    <div class="banner_box rel">
        <ul class="flx">
                    <li class="banner_pic" style=""><a style="background: url('static/images/201609251528471821984.jpg') no-repeat center top; background-size: cover;"></a></li>

        </ul>
        <div class="banner_page">
            <a href="javascript:f2.prev();" class="abs banner_up"><i class="icon-left-open"></i></a>
            <a href="javascript:f2.next();" class="abs banner_next"><i class="icon-right-open"></i></a>
        </div>
        <div class="abs" style="display: none;">
            <em class="banner_p"></em>
        </div>

    </div>

</div>
<div class="tc page_next"><a href="javascript:;" class="f_wh"><i class="icon-angle-down fadeInDown fadeIn"></i></a></div>

<div class="photo_bg">
    <div class="photo">
        <div class="intro_tit flx">
            <h2 class="f24 n lt"><i class="icon-picture f30 fb"></i>景区展示</h2>
            <ul class="lt photo_nav">
            	<?php foreach($nav_two as $item) {?>
                <li><a href="<?php echo $item['nav_url'];?>"><?php echo $item['nav_name'];?></a></li>
                <?php }?>
             </ul>
        </div>
        <div class="photo_view">
            <ul class="flx">
            	<?php foreach($art_intro as $key=>$item) {?>
		            <li class="photo_view_0<?php echo $key+1;?>"><a href="art_detail.php?article_id=<?php echo $item['article_id'];?>" class="db rel"><img src="<?php echo $item['article_img'];?>" class="db" width="560" height="320"><span class="abs fw f18"><?php echo $item['article_title'];?></span></a></li>
				<?php }?>		            
            </ul>
        </div>
    </div>
</div>

<div class="infor_bg">
    <div class="infor flx">

        <div class="main lt">
            <div class="news">
                <div class="intro_tit flx">
                    <h2 class="f24 n lt"><i class="icon-doc-text-inv f30 fb"></i>景区资讯</h2>
                </div>
                <div class="news_list">
                <?php foreach($art_list as $item) {?>
                    <dl class="flx news_list_top">
                        <dt><a href="art_detail.php?article_id=<?php echo $item['article_id'];?>"><img src="<?php echo $item['article_img'];?>" width="182" height="110" /></a></dt>
                        <dd class="fa_blue">
                            <a href="art_detail.php?article_id=<?php echo $item['article_id'];?>" class="f14"><?php echo $item['article_title'];?>
                                   <em class="news_list_icon"><?php echo $item['artcate_name'];?></em>

                            </a>
                            <span class="news_time db g9"><?php echo date('Y-m-d',$item['article_time']);?></span>
                            <div class="news_text"><?php echo $item['article_desc'];?></div>
                        </dd>
                    </dl>
                   <?php }?>
                </div>
            </div>

            <div class="play">
                <div class="intro_tit flx">
                    <h2 class="f24 n lt"><i class="icon-camera f30 fb"></i>景区游玩</h2>
                </div>
                <div class="play_box flx">
                    <dl class="lt">
                        <dt><img src="<?php echo $art_play[0]['article_img'];?>" width="263" height="174" /></dt>
                       	<dd>
                        <h3 class="f14 tc"><?php echo $art_play[0]['article_title'];?></h3>
                        <p class="fa_green g6 lh18">
                           <?php echo str_cut($art_play[0]['article_desc'],0,100);?>
                            <a href="#">[了解更多]</a>
                        </p>
                        </dd>
                    </dl>
                    <ul class="flx lt">
                    <?php foreach($art_play as $key=>$item) {?>
                    	<?php if($key == 0){continue;}?>
                        <li><img src="<?php echo $item['article_img'];?>" width="207" height="125" /><span class="db tc"><?php echo $item['article_title'];?></span></li>
                    <?php }?>
                    </ul>
				</div>
            </div>
            <div class="index_ad mt20">
        <a href="http://www.zjnby.com/Home/View?ID=251" target="_blank"><img src="static/images/201607200142365837407.jpg" width="745" height="165" class="db" border="0"></a>

            </div>
        </div>
        
        <div class="infor_right rt">

            <div class="ticket">
                <div class="intro_tit flx">
                    <h2 class="f24 n lt"><i class="icon-ticket f30 fb"></i>门票预订</h2>
                </div>
                <div class="ticket_box">
                <?php foreach($art_product as $item) {?>
			        <a href="product_detail.php?product_id=<?php echo $item['product_id'];?>" class="db">
			            <dl class="flx">
			                <dt class="lt"><img src="<?php echo $item['product_img'];?>" width="134" height="81" /></dt>
			                <dd class="lt">
			                    <span class="db mb10"><?php echo $item['product_name'];?></span>
			                    <span class="db">优惠价：<em class="fo">￥<?php echo $item['product_price'];?></em></span>
			                </dd>
			            </dl>
			        </a>
				<?php }?>
                </div>
            </div>

            <div class="contact">
                    <div class="intro_tit flx">
                        <h2 class="f24 n lt"><i class="icon-mail f30 fb"></i>联系我们</h2>
                    </div>
                    <div class="contact_view">
                        <ul>
	                		<?php foreach($sql_set as $item) {?>
	                            <li><i class=""></i><?php echo $item['set_value'];?></li>
                            <?php }?>      
						</ul>
                    </div>
                </div>

            <div class="map">
                    <div class="intro_tit flx">
                        <h2 class="f24 n lt"><i class="icon-location f30 fb"></i>交通指南</h2>
                    </div>
                    <div class="map_view">
                        <a href="art_detail.php?article_id=<?php echo $art_map['article_id'];?>" title="点击查看详细"><img src="<?php echo $art_map['article_img'];?>" class="db" width="365" height="228" alt="点击查看详细" /></a>
                    </div>
                </div>

         </div>

     </div>
</div>

<div class="right_fixed">
    <div class="rf_box rf_qrcode rel">
        <span class="rf_qrcode_small"><i class="icon-qrcode db fw"></i></span>
        <div class="rf_qrcode_big abs" style="display:none;">
            <img src="<?php echo $art_code[1]['set_value'];?>" width="184" height="184" class="db" />
            <em class="db tc fw mt5 f14">微信扫一扫加关注</em>
        </div>
    </div>
    <div class="rf_box rf_qq rel">
        <span class="rf_qq_small"><i class="icon-qq db fw"></i></span>
        <div class="rf_qq_big abs" style="display:none;">
            <a href="tencent://message/?uin=<?php echo $art_code[0]['set_value'];?>&Site=在线QQ&Menu=yes" class="f_wh db">客服QQ：<?php echo $art_code[0]['set_value'];?></a>
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

    </script>
    
<script type="text/javascript" src="static/js/base-min.js"></script>
<script type="text/javascript" src="static/js/focus-min.js"></script>
<script>
    $(document).ready(function () {
        $(".nav ul li").hover(function () {
            $(this).addClass("nav_clo");
        }, function () {
            $(this).removeClass("nav_clo");
        });

        $(".photo_view ul li a").hover(function () {
            $(this).find(".photo_look").stop(true, true).fadeIn(600);
        }, function () {
            $(this).find(".photo_look").hide();
        });

        var banner_index = $(".banner_box ul li").index();
        for (var i = 0; i < banner_index; i++) {
            $(".banner_page").append("<em class=\"banner_p\"></em>");
        }
        window.onload = function () {
            f2 = new Focus("banner_pic", "banner_p", { effect: "scroll", scrollDir: "Left", event: "mouseover", index: "random", scrollMode: 2, timeout:10000 });
        };
        $(".page_next a").live("click", function () {
            $("html,body").animate({ scrollTop: "960px" }, 500);
        });
        $(".rf_box").hover(function () {
            $(this).addClass("rf_qrcode_hover").find(".abs").show();
        }, function () {
            $(this).removeClass("rf_qrcode_hover").find(".abs").hide();
        });
    });
</script>
    
</body>

</html>