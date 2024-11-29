<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Order Manager Setting";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Order Manager Setting </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frsc_om_deforderlist'])){
     extract($_POST);
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_soft_config SET 
                frsc_om_deforderlist = :frsc_om_deforderlist
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frsc_om_deforderlist', $frsc_om_deforderlist, PDO::PARAM_STR);
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

   


<section>
    <div class="container">
        <div class="col-md-11">


           <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">

                        <span>Default Order List </span><br>
                        <input type="radio" name="frsc_om_deforderlist" value="all" <?php if ($frsc_om_deforderlist == "all") { echo "checked";} ?> required> ALL &#160; &#160;&#160;
                        <input type="radio" name="frsc_om_deforderlist" value="new" <?php if ($frsc_om_deforderlist == "new") { echo "checked";} ?> required> Only New

                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
            </div>
           </div>
          





        </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   