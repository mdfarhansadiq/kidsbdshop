<?php
//from frd_products  //productss_t_frd 
$rowfrd = $result_frd->fetch();  
$pro_id=$rowfrd['id'];
$frpro_priority=$rowfrd['frpro_priority'];
$pro_bn_name=$rowfrd['bn_name'];
$fr_short_desc=$rowfrd['fr_short_desc'];
$pro_detailes=$rowfrd['detailess'];
$fr_slug=$rowfrd['fr_slug'];
$fr_meta_title=$rowfrd['fr_meta_title'];
$fr_meta_desc=$rowfrd['fr_meta_desc'];
$pro_tag=$rowfrd['tagg']; 
$pro_view=$rowfrd['vieww'];
 
$buy_pri=$rowfrd['buy_pri'];
$pro_market_price=$rowfrd['market_pri'];
$pro_discount_amount=$rowfrd['discount_pri'];
$pro_discount_persent=$rowfrd['dis_persent'];
$pro_sells_price=$rowfrd['sells_pri'];
 
$pro_r_cat_1=$rowfrd['r_cat_1']; 
$pro_r_cat_2=$rowfrd['r_cat_2'];
$pro_r_cat_3=$rowfrd['r_cat_3'];
$pro_r_cat_4=$rowfrd['r_cat_4'];
$fr_read_a_little=$rowfrd['fr_read_a_little'];

$g_cat_id=$rowfrd['g_cat_id'];
$pro_m_cat_1=$rowfrd['m_cat_1'];
$pro_m_cat_2=$rowfrd['m_cat_2'];
$pro_m_cat_3=$rowfrd['m_cat_3'];
$pro_m_cat_4=$rowfrd['m_cat_4'];
 
$pro_r_brand=$rowfrd['r_brand'];
$pro_r_writer=$rowfrd['r_writer'];
$pro_r_color=$rowfrd['r_color']; 
$r_supplier=$rowfrd['r_supplier'];

$pro_pic_1=$rowfrd['pic_1'];
$pro_pic_2=$rowfrd['pic_2'];
$pro_pic_3=$rowfrd['pic_3'];
$pro_pic_4=$rowfrd['pic_4'];

$pro_video=$rowfrd['videoo'];

$pro_v_mp_id=$rowfrd['v_mp_id'];

$pro_size_name=$rowfrd['siz_name'];


$pro_type=$rowfrd['pro_typ'];
$pro_vry_type=$rowfrd['vry_typ'];

$pro_skuu=$rowfrd['skuu'];

$fr_stock_typ = $rowfrd['fr_stock_typ'];
$fr_stock_unit = $rowfrd['fr_stock_unit'];
$pro_qtyy=$rowfrd['qtyy'];


$frpro_featurepro=$rowfrd['frpro_featurepro'];
$pro_ofer_status=$rowfrd['ofer_status'];
$fr_flash_sale=$rowfrd['fr_flash_sale'];
$pro_status=$rowfrd['statuss'];
$fr_stock_visi=$rowfrd['fr_stock_visi'];

$fr_t_rr_c=$rowfrd['fr_t_rr_c'];
$fr_a_rating=$rowfrd['fr_a_rating'];
$fr_t_1sr=$rowfrd['fr_t_1sr'];
$fr_t_2sr=$rowfrd['fr_t_2sr'];
$fr_t_3sr=$rowfrd['fr_t_3sr'];
$fr_t_4sr=$rowfrd['fr_t_4sr'];
$fr_t_5sr=$rowfrd['fr_t_5sr'];

$deli_crg_typ = $rowfrd['deli_crg_typ'];
$fr_p_lps = $rowfrd['fr_p_lps'];
$fr_p_icf_dp = $rowfrd['fr_p_icf_dp'];

$pro_by=$rowfrd['byy'];
$pro_datee=$rowfrd['datee'];
$pro_time=$rowfrd['timee'];

if($pro_status==1){$pro_status_M="Published";}
if($pro_status==2){$pro_status_M="Unlisted";}
if($pro_status==3){$pro_status_M="Private";}
if($pro_status==4){$pro_status_M="Trashed";}

if($pro_qtyy<0){$pro_qtyy_m="Disqualified";}
if($pro_qtyy>0){$pro_qtyy_m=$pro_qtyy;}
if($pro_qtyy==0){$pro_qtyy_m="স্টক শেষ";}

if($pro_ofer_status==1){$pro_ofer_status_mody="Yes";}
if($pro_ofer_status==0){$pro_ofer_status_mody="No";}

if($pro_vry_type==1){$pro_vry_type_mody="General";}
if($pro_vry_type==2){$pro_vry_type_mody="Color Variation";}
if($pro_vry_type==3){$pro_vry_type_mody="Size Variation";}

$pro_pic_1_path="$FRD_HURL/frd-data/img/product/$pro_pic_1";
$pro_pic_2_path="$FRD_HURL/frd-data/img/product/$pro_pic_2";
$pro_pic_3_path="$FRD_HURL/frd-data/img/product/$pro_pic_3";
$pro_pic_4_path="$FRD_HURL/frd-data/img/product/$pro_pic_4";