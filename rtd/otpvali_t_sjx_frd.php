<?php
//frd_otpvali //otpvali_t_sjx_frd 
$rowfrd = $result_frd->fetch();
$FRotp_id=$rowfrd['id'];
$FRotp_typ=$rowfrd['opt_typ'];
$FRotp_code=$rowfrd['opt_is'];
$FRotp_sendtime=$rowfrd['opt_send_t'];
$FRotp_expitime=$rowfrd['otp_expir_t'];
$FRotp_usermobile=$rowfrd['usr_mobile'];
$FRotp_userip=$rowfrd['usr_ip_a'];