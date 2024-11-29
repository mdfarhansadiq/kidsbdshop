<?php
//frd_pages //pages_t_frd 
$rowfrd = $result_frd->fetch();
$page_id=$rowfrd['id'];
$page_urlslug=$rowfrd['page_url'];
$page_name_en=$rowfrd['page_name_en'];
$page_body_en=$rowfrd['page_body_en'];
$page_format_link=$rowfrd['page_format_link'];
$page_view=$rowfrd['vieww'];
$page_baner_pic=$rowfrd['baner_pic'];
$page_baner_pic_path="$FRD_HURL/frd-data/img/page_baner/$page_baner_pic";    