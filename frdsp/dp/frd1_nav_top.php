<nav class="navbar navbar-fixed-top frdtopfnav">
  <a id="btn_close_sidenave" href="javascript:void(0)" class="closebtn  navbar-brand sidenave_closebtn glyphicon glyphicon-list" onclick="FRcloseNavLS()"> </a>
	<span id="btn_open_sidenave" onclick="FRopenNavLS()" class="navbar-brand side_nave_open glyphicon glyphicon-list sidenave_openbtn pointer alertt" ><b> </b></span>

  <a href="<?php echo "$FR_SP_HURL_DP/dp-PanelChanger/1";?>" class="navbar-brand cddd frs_showpanel" title="SHOW PANELS"><span class="glyphicon glyphicon-th"></span></a>

  <img id="nav2_brandlogu" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"?>" alt="" class="navbar-brand">

   <!-- Collect the nav links, forms, and other content for toggling -->
   <?php if($UsrType == "ad" AND $frplug_ac_m == 1){ ?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo "$FR_SP_HURL_DP/dp-PanelChanger/8";?>">Accounting Manager</a></li>
            <li><a href="<?php echo "$FR_SP_HURL_DP/dp-PanelChanger/7";?>">Cost Manager</a></li>
            <li><a href="<?php echo "$FR_SP_HURL_DP/dp-PanelChanger/11";?>">Investors Manager</a></li>
            <li><a href="<?php echo "$FR_SP_HURL_DP/dp-PanelChanger/12";?>">Suppliers Manager</a></li>
            <!-- <li role="separator" class="divider"></li> -->
          </ul>
        </li>
      </ul>
    </div>
    <?php } ?>
    <!-- /.navbar-collapse -->


</nav>