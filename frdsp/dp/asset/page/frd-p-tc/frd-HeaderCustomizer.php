<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Header Customizer";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Header Customizer </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frtc_header_n'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_header_n = :frtc_header_n
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_header_n', $frtc_header_n, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
?>   
</section>
<!-- 1 SCRIPT END -->    

   

<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
             <div class="col-md-6 jumbotron">
                <form id="" action="" method="post">

                        <br><br>
                         <span>Header Number </span>
                         <select class='form-control' name='frtc_header_n' required>
                            <option value='<?php echo "$frtc_header_n";?>'><?php echo "Header $frtc_header_n";?></option>
                            <option value='1'>Header 1</option>
                            <option value='2'>Header 2</option>
                            <!-- <option value='3'>Header 3</option> -->
                            <option value='4'>Header 4</option>
                        </select>
                         
                    
                    <div class="text-right">
                        <br>
                        <input class="btn btn-success" type="submit" value="Confirm & Update" name="do_topnaveofferdata_update">
                    </div>
                </form>
             </div>
            <div class="col-md-3"></div>
        </div>
        
    
    </div>
</section>





<?php require_once('frd1_footer.php'); ?>   