<!-- POPULER CATEGORY CATEGORY CAROSOL START  -->
<section class="popo_cat_crosol_secfrd hp_super_secfrd">
  <div class="container">

    <div class="row hp_sectitlfull">
      <div class="col-xs-8">
        <?php echo "<span class='hp_sectitlefrd'> $fr_hpc_text_popu_cats </span>"; ?>
      </div>
      <div class="col-xs-4 text-right">
        <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/categories"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_hp_populcats pointer TAC catbasebuy">
          <?php
          $FRR = FR_QSEL("SELECT * FROM frd_categoriess WHERE id in($fr_hpc_popu_cats)", "ALL");
          if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);
              echo "
                            <div class='item'>
                            <a href='$fr_cat_bpro_url/$slugg'>
                                <img src='$FRD_HURL/frd-data/img/cat_thum/$thumb_picc' class='img-responsive'>
                            </a>
                            <span class='cat_name'> $bn_name </span>
                            </div>
                        ";
            }
          } else {
            // PR($FRR);
            echo "<div class='item alert alert-danger text-center'> No Popular Product Categories Found </div>";
          }
          ?>
        </div>
      </div>
    </div>
    
  </div>
</section>