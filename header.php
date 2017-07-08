    <div class="header_bg">
        <div class="header fix">
            <h1 class="lt logo"><a href="/" class="ico" style="background: url('static/images/201604062008554821632.png') no-repeat; width: 140px; height: 150px;">农夫乐园官网</a></h1>
            <div class="nav rt">
                <ul id="nav_list" class="fix fa_wh f14">
                    <li class="nav_01"><a href="index.php" class="nav_name"><i class="f30 db"></i>首页</a></li>
                        <?php foreach($nav_list as $item) {?>
                            <li class="nav_02">
                                <a href="<?php echo $item['nav_url'];?>" class="nav_name"><i class="f30 db"></i><?php echo $item['nav_name'];?></a>
                                <?php if(isset($item['son']) && !empty($item['son'])) {?>
                                    <div class="nav_sub">
                                    <?php foreach($item['son'] as $v) {?>
                                        <a href="<?php echo $v['nav_url'];?>"><?php echo $v['nav_name'];?></a>
                                    <?php }?>
                                    </div>
                                <?php }?>
                            </li>
                        <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $("#nav_list li").each(function(e){
            switch(e){
                case 0:
                    $(this).find("i").eq(0).addClass("icon-home");
                break;
               case 1:
                $(this).find("i").eq(0).addClass("icon-picture");
                break;
                case 2:
                    $(this).find("i").eq(0).addClass("icon-ticket");
                    break;
                case 3:
                    $(this).find("i").eq(0).addClass("icon-doc-text-inv");
                    break;
                case 4:
                    $(this).find("i").eq(0).addClass("icon-camera");
                    break;
                case 5:
                    $(this).find("i").eq(0).addClass("icon-location-1");
                    break;
                case 6:
                    $(this).find("i").eq(0).addClass("icon-mail");
                    break;
             }
        });
    });
    </script>