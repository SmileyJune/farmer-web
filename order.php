<?php 
    include("include/init.php");
    include("common_data.php");

    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 0;
    if(!$product_id){
        show_msg("选择的产品不存在，请重新选择","product_list.php");
        exit;
    }

    $sql = "SELECT * FROM {$pre_}product WHERE product_id = $product_id";
    $product_info = getOne($sql);

    if($_POST){
        $data = array(//获取表单中的值
            "order_sn"=>GetRandStr(12),//调用随机函数
            "order_price"=>$_POST['order_price'],
            "order_time"=>time(),//获取下单的时间
            "order_username"=>$_POST['order_username'],
            "order_phone"=>$_POST['order_phone'],
            "order_number"=>$_POST['order_number'],
            "order_date"=>strtotime($_POST['order_date']),//将正常格式转为时间戳
            "order_state"=>0,
            "product_id"=>$product_id,
        );


        $insert_id = insert("{$pre_}order",$data);//将订单插入数据库中
        if($insert_id){
            show_msg("下单成功","product_list.php");
        }else{
            show_msg("下单失败，请重新下单","order.php");
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>预定 - 农夫乐园官网</title>
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
        <form action="#" method="post">          
          <div class="ticket_view bgwh">
            <div class="ord_box ord_box1 bgwh">
                <div class="ord_tit"><h2 class="yhei f18 blue n"><?php echo $product_info['product_name']?>（景区现付）</h2></div>
                <div class="ord_intro flx">
                    <span class="f14 yhei lt">名称：</span>
                    <div class="ord_intro_name lt">
                        <h3 class="blue yhei n"><?php echo $product_info['product_name'];?>（景区现付）</h3>
                    </div>
                </div>
                <dl class="ord_list fix">
                    <dt>游玩日期：</dt>
                    <dd class="rel ord_list_time">
                       
                        <input type="text" name="order_date" id="BeginTime" value="<?php echo date("Y/m/d")?>" class="ord_txt" placeholder="点此选择日期" maxlength="20">
                    </dd>
                </dl>
                <dl class="ord_list fix ord_list_amount">
                    <input type="hidden" id="SalePrice" value="55.00" />
                    <dt>数量：</dt>
                    <dd class="flx"><span class="icon bc_o wh20 lt ord_up"></span><input type="text" id="Number" name="order_number" maxlength="3" value="1" class="ord_txt lt"><span class="icon bc_o wh20 lt ord_down"></span></dd>
                </dl>
            </div>
            <div class="ord_box ord_box2 bgwh mt30">
                <div class="ord_tit"><h2 class="yhei f18 blue n">取票人信息</h2></div>
                <dl class="ord_list fix">
                    <dt><span class="fr">*</span> 取票人：</dt>
                    <dd><input type="text" value="" name="order_username" id="Customer" class="ord_txt"></dd>
                </dl>
                <dl class="ord_list fix">
                    <dt><span class="fr">*</span> 手机号码：</dt>
                    <dd><input type="text" value="" id="Mobile" name="order_phone" class="ord_txt"></dd>
                </dl>
            </div>
            <div class="ord_action flx yhei f14 mt20" style="background: #f6f6f6;">
                <span class="lt"><span class="f20 mr10">订单总价：<strong class="fo" id="total">￥55.00</strong></span></span>

                <input type="hidden" name="order_price" id="order_price" value="<?php echo $product_info['product_price']?>">

                <input type="button" class="btn bgorange bbo2 rt f20" style="font-size: 20px;" id="Button" value="提交订单">

                <span class="rt g9">订单提交成功后，请支付</span>
            </div>
        </div>
    </form>    
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
    
<script language="javascript" type="text/javascript" src="static/js/wdatepicker.js"></script>

   <script>
        String.prototype.IsMobile = function () {
            return /^0{0,1}1[3,4,5,7,8][0-9]{9}$/.test(this);
        }
        $("#BeginTime").bind("click", function () { WdatePicker({ doubleCalendar: true, dateFmt: 'yyyy-MM-dd', minDate: '2017-04-09',maxDate:'2027-02-28' }) });

        $(document).ready(function () {
            var minValue = 1;
            var maxValue = 100;

            $("#Button").bind("click", function () {
                if ($("#Customer").val() == "")
                {
                    alert("请输入取票人");
                    $("#Customer").focus();
                    return false;
                }
                if ($("#Mobile").val() == "")
                {
                    alert("请输入手机号码");
                    $("#Mobile").focus();
                    return false;
                }
                if (!$("#Mobile").val().IsMobile()) {
                    alert("请输入正确手机号码");
                    $("#Mobile").focus();
                    return false;
                }
                $("form").submit();
                $("#Button").val("提交中...").unbind("click");
            });
            $(".ord_up").bind("click", function () {
                var number = parseInt($("#Number").val());
                if (number > minValue) {
                    number--;
                    $("#Number").val(number);
                    CalculatePrice();
                }
            });

            $(".ord_down").bind("click", function () {
                var number = parseInt($("#Number").val());
                if (number < maxValue) {
                    number++;
                    $("#Number").val(number);
                    CalculatePrice();
                }
            });

            $("#Number").bind("change", function () {
                var number = parseInt($("#Number").val());
                if (number < minValue) {
                    alert("数量不能小于" + minValue);
                    $("#Number").val(minValue);
                    return false;
                }
                if (number > maxValue) {
                    alert("数量不能大于" + maxValue);
                    $("#Number").val(maxValue);
                    return false;
                }
                CalculatePrice();
            });

            function CalculatePrice() {
                var number = parseInt($("#Number").val());
                var salePrice = parseFloat($("#SalePrice").val());
                $("#total").html("￥" + (number * salePrice) + "元");  
                $("#order_price").val(number * salePrice);   //输出隐藏域中的价格，进行提交上去           
            }
        });
</script> 

    
</body>

</html>