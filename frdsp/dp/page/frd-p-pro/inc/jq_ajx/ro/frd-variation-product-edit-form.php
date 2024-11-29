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

<form action="<?php echo "$FRD_HURL/frdsp/dp/pro-EditProduct/$pro_v_mp_id"?>" method="post" enctype="multipart/form-data">

       <?php if($pro_vry_type==2){ ?>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <span>Product Color</span> 
                <select name="f_vp_colorId" id="" class="chosen form-control" >
                    <option value="<?php echo "$FRc_ProColorId"?>"><?php echo "$FRc_ProColorName"?></option>
                    <?php 
                        $q_frd="SELECT * FROM frd_colorr";
                        require("$rtd_path/1_frd.php"); 
                        for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
                        require("$rtd_path/color_t_frd.php");
                        echo "
                        <option value='$Color_ID'>$color_en_name</option>
                        ";
                        }//For Loop E  
                    ?>
                </select>
            </div>
        </div>
       <?php } ?>


       <?php if($pro_vry_type==3){ ?>
       <div class="row mt-10">
          <div class="col-xs-12">
              <small>Size Name</small>
              <input class='form-control' type='text' name='f_vp_sizename' value='<?php echo "$pro_size_name";?>'>
          </div>
       </div>
       <?php } ?>


     <div class="row mt-10 alert alert-success">
          <?php if($_SESSION['sUsrType'] == "ad" || $_SESSION['sUsrType'] == "M"){ ?>
           <div class="col-xs-12">
              <span> Buy Price (Optional)</span>
              <input class='form-control' type="number" step=".02" name="f_buy_price" id="f_buy_price" placeholder="Input Buy Price" value="<?php echo "$buy_pri";?>">
          </div>
          <?php } ?>
         <div class="col-xs-4">
              <small>Market Price *</small>
              <input class='form-control' type='number' step=".02" name='f_vp_market_price' id="market_price1" value="<?php echo "$pro_market_price";?>" required>
         </div>
         <div class="col-xs-4">
             <small>Discount *</small>
             <input class='form-control' type='number' step=".02" name='f_vp_discount' id="discount_amount1" value="<?php echo "$pro_discount_amount";?>" required>
         </div>
         <div class="col-xs-4">
             <small>Sells Price</small>
             <input class='form-control' type='number' step=".02" name='f_sellls_price' id="sellls_price1" value="<?php echo "$pro_sells_price";?>" required>
         </div>
     </div>


     <div class="row">
         <div class="col-xs-12">
             <small>SKU</small>
             <input class='form-control' type='text' name='f_vp_sku' value="<?php echo "$pro_skuu";?>">
         </div>
     </div>  

     <br>
     <div class="row">
         <div class="col-xs-12">
             <small>Stock</small>
             <input class='form-control' type='number' name='f_vp_qty' value="<?php echo "$pro_qtyy";?>">
         </div>
     </div>   
     
     
     <br>
     <div class="row">
         <div class="col-xs-12">
             <input type='checkbox' name='f_vp_quick_img_add'>  Quick Add All Image From Main Product
         </div>
     </div>    

     <input type='hidden' name='f_vp_id' value="<?php echo "$pro_id";?>">
      

    <div class="row">
        <div class="col-xs-12 text-right">
             <br>
             <button type='submit' class='btn btn-success' name='DoFrd_VariationProInfoUpdate'>Confirm & Update</button>
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