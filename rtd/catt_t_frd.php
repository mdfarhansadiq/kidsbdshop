<?php
//frd_categoriess  //catt_t_frd.php 
$rowfrd = $result_frd->fetch();
$catt_id=$rowfrd['id'];
$catt_name=$rowfrd['en_name'];
$catt_name_bn=$rowfrd['bn_name'];
$catt_slugg=$rowfrd['slugg'];
$catt_thumb_picc=$rowfrd['thumb_picc'];
$catt_baner_picc=$rowfrd['baner_picc'];
$catt_type=$rowfrd['cat_type'];
$catt_father=$rowfrd['cat_father'];
$catt_status=$rowfrd['statuss'];

$catt_comi_type=$rowfrd['comi_typ'];
$catt_comi_tk=$rowfrd['comi_tk'];

$fr_cat_meta_title=$rowfrd['fr_cat_meta_title'];
$fr_cat_meta_tag=$rowfrd['fr_cat_meta_tag'];
$fr_cat_meta_dec=$rowfrd['fr_cat_meta_dec'];
$fr_cat_details=$rowfrd['fr_cat_details'];

$catt_byy=$rowfrd['byy'];
$catt_date=$rowfrd['datee'];
$catt_time=$rowfrd['timee'];

if($catt_type==1){$catt_type_M="Father";}
if($catt_type==2){$catt_type_M="Son";}
if($catt_type==3){$catt_type_M="Grandson";}
if($catt_type==4){$catt_type_M="Grandson child";}


if($catt_comi_type==1){$catt_comi_type_mody="CPA";}
if($catt_comi_type==2){$catt_comi_type_mody="Commission";}


$catt_thumb_picc_path="$FRD_HURL/frd-data/img/cat_thum/$catt_thumb_picc";
$catt_baner_picc_path="$FRD_HURL/frd-data/img/cat_baner/$catt_baner_picc";