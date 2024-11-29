<?php
$Callingg="FRD";// File access Validaion O Step
require_once('../frd_lconfig.php'); //DB Connaction   

if(isset($_POST['v_pro_id'])){
    $FRc_EditProductIdx = $_POST['v_pro_id'];

    $q_frd="SELECT * FROM frd_products WHERE id = $FRc_EditProductIdx";
    require("$rtd_path/1_frd.php");   
    require("$rtd_path/productss_t_frd.php");

    $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $pro_r_color");
    $row_frd_cnf = $FRQ->fetch();
    $FRc_ProColorId = $pro_r_color;
    $FRc_ProColorName = $row_frd_cnf['en_name'];
?>

<form action="" method="post" enctype="multipart/form-data">


       <?php if($pro_vry_type==2){ ?>
       <div class="row mt-10">
          <div class="col-xs-12">
              <select class='form-control' name="f_vp_total_item_add" id="" required> 
                 <option value="">Select Items</option>
                 <option value="1">1 Item</option>
                 <option value="2">2 Items</option>
                 <option value="3">3 Items</option>
                 <option value="4">4 Items</option>
                 <option value="5">5 Items</option>
                 <option value="6">6 Items</option>
                 <option value="7">7 Items</option>
                 <option value="8">8 Items</option>
                 <option value="9">9 Items</option>
                 <option value="10">10 Items</option>
                 <option value="11">11 Items</option>
                 <option value="12">12 Items</option>
                 <option value="13">13 Items</option>
                 <option value="14">14 Items</option>
                 <option value="15">15 Items</option>
                 <option value="16">16 Items</option>
                 <option value="17">17 Items</option>
                 <option value="18">18 Items</option>
                 <option value="19">19 Items</option>
                 <option value="20">20 Items</option>
              </select>
          </div>
       </div>
       <?php } ?>



       <?php if($pro_vry_type==3){ ?>
       <div class="row mt-10">
          <div class="col-xs-12">
              <small>Input All Size Name With Coma (,)</small>
              <input class='form-control' type='text' name='f_vp_all_size_name'>
          </div>
       </div>
       <?php } ?>


    <div class="row">
        <div class="col-xs-12 text-right">
             <br>
             <button type='submit' class='btn btn-success' name='DoFrd_VariationProductAdd'>Confirm & Add</button>
        </div>
    </div>
</form>
<?php  
}
?>


<script>
      $(document).ready(function(){

        $('#market_price1,#discount_amount1').keyup(function() {
            let market_price1 = $('#market_price1').val();
            let discount_amount1 = $('#discount_amount1').val();
            let sellls_price1 = (market_price1 - discount_amount1);
            $('#sellls_price1').val(sellls_price1);

            if (sellls_price1 < 0) {
                swal('Sells Price Not Valid', '', 'warning');
            }
        });

      });   
</script>