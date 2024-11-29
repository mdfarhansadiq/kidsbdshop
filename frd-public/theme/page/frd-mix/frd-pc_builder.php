<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cname - $fr_ctagline";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");
?>
<h2 class="PT"> PC Builder </h2>
<!-- 1 scripts s-->
<section>
<?php   

?>
</section>
<!-- 1 scripts e-->





<?php
// FRD CATEGORY BASE 6 PRODUCT SHOWING:-  
$FRc_CatBasPro = explode(",", "1,2");
foreach ($FRc_CatBasPro as $val) {
  $hp_m_catt_id = $val;
?>

  <section class="catbaselastpro_secfrd hp_super_secfrd">
    <?php
    //$hp_m_catt_id=1; ///suplying from calling place
    $FRQ = $FR_CONN->query("SELECT bn_name,slugg,baner_picc FROM frd_categoriess WHERE id = $hp_m_catt_id");
    $hp_catt_data = $FRQ->fetch();
    $hp_catt_name_bn = $hp_catt_data['bn_name'];
    $hp_catt_slug = $hp_catt_data['slugg'];
    $hp_catt_baner = $hp_catt_data['baner_picc'];
    $hp_catt_baner_link = "$FRD_HURL/frd-data/img/cat_baner/$hp_catt_baner";
    ?>


   <div class="container">

        <div class="jumbotron">

        <div class="row">
            <div class="col-xs-8">
            <?php echo "<span class='h2 boldd text-danger'> $hp_catt_name_bn </span>"; ?>
            </div>
            <div class="col-xs-4 text-right">
            </div>
        </div>

        <div class="row">
          <table class="table table-bordered">

            <?php
            $FRc_PFQ = "SELECT * FROM frd_products WHERE statuss=1 AND pro_typ=1 AND qtyy>=0 AND (r_cat_1=$hp_m_catt_id OR r_cat_2=$hp_m_catt_id OR r_cat_3=$hp_m_catt_id OR r_cat_4=$hp_m_catt_id OR m_cat_1=$hp_m_catt_id OR m_cat_2=$hp_m_catt_id OR m_cat_3=$hp_m_catt_id OR m_cat_4=$hp_m_catt_id) ORDER BY vieww DESC LIMIT 0,100";
            $FRR = FR_QSEL("$FRc_PFQ", "ALL");
            if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
                extract($FR_ITEM);
                require("frd-public/theme/inc/frd_product/inc/jq_ajx/frd-product-box-5.php");
            }
            } else {
            echo "<div class='alert alert-danger text-center'> No Product Found In $hp_catt_name_bn ! Right Now!</div>";
            }
            ?>
         </table>
        </div>

        </div>

   </div>
  </section>
<?php
}
?>




<?php require_once("frd-public/theme/frd-footer.php");?>

<script type="text/javascript">
  FrFunAddToCartManger();
</script>


<script>
  $(document).ready(function(){
    $(".FrTrig_IPI_PopUp").unbind().click(function(){
        var frproid = $(this).attr("frproid"); 

       $.ajax({
        url:FR_HURL_APII + "/IPI_PopUp",
        method:"POST",
        data: {frproid:frproid},
        success:function(data){
          console.log(data);
          $('#FR_SPIDER_MODEL .modal-dialog').addClass('modal-lg modal-dialog-centered');
          $('#FR_SPIDER_MODEL_DATA').html(data);
          $('#FR_SPIDER_MODEL').modal("show");
        }
      });

      
    }); 
  });
</script>