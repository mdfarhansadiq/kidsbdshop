<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Single User";//PAGE TITLE
$p="SoftUsrList";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Edit User </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php
//FRD  THEME COMFIG DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themeconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }

$FRR = FR_QSEL("SELECT * FROM frd_soft_config WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

 
///////////////////////////////////////
//FRD DATA RECEIVING FROM URL:-
///////////////////////////////////////    
 if(isset($_GET['editid'])){
      $edit_idd=$_GET['editid'];
      $FR_eidx = $edit_idd;
 }
 
$FR_THIS_PAGE = "$FR_THIS_PAGE?editid=$FR_eidx";
    


////////////////////////////////////////////////////////////////////
//FRD UPDATE DATA:-
////////////////////////////////////////////////////////////////////
if(isset($_POST['updateinfo_sub'])){
    
    $file_pic1_name = $_FILES['pic_1']['name'];

    $f_name = $_POST['f_name'];
    $f_email1 = $_POST['f_email1'];
    $f_phonn1 = $_POST['f_phonn1'];
    $f_phonn2 = $_POST['f_phonn2'];
    $f_gender = $_POST['f_gender'];
    $f_addresss = $_POST['f_addresss'];
    $f_user_status = $_POST['f_user_status'];

    if(isset($_POST['f_accesspanelid'])){
        $f_accesspanelid = implode(",", $_POST['f_accesspanelid']);
        $f_accesspanelid = "1,$f_accesspanelid";
    }else{
        $f_accesspanelid = 1;
    }


    
            //Update data S
             $FRQ="UPDATE frd_usr SET 
             namee='$f_name',
             email1='$f_email1',
             phon1='$f_phonn1',
             phon2='$f_phonn2',
             genderr='$f_gender',
             addresss='$f_addresss',
             statuss=$f_user_status,
             fr_uapp='$f_accesspanelid'
             WHERE id = $edit_idd
             ";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName","User Information update Done","success");

                //PIC_1  Proses Start:-
                if(!empty($file_pic1_name)){
                    $file_pic1_name=$_FILES['pic_1']['name'];
                    $f_tmp_localion=$_FILES['pic_1']['tmp_name'];
                    $f_size=$_FILES['pic_1']['size'];
                    $f_extention_explor= explode('.',$file_pic1_name);
                    $f_extention = strtolower( end($f_extention_explor) );
                    $f_store_name =uniqid().'_frd.'.$f_extention;
                    $f_store = "$FR_HDPATH/frd-data/img/user/$f_store_name";    

                    if($f_extention=='jpg'||$f_extention=='png'){
                        if($f_size>=500000){
                            echo "<h6 class='TAC r pip_pip_1s'>Maximum 500kb Image You Can Uplode!</h6>";
                        }else{
                            if( move_uploaded_file($f_tmp_localion,$f_store) ){

                                $R = FR_DATA_UP("UPDATE frd_usr SET picc = '$f_store_name' WHERE id = $edit_idd");
                                if($R['FRA']==1){
                                    FR_SWAL("Picture Update Done!","","success");
                                }else{
                                    FR_SWAL("Picture Update Failed ","","error");
                                }
                            }
                        }
                    }else{
                        echo "<h4 class='TAC r'>You Can Uplode Only JPG Or PNG Images $f_extention</h4>";
                    }    
                
                    }
                //END>>

            }else{
                FR_SWAL("Dear Boss $UsrName!","User Information update Failed","error");
            }
           //Update data E
}  
//END>>  



////////////////////////////////////////////////////////////////////
//FRD USER DELETE:-
////////////////////////////////////////////////////////////////////
if(isset($_POST['FRTIGT_DELETE_USER'])){
            //Update data S
             $FRQ="UPDATE frd_usr SET 
             email1 = $FR_NOW_TIME,
             statuss = 3,
             fr_uapp = ''
             WHERE id = $edit_idd
             ";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName","User Deleted Done","success");
                FR_GO("$FR_THISHURL/usr-SoftUsrList",2);
                exit;
            }else{
                FR_SWAL("Dear Boss $UsrName!","User Delete Failed","error");
            }
           //Update data E
}  
//END>>  


    

    

    
    
    
//FRD USER DATA READ:-
$q_frd="SELECT * FROM frd_usr WHERE id = $edit_idd";
require("$rtd_path/1_frd.php");
require("$rtd_path/usr_t_frd.php");
//END>>


   
    
?>     
</section>
<!-- 1 SCRIPT END -->    

   







  <!--From--> 
    <div class="container">
    <div class="col-md-11">

     <div class="row">
        <div class="col-md-3"></div>
         <div class="col-md-6 jumbotron">
             
              <form id="" action="" method="post" enctype="multipart/form-data" >


                   <img id="t1_img" src="<?php echo "$usr_pic_path"?>" alt="" class="img-responsive">
                   <small>Recommended image size 400px X 400px</small>
                   <input class="form-control" type="file" name="pic_1" >


                   <br>
                   <span> Name *</span>
                   <input  class="form-control" type="text" value="<?php echo "$usr_namee"?>" name="f_name" required>
                   
                   <br>
                   <span>Primary Email Or Phone *</span>
                   <input class="form-control" type="text" value="<?php echo "$usr_email1"?>" name="f_email1" required >
                   
                   <br>
                   <span>Phone 1 (Optional) </span>
                   <input class="form-control" type="text" value="<?php echo "$usr_phon1"?>" name="f_phonn1">
                   
                   <br>
                   <span>Phone 2 (Optional) </span>
                   <input class="form-control" type="text" value="<?php echo "$usr_phon2"?>" name="f_phonn2">
                   
                
                   
                     
                    <br><br>
                    <span>Gender &nbsp;&nbsp;</span>
                    <input type="radio" name="f_gender" value="1" <?php if($usr_genderr==1){echo "checked";}?> required> Male 
                    <input type="radio" name="f_gender" value="2" <?php if($usr_genderr==2){echo "checked";}?> required> Female<br>
                    <br><br>
                    
                    <span>Address </span>
                    <textarea class="form-control" name="f_addresss" id="" rows="3" placeholder="Type Address"><?php echo "$usr_addresss"?></textarea><br> 
                    
                    
                    <br>
                    <span>User Status *</span>
                    <select class="form-control" name="f_user_status" id="" required>
                        <option value="<?php echo "$usr_status"?>"><?php echo "$usr_status_mody"?></option>
                        <option value="1">Active</option>
                        <option value="2">Blocked</option>
                    </select>


                    <br>
                    <span>User Access Control *</span> <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='6' id='6'> Order Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='2' id='2'> Product Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='19' id='19'> Settings <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='9' id='9'> Category Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='22' id='22'> Brand Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='24' id='24'> Product Color Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='21' id='21'> Delivery Partner Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='23' id='23'> Book Writer Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='3' id='3'> Page Manager <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='26' id='26'> Theme Customizer <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='16' id='16'> Software Update <br>
                    <input type='checkbox' name='f_accesspanelid[]' value='17' id='17'> Insert Header & Footer Manager <br>

                    <br>
                    <?php 
                    if($frplug_SMSs == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='25' id='25'> SMS Services <br>"; 
                    }
                    if($frsc_cust_m_panel == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='15' id='15'> Customers Manager<br>"; 
                    }
                    if($frplug_RatingRev == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='4' id='4'> Rating & Review Manager<br>"; 
                    }
                    if($frsc_sells_reports == 1){
                         echo "<input type='checkbox' name='f_accesspanelid[]' value='10' id='10'> Sales Report Manager <br>"; 
                         echo "<input type='checkbox' name='f_accesspanelid[]' value='14' id='14'> Profit & Loss Report Manager <br>"; 
                    }
                    if($frsc_usr_m_panel == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='5' id='5'> Multi-User Manager <br>"; 
                    }
                    if($frsc_ppr_panel == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='18' id='18'> Partial Product Return Back Manager <br>"; 
                    }
                    if($FRcf_ParcelBooki=="1"){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='20' id='20'> PARCELS DELIVERY MANAGER <br>";
                    }

                    if($frplug_SFC_OSAU == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='27' id='27'> SteadFast Order Status Auto Update <br>";
                    }
                    if($frplug_sms_m_osb == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='28' id='28'> SMS Marketing - OSB <br>";
                    }
                    if($frsc_fb_feed_xml == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='29' id='29'> Facebook Dynamic Catalog Manager <br>";
                    }


                    echo "<br>"; 
                    if($frplug_suppliers == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='12' id='12'> Suppliers Manager <br>";  
                    }
                    if($frplug_cost == 1){
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='7' id='7'> Cost Manager <br>";
                    }
                    if($frplug_ac_m == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='8' id='8'> Accounting Manager <br>"; 
                    }
                    if($frplug_inv_m == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='11' id='11'> Investor Manager <br>";
                    }
                    if($frplug_due_m == 1){ 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='30' id='30'> Due Manager <br>";
                    }
                    
                    
                    if($frplug_sitedata == 1){ 
                        echo "<br>"; 
                        echo "<br>"; 
                        echo "<input type='checkbox' name='f_accesspanelid[]' value='301' id='301'> Site Data <br>";
                    }
                    ?>

                    
                   
                   
                   <br>
                   <br>
                   <div class='text-right'>
                        <button type='submit' class='btn btn-success' name="updateinfo_sub"> <span class='glyphicon glyphicon-save'></span> Confirm & Update</button>
                    </div>
                   
               </form>
         </div>
         <div class="col-md-3"></div>
     </div>


  </div>
 </div>



 
<?php if($UsrType == "ad"){ ?>
    <section>
        <div class="container">
            <div class="row">
                <hr>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <form action='' method='POST'>
                    <input type='checkbox' required> I am sure!
                    <button type='submit' class='btn btn-danger btn-xs btn-block' name="FRTIGT_DELETE_USER"> <span class='glyphicon glyphicon-flash'></span> Confirm & Delete This User </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</section>
<?php } ?>




 <script>
     const str_uapp = '<?php echo "$fr_uapp"?>';

    $(document).ready(function(){
        let arr_uapp = str_uapp.split(',');
        arr_uapp.forEach((item)=>{
            console.log(item);
            $('#'+item).attr('checked',true); 
        });
    });
 </script>



<?php require_once('frd1_footer.php'); ?>   