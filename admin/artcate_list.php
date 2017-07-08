<?php
  include("../include/init.php");
  include("check_login.php");

  $current = isset($_GET['page']) ? $_GET['page'] : 1;//获取当前页码值

  $sql = "SELECT COUNT(*) AS c FROM {$pre_}article_cate";//获取产品表总数
  $count = getOne($sql);//得到总数

  $limit = 5;//设置当前每个页面的查询条数
  $size = 4; //设置当前的中间页码数

  $str_page = page($current,$count['c'],$limit,$size,"scott");//调用page函数，实现分页功能

  $start = ($current-1)*$limit;//每页开始值

  $sql ="SELECT * FROM {$pre_}article_cate ORDER BY artcate_id DESC LIMIT $start,$limit";//倒序查询出来

  $artcate_list = getAll($sql);

  //删除单条记录
  $artcate_id = isset($_GET['artcate_id']) ? $_GET['artcate_id'] : 0;//获取删除的id号
  if($artcate_id){
     $sql = "artcate_id = $artcate_id";
     $artcate_one = delete("{$pre_}article_cate",$sql);

     if($artcate_one){
      show_msg("删除文章分类成功","artcate_list.php");
     }else{
      show_msg("删除文章分类失败","artcate_list.php");
     }
  }

  //批量删除
  $artcate_dele = isset($_POST['artcate_dele']) ? $_POST['artcate_dele'] : 0 ;
  if($artcate_dele){
    $artcate_dele = implode(",",$artcate_dele);
    $sql = "artcate_id IN($artcate_dele)";
    $artcateAll = delete("{$pre_}article_cate",$sql);
    if($artcateAll){
      show_msg("批量删除文章分类成功","artcate_list.php");
    }else{
      show_msg("批量删除文章分类失败","artcate_list.php");
    }
  }





?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章分类管理</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="../static/admin/css/invalid.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../static/css/page.css" />

<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="../static/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="../static/admin/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="../static/admin/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="../static/admin/scripts/jquery.wysiwyg.js"></script>
<!-- jQuery Datepicker Plugin -->
<script type="text/javascript" src="../static/admin/scripts/jquery.datePicker.js"></script>
<script type="text/javascript" src="../static/admin/scripts/jquery.date.js"></script>
</head>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    
    <?php include("menu.php");?>

  </div>
  <!-- End #sidebar -->
  <div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <!-- <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
        Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div> -->
    </noscript>

    <ul class="shortcut-buttons-set">
      <li>
        <a class="shortcut-button" href="artcate_add.php">
          <span><img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />添加</span>
        </a>
      </li>
    </ul>

    <div class="clear"></div>

    <div class="content-box">
      <div class="content-box-header">
        <h3>文章分类管理</h3>
        <div class="clear"></div>
      </div>
  
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <form action="#" method="post" name="form_list">
            <table>
              <thead>
                <tr>
                  <th>
                    <input class="check-all" name="checkall" type="checkbox" />
                  </th>
                  <th>主键</th>
                  <th>文章分类</th>
                  <th>添加时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td colspan="6">
                      <div class="bulk-actions align-left">
                          <a class="button" href="javascript:document.form_list.submit()">批量删除</a> 
                      </div>
                      <div class="pagination"><?php echo $str_page;?></div>
                      <div class="clear"></div>
                  </td>
                </tr>
              </tfoot>
              <tbody>
              <?php foreach($artcate_list as $item) {?>
                  <tr>
                    <td>
                      <input type="checkbox" name="artcate_dele[]" value="<?php echo $item['artcate_id'];?>" />
                    </td>
                    <td><?php echo $item['artcate_id'];?></td>
                    <td><?php echo $item['artcate_name'];?></td>
                    <td><?php echo date("Y-m-d H:i:s",$item['artcate_time']);?></td>
                    <td>
                      <!-- Icons -->
                      <a href="artcate_edit.php?artcate_id=<?php echo $item['artcate_id'];?>" title="Edit"><img src="../static/admin/images/icons/pencil.png" alt="Edit" /></a> 
                      <a href="artcate_list.php?artcate_id=<?php echo $item['artcate_id'];?>" title="Delete"><img src="../static/admin/images/icons/cross.png" alt="Delete" /></a> 
                    </td>
                  </tr>
              <?php }?>
              </tbody>
            </table>
          </form>
        </div>
        </div>
      </div>

      <div id="footer" style="text-align: center;"> 
      <small>
      &#169; Copyright 2010 Your Company | Powered by <a href="#">农夫乐园</a> 
      </small>
      </div>
    </div>
  </div>
</body>
</html>
