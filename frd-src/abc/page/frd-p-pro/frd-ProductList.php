<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product List";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>

<h2 class="PT"> Products 
    <button class="btn btn-success"><a href="pro-AddNewProduct" class="fr-text-deco-none fr-color-white"><span class="glyphicon glyphicon-plus"></a></button>
</h2>



<!-- 1 SCRIPT S-->
<section> 
<?php


//FRD DELETE PRODUCT:-
if(isset($FRurl[1])){ 
 if($FRurl[1] == "delete"){
    $FR_VC_ROL = "";

    $FRc_DeleteProductIdx = $FRurl[2];

    $FRQ = $FR_CONN->query("SELECT vry_typ FROM frd_products WHERE id = $FRc_DeleteProductIdx");
    extract($FRQ->fetch());

    if($UsrType == "ad"){
        $FR_VC_ROL = 1;
    }else{
        FR_SWAL("Only Admin Can Do It $UsrName","","warning");
    }

       if($FR_VC_ROL == 1){

            $FRQ = "UPDATE frd_products SET 
            statuss = 4
            WHERE id = $FRc_DeleteProductIdx";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

                if($vry_typ > 1){
                    try{
                        $FR_CONN->exec("UPDATE frd_products SET statuss = 4 WHERE v_mp_id = $FRc_DeleteProductIdx");
                        FR_SWAL("Dear Boss $UsrName", "Update Delete Done With VP", "success");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }catch(PDOException $e){
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                        FR_SWAL("$UsrName", "Update Delete Failed With VP", "error");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }
                }else{
                    FR_SWAL("Dear Boss $UsrName", "Update Delete Done", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                }

            }else{
                FR_SWAL(" $FRs_UsrName DELETE FAILED","","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
           }

        }
         
}}
//END>>




//FRD Duplicate PRODUCT:-
if(isset($FRurl[1])){ 
 if($FRurl[1] == "duplicate"){
    $FRc_DuplicateProductIdx = $FRurl[2];


    //FRD_INSERT_DATA_START:-
    try{
        $FR_CONN->exec("INSERT INTO frd_products (bn_name) VALUES ('Copy Product')");
        $FR_LastInId = $FR_CONN->lastInsertId();
    }catch(PDOException $e){
        echo "DATA INSERT FAILED";
        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
    }
  //END>>


  //QUICK DATA READ WITH EXTRACT:-
    $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE id = $FRc_DuplicateProductIdx");
    $FRc_DATA_ARR = $FRQ->fetch();
    extract($FRc_DATA_ARR);




    try{
        $FRQ = "UPDATE frd_products SET 
        bn_name = :bn_name,
        fr_meta_title = :fr_meta_title,
        detailess = :detailess,
        fr_meta_desc = :fr_meta_desc,
        tagg = :tagg
        WHERE id = $FR_LastInId";
        $FRQ = $FR_CONN->prepare("$FRQ");
        $FRQ->bindParam(':bn_name', $bn_name, PDO::PARAM_STR);
        $FRQ->bindParam(':fr_meta_title', $fr_meta_title, PDO::PARAM_STR);
        $FRQ->bindParam(':detailess', $detailess, PDO::PARAM_STR);
        $FRQ->bindParam(':fr_meta_desc', $fr_meta_desc, PDO::PARAM_STR);
        $FRQ->bindParam(':tagg', $tagg, PDO::PARAM_STR);
        $FRQ->execute();
        FR_TAL("Step 1 Data Update Done","success");
    }catch(PDOException $e){
        FR_TWAL("Step 1 Data Update Failed","error");
        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
    }
    

        $FRc_SL = 0;
        $FRc_ARRCOUNT = count($FRc_DATA_ARR);
        foreach($FRc_DATA_ARR AS $FR_KEY => $FR_VAL){
            $FRc_SL = ($FRc_SL + 1);

            if($FR_KEY == "bn_name" || $FR_KEY == "fr_meta_title" || $FR_KEY == "detailess" || $FR_KEY == "fr_meta_desc" || $FR_KEY == "tagg"){
                continue;
            }

            if($FR_KEY == "id"){$FR_VAL = $FR_LastInId;}
            if($FR_KEY == "v_mp_id"){$FR_VAL = "";}
            if($FR_KEY == "pro_typ"){$FR_VAL = 1;}
            if($FR_KEY == "vry_typ"){$FR_VAL = 1;}
            if($FR_KEY == "vieww"){$FR_VAL = 0;}
            if($FR_KEY == "byy"){$FR_VAL = $UsrId;}
            if($FR_KEY == "datee"){$FR_VAL = $FR_NOW_DATE;}
            if($FR_KEY == "timee"){$FR_VAL = $FR_NOW_TIME;}
            
            try{
                $FR_CONN->exec("UPDATE frd_products SET $FR_KEY = '$FR_VAL' WHERE id = $FR_LastInId");
                if($FRc_SL == $FRc_ARRCOUNT){ FR_SWAL("Dear Boss $UsrName! Product Duplicate Completed! You saved your 5 minutes!","Duplicate Completed","success"); }
            }catch(PDOException $e){
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                FR_TAL("Update Failed [$FR_KEY]","error");
                FR_SWAL("Dear Boss $UsrName!"," Duplicate Failed","error");
            }

        }  
         
}}
//END>>




?>
</section>
<!-- 1 SCRIPT E-->




<section>
    <div class="container">
    <div class="col-md-11">

    <form id="FilterForm" action="">
       <div class="row frd-card-1 text-left">
         <div class="col-md-2 pt-5">
             <input class="form-control" type="text" id="f_search_id" placeholder="Search Product Id">
         </div>
         <div class="col-md-2 pt-5">
             <input class="form-control" type="text" id="f_search_text" placeholder="Title, Tag, Description, SKU">
         </div>
         <div class="col-md-3 pt-5">
                <select class='form-control' id="f_filt_status" name='f_filt_status'>
                    <option value='Published'>Published</option>
                    <option value=''>All Status</option>
                    <option value='Unlisted'>Unlisted</option>
                    <option value='Private'>Private</option>
                    <option value='Trashed'>Trashed</option>
                    <option value='LowStock'>Low Stock</option>
                    <option value='StockOut'>Out of stock</option>
                    <option value='ColorVariation'>Color Variation</option>
                    <option value='SizeVariation'>Size Variation</option>
                </select>
         </div>
         <div class="col-md-3 pt-5">
                <select class='form-control chosen' id="f_filter_cat" name='f_filter_cat'>
                    <option value=''>All Categories</option>
                    <?php echo FRF_OPTION_CAT(); ?>
                    <option value='0'>Uncategorized Product</option>
                </select>
         </div>
         <div class="col-md-2 pt-5">
                <select class='form-control' id="f_filt_asc_desc" name='f_filt_asc_desc'>
                    <option value='DESC'>Old => New</option>
                    <option value='ASC'>New => Old</option>
                </select>
         </div>
         <div class="col-md-2 mt-5">
                <select class='form-control' id="f_filt_limit" name='f_filt_limit'>
                    <option value='60'>Limit 60</option>
                    <option value='300'>Limit 300</option>
                    <option value='600'>Limit 600</option>
                    <option value='900'>Limit 900</option>
                    <option value='1000'>Limit 1000</option>
                    <option value='2000'>Limit 2000</option>
                    <option value='3000'>Limit 3000</option>
                </select>
         </div>
         <div class="col-md-2 mt-5">
                <select class='form-control' id="f_filt_supplier" name='f_filt_supplier'>
                   <option value="">Select Supplier</option>
                   <?php echo FRF_OPTION_SUPPLIERS();?>
                </select>
         </div>
       </div>
    </form>


        <br>
        <div class="row">
            <div class="col-md-12">
                <div id="FRD_LIST"></div>
            </div>
        </div>

    </div>
    </div>
</section>










<script>
$(document).ready(function(){

      
            let f_filt_status = $('#f_filt_status').val();
            let f_filt_limit = $('#f_filt_limit').val();
            let f_filt_supplier = $('#f_filt_supplier').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            $.ajax({
                url:FR_HURL_APII + "/ProductListAPI",
                method:"POST",
                data: {f_filt_status:f_filt_status, f_filter_cat:'', f_filt_supplier:f_filt_supplier, f_filt_limit:f_filt_limit, f_filt_asc_desc:f_filt_asc_desc},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(600);
                }
            });


        $('#f_filt_asc_desc,#f_filt_limit,#f_filt_status,#f_filter_cat,#f_filt_supplier').on('change', function() {
            
           let f_filt_asc_desc = $('#f_filt_asc_desc').val();
           let f_filt_limit = $('#f_filt_limit').val();
           let f_filt_status = $('#f_filt_status').val();
           let f_filter_cat = $('#f_filter_cat').val();
           let f_filt_supplier = $('#f_filt_supplier').val();

            $.ajax({
                url:FR_HURL_APII + "/ProductListAPI",
                method:"POST",
                data: {f_filt_status:f_filt_status, f_filter_cat:f_filter_cat, f_filt_supplier:f_filt_supplier, f_filt_limit:f_filt_limit, f_filt_asc_desc:f_filt_asc_desc},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(600);
                }
            });

            $("#f_search_id").val("");
      });



      $('#f_search_text').keyup(function(){
         var f_search_text = $(this).val();
            if(f_search_text != ""){
                  $.ajax({
                     url:FR_HURL_APII + "/ProductListAPI",
                     method:"POST",
                     data: {f_search_text:f_search_text},
                     success:function(data){
                        // alert(data);
                        $('#FRD_LIST').html(data);
                     }
                  });
            }
            if(f_search_text == ""){ $('#FRD_LIST').html(""); }
      });

      $('#f_search_id').keyup(function(){
         var f_search_id = $(this).val();
            if(f_search_id != ""){
                  $.ajax({
                     url:FR_HURL_APII + "/ProductListAPI",
                     method:"POST",
                     data: {f_search_id:f_search_id},
                     success:function(data){
                        $('#FRD_LIST').html(data);
                     }
                  });
            }
            if(f_search_text == ""){ $('#FRD_LIST').html(""); }
      });


  
});
</script>
   








<?php require_once('frd1_footer.php'); ?>