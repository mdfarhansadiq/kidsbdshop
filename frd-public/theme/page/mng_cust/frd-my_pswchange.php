<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "My Profile  CP - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-this-header.php");
require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> MY psw change </h2>-->
<!-- 1 scripts s-->
<section>
<?php



//---------------------------------------------------------
//FRD PASSWORD CHANGE
//---------------------------------------------------------
if(isset($_POST['frf_new_psw'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
	$FRc_frf_new_psw = $_POST['frf_new_psw'];
    $FRc_new_psw = md5($FRc_frf_new_psw);

    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($FRc_frf_new_psw)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($FRc_frf_new_psw != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_usr SET 
            psww = '$FRc_new_psw',
            psw_rc = $FR_NOW_TIME
            WHERE id = ".$_SESSION['s_cust_id']."";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL(" $cust_name আপনার পাসওয়ার্ড পরিবর্তন হয়েছে ","","success");
            }else{
                $FRR["FRA"] = 1;
                $FRR["FRM"] = "Update Done";
                // FR_SWAL("Hi $FRs_UsrName",$R['FRM'],"error");
                FR_SWAL(" $cust_name আপনার পাসওয়ার্ড পরিবর্তন হয়নি ","","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }
        }
    

}
//END>>
?>
</section>
<!-- 1 scripts e-->

   
<br>
<br>
<br>
<br>
<!-- FORM USER PASSWORD CHANGEING -->
<section>
<?php if(!isset($_POST['dofrd_update_password_sub'])){ ?>   
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
                <form class="f2" action="" method="post">
                   <h4>আপনার পাসওয়ার্ড পরিবর্তন করুন</h4>
                  <table>
                        <tr>
                           <td> নতুন পাসওয়ার্ড লিখুন *</td>
                           <td> 
                          <input class="form-control" type="password" placeholder="লিখুন*" name="frf_new_psw" required >
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td>
                               <button class="btn btn-success btn-block " type="submit">নিশ্চিত</button>
                           </td>
                       </tr>
                   </table>
                   
               </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
<?php } ?>     
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







<?php 
require_once("frd-this-footer.php");
require_once("frd-public/theme/frd-footer.php");
?>