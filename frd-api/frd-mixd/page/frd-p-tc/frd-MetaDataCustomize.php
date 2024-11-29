<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Meta Data Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Meta Data Customize </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD COMPANY TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_cmetatitle'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
    //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $keys = array_keys($_POST);
        foreach($keys as $key){
            $$key = $_POST["$key"];
            //echo "$key <br>";
        }
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($fr_cmetatitle)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_cmetatitle != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }
        

    
        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_cprofile SET 
            fr_cmetatitle = '$fr_cmetatitle',
            fr_cmetatag = '$frf_CompanyMetaTag',
            fr_cmetades = '$frf_CompanyMetaDescription',
            dumytxt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName!","Update Done! 1","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("Dear Boss $UsrName!","Message Update Failed! 1","error");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    
}
//END>>


?>   
</section>
<!-- 1 SCRIPT END -->    

   


<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">


                <form class="jumbotron" id="" action="" method="post">

                    <span>Site Meta Title *</span>
                    <textarea class="form-control" name="fr_cmetatitle" id="" cols="30" rows="2" placeholder="লিখুন" required><?php echo "$fr_cmetatitle";?></textarea>

                    <br>
                    <span>Site Meta Tag *</span>
                    <textarea class="form-control" name="frf_CompanyMetaTag" id="" cols="30" rows="4" placeholder="লিখুন" required><?php echo "$fr_cmetatag";?></textarea>

                    <br>
                    <span>Site Meta Description *</span>
                    <textarea class="form-control" name="frf_CompanyMetaDescription" id="" cols="30" rows="4" placeholder="লিখুন" required><?php echo "$fr_cmetades";?></textarea>


                
                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>


               
            </div>
            <div class="col-md-3"></div>
        </div>


        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   