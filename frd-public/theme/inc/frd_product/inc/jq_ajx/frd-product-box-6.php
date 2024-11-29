<?php
$sells_pri = number_format($sells_pri);
?>

<style>
  .fr_pbox_6 table{
     width: 100%;
     background: #dddddd;
     margin: 10px;
  }
  .fr_pbox_6 table tr td{
     padding: 10px;
  }
</style>
<div class="row fr_pbox_6">
  <div class="col-md-12">
    <table class="">
      <tr>
        <td width="5%">
          <img src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" alt="<?php echo "$tagg";?>" width="50px" height="50px">
        </td>
        <td width="60%" class="text-left"><?php echo "$bn_name"?></td>
        <td width="10%" class="text-right boldd"><?php echo "$sells_pri ৳"; ?></td>
        <td width="10%" class="text-right">
          <?php echo "<button class='frbtn_ordernow frdtrig_atc btn btn-success' id='$id' ProVariaTyp='$vry_typ' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>"; ?>
        </td>
      </tr>
    </table>
  </div>
</div>