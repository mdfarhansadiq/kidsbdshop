<?php
$sells_pri = number_format($sells_pri); 
//FRD DISCOUNT AMOUNT CONFIG:-
    if ($discount_pri > 0) {
        $FRc_MarkPrice_Html = "<small class='markprice'><del> ৳ " . number_format(($market_pri)) . "</del></small> <br>";
    } else {
        $FRc_MarkPrice_Html = "";
    }
//FRD:-
    if ($vry_typ == 2) {
        $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) FROM frd_products WHERE v_mp_id = $id");
        $row_fcvpmmp = $FRQ->fetch();
        $frd_color_v_pro_mini_price = $row_fcvpmmp['MIN(sells_pri)'];
        $frd_color_v_pro_max_price = $row_fcvpmmp['MAX(sells_pri)'];
        $sells_pri = "<small style='font-size:10px;'>" . number_format($frd_color_v_pro_mini_price) . " To " . number_format($frd_color_v_pro_max_price) . "</small>";
    }
//FRD:-
    if ($vry_typ == 3) {
        $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) FROM frd_products WHERE v_mp_id = $id");
        $row_fsvpmp = $FRQ->fetch();
        $frd_size_v_pro_mini_price = $row_fsvpmp['MIN(sells_pri)'];
        $frd_size_v_pro_max_price = $row_fsvpmp['MAX(sells_pri)'];
        $sells_pri = "<small style='font-size:10px;'>" . number_format($frd_size_v_pro_mini_price) . " To " . number_format($frd_size_v_pro_max_price) . "</small>";
    }
?>

<tr>
    <td>
      <img class="img-responsive" src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1"; ?>" alt="<?php echo "$tagg";?>" width="50px" height="50px">
    </td>
     <td>
       <?php echo "<span class='ptitel'>$bn_name</span>"; ?>
     </td>
     <td>
       <span class="pprice boldd"><?php echo "$FRc_MarkPrice_Html  $sells_pri ৳"; ?></span>
     </td>
     <td>
       <button class="FrTrig_IPI_PopUp btn btn-primary" frproid="<?php echo "$id";?>"><span class="glyphicon glyphicon-fullscreen"></span></button>
     </td>
     <td>
       <?php echo "<button class='frbtn_ordernow frdtrig_atc btn btn-success' id='$id' ProVariaTyp='$vry_typ' FrAT='addtocart'><span class='glyphicon glyphicon-flash'></span> AddToCart </button>";?>
     </td>
     
</tr>