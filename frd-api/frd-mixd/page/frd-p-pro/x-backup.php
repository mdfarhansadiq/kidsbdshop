<?php
if($FR_VC_COLUMN_SERIAL == 1){
    $FRc_SL = 1;
    //FOREACH LOOP START:-
    foreach($FRc_XLSXdataARR as $FRITEM) {
        if($FRc_SL > 1){
            $ProductTitle = $FRITEM[0];
            $MarketPrice = $FRITEM[1];
            $DiscountAmount = $FRITEM[2];
            $SalesPrice = $FRITEM[3];
            $GoogleCategoryId = $FRITEM[4];
            $MainCategoryId = $FRITEM[5];
            $CategoryId2 = $FRITEM[6];
            $CategoryId3 = $FRITEM[7];
            $CategoryId4 = $FRITEM[8];
            $BrandId = $FRITEM[9];
            $ColorId = $FRITEM[10];
            $YouTubeVideoId = $FRITEM[11];

            $ProductTitle = preg_replace("/'/","",$ProductTitle);

            $DiscountPercent = ($DiscountAmount / $MarketPrice * 100);

            $FRc_Slug = preg_replace("/ /", "-", $ProductTitle);
            $FRc_Slug = preg_replace("/%/", "-", $FRc_Slug);
            $FRc_Slug = strtolower("$FRc_Slug");

            $FRc_ProductTags = preg_replace("/ /", ",", $ProductTitle);

            $FRc_ProductQty = 99999;

            $r_writer  = 0;
            $statuss  = 1;
            $deli_crg_typ = 1;//[1=FROM SHIPPING ZONE]

            if($ColorId == ""){ $ColorId = 1;}


                //FRD_INSERT_DATA_START:-
                    try{
                        $ARR = ["bn_name","market_pri","discount_pri","dis_persent","sells_pri"];
                        // $ARR = ["bn_name","market_pri","discount_pri","sells_pri","fr_slug","fr_meta_title","fr_meta_desc","detailess","tagg","qtyy","g_cat_id","r_cat_1","r_cat_2","r_cat_3","r_cat_4","r_writer","r_brand","r_color","videoo","statuss","deli_crg_typ","byy","datee","timee"];
                        $FRc_Columns = implode(", ", array_values($ARR));
                        $FRc_ValuesBind = implode(", :", array_values($ARR));
                        $FRQ = "INSERT INTO frd_products ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
                        $FRQ = $FR_CONN->prepare("$FRQ");
                        $FRQ->bindParam(':bn_name', $ProductTitle, PDO::PARAM_STR);
                        $FRQ->bindParam(':market_pri', $MarketPrice, PDO::PARAM_STR);
                        $FRQ->bindParam(':discount_pri', $DiscountAmount, PDO::PARAM_STR);
                        $FRQ->bindParam(':dis_persent', $DiscountPercent, PDO::PARAM_STR);
                        $FRQ->bindParam(':sells_pri', $SalesPrice, PDO::PARAM_INT);
                        // $FRQ->bindParam(':fr_slug', $FRc_Slug, PDO::PARAM_STR);
                        // $FRQ->bindParam(':fr_meta_title', $ProductTitle, PDO::PARAM_STR);
                        // $FRQ->bindParam(':fr_meta_desc', $ProductTitle, PDO::PARAM_STR);
                        // $FRQ->bindParam(':detailess', $ProductTitle, PDO::PARAM_STR);
                        // $FRQ->bindParam(':tagg', $FRc_ProductTags, PDO::PARAM_STR);
                        // $FRQ->bindParam(':qtyy', $FRc_ProductQty, PDO::PARAM_INT);
                        // $FRQ->bindParam(':g_cat_id', $GoogleCategoryId, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_cat_1', $MainCategoryId, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_cat_2', $CategoryId2, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_cat_3', $CategoryId3, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_cat_4', $CategoryId4, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_writer', $r_writer, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_brand', $BrandId, PDO::PARAM_INT);
                        // $FRQ->bindParam(':r_color', $ColorId, PDO::PARAM_INT);
                        // $FRQ->bindParam(':videoo', $YouTubeVideoId, PDO::PARAM_STR);
                        // $FRQ->bindParam(':statuss', $statuss, PDO::PARAM_INT);
                        // $FRQ->bindParam(':deli_crg_typ', $deli_crg_typ, PDO::PARAM_INT);
                        // $FRQ->bindParam(':byy', $UsrId, PDO::PARAM_INT);
                        // $FRQ->bindParam(':datee', $FR_NOW_DATE, PDO::PARAM_STR);
                        // $FRQ->bindParam(':timee', $FR_NOW_TIME, PDO::PARAM_INT);
                        $FRQ->execute();
                        $FR_LAST_IN_ID = $FR_CONN->lastInsertId();
                        ECHO_4("SL:$FRc_SL => New Product Added #$FR_LAST_IN_ID => $ProductTitle","text-success h6");
                    }catch(PDOException $e){
                        FR_SWAL("Dear Boss $UsrName","ERROR: Data Insert Failed","error");
                        echo "<h2> DATA INSERT DONE ERROR MESSAGE:" . $e->getMessage() . "</h2>";
                    }
                //END>>
        }
        $FRc_SL = ($FRc_SL + 1); 
    }//FOREACH LOOP END>>
}
















if(isset($FR_VC_FILE_STORE_DONE)){
    if ( $xlsx = SimpleXLSX::parse("$FRc_File_StoreLocation") ) {
        $FRc_XLSXdataARR = $xlsx->rows();
          echo "<pre>"; print_r( $FRc_XLSXdataARR ); echo "</pre>";

        $FR_VC_COLUMN_SERIAL = "";

        $FRc_Col_A = $FRc_XLSXdataARR[0][0];
        $FRc_Col_B = $FRc_XLSXdataARR[0][1];
        $FRc_Col_C = $FRc_XLSXdataARR[0][2];
        $FRc_Col_D = $FRc_XLSXdataARR[0][3];
        $FRc_Col_E = $FRc_XLSXdataARR[0][4];
        $FRc_Col_F = $FRc_XLSXdataARR[0][5];
        $FRc_Col_G = $FRc_XLSXdataARR[0][6];
        $FRc_Col_H = $FRc_XLSXdataARR[0][7];
        $FRc_Col_I = $FRc_XLSXdataARR[0][8];
        $FRc_Col_J = $FRc_XLSXdataARR[0][9];
        $FRc_Col_K = $FRc_XLSXdataARR[0][10];
        $FRc_Col_L = $FRc_XLSXdataARR[0][11];

        //FRD_VC_____________________________;-
        if($FRc_Col_A == "ProductTitle" AND 
        $FRc_Col_B == "MarketPrice" AND 
        $FRc_Col_C == "DiscountAmount" AND 
        $FRc_Col_D == "SalesPrice" AND 
        $FRc_Col_E == "GoogleCategoryId" AND 
        $FRc_Col_F == "MainCategoryId" AND 
        $FRc_Col_G == "CategoryId2" AND 
        $FRc_Col_H == "CategoryId3" AND 
        $FRc_Col_I == "CategoryId4" AND 
        $FRc_Col_J == "BrandId" AND 
        $FRc_Col_K == "ColorId" AND 
        $FRc_Col_L == "YouTubeVideoId"
        ){ $FR_VC_COLUMN_SERIAL = 1; }else{
            FR_SWAL("ERROR","Column Serial Not Valid","error");
        }


        if($FR_VC_COLUMN_SERIAL == 1){

            $header_values = $rows = [];
            foreach ( $FRc_XLSXdataARR AS $k => $r ) {
                if ( $k === 0 ) {
                    $header_values = $r;
                    continue;
                }
                $rows[] = array_combine( $header_values, $r );
            }
            PR( $rows );
            
        }
        
    } else {
        echo SimpleXLSX::parseError();
    }
}

?>