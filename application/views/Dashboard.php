<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'dashboard';
?>
<style type="text/css">
  #background{
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    min-height:100%; 
    min-width:100%;
    color:yellow;
}

#bg-text
{
    color:lightgrey;
    font-size:60px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
</style>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

    <div class="row-fluid">
      <div id="background">
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <center><p id="bg-text">Demo Mode <br><br><br> <a id="bg-text" href="aistrick.com">aistrick.com</a></p></center>
  </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<?php
    require_once(APPPATH."views/parts/footer.php");
?>