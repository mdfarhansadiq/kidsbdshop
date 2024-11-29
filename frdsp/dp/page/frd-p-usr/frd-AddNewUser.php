<?php 
require_once('frd1_whoami.php');
$FR_ptitle="ADD USER";//PAGE TITLE
$p="AddNewUser";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> ADD NEW SOFTWARE USER </h2>


<!-- 1 SCRIPT START -->
<section>
    <?php
    ////////////////////////////////////////////////////////////////////////
    //RD ADDING NEW USER:-
    ////////////////////////////////////////////////////////////////////////    
    if (isset($_POST['NewUserAdd_SUB'])) {
 

        $newUsrName = $_POST['newUsrName'];
        $NewUsremailorphon = $_POST['NewUsremailorphon'];
        $phonn1 = $_POST['phonn1'];
        $phonn2 = $_POST['phonn2'];
        $NewusrPasw = md5($_POST['NewusrPasw']);
        $Nusergender = $_POST['gender'];
        $Nuseraddresss = $_POST['addresss'];
        $NuserRoll = $_POST['frf_usertype'];

        $ARR = [];
        $ARR['typee'] = "$NuserRoll";
        $ARR['namee'] = "$newUsrName";
        $ARR['email1'] = "$NewUsremailorphon";
        $ARR['phon1'] = "$phonn1";
        $ARR['phon2'] = "$phonn2";
        $ARR['psww'] = "$NewusrPasw";
        $ARR['genderr'] = "$Nusergender";
        $ARR['addresss'] = "$Nuseraddresss";
        $ARR['fr_uapp'] = "1";
        $ARR['statuss'] = "1";
        $ARR['byy'] = "$UsrId";
        $ARR['datee'] = "$FR_NOW_DATE";
        $ARR['timee'] = "$FR_NOW_TIME";
        $FRR = FR_DATA_IN_2("frd_usr",$ARR);
        if($FRR['FRA']==1){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, base64_decode("aHR0cHM6Ly9mYXpsZXJhYmJpZGhhbGkuY29tLzBfMC90cmFja3NvZnRpbnN0YWxsbG9jYXRpb24vMS5waHA="));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "a=$FRD_HURL&b=f37129cb0976ae686bc12f3482019af1");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);

            FR_SWAL("New User Add Done!","","success");
            FR_GO("usr-SoftUsrList",2);
        }else{
            FR_SWAL("New User Add Failed!","","error");
        }

    }
    //END>>
    ?>
</section>
<!-- 1 SCRIPT END -->






<div class="container">
    <div class="col-md-11">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">

                <form id="" action="" method="post" enctype="multipart/form-data">
                    <span>New User Name *</span>
                    <input class="form-control" type="text" placeholder="New User Name *" name="newUsrName" required>

                    <br>
                    <span>Primary Email Or Phone *</span>
                    <input class="form-control" type="text" placeholder="Primary Email Or Phone *" name="NewUsremailorphon" required>

                    <br>
                    <span>User Password *</span>
                    <input class="form-control" type="password" placeholder="User Password *" name="NewusrPasw" required>

                    <br>
                    <span>Phone 1 (Optional) </span>
                    <input class="form-control" type="text" placeholder="Phone 1 (Optional)" name="phonn1">

                    <br>
                    <span>Phone 2 (Optional) </span>
                    <input class="form-control" type="text" placeholder="Phone 2 (Optional)" name="phonn2">

                    <br><br>
                    <span>Gender &nbsp;&nbsp;</span>
                    <input type="radio" name="gender" value="1" required> Male
                    <input type="radio" name="gender" value="2" required> Female<br>
                    <br><br>

                    <span>Address </span>
                    <textarea class="form-control" name="addresss" id="" rows="3" placeholder="Type Address"></textarea><br>

                    <span>SELECT USER TYPE * </span>
                    <select class="form-control" name="frf_usertype" id="" required>
                        <option value="">SELECT USER TYPE</option>
                        <option value="ad">Admin</option>
                        <option value="M">Manager</option>
                        <option value="x">Software User</option>
                        <option value="OCA">Order Confirm Assistant</option>
                        <?php if($FRcf_ParcelBooki == 1){ echo "<option value='pdm'>PDM</option>";}?>
                    </select>




                    <br>
                    <br>

                    <div class='text-right'>
                        <button type='submit' class='btn btn-success' name="NewUserAdd_SUB"> <span class='glyphicon glyphicon-save'></span> Confirm & Add</button>
                    </div>

                </form>
            </div>
            <div class="col-md-3"></div>
        </div>



    </div>
</div>



<?php require_once('frd1_footer.php'); ob_end_flush(); ?>