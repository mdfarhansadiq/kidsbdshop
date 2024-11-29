<?php
//frd_sliderr  //slider_t_frd.php
$rowfrd = $result_frd->fetch();
$sli_id=$rowfrd['id'];
$sli_name=$rowfrd['namee'];
$sli_slug=$rowfrd['slugg'];

$sli_pic_1=$rowfrd['pic_1'];
$sli_pic_2=$rowfrd['pic_2'];
$sli_pic_3=$rowfrd['pic_3'];
$sli_pic_4=$rowfrd['pic_4'];
$sli_pic_5=$rowfrd['pic_5'];
$sli_pic_6=$rowfrd['pic_6'];

$sli_pic_1_link=$rowfrd['pic_1_link'];
$sli_pic_2_link=$rowfrd['pic_2_link'];
$sli_pic_3_link=$rowfrd['pic_3_link'];
$sli_pic_4_link=$rowfrd['pic_4_link'];
$sli_pic_5_link=$rowfrd['pic_5_link'];
$sli_pic_6_link=$rowfrd['pic_6_link'];

$sli_byy=$rowfrd['byy'];
$sli_datee=$rowfrd['datee'];
$sli_time=$rowfrd['timee'];

$sli_pic_1_url="$FR_HURL_IMG/sliders/$sli_pic_1";
$sli_pic_2_url="$FR_HURL_IMG/sliders/$sli_pic_2";
$sli_pic_3_url="$FR_HURL_IMG/sliders/$sli_pic_3";
$sli_pic_4_url="$FR_HURL_IMG/sliders/$sli_pic_4";
$sli_pic_5_url="$FR_HURL_IMG/sliders/$sli_pic_5";
$sli_pic_6_url="$FR_HURL_IMG/sliders/$sli_pic_6";