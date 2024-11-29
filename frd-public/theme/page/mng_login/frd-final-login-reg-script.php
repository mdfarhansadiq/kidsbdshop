<?php
//FRD 0 STEP VALIDATION
if("$Callingg" !== "FRD"){ header('location:https://google.com'); }

if(!isset($FRvc_CrossLogRegMobileNum)){
    //##FRD OTO VALIDATION  T DATA:-
    $q_frd="select * from frd_otpvali where id=".$_SESSION['FRs_loginToken']."";
    require("$rtd_path/1_frd.php");   
    require("$rtd_path/otpvali_t_sjx_frd.php");
    //FRD LOGIN REG MOBILE NUMBER
    $cus_primary_mobile=$FRotp_usermobile;
}
if(isset($FRvc_CrossLogRegMobileNum)){
    //FRD LOGIN REG MOBILE NUMBER
    $cus_primary_mobile=$FRvc_CrossLogRegMobileNum;
}
    


// CHACKING CUSTOMER REGISTERED  OR NOT 
$FRQ = $FR_CONN->query("SELECT email1 FROM frd_usr WHERE email1 = '$cus_primary_mobile'");
$row = $FRQ->fetch();
$rowsnum_cceon_ssx = $FRQ->rowCount();
if($rowsnum_cceon_ssx==1){
     $frd_action_inni="cust_login";
}
if($rowsnum_cceon_ssx==0){
      $frd_action_inni="cust_singup";
}






//##############################################################
// INNITILIZING CUSTOMER LOGIN 
//##############################################################
if($frd_action_inni=="cust_login"){
            $FRQ = $FR_CONN->query("SELECT id,namee,email1,typee,picc,genderr,psww FROM frd_usr WHERE email1 = '$cus_primary_mobile' AND typee = 'cu'");
            $row = $FRQ->fetch();
            $UsrId=$row['id'];
            $UsrName=$row['namee'];
            $Usremail1=$row['email1'];
            $UsrType=$row['typee'];
            $UsrPIC=$row['picc'];
            $UsrGenderr=$row['genderr'];
            $UsrPsww=$row['psww'];
            if($UsrName==""){$UsrName=$Usremail1;}
    
            $_SESSION['s_cust_id']=$UsrId;
            $_SESSION['s_cust_Name']=$UsrName;
            $_SESSION['s_cust_pic']=$UsrPIC;
            $_SESSION['s_cust_Type']=$UsrType;
            $_SESSION['customer_pic_path']="$FRD_HURL/frd-data/img/customer/$UsrPIC";
            $_SESSION['s_cust_pemail']=$Usremail1;
            $_SESSION['s_cust_psw']=$UsrPsww;
            $_SESSION['s_cust_gender']=$UsrGenderr;
        
        
        // Usr Login Counter
        try{
            $FR_CONN->exec("UPDATE frd_usr SET loginn = loginn+1 WHERE id = $UsrId");
        }catch(PDOException $e){
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
        }
    
        echo "<script>toastr.success('LOGIN DONE');</script>";
        
           //
            unset($_SESSION['FRs_loginToken']);
            if(isset($_SESSION['FRs_OTPinputC'])){
                unset($_SESSION['FRs_OTPinputC']);
            }  
       


            //FRD NEXT DESTINATION SET AFTER LOGIN :-
                if(isset($_GET["next_destination"])){
                    FR_GO($_GET["next_destination"]);
                    exit;
                }else{
                    header("location:$FRc_Hurl/checkout");
                    exit;
                }


}







//############################################################## 
// INNITILIZING CUSTOMER SINGUP 
//##############################################################
if($frd_action_inni=="cust_singup"){
        //echo "<script>toastr.error('SINGUP INNI');</script>";
     
            // FRD CUSTOM VALUE MAKING
             $frd_cus_user_type='cu';
             $frd_cus_user_name="";
             $frd_cus_email1="$cus_primary_mobile";   
             $frd_cus_phon1="$cus_primary_mobile";
             $frd_cus_psw=md5(uniqid());
             $frd_cus_gender=3;//[3=not set yet]
             $frd_cus_status=1;//[1=live]

                    $arr = [];
                    $arr['typee'] = $frd_cus_user_type;
                    $arr['namee'] = $frd_cus_user_name;
                    $arr['email1'] = $frd_cus_email1;
                    $arr['phon1'] = $frd_cus_phon1;
                    $arr['psww'] = $frd_cus_psw;
                    $arr['genderr'] = $frd_cus_gender;
                    $arr['statuss'] = $frd_cus_status;
                    $arr['datee'] = $FR_NOW_DATE;
                    $arr['timee'] = $FR_NOW_TIME;
                    $FRR = FR_DATA_IN("frd_usr",$arr);
                    if($FRR['FRA']==1){
                            $last_insert_id = $FRR['FR_LIID'];
                            $_SESSION['s_cust_id']="$last_insert_id";
                            $_SESSION['s_cust_Name']="$frd_cus_email1";
                            $_SESSION['s_cust_pic']=$UsrPIC;
                            $_SESSION['s_cust_Type']="$frd_cus_user_type";
                            $_SESSION['customer_pic_path']="$FRD_HURL/frd-data/img/customer/1.jpg";
                            $_SESSION['s_cust_pemail']="$frd_cus_email1";
                            $_SESSION['s_cust_psw']="$frd_cus_psw";
                            $_SESSION['s_cust_gender']="$frd_cus_gender";

                            // Usr Login Counter:-
                            try{
                                $FR_CONN->exec("UPDATE frd_usr SET loginn = loginn+1 WHERE id = $last_insert_id");
                            }catch(PDOException $e){
                                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                            }

                            FR_TAL("SINGUP DONE","","success");
                
                            //FRD NEXT DESTINATION SET AFTER LOGIN :-
                            if(isset($_GET["next_destination"])){
                                FR_GO($_GET["next_destination"]);
                                exit;
                            }else{
                                header("location:$FRc_Hurl/checkout");
                                exit;
                            }

                    }else{
                        FR_TAL("SINGUP FAILED","","error");
                    }

        
}