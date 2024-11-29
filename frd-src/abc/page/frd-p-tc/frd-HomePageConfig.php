<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Home Page Config"; //PAGE TITLE
$p = "HomePageConfig"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Home Page Config </h2> -->
<br>

<!-- 1 SCRIPT START -->
<section>
<?php
//---------------------------------------------------------
//FRD THEME CONFIG TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_hpc_catbaspro_show'])){
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
        if(isset($fr_hpc_catbaspro_show)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_hpc_catbaspro_show != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_hpconfig SET 
            fr_hpc_catbaspro_show = '$fr_hpc_catbaspro_show',
            fr_hpc_catbasepro_catids = '$f_fr_hpc_catbasepro_catids',
            fr_hpc_popu_cats = '$f_fr_hpc_popu_cats',
            dumytxt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName","Update Done","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("Dear Boss $UsrName","Update Failed","error");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    

}
//END>>






//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_hpconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>


//FRD  DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themeconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

?>
</section>
<!-- 1 SCRIPT END -->



<section>
<div class="container">

   <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 jumbotron">
        <h3 class="text-center text-primary boldd">Home Page Section Serialize</h3>
        <?php
         $FRR = FR_QSEL("SELECT * FROM frd_hpserial WHERE fr_hp_sec_stat = 1 ORDER BY fr_hp_sec_serial ASC","ALL");
         if($FRR['FRA']==1){ 
                echo "<table id='FrTabHpSerialize' class='table table-bordered table-striped'>";
                echo "
                <thead>
                    <tr class='h4 alert alert-success'>
                        <td>Section</td>
                    </tr>
                </thead>
                <tbody class='row_position'>
                ";
         
                        $FRc_SL = 1;
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
                                echo "
                                    <tr id='$id'>
                                        <td>$fr_hp_sec_dp_name</td>
                                    </tr> 
                                ";
                                
                            $FRc_SL = ($FRc_SL + 1);
                        }
                
                echo "</tbody> </table>";
         } else{ 
           //   PR($FRR);
           echo "<div class='text-center alert alert-danger'>  NO DATA FOUND  </div>";
         }
        ?>
    </div>
    <div class="col-md-3"></div>
   </div>

</div>
</section>






<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h3 class="text-center text-success boldd">Mixd</h3>
            
                <form class="" id="" action="" method="post">
            
                    <span>Populers Category Carosol </span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="f_fr_hpc_popu_cats" value="<?php echo "$fr_hpc_popu_cats"; ?>" required>


                    <br><br><br>
                    <span>Special Product Categories</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="f_fr_hpc_catbasepro_catids" value="<?php echo "$fr_hpc_catbasepro_catids"; ?>" required>
                    <span> Special Product Categories - Base Product Show Limit</span>
                    <select class='form-control' name='fr_hpc_catbaspro_show' required>
                            <option value='<?php echo "$fr_hpc_catbaspro_show";?>'><?php echo "$fr_hpc_catbaspro_show";?></option>
                            <option value='4'>4</option>
                            <option value='8'>8</option>
                            <option value='12'>12</option>

                            <option value='6'>6</option>
                            <option value='12'>12</option>
                            <option value='18'>18</option>
                            <option value='24'>24</option>
                            <option value='30'>30</option>

                    </select>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>

                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>





<script>
    	$(document).ready(function() {

			$("#FrTabHpSerialize tbody").sortable({
				delay: 150,
				stop: function() {
					var selectedData = new Array();
					$("#FrTabHpSerialize tbody tr").each(function() {
						selectedData.push($(this).attr("id"));
					});
					updateOrder(selectedData);
				}
			});

			function updateOrder(FrPostDataArray) {
				$.ajax({
					url: FR_HURL_APII + "/Api_HpSecSerialize",
					type: 'POST',
					data: {
						FrPostDataArray: FrPostDataArray
					},
					success: function(data) {
                        let FrObj = JSON.parse(data);
                        if(FrObj.FRA == 1){
                            swal("Dear Boss " + FRc_USER_NAMEE ,FrObj.FRM, "success");
                        }
                        else if(FrObj.FRA == 2){
                            swal("Hi",FrObj.FRM,"error");
                        }
                        else{
                            swal("ERROR (H:HDSHDYEIEX)","error");
                            console.log(data);
                        }
					},
                    error: function(xhr, textStatus, error){
                        console.log("ERROR FOUND");console.log(xhr.statusText);console.log(textStatus);console.log(error);
                    }
				});
			}


		});

</script>




<?php require_once('frd1_footer.php'); ?>