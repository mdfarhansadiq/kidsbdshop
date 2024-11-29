<?php
///Step 0 Validation for File Access
if("$Callingg" !== "FRD"){ header("location:$FRD_HURL/?alert_frd=Access Denied!"); }
//Step 1 Validation
if(!isset($_SESSION['s_cust_pemail'])){ header("location:$FRD_HURL/?alert_frd=Access Denied! Please Login!"); }

 $cust_id=$_SESSION['s_cust_id'];
 $cust_name=$_SESSION['s_cust_Name'];
 $cust_type=$_SESSION['s_cust_Type'];
 $cust_email=$_SESSION['s_cust_pemail'];//primari email
 $cust_pic_path=$_SESSION['customer_pic_path'];

 
//2 step Usr Validatio clacking:-
if(!isset($_SESSION['2suv'])){
    //$Q_2svc===Q 2 step user Validation Chacking
    $FRQ = $FR_CONN->query("SELECT email1,psww FROM frd_usr WHERE id = $cust_id");
    $row_2svc = $FRQ->fetch();
    if($row_2svc['email1'] !== $cust_email or $row_2svc['psww'] !== $_SESSION['s_cust_psw']){
        header('location:logout.php');
    }else{
       $_SESSION['2suv']="Passed";//when Passed 2 Step User Validation then start this Session
       unset($_SESSION['sUsrPsw']);//Unset Usr Psw After 2 step validation    
    }
}
//END>>


//FRD BASIC LOGIN VALIDATION CHACKING:-
if(!isset($_SESSION['s_cust_id'])){
    echo "<h4 class='r TAC alertt alert alert-danger'>YOU HAVE TO LOGIN</h4>";
    header("REFRESH:4, URL='$FRD_HURL/login'");    
    exit;
 }else{
     //FRD CUSTOMER ID SUPLYING FROM:-
     $FR_CustIdx = $_SESSION['s_cust_id'];
 }   


//######################################################    
//-VALIDATION GUEST CUSTOMER CAN'T STAY HEAR
//###################################################### 
if($cust_id == 1){
    session_destroy();    
    header("location:$FRD_HURL?alert_frd=Access Denied [fc-1hdjgatt5ttwtv]");
}