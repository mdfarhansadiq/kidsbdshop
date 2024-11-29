<!-- CALL FOR ORFER SECTION-->
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <?php
            if($frtc_callfororder_s_dp == 1){
              echo "
                <br>
                <div class='CallForOrderDiv text-center'>
                  <div class='textt'> <span class='glyphicon glyphicon-phone'></span> <br> $frlc_call_for_order_tx</div>
                  <a href='tel:$fr_cmobile_1'>$fr_cmobile_1</a>
                </div>
              ";
            }
        ?>
    </div>
  </div>
</div>