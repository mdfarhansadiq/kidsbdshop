<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Add Products From XLS";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Add Products From XLS </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 


//FRD FILE UPDATE START:-
if(isset($_FILES['f_XLS_FILE'])){

    require_once($FR_PATH_HD."frd-src/inc/php/SimpleXLSX.php");

    //PR($_FILES['FRD_IMG']);
    //FRD VC NEED:-
        $FR_VC_FILE_EXTENTION = "";
        $FR_VC_FILE_MAX_SIZE = "";
        $FR_VC_FILE_STORE_DONE = "";
         
    //FRD UPLODE IMG CONFIG:-
        $FRc_File_MaxSize_KB = 5000;
        $FRc_File_MaxSize_Dis = "5 MB";
        
        
        $FRc_File_Name = $_FILES['f_XLS_FILE']['name'];
        $FRc_File_Templocalion = $_FILES['f_XLS_FILE']['tmp_name'];
        $FRc_FileSize_Byte = $_FILES['f_XLS_FILE']['size'];//BYTE FORMET
        $FRc_FileSize_KB = round($FRc_FileSize_Byte/1000);//KB FORMET
        //+
        $FRc_File_ExtentionExplor = explode('.',$FRc_File_Name);
        $FRc_File_Extention = strtolower( end($FRc_File_ExtentionExplor) );
        //+ 
        $FRc_File_StoreName = "tmp_file-$FR_NOW_TIME".""."-frd".".$FRc_File_Extention";
        $FRc_File_StoreLocation = "$FR_PATH_HD"."frd-src/temp/$FRc_File_StoreName";

        //FRD_VC______________________________________ IMAGE EXTENTION:-
        if($FRc_File_Extention =='xlsx'){
            $FR_VC_FILE_EXTENTION = 1;
        }else{
            FR_SWAL("Dear $UsrName","You Can Upload Only XLS File","error");
        }

        //FRD_VC______________________________________ IMAGE FILE SIZE:-
        if($FRc_FileSize_KB <= $FRc_File_MaxSize_KB){
            $FR_VC_FILE_MAX_SIZE = 1;
        }else{
            FR_SWAL("Dear $UsrName","Maximum $FRc_File_MaxSize_Dis file you can uplode!","error");
        } 

        //FRD IMAGE STORE START :--
            if($FR_VC_FILE_EXTENTION == 1 AND $FR_VC_FILE_MAX_SIZE == 1){
                //FRD IMG MOVING:-
                    if( move_uploaded_file($FRc_File_Templocalion,$FRc_File_StoreLocation) == 1){
                        $FR_VC_FILE_STORE_DONE = 1;
                    }else{
                      FR_SWAL("ERROR","File Store Failed","error");
                    }
            }
        //END>>>



        



}
//END>>


if(isset($FR_VC_FILE_STORE_DONE)){
    if ( $xlsx = SimpleXLSX::parse("$FRc_File_StoreLocation") ) {
        // echo "<pre>"; print_r( $FRc_XLSXdataARR ); echo "</pre>";
        $header_values = $rows = [];
        foreach (  $xlsx->rows() AS $k => $r ) {
            if ( $k === 0 ) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine( $header_values, $r );
        }

        //FRD_VC______________________________:-
        if (empty($rows)) {
            FR_SWAL("Dear Boss $UsrName File is empty","","error"); FR_GO("$FR_THIS_PAGE",2); exit;
        }
    
        //FRD_VC___________________________________________:-
        extract($rows[0]);
        if(!isset($ProductTitle)){ FR_SWAL("FILE NOT VALID","ProductTitle","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($MarketPrice)){ FR_SWAL("FILE NOT VALID","MarketPrice","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($DiscountAmount)){ FR_SWAL("FILE NOT VALID","DiscountAmount","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($SalesPrice)){ FR_SWAL("FILE NOT VALID","SalesPrice","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($SKU)){ FR_SWAL("FILE NOT VALID","SKU","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($LongDescription)){ FR_SWAL("FILE NOT VALID","LongDescription","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($ShortDescription)){ FR_SWAL("FILE NOT VALID","ShortDescription","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($DeliveryChargeType)){ FR_SWAL("FILE NOT VALID","DeliveryChargeType","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($GoogleCategoryId)){ FR_SWAL("FILE NOT VALID","GoogleCategoryId","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($MainCategoryId)){ FR_SWAL("FILE NOT VALID","MainCategoryId","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($CategoryId2)){ FR_SWAL("FILE NOT VALID","CategoryId2","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($CategoryId3)){ FR_SWAL("FILE NOT VALID","CategoryId3","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($CategoryId4)){ FR_SWAL("FILE NOT VALID","CategoryId4","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($BrandId)){ FR_SWAL("FILE NOT VALID","BrandId","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($ColorId)){ FR_SWAL("FILE NOT VALID","ColorId","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($YouTubeVideoId)){ FR_SWAL("FILE NOT VALID","YouTubeVideoId","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        if(!isset($MainPicUrl)){ FR_SWAL("FILE NOT VALID","MainPicUrl","error"); FR_GO("$FR_THIS_PAGE",2); exit; }
        


        //FOREACH LOOP START:-
            $FRc_SL = 1;
            foreach($rows as $data){
                extract($data);
                $ProductTitle = preg_replace("/'/","",$ProductTitle);

                $SalesPrice = ($MarketPrice - $DiscountAmount);
                if ($SalesPrice < 0) {
                    FR_SWAL("Sells Amount Not Valid", "", "error");
                    FR_GO("$FR_THIS_PAGE", 2);
                    exit;
                }
                $DiscountPercent = ($DiscountAmount / $MarketPrice * 100);

                $FRc_Slug = preg_replace("/ /", "-", $ProductTitle);
                $FRc_Slug = preg_replace("/%/", "-", $FRc_Slug);
                $FRc_Slug = strtolower("$FRc_Slug");

                $FRc_ProductTags = preg_replace("/ /", ",", $ProductTitle);
                $FRc_ProductQty = 99999;
                $r_writer  = 0;
                $statuss  = 1;
                $deli_crg_typ = 1;//[1=FROM SHIPPING ZONE]


                if($LongDescription == ""){ $LongDescription = "$ProductTitle";}
                if($ShortDescription == ""){ $ShortDescription = "$ProductTitle";}

                if($DeliveryChargeType == "free"){ $DeliveryChargeType = 2;}else{$DeliveryChargeType = 1;}

                if($MainCategoryId == ""){ $MainCategoryId = 0;}
                if($CategoryId2 == ""){ $CategoryId2 = 0;}
                if($CategoryId3 == ""){ $CategoryId3 = 0;}
                if($CategoryId4 == ""){ $CategoryId4 = 0;}
                if($ColorId == ""){ $ColorId = 1;}
                if($BrandId == ""){ $BrandId = 1;}
                


                //FRD_INSERT_DATA_START:-
                    try{
                        // $ARR = ["bn_name","market_pri","discount_pri","dis_persent","sells_pri"];
                        $ARR = ["bn_name","market_pri","discount_pri","dis_persent","sells_pri","skuu","fr_slug","fr_meta_title","fr_meta_desc","detailess","fr_short_desc","deli_crg_typ","tagg","qtyy","g_cat_id","r_cat_1","r_cat_2","r_cat_3","r_cat_4","r_writer","r_brand","r_color","videoo","pic_1_temp","statuss","byy","datee","timee"];
                        $FRc_Columns = implode(", ", array_values($ARR));
                        $FRc_ValuesBind = implode(", :", array_values($ARR));
                        $FRQ = "INSERT INTO frd_products ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
                        $FRQ = $FR_CONN->prepare("$FRQ");
                        $FRQ->bindParam(':bn_name', $ProductTitle, PDO::PARAM_STR);
                        $FRQ->bindParam(':market_pri', $MarketPrice, PDO::PARAM_STR);
                        $FRQ->bindParam(':discount_pri', $DiscountAmount, PDO::PARAM_STR);
                        $FRQ->bindParam(':dis_persent', $DiscountPercent, PDO::PARAM_STR);
                        $FRQ->bindParam(':sells_pri', $SalesPrice, PDO::PARAM_INT);
                        $FRQ->bindParam(':skuu', $SKU, PDO::PARAM_STR);
                        $FRQ->bindParam(':fr_slug', $FRc_Slug, PDO::PARAM_STR);
                        $FRQ->bindParam(':fr_meta_title', $ProductTitle, PDO::PARAM_STR);
                        $FRQ->bindParam(':fr_meta_desc', $ProductTitle, PDO::PARAM_STR);
                        $FRQ->bindParam(':detailess', $LongDescription, PDO::PARAM_STR);
                        $FRQ->bindParam(':fr_short_desc', $ShortDescription, PDO::PARAM_STR);
                        $FRQ->bindParam(':deli_crg_typ', $DeliveryChargeType, PDO::PARAM_STR);
                        $FRQ->bindParam(':tagg', $FRc_ProductTags, PDO::PARAM_STR);
                        $FRQ->bindParam(':qtyy', $FRc_ProductQty, PDO::PARAM_INT);
                        $FRQ->bindParam(':g_cat_id', $GoogleCategoryId, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_cat_1', $MainCategoryId, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_cat_2', $CategoryId2, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_cat_3', $CategoryId3, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_cat_4', $CategoryId4, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_writer', $r_writer, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_brand', $BrandId, PDO::PARAM_INT);
                        $FRQ->bindParam(':r_color', $ColorId, PDO::PARAM_INT);
                        $FRQ->bindParam(':videoo', $YouTubeVideoId, PDO::PARAM_STR);
                        $FRQ->bindParam(':pic_1_temp', $MainPicUrl, PDO::PARAM_STR);
                        $FRQ->bindParam(':statuss', $statuss, PDO::PARAM_INT);
                        $FRQ->bindParam(':byy', $UsrId, PDO::PARAM_INT);
                        $FRQ->bindParam(':datee', $FR_NOW_DATE, PDO::PARAM_STR);
                        $FRQ->bindParam(':timee', $FR_NOW_TIME, PDO::PARAM_INT);
                        $FRQ->execute();
                        $FR_LAST_IN_ID = $FR_CONN->lastInsertId();
                        ECHO_4("SL:$FRc_SL => New Product Added #$FR_LAST_IN_ID => $ProductTitle","text-success h6");
                    }catch(PDOException $e){
                        FR_SWAL("Dear Boss $UsrName","ERROR: Data Insert Failed","error");
                        echo "<h2> DATA INSERT DONE ERROR MESSAGE:" . $e->getMessage() . "</h2>";
                    }
                //END>>
            
                $FRc_SL = ($FRc_SL + 1); 
            }
        //FOREACH LOOP END>>


        
    } else {
        echo SimpleXLSX::parseError();
    }
}







?>   
</section>
<!-- 1 SCRIPT END -->    





  
<?php if(!isset($_FILES['f_XLS_FILE'])){ ?>
<section>
    <div class="container">
    <div class="col-md-11">

      
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 jumbotron">
                <form id='' action='' method='post' enctype='multipart/form-data'>
                    <small>Uplode XLS File *</small>
                    <input class="form-control" type="file" name="f_XLS_FILE" required>
                    <br>
                    <div class='text-right'>
                        <button class='btn btn-success' type='submit'> <span class='glyphicon glyphicon-save'></span> Confirm & Add Product </button>
                    </div>
                </form>
        </div>
        <div class="col-md-3"></div>
      </div>
       

    </div>
    </div>
</section>
<?php } ?>






<?php require_once('frd1_footer.php'); ?>   