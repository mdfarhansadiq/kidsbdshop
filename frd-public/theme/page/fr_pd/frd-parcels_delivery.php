<?php 
ob_start();
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Parcels Delivery - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");
?>
<h2 class="PT"> পার্সেল ডেলিভারি বুকিং </h2>
<style>
    body{
        background: #FFF !important;
    }
    .parcel_deli_link_2{
        display: none;
    }
</style>
<!-- 1 scripts s-->
<section>
<?php 
//FRD_VC___________________________________________________
    if(!isset($_SESSION['s_cust_id'])){
         FR_SWAL("পার্সেল ডেলিভারি বুকিং এর জন্য প্রথমে লগইন করুন","","info");
         setcookie("fr_percel_deli_login", "abc", time() + (60 * 5), "/");//Set Cooki
         FR_GO("$FRD_HURL/login?next_destination=$FRD_HURL/parcels_delivery",3);
         exit;
    }


$FRc_UserId = $_SESSION['s_cust_id'];



//FRD USER TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE id = $FRc_UserId AND typee =  'cu'", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        //   PR($FRR);
        FR_SWAL("NO DATA FOUND");
        FR_GO("$FRD_HURL/?hinks=hdyr7rjv9cccx");
        exit;
    }


//FRD DELIVERY ZONE TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pd_deli_zone WHERE id = 1", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        //   PR($FRR);
        FR_SWAL("NO DATA FOUND");
        FR_GO("$FR_THISPAGE");
        exit;
    }



//FRD FRD PAGE TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE page_url = 'parcel-booking-terms-and-conditions' AND statuss = 1", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        //   PR($FRR);
        FR_SWAL("NO DATA FOUND");
        FR_GO("$FRD_HURL/?hinks=hdnhduum,dkeieijx");
        exit;
    }



//---------------------------------------------------------------------------------
//FRD ADDDING MEW PERCEL DELIVERY ORDERS:-
//---------------------------------------------------------------------------------
    if(isset($_POST['frf_sender_name'])){

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
            if(isset($frf_sender_name)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); goto THIS_LAST; }
    
        //FRD_VC___________ALL REQUIRED FILED:-
            if($frf_sender_name != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); goto THIS_LAST; }


        //FRD CUSTOM VALUE MAKING:-
            $FRc_EncriptId = uniqid();

            $frf_parcel_weight = explode('+',$frf_parcel_weight); 
            $FRc_parcel_weight = $frf_parcel_weight[0];
            $FRc_parcel_delivery_charge = $frf_parcel_weight[1];

            $FRc_OrderProsHistory = "পার্সেলটি পিকআপ এর জন্য মার্চেন্ট অনুরোধ করেছেন * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";

            if($frf_collection_amount == ""){$frf_collection_amount = 0;}

            $frf_deli_zone_id = 1; //temp
    
    

                    if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){
    
                        $arr = array();
                        $arr['fr_encrip_id'] = "$FRc_EncriptId";

                        $arr['fr_s_id'] = $FRc_UserId;
                        $arr['fr_s_name'] = "$frf_sender_name";
                        $arr['fr_s_mobile'] = "$email1";
                        $arr['fr_s_pickup_address'] = "$frf_pickup_address";

                        $arr['fr_r_name'] = "$frf_reciver_name";
                        $arr['fr_r_mobile'] = "$frf_reciver_mobile";
                        $arr['fr_r_address'] = "$frf_delivery_address";
                        $arr['fr_deli_zone_id'] = $frf_deli_zone_id;

                        $arr['fr_p_weight'] = "$FRc_parcel_weight";
                        $arr['fr_pd_charge'] = "$FRc_parcel_delivery_charge";
                        
                        $arr['fr_collection_amount'] = "$frf_collection_amount";

                
                        $arr['fr_ord_date'] = "$FR_NOW_DATE";
                        $arr['fr_ord_time'] = "$FR_NOW_TIME";

                        $arr['fr_stat'] = 0;
                        $arr['fr_pd_history'] = "$FRc_OrderProsHistory";

                        $FRR = FR_DATA_IN("frd_pd_orders",$arr);
                        if($FRR['FRA']==1){
                            $FRc_LastInId = $FRR['FR_LIID'];
                            FR_SWAL("$frf_sender_name আপনার পার্সেল বুকিং সম্পন্ন হয়েছে ","","success");



                                //FRD SENDER PROFILE INFO AUTO UPDATE:-
                                    $FRQ = "UPDATE frd_usr SET 
                                    namee = '$frf_sender_name',
                                    addresss = '$frf_pickup_address',
                                    psw_rc = '$FR_NOW_TIME'
                                    WHERE id = $FRc_UserId";
                                    $R = FR_DATA_UP("$FRQ");
                                    //PR($R);
                                    if($R['FRA']==1){
                                        // FR_SWAL(" কাস্টমারের তথ্য আপডেট হয়েছে ","","success");
                                    }else{
                                        FR_SWAL("কাস্টমারের তথ্য আপডেট হয়নি ","","error");
                                        FR_GO("$FR_THISPAGE","3");
                                        exit;
                                    }
                                //END>>
                                

                            //FRD CALLING -> ORDER CONFARMATION SMS SEND  API:-
                                    $url = "$FR_HURL_API/PD_OrderThankYouSMS";
                                    $data = [
                                    "fr_order_id"=> "$FRc_LastInId"
                                    ];
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                    $FR_cRESPOND = curl_exec($ch);//JSON RECEIVED
                                    curl_close($ch);
                                    $FRR = json_decode($FR_cRESPOND,true);
                                    if($FRR['FRA'] == 1){
                                    // FR_AL($FRR['FRM']);
                                       echo "<h4 class='g TAC'>".$FRR['FRM']."</h4>";
                                    }else{
                                    // FR_AL($FRR['FRM']);
                                       echo "<h4 class='r TAC'>".$FRR['FRM']."</h4>";
                                    }
                            //END>>


                            FR_GO("$FRD_HURL/track_parcel/$FRc_EncriptId",2);
                            exit;

                        }else{
                            FR_SWAL("অর্ডার করার ব্যর্থ হয়েছে",$R['FRM'],"error");
                        }
                    }
                            
    }
    THIS_LAST:
    //END PRODUCT ADD>>



    
?>
</section>
<!-- 1 scripts e-->
   



<section>
    <div class="container">

            <div class="row">
                <div class="col-md-12 text-right">
                    <h3><a href="<?php echo "$FRD_HURL/my_parcels";?>" class="btn btn-success"> আপনার পার্সেল বুকিং রিপোর্ট দেখুন </a></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 jumbotron">
                    <form id="" action="" method="post">

                        <div class="alert alert-success">
                            <div class="text-center ">
                                <span class="label label-success"> প্রেরকের তথ্য </span><br>
                            </div>
                            <span> প্রেরকের নাম *</span>
                            <input class="form-control" type="text" placeholder="লিখুন" name="frf_sender_name" value="<?php echo "$namee";?>"  required>

                            <br>
                            <span> প্রেরকের মোবাইল নাম্বার *</span>
                            <input class="form-control" type="text" placeholder="লিখুন" name="frf_sender_mobile" value="<?php echo "$email1";?>" required disabled>

                            <br>
                            <span> পার্সেল পিকআপ ঠিকানা *</span>
                            <textarea class="form-control" name="frf_pickup_address" id="" rows="3" placeholder="লিখুন" required><?php echo "$addresss";?></textarea>
                        </div>




                        <br><br>
                        <div class="alert alert-danger">
                            <div class="text-center ">
                                <span class="label label-danger">প্রাপকের তথ্য</span><br>
                            </div>
                            <span>প্রাপকের নাম *</span>
                            <input class="form-control" type="text" placeholder="লিখুন" name="frf_reciver_name" required>

                            <br>
                            <span> প্রাপকের মোবাইল নাম্বার *</span>
                            <input class="form-control" type="text" placeholder="লিখুন" name="frf_reciver_mobile" required>

                            <br>
                            <span> পার্সেল ডেলিভারি ঠিকানা *</span>
                            <textarea class="form-control" name="frf_delivery_address" id="" rows="3" placeholder="লিখুন" required></textarea>
                        </div>


                        <br><br>
                        <div class="alert alert-info">
                            <div class="text-center ">
                                <span class="label label-info">অন্যান্য তথ্য</span><br>
                            </div>
                            <span> পার্সেল এর ওজন নির্বাচন করুন *</span>
                            <select name="frf_parcel_weight" class="form-control" id="" required>
                                <option value="">ওজন নির্বাচন করুন</option>
                                <?php
                                if($fr_w_1_name != ""){ echo "<option value='$fr_w_1_name + $fr_w_1_charge'>$fr_w_1_name => ডেলিভারি চার্জ $fr_w_1_charge ৳ </option>";}
                                if($fr_w_2_name != ""){ echo "<option value='$fr_w_2_name + $fr_w_2_charge'>$fr_w_2_name => ডেলিভারি চার্জ $fr_w_2_charge ৳ </option>";}
                                if($fr_w_3_name != ""){ echo "<option value='$fr_w_3_name + $fr_w_3_charge'>$fr_w_3_name => ডেলিভারি চার্জ $fr_w_3_charge ৳ </option>";}
                                if($fr_w_4_name != ""){ echo "<option value='$fr_w_4_name + $fr_w_4_charge'>$fr_w_4_name => ডেলিভারি চার্জ $fr_w_4_charge ৳ </option>";}
                                if($fr_w_5_name != ""){ echo "<option value='$fr_w_5_name + $fr_w_5_charge'>$fr_w_5_name => ডেলিভারি চার্জ $fr_w_5_charge ৳ </option>";}
                                if($fr_w_6_name != ""){ echo "<option value='$fr_w_6_name + $fr_w_6_charge'>$fr_w_6_name => ডেলিভারি চার্জ $fr_w_6_charge ৳ </option>";}
                                if($fr_w_7_name != ""){ echo "<option value='$fr_w_7_name + $fr_w_7_charge'>$fr_w_7_name => ডেলিভারি চার্জ $fr_w_7_charge ৳ </option>";}
                                if($fr_w_8_name != ""){ echo "<option value='$fr_w_8_name + $fr_w_8_charge'>$fr_w_8_name => ডেলিভারি চার্জ $fr_w_8_charge ৳ </option>";}
                                if($fr_w_9_name != ""){ echo "<option value='$fr_w_9_name + $fr_w_9_charge'>$fr_w_9_name => ডেলিভারি চার্জ $fr_w_9_charge ৳ </option>";}
                                ?>
                            </select>

                            <br>
                            <span> কালেকশন অ্যামাউন্ট <i><small>(ঐচ্ছিক)</small></i> <br><small>(প্রাপক এর নিকট থেকে যত টাকা গ্রহণ করতে হবে)</small></span>
                            <input class="form-control" type="text" placeholder="লিখুন" name="frf_collection_amount">
                        </div>


                        <input type="checkbox" required> <?php echo "$page_body_en";?>
                         
                    

                        <br>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-send"></span> নিশ্চিত</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>



    </div>
</section>



<!-- <section>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 jumbotron">
                
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section> -->





<?php require_once("frd-public/theme/frd-footer.php"); ob_end_flush(); ?>