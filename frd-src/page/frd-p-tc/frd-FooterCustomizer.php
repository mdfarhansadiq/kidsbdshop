<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Footer Customozer";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Footer Customozer </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frtc_footer_n'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_footer_n = :frtc_footer_n
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");;
                $FRQ->bindParam(':frtc_footer_n', $frtc_footer_n, PDO::PARAM_INT);
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
                         <span>Footer Number </span>
                         <select class='form-control' name='frtc_footer_n' required>
                            <option value='<?php echo "$frtc_footer_n";?>'><?php echo "Footer $frtc_footer_n";?></option>
                            <option value='1'>Footer 1</option>
                            <option value='2'>Footer 2</option>
                            <option value='3'>Footer 3</option>
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