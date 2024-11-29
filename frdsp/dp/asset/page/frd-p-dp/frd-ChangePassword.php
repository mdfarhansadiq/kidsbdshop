<?php 
require_once('frd1_whoami.php');
 $FR_ptitle="Change Password";//Page  Title
 $p="p_changepsw";//Page Name
 $inn="mng_profile";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Change Password </h2> -->
<!-- 1 SCRIPT START -->   
<section>
<?php 
 /////////////////////////////////////////////////////////
////// UPDATE PASSWOED //////////////////////////////////
////////////////////////////////////////////////////////
if(isset($_POST['dofrd_update_password_sub'])){
    
    $NewusrPasw = md5($_POST['NewusrPasw']);
    $confarmationPasw = md5($_POST['confarmationPasw']);

       //#// USER TABLE DATA FETCH
       $q_frd="SELECT * from frd_usr where id=$UsrId";
       require("$rtd_path/1_frd.php");   
       require("$rtd_path/usr_t_frd.php");
     
       if($usr_psw==$confarmationPasw){//Psw Confarmation

            //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_usr SET 
                psww = :psww
                WHERE id = $UsrId";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':psww', $NewusrPasw, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("$UsrName! Password Successfully Updated","","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName! Password Update Failed","","success");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                echo "ERROR LINE: " .$e->getline() . "<br>";
                echo "ERROR CODE: " .$e->getCode() . "<br>";
                echo "ERROR FILE: " .$e->getFile() . "<br>";
            }
            //END>>

   }else{
      FR_SWAL("$UsrName! Password Update Failed! Old Password Not Match!","","error");
    }
    
}   
?>   
</section>
<!-- 1 SCRIPT END -->

   


<br><br>
<!-- FORM USER PASSWORD CHANGEING -->
<section>
<div class="container">
<div class="col-md-11">
   
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
                <form class="f2" action="" method="post">
                   <h4>Password changing</h4>
                  <table>
                       <tr>
                           <td> Old Password *</td>
                           <td> 
                           <input class="form-control" type="password" placeholder=" Input Old Password **" name="confarmationPasw" required>
                           </td>
                       </tr>
                        <tr>
                           <td> New Password *</td>
                           <td> 
                          <input class="form-control" type="password" placeholder="Input New Password*" name="NewusrPasw" required >
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td>
                               <button class="btn btn-success btn-block " type="submit" name="dofrd_update_password_sub">Update Password</button>
                           </td>
                       </tr>
                   </table>
                   
               </form>
            </div>
            <div class="col-md-3"></div>
        </div>


</div>
</div>  
</section>





<?php require_once('frd1_footer.php'); ?>   