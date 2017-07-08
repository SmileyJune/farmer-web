<?php 
  include("include/init.php");
  include("common_data.php");

  $current = isset($_GET['page']) ? $_GET['page'] :1;//接收分页
  $count = "SELECT COUNT(*) AS c FROM {$pre_}article WHERE artcate_id=3";

  $count = getOne($count);

  $limit = 15;
  $size = 4;

  $page_str = page($current,$count['c'],$limit,$size,"scott");

  $start = ($current-1)*$limit;


  //var_dump($count);exit;


  //查询联系我们
  $sql = "SELECT * FROM {$pre_}settings WHERE set_id BETWEEN 25 AND 30";
  $contact_list = getAll($sql);

  //查询图片
  $sql = "SELECT * FROM {$pre_}article WHERE artcate_id = 3 LIMIT $start,$limit";
  $pitrue_list = getAll($sql);
  

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>景区图片 - 农夫乐园官网</title>
    <link rel="stylesheet" href="static/css/fontello.css">
    <!--[if IE 7]><link rel="stylesheet" href="static/css/fontello-ie7.css"><![endif]-->
    <link rel="stylesheet" href="static/css/css.css" />
    <link rel="stylesheet" href="static/css/wuxie.css" />
    
    <link rel="stylesheet" type="text/css" href="static/css/jquery.fancybox.css" media="screen" />
    <link rel="stylesheet" href="static/css/page.css" />
    <script type="text/javascript" src="static/js/jquery-1.8.2.min.js"></script>


</head>
<body class="index_bg">

    <?php include("header.php");?>
    
<div class="banner_intro" style="background: url('static/images/201603301357517461691.jpg') no-repeat center bottom;"></div>
<div class="content_bg">
    <div class="content flx round_content">
        <div class="ct_main">
            <div class="intro_main_tit"><h2>景区图片</h2></div>
            <div class="hotel_list mt20">
                <ul class="flx fa_wh">
                <?php foreach($pitrue_list as $item) {?>
                    <li><a rel="photo"  href="<?php echo $item['article_img'];?>" class="fancybox" title="<?php echo $item['article_title']?>"><?php echo $item['article_content'];?><span class="db tc"><?php echo $item['article_title'];?></span></a></li>
                <?php }?>
                </ul>
            </div>
            
            <div class="page">
             <?php echo $page_str;?>
            </div>
        </div>
        <div class="ct_right">
            <div class="rt_tit"><h3>联系我们</h3></div>
              <div class="contact_view">
                <ul>
                  <?php foreach($contact_list as $item) {?>
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
        });
    </script>
    
<script type="text/javascript" src="static/js/jquery.fancybox.js"></script>
<script>
    $('.fancybox').fancybox({
        'autoDimensions':true
    }).resize();

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


    
</body>

</html>