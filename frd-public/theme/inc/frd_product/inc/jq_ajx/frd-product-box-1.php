<?php
$sells_pri=number_format($sells_pri);

$cus_frd_ordernow_btn="<button class='on $frtc_on_btn_trig' id='$id' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span> $frd_ordernow_txt</button>";

$cus_quick_adftocart_btn="<button class='atc frdtrig_atc' id='$id' ProVariaTyp='$vry_typ' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd</button>";

//FRD DISCOUNT AMOUNT CONFIG:-
    if($discount_pri > 0){
     $FRc_MarkPrice_Html="<small class='markprice'><del> ৳ ".number_format($market_pri)."</del></small> <br>";  
    }else{
        $FRc_MarkPrice_Html="";
    }

//
if($vry_typ==2){
    $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) FROM frd_products WHERE v_mp_id = $id");
    $row_fcvpmmp = $FRQ->fetch();
    $frd_color_v_pro_mini_price = $row_fcvpmmp['MIN(sells_pri)'];
    $frd_color_v_pro_max_price = $row_fcvpmmp['MAX(sells_pri)'];
    $sells_pri="<small style='font-size:10px;'>".number_format($frd_color_v_pro_mini_price)." To ".number_format($frd_color_v_pro_max_price)."</small>";
}
//
if($vry_typ==3){
    $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) FROM frd_products WHERE v_mp_id = $id");
    $row_fsvpmp = $FRQ->fetch();
    $frd_size_v_pro_mini_price=$row_fsvpmp['MIN(sells_pri)'];
    $frd_size_v_pro_max_price=$row_fsvpmp['MAX(sells_pri)'];
    $sells_pri="<small style='font-size:10px;'>".number_format($frd_size_v_pro_mini_price)." To ".number_format($frd_size_v_pro_max_price)."</small>";
}
?>

<div class='col-xs-6 col-md-3'>
    <div class='frs_pbox_1'>
    <?php 
        if($dis_persent>0){
            echo "
            <div class='frs_dcb'>
                <span> $dis_persent %<br> <span class='pip_pip_1s'>$frtc_off_txt</span> </span>
            </div>
            ";
        }
        ?>
            
        <img src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" alt="<?php echo "$tagg";?>">

        
        <div class="fr_c1">
            <span class="pprice"><?php echo "$FRc_MarkPrice_Html $sells_pri ৳";?></span>
            <?php echo "<span class='ptitel'>$bn_name</span>"; ?>
        </div>
        <div class="frcontent">
            <div class="btnsec">
            <br>
                <table width='100%'>
                    <tr>
                        <td>
                            <a title="<?php echo "$bn_name"?>" href="<?php echo "$FRD_HURL/product/$id/$fr_slug";?>"> 
                            <button class="vd"><span class='glyphicon glyphicon-eye-open'></span> <?php echo "$FRgtd_Fdetails";?></button>
                        </a>
                        </td>
                    </tr>
                </table>
                <?php 
                if($qtyy > 0 or $qtyy < 0){
                    echo "$cus_frd_ordernow_btn";
                    echo "$cus_quick_adftocart_btn";
                }else{
                    echo "<button class='btn btn-danger btn-block pip_pip_1s'>$stockout_frd</button>";
                }
                ?>
                
                
            </div>
        </div>
    </div>
</div>