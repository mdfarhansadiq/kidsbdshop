<?php
//frd_brandss //brands_t_frd
$rowfrd = $result_frd->fetch();
$brand_id=$rowfrd['id']; 
$brand_en_name=$rowfrd['en_name'];
$brand_bn_name=$rowfrd['bn_name'];
$brand_r_cat_id=$rowfrd['r_catt_id'];
$brand_slugg=$rowfrd['slugg'];
$brand_thumb_picc=$rowfrd['thumb_picc'];
$brand_banar_picc=$rowfrd['baner_picc'];
$brand_status=$rowfrd['statuss'];
$brand_by=$rowfrd['byy'];
//$brand_last_upd_by=$rowfrd['last_upd_by'];
//$brand_last_upd_time=$rowfrd['last_upd_time'];
$brand_datee=$rowfrd['datee'];
$brand_time=$rowfrd['timee'];

$brand_thumb_pic_path="$FRD_HURL/frd-data/img/brands_thum/$brand_thumb_picc";
$brand_banar_pic_path="$FRD_HURL/frd-data/img/brands_banar/$brand_banar_picc";


////////Byy Name Founder
$brand_by_name="Comming Soon..";


/////// Relational Catt Name Founder
$brand_r_catt_name="Comming soon..";