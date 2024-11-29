<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Insert Header Footer";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
$FRc_THIS_P_ID = 17;//THIS PANEL ID
require_once('frd1_header.php');
?>

<h2 class="PT"> Insert Code In Header & Body & Footer</h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

 $FRc_FilePath_Header = $FR_PATH_HD."frd-data/mixd/frd-insert-header.php";
 $FRc_FilePath_Body = $FR_PATH_HD."frd-data/mixd/frd-insert-body.php";
 $FRc_FilePath_Footer = $FR_PATH_HD."frd-data/mixd/frd-insert-footer.php";
 


 if(isset($_POST['f_file_data_header'])){
    $FR_fdata = $_POST['f_file_data_header'];
    $FR_fh = fopen("$FRc_FilePath_Header", "w");
    if(fwrite( $FR_fh, $FR_fdata )){
        FR_SWAL("$UsrName DATA INSERT DONE TO HEADER","","success");
    }else{
        FR_SWAL("$UsrName DATA INSERT FAILED TO HEADER","","error");
    }
    fclose( $FR_fh );
 }



 if(isset($_POST['f_file_data_body'])){
    $FR_fdata = $_POST['f_file_data_body'];
    $FR_fh = fopen("$FRc_FilePath_Body", "w");
    if(fwrite( $FR_fh, $FR_fdata )){
        FR_SWAL("$UsrName DATA INSERT DONE TO BODY","","success");
    }else{
        FR_SWAL("$UsrName DATA INSERT FAILED TO BODY","","error");
    }
    fclose( $FR_fh );
 }



 if(isset($_POST['f_file_data_footer'])){
    $FR_fdata = $_POST['f_file_data_footer'];
    $FR_fh = fopen("$FRc_FilePath_Footer", "w");
    if(fwrite( $FR_fh, $FR_fdata )){
        FR_SWAL("$UsrName DATA INSERT DONE TO FOOTER","","success");
    }else{
        FR_SWAL("$UsrName DATA INSERT FAILED TO FOOTER","","error");
    }
    fclose( $FR_fh );
 }




?>   
</section>
<!-- 1 SCRIPT END -->    

   








<section>
    <div class="container">
    <div class="col-md-11">
    
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                
                <form class="jumbotron" id="" action="" method="post">
                   <h3 class="text-center boldd text-success">Insert Header</h3>
                   <textarea class="form-control" name="f_file_data_header" id="" cols="30" rows="15" placeholder="লিখুন"><?php echo file_get_contents($FRc_FilePath_Header);?></textarea>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Insert In Header </button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>




        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="jumbotron" id="" action="" method="post">
                   <h3 class="text-center boldd text-danger">Insert Body</h3>
                   <textarea class="form-control" name="f_file_data_body" id="" cols="30" rows="15" placeholder="লিখুন"><?php echo file_get_contents($FRc_FilePath_Body);?></textarea>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-danger" type="submit"> <span class="glyphicon glyphicon-save"></span> Insert In Body </button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>




        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="jumbotron" id="" action="" method="post">
                   <h3 class="text-center boldd text-info">Insert Footer</h3>
                   <textarea class="form-control" name="f_file_data_footer" id="" cols="30" rows="15" placeholder="লিখুন"><?php echo file_get_contents($FRc_FilePath_Footer);?></textarea>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-info" type="submit"> <span class="glyphicon glyphicon-save"></span> Insert In Footer </button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>


        


    </div>
    </div>
</section>

   






<?php require_once('frd1_footer.php'); ?>   