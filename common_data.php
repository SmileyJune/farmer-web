<?php
  $sql = "SELECT * FROM {$pre_}nav";
  $nav = getAll($sql);

  $nav_list = array();
  foreach($nav as $key=>$item){//先获取到一级栏目
       if($item['parent_id'] == 0){
        $nav_list[] = $item;
        }
       foreach($nav_list as $k=>$v){//一级栏目的id=子栏目中的parent_id,然后再放入对应的一级栏下面
          if($item['parent_id'] == $v['nav_id']){//$item所有的的值中的parent_id = $v一级导航中的nav_id值
          $nav_list[$k]['son'][] = $item;
          }
          if($k >= 6){//防止添加父级导航后在页面显示多余的导航
            unset($nav_list[$k]);
          }
      }
  }

  $sql = "SELECT * FROM {$pre_}settings WHERE set_name = 'copyright' or set_name = 'site_link' LIMIT 2";
  $set_list = getAll($sql);
?>