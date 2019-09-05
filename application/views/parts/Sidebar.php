<!--sidebar-menu-->
<?php
  $active = '';
  $temp_lv1 = $this->GlobalVar->GetSideBar($user_id,0)->result();
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li><a href="<?= base_url(); ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <?php
      foreach ($temp_lv1 as $key) {
        $parent_id = $key->id;
        $temp_lv2 = $this->GlobalVar->GetSideBar($user_id,$parent_id)->result();

        if ($key->multilevel == "0") {
          echo "<li><a href='".base_url().$key->link."'><i class='icon ".$key->ico."'></i> <span>".$key->permissionname."</span></a> </li>";
        }
        else{
          echo "<li class='submenu'>";
          echo "<a href='".base_url().$key->link."'><i class='icon ".$key->ico."'></i> <span>".$key->permissionname."</span></a>";
          echo "<ul>";
          foreach ($temp_lv2 as $child) {
            echo "<li><a href='".base_url().$child->link."'>".$child->permissionname."</a></li>";
          }
          echo "</ul>";
          echo "</li>";
        }
      }
    ?>
  </ul>
</div>