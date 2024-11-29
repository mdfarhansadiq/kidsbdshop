<?php
ob_start(); 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Login - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
    <meta property='og:title' content='$FRc_PAGE_TITEL'>
    <meta property='og:description' content='$fr_cmetades'>
    <meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
    <meta property='og:url' content='$FR_THISPAGE'>
    <meta property='og:image:type' content='image/jpeg'/>
    <meta property='og:image:width' content='1200'/>
    <meta property='og:image:height' content='300'/>

    <meta name='keywords' content='$fr_cmetatag'>
    <meta name='author' content='$fr_cname'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_cname'>
    <meta name='description' content='$fr_cmetades'>
    <meta name='page-topic' content='Ecommerce'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";

require_once("frd-public/theme/frd-header.php");
?>

<style type="text/css">
/* FRD OVERWRITE FRO THIS PSGE FORM MOBILE DEVICE */    
@media (max-width: 768px) {
    body {
       margin-right: 0px !important;
    }
}
</style>


<!-- 1 SCRIPTAS -->
<section>
<?php
function FRfun_ab(){
    header("location:https://google.com");
} 
$FRc_Hurl="$FRD_HURL";



//########################################################    
//ONE TIME PIN SENDING TO CUSTOMER
//########################################################    
if(isset($_POST['f_mobilenumber'])){
    //FRD VALIDATION NEED:-
    $FR_VC_PhonNumber="";
    $FR_VC_CalulationRej="";
    //FRD_VC FORM  REQUIRED FIELD VALIDATION:-
    if(!isset($_POST['f_mobilenumber']) ){ header("refresh:3; url=$FRc_Hurl"); exit; }
    if(!isset($_POST['frf_calculatereg']) ){ header("refresh:3; url=$FRc_Hurl"); exit; }
    //FRD_VC FORM DATA RECIVING:-
      $f_mobilenumber=$_POST['f_mobilenumber'];
      $FRf_Usrcalculateregx=$_POST['frf_calculatereg'];
    //FRD_VC FROM NULL FIELD VALIDATION:-
    if($f_mobilenumber==""){  header("refresh:3; url=$FRc_Hurl"); exit; }
    if($FRf_Usrcalculateregx==""){ header("refresh:3; url=$FRc_Hurl"); exit; }
    //FRD_VC____ CALCULATE REJELT VALIDATION CHACKING:-
    $FRs_CalculateRej=$_SESSION['FRs_CalculateRej'];
    if($FRs_CalculateRej==$FRf_Usrcalculateregx){
        $FR_VC_CalulationRej = "VALID";
        //echo "$FRs_CalculateRej = $FRf_Usrcalculateregx";
    }

    //FRD VALIDATION ALERT:-
    if($FR_VC_CalulationRej==""){echo "<script>toastr.error('হিসাব এর ফলাফল সঠিক নয়');</script>";}
 
      //CUSTOM-VALUE-MAKER
      $FRc_OTPrand1 = rand(0,9);
      $FRc_OTPrand2 = rand(1,9);
      $FRc_OTPrand3 = rand(0,9);
      $FRc_OTPrand4 = rand(0,9);
      
      $FRc_login_otp = "$FRc_OTPrand1$FRc_OTPrand2$FRc_OTPrand3$FRc_OTPrand4";
    
      //CLIENT-IP-FINDING
          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
               $FR_UserIP = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $FR_UserIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $FR_UserIP = $_SERVER['REMOTE_ADDR'];
            }
    //FRD_VC PHOE NUMBER VALIDATION CHECKING:-
    if(preg_match('/^[0-9]{11}+$/', $f_mobilenumber)) {
        //echo "<script>toastr.success('PHON NUMBER IS VALID');</script>";
        $FR_VC_PhonNumber="VALID";
    }else{
        $FR_VC_PhonNumber="NOT_VALID";
        echo "<script>toastr.error('PHON NUMBER NOT VALID');</script>";
        header("refresh:3; url=$FRc_Hurl/login");
        exit;
    }
    //FRD-VC-CHACKING THIS IS BLACK USER ON NOT S:-
    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_blackusr WHERE typee='c' AND b_mob_num = $f_mobilenumber AND statuss = 1");
    $fr_black_nc = $FRQ->fetch();
    $frd_black_usr_c=$fr_black_nc['COUNT(id)'];
    //echo "<hr><h4> BU: $frd_black_usr_c </h4>";
      if($frd_black_usr_c>0){
          $FR_VC_BlackUser="YES";
          //SAVE DATA IN LOGE
          $fp = fopen('blackusr_ip.txt', 'a');
          $d = "$f_mobilenumber -> $FR_UserIP \n";
          fwrite($fp,$d);
          fclose($fp);
          echo "<h4 class='alert alert-danger TAC alertt'>Sorry! You Can't Do It! Please Contact With Site Owner!</h4>";
      }else{
          $FR_VC_BlackUser="NO";
      }
    //FRD_VC_______ OTP SEND LIMIT OTP SEND LIMIT VALIDATION:-
         //FRD TODAY TOTAL OTP SEND COUNTER
         $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_otpvali WHERE usr_ip_a = '$FR_UserIP' AND usr_mobile = '$f_mobilenumber' AND frotp_send_d = '$FR_NOW_DATE'");
         $FRsd_TotpSC = $FRQ->fetch();
         $FRv_TodayOTPsend_c=$FRsd_TotpSC['COUNT(id)'];
         if($FRv_TodayOTPsend_c<15){
             $FRvc_OTPsendLimit="NOT_OVER";
         }else{
              $FRvc_OTPsendLimit="OVER";
              echo "<script>toastr.error('OTP SEND LIMIT OVER');</script>";
              $alert_frd_r="Your OTP SEND LIMIT OVER For Today! <br> Please Call $fr_cmobile_1";
         }
     
    
 
    if($FR_VC_CalulationRej=="VALID" and $FR_VC_PhonNumber=="VALID" and $FR_VC_BlackUser=="NO" and $FRvc_OTPsendLimit=="NOT_OVER"){
        //FRD OPT SEND CLIENT IP AND MOBILE NUMBER SAVING:-
        //FRD_INSERT_DATA_S
        //FRD DATA CUSTOMIZING
            $FRc_opt_typ = 1; //[1=CUSTOMER LOGIN]
            $FRc_UserIP = $FR_UserIP;
            $FRc_UserMobile = $f_mobilenumber;
            $FRc_OTPis = md5($FRc_login_otp);
            $FRc_OTPsend_T = time();
            $FRc_OTPexpir_T = time() + 120;
            $FRc_OTPsend_D = $FR_NOW_DATE;

             $arr = [];
             $arr['opt_typ'] = $FRc_opt_typ;
             $arr['opt_is'] = $FRc_OTPis;
             $arr['opt_send_t'] = "$FRc_OTPsend_T";
             $arr['otp_expir_t'] = "$FRc_OTPexpir_T";
             $arr['usr_mobile'] = "$FRc_UserMobile";
             $arr['usr_ip_a'] = "$FRc_UserIP";
             $arr['frotp_send_d'] = "$FRc_OTPsend_D";
             $FRR = FR_DATA_IN_2("frd_otpvali",$arr);
             if($FRR['FRA']==1){

                    $_SESSION['FRs_loginToken'] = $FRR['FR_LIID'];//FRs_loginToken_START 

                      $frd_sms_to="$f_mobilenumber";
                      $frd_sms_text="$FRc_login_otp is your $fr_cname OTP";

                      $FRR = FR_SEND_SMS($frd_sms_to, $frd_sms_text);
                      if($FRR['FRA']==1){
                          FR_SWAL("OTP SEND DONE","","success");
                      }else{
                          FR_SWAL($FRR['FRM'],"","error");
                      }
                      
                    if(isset($_GET["next_destination"])){
                        FR_GO("$FRc_Hurl/login?next_destination=".$_GET["next_destination"],"1");
                        exit;
                    }else{
                        header("refresh:2; url=$FRc_Hurl/login");
                    }
             }else{
                 FR_SWAL("OPT SENT INFO SAVE FAILED","","error");
             }
            //FRD_INSERT_DATA_E
    }
    
    
}



//++
//++
//###############################################################    
// ONE TIME PIN VALIDATION CHACKING    
//###############################################################
if(isset($_POST['f_frd_login_otp'])){
     //FRD INPUT DATA RECIVING
     $f_frd_login_otp=$_POST['f_frd_login_otp'];
     //FRD SESSION DATA RECIVING
     $FR_loginTokenn=$_SESSION['FRs_loginToken'];
     //FRD OPARATION INNI PERMIT
     $FR_OinniP="YES";
     //##FRD OTO VALIDATION  T DATA:-
     $q_frd="SELECT * from frd_otpvali where id=$FR_loginTokenn";
     require("$rtd_path/1_frd.php");   
     require("$rtd_path/otpvali_t_sjx_frd.php");
     //FRD VC_1 TOKEN TIME EXPIARY VALIDATION CHACKING:-
     if(time()<$FRotp_expitime){
          $FR_OinniP="YES";
         
            //FRD VC_2 USER INPUTED TOKEN VALIDATIONING S:-
             if("$FRotp_code"==md5($f_frd_login_otp)){
                 $FR_OinniP="YES";
             }else{
                 $FR_OinniP="NO";
                 echo "<script>toastr.error('OTP NOT MATCHING');</script>";
                 echo "<script>toastr.warning('অনুগ্রহ করে সঠিক ৪ ডিজিট এর OTP দিন ।');</script>";
                 //FRD OTP INPUT COUNT S:-
                 if(!isset($_SESSION['FRs_OTPinputC'])){
                     $_SESSION['FRs_OTPinputC']=1;
                 }else{
                     $_SESSION['FRs_OTPinputC']=$_SESSION['FRs_OTPinputC']+1;
                 }
                 //FRD OTP INPUT COUNT E:-
                 if($_SESSION['FRs_OTPinputC']>2){
                     echo "
                         <style>
                                body{
                                    background: red;
                                    color: red;
                                    animation: pip_pip 1s infinite;
                                }
                            </style>  
                         ";
                 }
                 //
                 if($_SESSION['FRs_OTPinputC']>3){
                     unset($_SESSION['FRs_loginToken']);
                     unset($_SESSION['FRs_OTPinputC']);
                     header("location:$FRc_Hurl?h=ANV");
                 }
                 
             }
            //FRD VC_2 USER INPUTED TOKEN VALIDATIONING E>
         
     }else{
         $FR_OinniP="NO";
         echo "<script>toastr.error('OTP EXPIRED');</script>";
         unset($_SESSION['FRs_loginToken']);
         if(isset($_SESSION['FRs_OTPinputC'])){
                unset($_SESSION['FRs_OTPinputC']);
            }
     }
    
    
    
    //FRD OPARATION INNI:-
    if($FR_OinniP=="YES"){
        require_once("frd-final-login-reg-script.php");
    }
}    
//++
//++
//###############################################################    
// MOBILE NUMBER  CHANGE CONFIGAR   
//############################################################### 
if(isset($_POST['frddo_changemobilenum'])){
    unset($_SESSION['FRs_loginToken']);
    if(isset($_SESSION['FRs_OTPinputC'])){
        unset($_SESSION['FRs_OTPinputC']);
    }
}

   

///////////////////////////////////////////////////////////////////
/////////////// FRD USER LOGIN || CUSTOMER LOGIN  /////////////////
///////////////////////////////////////////////////////////////////
    if( isset($_POST['frf_username']) and $FR_LOGIN_M_PSW=="ONN" ){
        //FRD DEFAULT VC:-
        $FRini_Login="";
        //FRD FORM  REQUIRED FIELD VALIDATION:-
        if(!isset($_POST['frf_username']) ){ FRfun_ab(); exit; }
        if(!isset($_POST['frf_password']) ){ FRfun_ab(); exit; }
        //FRD FORM DATA RECIVING:-
        $FRf_username=$_POST['frf_username'];
        $FRf_usernamex=$FRf_username;
        $FRf_password=$_POST['frf_password'];
        $FRf_passwordx=md5($FRf_password);
        //FRD FROM NULL FIELD VALIDATION:-
        if($FRf_usernamex==""){ FRfun_ab(); exit; }
        if($FRf_passwordx==""){ FRfun_ab(); exit; }
        //FRD CUSTOM VALUR MAKING:-
        $FRc_LoginPanId=3;//[3=HUB USER]
        
        
        //FRD VC USER LOGIN DATA:-
        $frq_1x = "SELECT * FROM frd_usr WHERE typee = 'cu' AND email1 = '$FRf_usernamex' AND psww = '$FRf_passwordx' AND statuss = 1";
        $FRQ = $FR_CONN->query("$frq_1x");
        $frrows_1x = $FRQ->rowCount();
        if($frrows_1x==1){
            $FRini_Login="YES";
        }else{
            header("refresh:3; url='$FR_THISPAGE'");
             FR_SWAL("লগইন তথ্য সঠিক নয়","","error");
            exit;
        }
        
        
        
     
      //FRD FINAL LOGIN INNI START:-
      if($FRini_Login=="YES"){    
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
            
            
                //Usr Login Counter:-
                try{
                    $FR_CONN->exec("UPDATE frd_usr SET loginn = loginn+1 WHERE id = $UsrId");
                }catch(PDOException $e){
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                }

                FR_TAL("Welcome Back $UsrName","success");



            //FRD NEXT DESTINATION SET AFTER LOGIN :-
                if(isset($_GET["next_destination"])){
                    FR_GO($_GET["next_destination"]);
                    exit;
                }else{
                    FR_GO("$FRD_HURL/my_profile");
                    exit;
                }
        
         }
        
        
    } 
    //END>>   
    
    
?> 
</section>


<!-- $ -->
<section>
    <div class="container">
        
            <!-- FROM - LOGIN WITH MOBILE OTP -->
            <div class="row">
                <?php 
                if(!isset($_SESSION['FRs_loginToken']) and !isset($_SESSION['s_cust_pemail']) ){ 
                
                ?>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                            <?php 
                            if($frd_gom=="frd_on"){
                              if(isset($_SESSION['FRs_Invo_Token'])){
                            ?>
                            <form action="<?php echo "$FRD_HURL/checkout";?>" method="post">
                                <button type="submit" class="frorderwithoutlogin"> <?php echo "$frlc_order_without_login_tx";?> </button>
                            </form>
                             <br>
                            <?php } } ?>

                    
                        <div class="jumbotron frd_div_ani_1 loginformdiv">
                           <span class="d_b_1"></span>
                           <span class="d_b_2"></span>
                           <span class="d_b_3"></span>
                           <span class="d_b_4"></span>
                            <form class="" action="" method="post" autocomplete="on">
                               <!-- <h6 class="TAC "><i>লগইন এবং রেজিস্ট্রেশন</i></h6> -->
                                <input class="form-control" type="text" name="f_mobilenumber" placeholder="<?php echo "$frlc_mobile_num_tx";?>" autocomplete="on" minlength="11" maxlength="11" required>
                                
                                <br>
                                <div class="fr_calculatdiv">
                                   <table width='100%'>
                                       <?php 
                                       ///////////////////////////////////////////////////////////////
                                       //////////// FRD CALULATION TYPE AND MUMBER MAKING ////////////
                                       ///////////////////////////////////////////////////////////////
                                        $FRc_CalcuN1 = rand(1,5);
                                        $FRc_CalcuN2 = rand(1,5);
                                        $FRc_CalcuTyp = '+';
                                        $FRc_CalcuTypText = "যোগফল";
                                        $_SESSION['FRs_CalculateRej'] = ($FRc_CalcuN1+$FRc_CalcuN2);
                                       ?>
                                        <tr>
                                          <td width='40%'><h4><?php echo "$FRc_CalcuN1 $FRc_CalcuTyp $FRc_CalcuN2 = ";?></h4></td>
                                          <td width='60%'> <input name="frf_calculatereg" class='form-control' type="number" placeholder="<?php echo "$frlc_input_result_tx";?>" required></td>
                                        </tr>
                                   </table>
                                   
                                   
                                </div>
                                <br>
                                
                                <button class="btn btn-success btn-block frsendmeotp" type="submit"> <?php echo "$frlc_send_me_otp_tx";?> </button>
                                
                            </form>

                             
                        </div>

                    
                    </div>
                    
                    <div class="col-md-4">
                        
                    </div>
                    
                <?php } ?>
            </div>

            



                        
            
                <!-- FROM - INPUT MOBILE OTP -->
                <div class="row">
                    <?php 
                    if(isset($_SESSION['FRs_loginToken'])){
                     //##FRD OTO VALIDATION  T DATA:-
                     $q_frd="select * from frd_otpvali where id=".$_SESSION['FRs_loginToken']."";
                     require("$rtd_path/1_frd.php");   
                     require("$rtd_path/otpvali_t_sjx_frd.php"); 
                    ?>
                        <br>
                        <br>
                        <br>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="jumbotron frotpinputformdiv">
                                <form class="" action="" method="post">
                                    <h5 class="TAC"> <b class="alertt"><?php echo $FRotp_usermobile;?></b> </h5>
                                    <h6 class="TAC"><span> <?php echo "$frlc_otp_will_expier_tx";?> <span class="r"><?php echo date('h:i:s A',$FRotp_expitime);?></span>  </span></h6>
                                    <input class="form-control" type="text" maxlength="5" minlength="4" name="f_frd_login_otp" placeholder="<?php echo "$frlc_input_otp_tx";?>" required>
                                    <br>
                                    <table width='100%' class="TAC">
                                        <tr>
                                            <td>
                                                <button class="btn btn-success btn-block frloginconfirm" type="submit"> <?php echo "$frlc_login_tx";?> <span class="glyphicon glyphicon-log-in"></span></button>
                                            </td>
                                        </tr>
                                    </table>

                                </form>
                            </div>

                            <form action="" method="POST" class="TAC F_ChangeMobileNumber">
                                <input type="hidden" name="frddo_changemobilenum">
                                <button class="btn btn-default btn-block frchangemobilenum" type="submit" name="frddo_changemobilenum"> <?php echo "$frlc_change_mobile_num_tx";?> </button>
                            </form>
                            <br><br><br>
                        </div>
                        <div class="col-md-4"></div>
                    <?php } ?>
                </div>
                
            
         
        
        
        
        <!-- ALRADY LOGEDI ALERT -->
        <div class="row">
           <?php if( isset($_SESSION['s_cust_pemail'])){ ?>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="jumbotron frd_div_ani_1">
                   <span class="d_b_1"></span>
                   <span class="d_b_2"></span>
                   <span class="d_b_3"></span>
                   <span class="d_b_4"></span>
                   <h4><?php echo "Hi ".$_SESSION['s_cust_Name']." আপনি লগইন করা আছেন";?></h4>
                   <button class='cust_logout_trig btn btn-default btn-block'><span class='glyphicon glyphicon-log-out'></span>  লগ আউট  </button>
                </div>
                <?php header("location:$FRD_HURL/my_orders");?>
            </div>
            <div class="col-md-4"></div>
            <?php }  ?>
        </div>



        <!-- OTHERS LOGIN OPTIONS S -->
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                OR,
                <?php
                if($FR_LOGIN_M_PSW=="ONN"){
                        echo " <button type='button' class='btn btn-default btn-block frbtn_login_with_psw' data-toggle='modal' data-target='#FRmodel_LoginWithPsw'> <i class='glyphicon glyphicon-flash alertt'></i> $rlc_login_with_psw_tx </button>";
                }
                ?>
            </div>
            <div class="col-md-4"></div>
        </div>
        
        
    </div>
</section>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- FRD MODELS -->
<section>
    
    
    <?php if($FR_LOGIN_M_PSW=="ONN"){ ?>
    <!-- LOGIN WITH PASSWORD MODEL S -->
    <div class="modal fade" id="FRmodel_LoginWithPsw" role="dialog"> 
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
        </div>
        <div class="modal-body">
         
          <div class="container-flueid">
              <div class="row">
                <?php
                if(!isset($_SESSION['s_cust_id'])){ ?>
                    <div class="col-md-3"></div>
                    <div class="col-md-12">
                       <form class="" action='' method='post'>
                            <input class='form-control' type='text' name='frf_username' placeholder='<?php echo "$frlc_mobile_num_tx";?>' required><br>
                            <input class='form-control' type='password' name='frf_password' placeholder='<?php echo "$frlc_input_psw_tx";?>' required>
                            <br><button class="btn btn-default btn-block frbtn_login_with_psw"><span class="glyphicon glyphicon-log-in"></span> <?php echo "$frlc_login_tx";?></button>
                        </form>
                   </div>
                   <div class="col-md-3"></div>
                 <?php } ?>   
             </div>
          </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo "$frlc_cloesed_txt";?></button>
        </div>
      </div>
    </div>
  </div>
 <?php } ?>
    
    
</section>




<?php require_once("frd-public/theme/frd-footer.php"); ob_end_flush(); ?>

<!-- THIS SCRIPT MUST HAVE  UNDER FOOTER -->
<script>
      $(document).ready(function(){
        //FRD CART HEID:-
        FRfun_CartHeid();
      });
</script>