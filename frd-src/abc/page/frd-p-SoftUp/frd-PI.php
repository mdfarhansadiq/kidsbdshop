<?php 
$Callingg_2 = "PluginInstall";
require_once('frd1_whoami.php');
$FR_ptitle="Plugin Install";//PAGE TITLE
$p="";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> New Plugin Install </h2>


<!-- 1 SCRIPT S -->
<section>
<?php

$FR_PART_1 = ""; //ZIP FILE Extract
$FR_PART_2 = ""; //ALTER TABLE FILE RUN
$FR_PART_3 = ""; //ALTER TABLE FILE DELETE
$FR_PART_4 = ""; //ZIP FILE DELETE


//FRD VC NEED:-
$FR_VC_FILE_EXTENTION = "";
$FR_VC_FILE_UPLODE_DONE = "";


$FRc_THIS_OPERATION_PATH = "$FR_PATH_HD/frdsp/dp/page/";

$FRc_PluginName = "";
$FRc_PluginFolderDelete = 0;



//FRD PART 1 START [ZIP FILE UPLODE AND UNZIP]:-
if (isset($_FILES['f_plugin_file'])) {
    PR($_FILES['f_plugin_file']);
    
    $FRc_File_Name = $_FILES['f_plugin_file']['name'];
    $FRc_File_Templocalion = $_FILES['f_plugin_file']['tmp_name'];
    $FRc_File_Size = $_FILES['f_plugin_file']['size']; //BYTE FORMET
    $FRc_File_Size_kbf = round($FRc_File_Size / 1000); //KB FORMET
    //+
    $FRc_filenameWithoutExtension = pathinfo($FRc_File_Name, PATHINFO_FILENAME);
    //+
    $FRc_File_ExtentionExplor = explode('.', $FRc_File_Name);
    $FRc_File_Extention = strtolower(end($FRc_File_ExtentionExplor));
    //++
    $FRc_File_StoreName = "$FRc_File_Name";
    $FRc_File_StoreLocation = "$FRc_THIS_OPERATION_PATH"."$FRc_File_StoreName";


    //FRD_VC___________________________________________EXTENTION:-
    if ($FRc_File_Extention == 'zip') {
        $FR_VC_FILE_EXTENTION = 1;
    } else {
        FR_SWAL("YOU CAN UPLODE ONLY ZIP FILE", "", "error");
        goto LAST_THIS;
    }

    //FRD UPLODE ZIPFILE TO SERVER:-
    if($FR_VC_FILE_EXTENTION == 1){
        if( move_uploaded_file($FRc_File_Templocalion,"$FRc_File_StoreLocation") == 1){
            $FR_VC_FILE_UPLODE_DONE = 1;
        }else{
            FR_SWAL("ERROR","FILE UPLODE FAILED","error");
        }
    }
    //END>>

}
//END>>




//FRD PART 1 - ZIP FILE Extracting:-
if ($FR_VC_FILE_EXTENTION == 1 AND $FR_VC_FILE_UPLODE_DONE == 1) {

    $unzip = new ZipArchive();
    $out = $unzip->open($FRc_File_StoreLocation);
    if ($out === TRUE) {
        $unzip->extractTo("$FRc_THIS_OPERATION_PATH");
        $unzip->close();
        echo "<h6 class='alert alert-success text-center'> PART 1 DONE: File Unzipped </h6>";
        $FR_PART_1 = 1;
    } else {
        echo "<h6 class='alert alert-danger text-center'> PART 1 FAILED: No Zip File Found </h6>";
        exit;
    }
}
//END>>>





//FRD PART 2 - TABLE UPDATE INITIALIZING:-
if ($FR_PART_1 == 1) {
    if (file_exists($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension/frd-alter-table.php")) {
        require_once($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension/frd-alter-table.php");
        echo "<h6 class='alert alert-success text-center'>PART 2 DONE: ALTER TABLE DONE </h6>";
        $FR_PART_2 = 1;
    } else {
        echo "<h6 class='alert alert-danger text-center'>PART 2 FAILED: Alter File Not Found </h6>";
        exit;
    }
}
//END>>




//FRD PART 3 -  ALTER TABLE FILE DELETING:-
if ($FR_PART_2 == 1) {
    //FRD ALTER FILE DELETEING:-
        if (file_exists($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension/frd-alter-table.php")) {
                unlink($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension/frd-alter-table.php");
                    if (!file_exists($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension/frd-alter-table.php")) {
                        echo "<h6 class='alert alert-success text-center'> PART 3 DONE: ALTER FILE DELETE DONE </h6>";
                        $FR_PART_3 = 1;
                    }
        } else {
            echo "<h6 class='alert alert-danger text-center'>PART 3 FAILED: ERROR DHDHUIREUECXXX </h6>";
            exit;
        }
}
//END>>
//FRD PART 4 - ZIP FILE DELETING:-
if ($FR_PART_3 == 1) {
    if (file_exists("$FRc_File_StoreLocation")){
        unlink("$FRc_File_StoreLocation");
            if (!file_exists("$FRc_File_StoreLocation")) {
                echo "<h6 class='alert alert-success text-center'>PART 4 DONE: ZIP FILE DELETE DONE </h6>";
                $FR_PART_4 = 1;
            }
    } else {
      echo "<h6 class='alert alert-danger text-center'> PART 4 FAILED: ERROR HDJDUIEUEYNHBBX </h6>";
      exit;
    }
}
//FRD PLUGIN FOLDER DELETE IF NEED:-
if($FRc_PluginFolderDelete == 1){
    PR(FRF_DeleteFolder($FRc_THIS_OPERATION_PATH."$FRc_filenameWithoutExtension"));
    echo "<h6 class='alert alert-success text-center'> Plugin Folder Delete Done </h6>";
}



if($FR_PART_4 == 1){
    FR_SWAL("$FRc_PluginName - Plugin Install Completed","","success");
}

LAST_THIS:

?>
</section>
<!-- 1 SCRIPT E -->  




    <?php if(!isset($_POST['f_plugin_install_sub']) ){ ?>
    <h6 class="text-center"> <?php echo "Current Version: $FR_SOFT_VERSION" ?> </h6>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 jumbotron">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input class="form-control" type="file" name="f_plugin_file" required>
                    <button type="submit" name="f_plugin_install_sub" class="btn btn-success btn-block"> Confirm & Plugin Install </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <?php } ?>




<?php require_once('frd1_footer.php'); ?>