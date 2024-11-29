<?php
//frd_couponn  //couponn_t_frd
$rowfrd = $result_frd->fetch();
$coup_id=$rowfrd['id'];
$coup_catid=$rowfrd['c_catid'];
$coup_name=$rowfrd['c_name'];
$coup_code=$rowfrd['c_code'];
$coup_typ=$rowfrd['c_typ'];
$coup_discotyp=$rowfrd['c_disco_typ'];
$coup_tk=$rowfrd['c_tk'];

$coup_gen_dat=$rowfrd['c_gen_dat'];
$coup_gen_tim=$rowfrd['c_gen_tim'];
$coup_expi_dat=$rowfrd['c_expi_dat'];
$coup_expi_tim=$rowfrd['c_expi_tim'];

$coup_stat=$rowfrd['c_stat'];

$coup_by=$rowfrd['byy'];

if($coup_typ==1){$coup_typ_M="SUPER COUPON";}
if($coup_typ==2){$coup_typ_M="SHOP COUPON";}

if($coup_discotyp==1){$coup_discotyp_M="Fix coupon";}
if($coup_discotyp==2){$coup_discotyp_M=" %  coupon";}

if($coup_stat==1){$coup_stat_M="Active";}
if($coup_stat==2){$coup_stat_M="Blocked";}
if($coup_stat==3){$coup_stat_M="PENDING";}


if($coup_discotyp==1){
    $coup_tk_M=number_format($coup_tk)." /-";
}else{
    $coup_tk_M=number_format($coup_tk)." %"; 
}