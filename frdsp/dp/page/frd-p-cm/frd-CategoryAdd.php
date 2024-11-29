<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Category Add"; //PAGE TITLE
$p = "CategoryAdd"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Category Add </h2> -->

<style>
    .catt {
        cursor: pointer;
    }

    .catt:hover {
        color: #FF6E68;
        font-weight: 900;
    }

    .cat_type1 {
        margin-top: 50px;
        font-style: italic;
        font-weight: 900;
    }

    .cat_type2 {
        margin-left: 100px;
    }

    .cat_type3 {
        margin-left: 150px;
    }

    .cat_type4 {
        margin-left: 200px;
    }
</style>

<!-- 1 SCRIPT START -->
<section>
    <?php

    ?>
</section>
<!-- 1 SCRIPT END -->



<link rel="stylesheet" href="<?php echo "$FR_THISHURL" ?>/inc/fr_css/catt_viewing_frd.css">

<!-- Inserting Data -->
<div class="container">
    <?php

    if (isset($_POST['add_new_catt_sub'])) {
        $cat_type = $_POST['f_cat_type'];
        $cat_father = $_POST['f_cat_father'];
        $cat_bn_name = $_POST['f_catt_name_bn'];
        $f_slug_name = $_POST['f_slug_name'];

        if ($f_slug_name == "") {
            ///Custmon slug not set
            $f_slug_name_strtolower = strtolower("$cat_bn_name");
        } else {
            /// Custom Slug Have Set
            $f_slug_name_strtolower = strtolower("$f_slug_name");
        }

        $f_slug_name_mody = preg_replace("/ /", "-", $f_slug_name_strtolower);
        $f_slug_name_mody = preg_replace("/'/", "", $f_slug_name_mody);
        $f_slug_name_mody = preg_replace("/&/", "", $f_slug_name_mody);

                    $arr = [];
                    $arr['bn_name'] = "$cat_bn_name";
                    $arr['slugg'] = "$f_slug_name_mody";
                    $arr['cat_type'] = "$cat_type";
                    $arr['cat_father'] = "$cat_father";
                    $arr['statuss'] = "1";
                    $arr['byy'] = "$UsrId";
                    $arr['timee'] = "$FR_NOW_TIME";
                    $FRR = FR_DATA_IN_2("frd_categoriess",$arr);
                    if($FRR['FRA']==1){
                        $FRc_LastInProId = $FRR['FR_LIID'];
                        FR_SWAL("New Category Add Done! => $cat_bn_name", "", "success");
                    }else{
                        FR_SWAL("New Category Add Failed => $cat_bn_name", "", "error");
                    }
    }


    ?>
</div>





<!-- Catt List S -->
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h4 class='btn btn-primary view_data add_fat_cat' id='0/0/0'><span class="glyphicon glyphicon-plus"></span> Add Father Catt</h4>
        </div>
        <div class="col-md-8 jumbotron">
            <?php

            $q_frd = "SELECT * FROM frd_categoriess WHERE cat_type = 1 AND cat_father = 0 AND statuss = 1 ORDER BY id ASC";
            $FRQ = $FR_CONN->query("$q_frd");
            $rowsnum_frd = $FRQ->rowCount();
            for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                $rowfrd = $FRQ->fetch();
                $catt_id = $rowfrd['id'];
                $catt_name = $rowfrd['en_name'];
                $catt_name_bn = $rowfrd['bn_name'];
                $catt_type = $rowfrd['cat_type'];
                echo "
                <h2 title='#$catt_id' class='catt cat_type1'> 
                $catt_name_bn 
                <button class='btn btn-success btn-xs view_data' id='$catt_id/$catt_type/$catt_name'><b class='glyphicon glyphicon-plus'></b></button>  
                <a href='cm-CategoryEdit?editcat_id=$catt_id'><button class='btn btn-success btn-xs'><b class='glyphicon glyphicon-edit'></b></button></a>
                </h2>
                ";

                ////////// 2 s
                $q_frd2 = "SELECT * FROM frd_categoriess WHERE cat_type = 2 AND cat_father = $catt_id AND statuss = 1";
                $FRQ2 = $FR_CONN->query("$q_frd2");
                $rowsnum_frd2 = $FRQ2->rowCount();
                for ($ii = 1; $ii <= $rowsnum_frd2; $ii++) { //For Loop S
                    $rowfrd2 = $FRQ2->fetch();
                    $catt_id2 = $rowfrd2['id'];
                    $catt_name2 = $rowfrd2['en_name'];
                    $catt_name2_bn = $rowfrd2['bn_name'];
                    $catt_type2 = $rowfrd2['cat_type'];


                    echo "
                    <h3 title='#$catt_id2' class='catt cat_type2'>
                    -- $catt_name2_bn 
                    <button class='btn btn-danger btn-xs view_data' id='$catt_id2/$catt_type2/$catt_name2'><b class='glyphicon glyphicon-plus'></b></button>
                    <a href='cm-CategoryEdit?editcat_id=$catt_id2'><button class='btn btn-danger btn-xs'><b class='glyphicon glyphicon-edit'></b></button></a>
                    </h3>
                    ";

                    ///////// 3 s
                    $q_frd3 = "SELECT * FROM frd_categoriess WHERE cat_type = 3 and cat_father = $catt_id2 AND statuss = 1";
                    $FRQ3 = $FR_CONN->query("$q_frd3");
                    $rowsnum_frd3 = $FRQ3->rowCount();
                    for ($iii = 1; $iii <= $rowsnum_frd3; $iii++) { //For Loop S
                        $rowfrd3 = $FRQ3->fetch();
                        $catt_id3 = $rowfrd3['id'];
                        $catt_name3 = $rowfrd3['en_name'];
                        $catt_name3_bn = $rowfrd3['bn_name'];
                        $catt_type3 = $rowfrd3['cat_type'];

                        echo "
                        <h4 title='#$catt_id3' class='catt cat_type3'>
                        --- $catt_name3_bn
                        <button class='btn btn-info btn-xs view_data' id='$catt_id3/$catt_type3/$catt_name3'><b class='glyphicon glyphicon-plus'></b></button>
                        <a href='cm-CategoryEdit?editcat_id=$catt_id3'><button class='btn btn-info btn-xs'><b class='glyphicon glyphicon-edit'></b></button></a>
                        </h4>
                        ";


                        ///////// 4 s
                        $q_frd4 = "SELECT * FROM frd_categoriess WHERE cat_type = 4 AND cat_father = $catt_id3 AND statuss = 1";
                        $FRQ4 = $FR_CONN->query("$q_frd4");
                        $rowsnum_frd4 = $FRQ4->rowCount();
                        for ($iiii = 1; $iiii <= $rowsnum_frd4; $iiii++) { //For Loop S
                            $rowfrd4 = $FRQ4->fetch();
                            $catt_id4 = $rowfrd4['id'];
                            $catt_name4 = $rowfrd4['en_name'];
                            $catt_name4_bn = $rowfrd4['bn_name'];


                            echo "
                            <h5 title='#$catt_id4' class='catt cat_type4'>
                            ---- $catt_name4_bn
                            <a href='cm-CategoryEdit?editcat_id=$catt_id4'><button class='btn btn-warning btn-xs'><b class='glyphicon glyphicon-edit'></b></button></a>
                            </small>
                            </h5>";
                        } /////// 4 e


                    } /////// 3 e


                } /////////2 e

            } //For Loop E



            ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<!-- Catt List E -->





<!-- Modal FRD -->
<style>
    #model .modal-dialog {
        margin-top: 15% !important;
    }
</style>
<div class="modal fade" id="model" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="data_detail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('.view_data').click(function() {
            var idd = $(this).attr("id");
            //alert(product_id);
            $.ajax({
                url: FR_HURL_APII + "/CatAddForm",
                method: "post",
                data: {
                    idd: idd
                },
                success: function(data) {
                    $('#data_detail').html(data);
                    $('#model').modal("show");
                }
            });

        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        const data = {
            FR_L: "categoryaddx",
        };
            fetch(`${FR_HURL_APII}/sid`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
        }, 10000);
    });
</script>









<?php require_once('frd1_footer.php'); ?>