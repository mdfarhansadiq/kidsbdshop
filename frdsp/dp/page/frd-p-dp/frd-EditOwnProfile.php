<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Edit Own Profile"; //Page  Title
$p = "e_wprofile"; //Page Name
$inn = "mng_profile";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>

<!-- <h2 class="PT"> Update Profile </h2> -->









<?php
//Update User Information:-
if (isset($_POST['UserInfoUpdate_SUB'])) {

  $newUsrName = $_POST['newUsrName'];
  $NewUsremailorphon = $_POST['NewUsremailorphon'];
  $phonn1 = $_POST['phonn1'];
  $confarmationPasw  = md5($_POST['confarmationPasw']);


  ///////////////////// User Table Data Retrive ////////////
  $FRQ = $FR_CONN->query("SELECT * FROM frd_usr WHERE id = $UsrId");
  $Row_UsrTDR = $FRQ->fetch();
  $Usr_psw = $Row_UsrTDR['psww'];
  ///////////////////// User Table Data Retrive End////////////

  if ($Usr_psw == $confarmationPasw) { //Psw Confarmation

    //FRD DATA UPDATE S:-
    try {
      $FRQ = "UPDATE frd_usr SET 
              namee = :namee, 
              email1 = :email1, 
              phon1 = :phon1
              WHERE id = $UsrId";
      $FRQ = $FR_CONN->prepare("$FRQ");
      $FRQ->bindParam(':namee', $newUsrName, PDO::PARAM_STR);
      $FRQ->bindParam(':email1', $NewUsremailorphon, PDO::PARAM_STR);
      $FRQ->bindParam(':phon1', $phonn1, PDO::PARAM_STR);
      $FRQ->execute();
      FR_SWAL("Hi $newUsrName Your Profile Update Done!", "", "success");
    } catch (PDOException $e) {
      FR_SWAL("Hi $newUsrName Your Profile Update Failed!", "", "error");
      echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
    }
    //END>>

  } else {
    FR_SWAL("Update failed ! your current password is not correct!", "", "error");
  }
}
//END>>








//////// Update User Image  ///////////////
if (isset($_POST['UserPicUpdate_SUB'])) {
  $UpdateUsr_ID = $_POST['UpdateUsr_ID'];

  $f_name = $_FILES['pic1']['name'];
  $f_tmp_localion = $_FILES['pic1']['tmp_name'];
  $f_size = $_FILES['pic1']['size'];
  $f_extention_explor = explode('.', $f_name);
  $f_extention = strtolower(end($f_extention_explor));
  $f_store_name = uniqid() . '_frd.' . $f_extention;
  $f_store = "$FR_HDPATH/frd-data/img/user/$f_store_name";

  if ($f_extention == 'jpg' || $f_extention == 'png') {
    if ($f_size >= 500000) {
      echo "<h3 class='TAC r'>Maximum 500kb Images You Can Uplode</h3>";
    } else {
      if (move_uploaded_file($f_tmp_localion, $f_store)) {
          try{
            $FR_CONN->exec("UPDATE frd_usr SET picc = '$f_store_name' WHERE id = $UpdateUsr_ID");
            FR_SWAL("$UsrName Congrats! Image Update Done!", "", "success");
          }catch(PDOException $e){
              FR_SWAL("Image Update Failed!", "", "error");
              echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
          }
      }
    }
  } else {
    echo "<h3 class='TAC r'>You Can Uplode Only jpg and png Images</h3>";

    ////// Refresh BTN S    
    echo "
                            <div class='row TAC'>
                                 <form id='refresh' action='' method='post'>
                                   <button type='submit' name='Refreshh_Sub' class='TAC'>Refresh</button> 
                                 </form>
                             </div>
                            ";
    ////// Refresh BTN E
  }
}





$Cust_IDD = $UsrId;
///////////////////// User Table Data Retrive ////////////
$FRQ = $FR_CONN->query("SELECT * FROM frd_usr WHERE id = $Cust_IDD");
$Row_UsrTDR = $FRQ->fetch();
$Usr_ID = $Row_UsrTDR['id'];
$Usr_type = $Row_UsrTDR['typee'];
$Usr_name = $Row_UsrTDR['namee'];
$Usr_phon1 = $Row_UsrTDR['phon1'];
$Usr_phon2 = $Row_UsrTDR['phon2'];
$Usr_email = $Row_UsrTDR['email1'];
$Usr_psw = $Row_UsrTDR['psww'];
$Usr_status = $Row_UsrTDR['statuss'];
$Usr_gender = $Row_UsrTDR['genderr'];
$Usr_birthday = $Row_UsrTDR['birthdayy'];
$Usr_picc = $Row_UsrTDR['picc'];
$Usr_login = $Row_UsrTDR['loginn'];
$Usr_timee = $Row_UsrTDR['timee'];

$PIC_Path = "$FRD_HURL/frd-data/img/user/$Usr_picc";

////
if ($Usr_type == "ad") {
  $Usr_typeM = "Admin";
}
if ($Usr_type == "ma") {
  $Usr_typeM = "Manager";
}
if ($Usr_type == "pem") {
  $Usr_typeM = "Product Entry Man";
}
if ($Usr_type == "dm") {
  $Usr_typeM = "Delivery man";
}
if ($Usr_type == "cu") {
  $Usr_typeM = " Customer ";
}

///
if ($Usr_status == 1) {
  $Usr_statusM = "LiVE";
}
if ($Usr_status == 2) {
  $Usr_statusM = "Blocked";
}
///////////////////// User Table Data Retrive End////////////   


?>










<div class="container">
  <div class="col-md-11">

    <br>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">

        <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
          <img id="EditwonProfile" src="<?php echo "$PIC_Path"; ?>" alt="User Pic" class="img-responsive"> <br>
          <span>Profile Picture *</span>
          <input type="file" name="pic1" required>
          <!--H-->
          <input type="hidden" value="<?php echo "$Usr_ID"; ?>" name="UpdateUsr_ID">



          <br>
          <div class="text-right">
            <button class="btn btn-success" type="submit" name="UserPicUpdate_SUB"> <span class="glyphicon glyphicon-save"></span> Save </button>
          </div>
        </form>

        <form class="jumbotron" id="" action="" method="post">
          <span>Full Name *</span>
          <input class="form-control" type="text" placeholder="Full Name *" name="newUsrName" value="<?php echo "$Usr_name"; ?>" required>

          <br>
          <span>Login Mobile/Email *</span>
          <input class="form-control" type="text" placeholder="Login Mobile Number*" name="NewUsremailorphon" value="<?php echo "$Usr_email"; ?>" required>

          <br>
          <span>Login Password *</span>
          <input class="form-control " type="password" placeholder="ইনপুট বর্তমান পাসওয়ার্ড *" name="confarmationPasw" required>


          <br>
          <span>Mobile Number </span>
          <input class="form-control" type="text" placeholder="Input মোবাইল নাম্বার " name="phonn1" value="<?php echo "$Usr_phon1"; ?>">


          <br>
          <div class="text-right">
            <button class="btn btn-success" type="submit" name="UserInfoUpdate_SUB"> <span class="glyphicon glyphicon-save"></span> Save </button>
          </div>
        </form>


      </div>
      <div class="col-md-3"></div>
    </div>

  </div>
</div>















<?php require_once('frd1_footer.php'); ?>