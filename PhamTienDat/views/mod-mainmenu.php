<?php 
$menu = loadModel('menu');
$list_menu1 = $menu->menu_list(['parentid'=>0,'status'=>1,'position'=>'mainmenu']);
?>
<div id="menu">
<ul class="navbar-nav mr-auto sub-menu">
     <?php  foreach($list_menu1 as $row_menu1):?>
      <?php 

    $list_menu2 = $menu->menu_list(['parentid'=>$row_menu1['id'],'status'=>1,'position'=>'mainmenu']);?>
    <?php if(count($list_menu2) > 0): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $row_menu1['name']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php  foreach($list_menu2 as $row_menu2):?>
          <a class="dropdown-item" href="<?php echo $row_menu2['link']; ?>"><?php echo $row_menu2['name']; ?></a>
          <?php  endforeach;?>
        </div>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $row_menu1['link']; ?>"><?php echo $row_menu1['name']; ?></a>
      </li>
    <?php endif; ?>
     
     <?php  endforeach;?>



      

    </ul>
    </div>