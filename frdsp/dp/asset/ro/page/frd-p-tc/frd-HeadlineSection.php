<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Headline";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Headline </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['fr_headline_dplay'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                fr_headline_dplay = :fr_headline_dplay,
                fr_headline_data = :fr_headline_data
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_headline_dplay', $fr_headline_dplay, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_headline_data', $fr_headline_data, PDO::PARAM_STR);
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

                        <span>Headline Text </span> <br>
                        <input type="radio" name="fr_headline_dplay" value="1" <?php if ($fr_headline_dplay == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="fr_headline_dplay" value="0" <?php if ($fr_headline_dplay == "0") { echo "checked";} ?> required> Hied
                        <br>
                        <textarea class="form-control mt-5" rows="4" name="fr_headline_data"><?php echo "$fr_headline_data"?></textarea>
                        
                    
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