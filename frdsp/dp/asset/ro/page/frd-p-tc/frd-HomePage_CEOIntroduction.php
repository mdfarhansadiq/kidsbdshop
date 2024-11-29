<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Home Page CEO Introduction";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="EditMess_OrderPlacedThankYou";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Home Page CEO Introduction </h2>


<!-- 1 SCRIPT START -->   
<section>
<?php 

//FRD ORDER PLACE THANK YOU MESSAGE UPDARE FOR CUSTOM:-
if(isset($_POST['f_pagebody'])){
    $f_pagebody = $_POST['f_pagebody']; 
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 22";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}


//FRD PAGE TABLE DATA READ:-
$FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 22","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   




<section>
    <div class="container">
        <div class="col-md-11">

            <div class="row">
            <div class="col-md-12 jumbotron">
              <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                
                <textarea class="form-control" name="f_pagebody" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>

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