<?php
//frd_usr //usr_t_frd 
$rowfrd = $result_frd->fetch();
$usr_id=$rowfrd['id'];
$usr_type=$rowfrd['typee'];
$usr_namee=$rowfrd['namee'];
$usr_email1=$rowfrd['email1'];
$usr_psw=$rowfrd['psww'];
$usr_phon1=$rowfrd['phon1'];
$usr_phon2=$rowfrd['phon2'];
$usr_genderr=$rowfrd['genderr'];
$usr_birthdayy=$rowfrd['birthdayy'];
$usr_picc=$rowfrd['picc'];
$usr_addresss=$rowfrd['addresss'];
$usr_loginn=$rowfrd['loginn'];

$fr_uapp=$rowfrd['fr_uapp'];
$usr_status=$rowfrd['statuss'];
$usr_by=$rowfrd['byy'];
$usr_datee=$rowfrd['datee'];
$usr_time=$rowfrd['timee'];

/////Modyfiy Start/////
if($usr_genderr==1){$usr_genderr_mody="Male";}
if($usr_genderr==2){$usr_genderr_mody="Female";}
if($usr_genderr==""){$usr_genderr_mody="NotSet";}
if($usr_genderr==3){$usr_genderr_mody="NotSet";}

if($usr_type=='ad'){$usr_type_mody="Admin";}
if($usr_type=='M'){$usr_type_mody="Manager";}
if($usr_type=='cu'){$usr_type_mody="Customer";}
if($usr_type=='pdm'){$usr_type_mody="PDM";}
if($usr_type=='x'){$usr_type_mody="Software User";}
if($usr_type=='OCA'){$usr_type_mody="Order Confirm Assistant";}

if($usr_status==1){$usr_status_mody="<span class='label label-success'>Active</span>";}
if($usr_status==2){$usr_status_mody="<span class='label label-danger'>Blocked</span>";}
if($usr_status==3){$usr_status_mody="<span class='label label-danger'>Deleted</span>";}

$usr_pic_path="$FRD_HURL/frd-data/img/user/$usr_picc";