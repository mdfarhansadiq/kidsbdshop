<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Writers";//PAGE TITLE
$p="writers";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Writers </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

//---------------------------------------------------------
//FRD WRITER ADD
//---------------------------------------------------------
if(isset($_POST['f_writer_name'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	$f_writer_name = $_POST['f_writer_name'];
    

    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($f_writer_name)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); goto THIS_LAST; }

    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_writer_name != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); goto THIS_LAST; }

        //FRD CUSTOME DATA MAKE:-
            $FRc_writer_slug = strtolower("$f_writer_name");
            $FRc_writer_slug = preg_replace("/ /","-",$FRc_writer_slug);

                if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                    $arr = array();
                    $arr['fr_writer_name'] = $f_writer_name;
                    $arr['fr_writer_slug'] = "$FRc_writer_slug";

                    $arr['fr_by'] = "$UsrId";
                    $arr['fr_add_date'] = "$FR_NOW_DATE";
                    $arr['fr_add_timee'] = "$FR_NOW_TIME";
                    $FRR = FR_DATA_IN("frd_writers",$arr);
                    if($FRR['FRA']==1){
                        FR_SWAL("Hi $UsrName Writer Add Done","","success");
                    }else{
                        FR_SWAL("Hi $UsrName",$R['FRM'],"error");
                    }
                }
                        
}
THIS_LAST:
//END ADD>>

?>   
</section>
<!-- 1 SCRIPT END -->    

   


    <div class="container">
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6 ">
               <form class="jumbotron" id="" action="" method="post">
                    <span>Writer Name *</span>
                    <input  class="form-control" type="text" placeholder="Writer Name *" name="f_writer_name" required>
                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Confirm Add</button>
                    </div>
               </form>
         </div>
          <div class="col-md-3"></div>
     </div>
    </div> 



    <section>
        <div class="container">
        <div class="col-md-11">


            <div class="row">
                <div class="col-me-12">
                    <div id="FRD_WRITERS_LIST"></div>
                </div>
            </div>


        </div>
        </div>
    </section>









<script>
    $(document).ready(function(){
        $.ajax({
          url:FR_HURL_APII + "/Writers",
          method:"POST",
          data: {a:'a'},
          success:function(data){
            console.log(data);
            $('#FRD_WRITERS_LIST').html(data);
          }
        });
  });
</script>



<?php require_once('frd1_footer.php'); ?>   