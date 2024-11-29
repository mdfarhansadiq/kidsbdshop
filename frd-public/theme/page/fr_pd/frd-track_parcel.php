<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Tracking Parcel - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FR_THISPAGE'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cmetatag'>
<meta name='author' content='$fr_cname'> 
<meta name='publisher' content='$fr_cname'>
<meta name='copyright' content='$fr_cname'>
<meta name='description' content='$fr_cmetades'>
<meta name='page-topic' content='Ecommerce'>
<meta name='page-type' content='Product'>
<meta name='audience' content='Everyone'>
<meta name='robots' content='index'>
";
require_once("frd-public/theme/frd-header.php");
?>
<!-- <h2 class="PT"> পার্সেল ট্রাকিং </h2> -->
<style>
    body{
        background: #FFF !important;
    }
</style>
<!-- 1 scripts s-->
<section>
<?php 

//FRD_VC___________________________VALIDATION CHACKING:-
     if(!isset($url[1])){FR_GO("$FRD_HURL/?hnks=gfyrf75rnf8cx");}

//FRD:-
   $FRc_OrderEncriptIdx = $url[1];

//FRD DELIVERY ZONE TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pd_orders WHERE fr_encrip_id = '$FRc_OrderEncriptIdx'", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        //   PR($FRR);
        FR_SWAL("NO DATA FOUND");
        FR_GO("$FR_THISPAGE");
        exit;
    }



//FRD THIS PAGE OVERWRITE:-
    $FR_THIS_PAGE = "$FR_THISPAGE/$FRc_OrderEncriptIdx";


//FRD ORDER TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pd_orders WHERE fr_encrip_id = '$FRc_OrderEncriptIdx'","");
    if($FRR['FRA']==1){ 
      extract($FRR['FRD']);
      $FRc_OrderIdx1 = $id;
    }else{ 
        // ECHO_4($FRR['FRM']);
        FR_GO("$FR_THISHURL/home?hinks=46yhbgdhgx"); exit;
     }
//++
//++
//++
//FRD DELIVERY ZONE TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pd_deli_zone WHERE id = $fr_deli_zone_id", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        //   PR($FRR);
        FR_SWAL("NO DATA FOUND");
        FR_GO("$FR_THISPAGE");
        exit;
    }



//FRD 
    if($fr_stat == 0){ $fr_stat_M = "নতুন পার্সেল বুকিং"; $FR_cc1 = "label-primary"; }
    if($fr_stat == 1){ $fr_stat_M = "পার্সেল পিকাপ এর জন্য  কনফার্ম হয়েছে"; $FR_cc1 = "label-success"; }
    if($fr_stat == 2){ $fr_stat_M = "পার্সেল পিকআপ সম্পন্ন হয়েছে"; $FR_cc1 = "label-danger"; }
    if($fr_stat == 3){ $fr_stat_M = "পার্সেল ডেলিভারি সফল হয়েছে"; $FR_cc1 = "label-success"; }
    if($fr_stat == 4){ $fr_stat_M = "বাতিল হয়েছে"; $FR_cc1 = "label-danger"; }
    if($fr_stat == 5){ $fr_stat_M = "পার্সেল ডেলিভারি ব্যর্থ হয়েছে"; $FR_cc1 = "label-danger"; }
    if($fr_stat == 6){ $fr_stat_M = "পার্সেল প্রেরককে ফেরত দেওয়া হয়েছে"; $FR_cc1 = "label-danger"; }







?>
</section>
<!-- 1 scripts e-->
   



<section class="section">
    <div class="container">
        <div class="col-md-12">



        <div class="row justify-content-center">

            <div class="col-md-3"></div>
            <div class="col-md-6">
            <div class="jumbotron text-center">
            <div class="card-body pt-3">
                    <div class="text-center mb-2">
                            <h4 class="text-danger"> <b>ট্রাকিং পার্সেল আইডি:</b>  <?php echo "#$FRc_OrderIdx1";?></h4>
                            <?php echo "<b>বুকিং সময়:</b>  ".date('Y-m-d h:i A',$fr_ord_time)." <br>"; ?>
                            <?php echo "<span class='label $FR_cc1'> $fr_stat_M </span> <br>"; ?>
                        </div>


                     
                    <?php
                     if(isset($_SESSION['sUsrId'])){
                         echo "<br>";
                         echo "<a href='$FRD_HURL/frdsp/dp/parcel-OrderEdit/$fr_encrip_id/$FRc_OrderIdx1/$fr_ord_time' class='fs-4 h3 text-center d-block'><i class='glyphicon glyphicon-edit'></i></a>";
                     }
                    ?>

            </div>
            </div>




                         <div class="row">
                              <div class="col-md-12 jumbotron">
                                  <div class="card">
                                      <div class="card-body">
                                          <h6 class="card-title text-center text-danger"> পার্সেল  প্রসেসিং টাইম লাইন </h6>

                                          <div id="content">

                                              <ul class="timeline">
                                                <?php
                                                  $FRc_fr_pd_history_ARR = explode(",",$fr_pd_history);
                                                  $FRc_fr_pd_history_ARR_REV = array_reverse($FRc_fr_pd_history_ARR);

                                                  foreach($FRc_fr_pd_history_ARR_REV AS $FR_ITEM){

                                                        if($FR_ITEM != ""){
                                                            $FR_ITEM_ARR = explode("*",$FR_ITEM);
                                                            echo "
                                                            <li class='event' data-date='$FR_ITEM_ARR[1]'>
                                                                <h1>$FR_ITEM_ARR[0]</h1>
                                                                <p></p>
                                                            </li>
                                                            ";
                                                        }

                                                  }
                                                ?>
                                              </ul>

                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>


        

                <div class="card">  
                    <div class="card-body">
                        <?php
                        echo "
                            <table class='table table-bordered alert alert-success mt-5'>
                                <tr class='text-center'>
                                    <td colspan='2'> <i class='glyphicon glyphicon-flash'></i> প্রেরকের তথ্য <i class='bi bi-pen-fill frtrig_EditCustomer' frid='$id'></i> </td>
                                </tr>

                                <tr>
                                    <td>নাম</td>
                                    <td>$fr_s_name</td>
                                </tr> 
                                <tr>
                                    <td>মোবাইল নাম্বার</td>
                                    <td> <a href='tel:$fr_s_mobile'><i class='bi bi-telephone-outbound-fill'></i> $fr_s_mobile </a> </td>
                                </tr> 
                                <tr>
                                    <td>পার্সেল পিকআপ ঠিকানা</td>
                                    <td>$fr_s_pickup_address</td>
                                </tr> 
                            </table>
                        ";
                        ?>
                    </div>
                </div>



                <div class="card">  
                    <div class="card-body">
                        <?php
                        echo "
                            <table class='table table-bordered alert alert-danger mt-5'>
                                <tr class='text-center'>
                                    <td colspan='2'> <i class='glyphicon glyphicon-flash'></i> প্রাপকের তথ্য <i class='bi bi-pen-fill frtrig_EditCustomer' frid='$id'></i> </td>
                                </tr>

                                <tr>
                                    <td>নাম</td>
                                    <td>$fr_r_name</td>
                                </tr> 
                                <tr>
                                    <td>মোবাইল নাম্বার</td>
                                    <td> <a href='tel:$fr_r_mobile'><i class='bi bi-telephone-outbound-fill'></i> $fr_r_mobile </a> </td>
                                </tr> 
                                <tr>
                                    <td>ডেলিভারি ঠিকানা</td>
                                    <td>$fr_r_address</td>
                                </tr> 
                            </table>
                        ";
                        ?>
                    </div>
                </div>


                <div class="card">  
                    <div class="card-body">
                        <?php
                        echo "
                            <table class='table table-bordered alert alert-info mt-5'>
                                <tr class='text-center'>
                                    <td colspan='2'> <i class='glyphicon glyphicon-flash'></i> অন্যান্য তথ্য <i class='bi bi-pen-fill frtrig_EditCustomer' frid='$id'></i> </td>
                                </tr>
                                <tr>
                                    <td>কালেকশন অ্যামাউন্ট</td>
                                    <td>$fr_collection_amount টাকা</td>
                                </tr> 
                                <tr>
                                    <td>পার্সেল এর ওজন</td>
                                    <td>$fr_p_weight</td>
                                </tr> 
                                <tr>
                                    <td>ডেলিভারি চার্জ</td>
                                    <td>$fr_pd_charge টাকা</td>
                                </tr> 
                                <tr>
                                    <td>ডেলিভারি জোন</td>
                                    <td>$fr_zone_name</td>
                                </tr> 
                            </table>
                        ";
                        ?>
                    </div>
                </div>




                          






            </div>
            <div class="col-md-3"></div>
        </div>


        </div>
    </div>
    </section>






<?php require_once("frd-public/theme/frd-footer.php");?>