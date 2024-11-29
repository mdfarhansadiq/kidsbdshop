<?php
// FRD CATEGORY BASE 6 PRODUCT SHOWING:-  
$FRc_CatBasPro = explode(",", $fr_hpc_catbasepro_catids);
foreach ($FRc_CatBasPro as $val) {
  $hp_m_catt_id = $val;
?>

  <section class="catbaselastpro_secfrd hp_super_secfrd">
    <?php
    //$hp_m_catt_id=1; ///suplying from calling place
    $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $hp_m_catt_id");
    $hp_catt_data = $FRQ->fetch();
    $hp_catt_name_bn = $hp_catt_data['bn_name'];
    $hp_catt_slug = $hp_catt_data['slugg'];
    ?>

    <div class="container">
      <div class="row hp_sectitlfull">
        <div class="col-xs-8">
          <?php echo "<span class='hp_sectitlefrd'> $hp_catt_name_bn </span>"; ?>
        </div>
        <div class="col-xs-4 text-right">
          <a class="frs_moreseebtn" href="<?php echo "$fr_cat_bpro_url/$hp_catt_slug"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
        </div>
      </div>

      <div class="row">
        <?php
        $FRc_PFQ = "SELECT * FROM frd_products WHERE statuss=1 AND pro_typ=1 AND qtyy>=0 AND (r_cat_1=$hp_m_catt_id OR r_cat_2=$hp_m_catt_id OR r_cat_3=$hp_m_catt_id OR r_cat_4=$hp_m_catt_id OR m_cat_1=$hp_m_catt_id OR m_cat_2=$hp_m_catt_id OR m_cat_3=$hp_m_catt_id OR m_cat_4=$hp_m_catt_id) ORDER BY frpro_priority DESC LIMIT 0,$fr_hpc_catbaspro_show";
        $FRR = FR_QSEL("$FRc_PFQ", "ALL");
        if ($FRR['FRA'] == 1) {
          foreach ($FRR['FRD'] as $FR_ITEM) {
            extract($FR_ITEM);
            require("frd-public/theme/inc/frd_product/inc/jq_ajx/frd-product-box-$FRcf_ProBoxNum.php");
          }
        } else {
          echo "<div class='alert alert-danger text-center'> No Product Found In $hp_catt_name_bn ! Right Now!</div>";
        }
        ?>
      </div>

    </div>
  </section>
<?php
}
?>
<script type="text/javascript">
  FrFunAddToCartManger();
</script>