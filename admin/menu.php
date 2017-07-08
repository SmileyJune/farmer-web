<?php
  include_once("../include/init.php");
  include_once("check_login.php");

?>

<div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      <!-- Logo (221px wide) -->
      <a href="#"><img id="logo" src="../static/admin/images/logo.png" alt="Simpla Admin logo" /></a>
      <!-- Sidebar Profile links -->
      <div id="profile-links"> Hello, <a href="#" title="Edit your profile"><?php echo $_SESSION['admin_name'] ? $_SESSION['admin_name'] : $_COOKIE['autoname'];?></a></a><br />
        <br />
        <a href="../index.php" title="查看首页">查看首页</a> | <a href="login.php?action=logout" title="Sign Out">退出</a> </div>
     <ul id="main-nav">
        <li> 
        <a href="index.php" class="nav-top-item no-submenu current"> 后台首页 </a>
      </li>
      <li> 
        <a href="nav_list.php" class="nav-top-item no-submenu"> 导航管理 </a>
      </li>
      <li> 
        <a href="artcate_list.php" class="nav-top-item no-submenu"> 文章分类管理 </a>
      </li>
      <li> 
        <a href="article_list.php" class="nav-top-item no-submenu"> 文章管理 </a>
      </li>
      <li> 
        <a href="order_list.php" class="nav-top-item no-submenu"> 订单管理 </a>
      </li>
      <li> 
        <a href="product_list.php" class="nav-top-item no-submenu"> 产品管理 </a>
      </li>
      <li> 
        <a href="setting_list.php" class="nav-top-item no-submenu"> 配置管理 </a>
      </li>
      <li> 
        <a href="admin_list.php" class="nav-top-item no-submenu"> 管理员 </a>
      </li>
        
      </ul>
      <!-- End #main-nav -->
      <div id="messages" style="display: none">
        <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
        <h3>3 Messages</h3>
        <p> <strong>17th May 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>2nd May 2009</strong> by Jane Doe<br />
          Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>25th April 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <form action="#" method="post">
          <h4>New Message</h4>
          <fieldset>
          <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
          </fieldset>
          <fieldset>
          <select name="dropdown" class="small-input">
            <option value="option1">Send to...</option>
            <option value="option2">Everyone</option>
            <option value="option3">Admin</option>
            <option value="option4">Jane Doe</option>
          </select>
          <input class="button" type="submit" value="Send" />
          </fieldset>
        </form>
      </div>
      <!-- End #messages -->
</div>