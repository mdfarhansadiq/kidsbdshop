<!--  POPULERS WRITERS CAROSOL START  -->
<section class="writers_crosol_secfrd hp_super_secfrd">

  <div class="container">

      <div class="row hp_sectitlfull">
        <div class="col-xs-8">
          <?php echo "<span class='hp_sectitlefrd'> $fr_hpc_text_popu_writers </span>"; ?>
        </div>
        <div class="col-xs-4 text-right">
          <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/writers"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
        </div>
      </div>

    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_hp_popu_writers pointer TAC catbasebuy">
          <?php
          $FRR = FR_QSEL("SELECT * FROM frd_writers WHERE id in($fr_hpc_popu_writers)", "ALL");
          if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);
              echo "
                            <div class='item'>
                            <a href='$FRD_HURL/writer/$fr_writer_slug'>
                                <img src='$FRD_HURL/frd-data/img/writers/$fr_writer_pic' class='img-responsive'>
                            </a>
                            <span class='writername'> $fr_writer_name </span>
                            </div>
                        ";
            }
          } else {
            PR($FRR);
          }

          ?>
        </div>
      </div>
    </div>



  </div>
</section>