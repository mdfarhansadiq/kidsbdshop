<section class="hp_super_secfrd gain_cust_trust_sec">
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_hp_gain_cust_trust pointer text-center">
          <?php
          $FRR = FR_QSEL("SELECT * FROM frd_gain_cust_trust ORDER BY id ASC", "ALL");
          if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);
              echo "
                            <div class='item'>
                                <img src='$FRD_HURL/frd-data/img/hp/gain_cust_trust/$fr_gct_icon' class='img-responsive'>
                                <b class='frtitle'> $fr_gct_title </b><br>
                                <span class='frshortdesc'> $fr_gct_dec </span>
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