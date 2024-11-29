<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "All Categories List - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FR_THISPAGE'>
<meta property='og:type' content='website'>
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
<!-- <h2 class="PT animated fadeInLeft"> ক্যাটাগরি লিস্ট সাইটম্যাপ   </h2> -->
<!-- 1 scripts s-->
<section>
<?php

?>    
</section>
<!-- 1 scripts e-->
   

<br>
<!-- Catt List S -->
<div class="container">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6 jumbotron catlistdiv">
            <?php
            $q_frd = "SELECT * FROM frd_categoriess WHERE cat_type = 1 AND cat_father = 0 AND statuss = 1 ORDER BY id ASC";
            $FRQ = $FR_CONN->query("$q_frd");
            $rowsnum_frd = $FRQ->rowCount();
            for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                $rowfrd = $FRQ->fetch();
                $catt_id = $rowfrd['id'];
                $catt_slug = $rowfrd['slugg'];
                $catt_name = $rowfrd['en_name'];
                $catt_name_bn = $rowfrd['bn_name'];
                $catt_type = $rowfrd['cat_type'];
                echo "
                <h2 title='#$catt_id' class='catt cat_type1'>
                 <a href='$FRD_HURL/category/$catt_slug'> $catt_name_bn </a> 
                </h2>
                ";

                ////////// 2 s
                $q_frd2 = "SELECT * FROM frd_categoriess WHERE cat_type = 2 AND cat_father = $catt_id AND statuss = 1";
                $FRQ2 = $FR_CONN->query("$q_frd2");
                $rowsnum_frd2 = $FRQ2->rowCount();
                for ($ii = 1; $ii <= $rowsnum_frd2; $ii++) { //For Loop S
                    $rowfrd2 = $FRQ2->fetch();
                    $catt_id2 = $rowfrd2['id'];
                    $catt_slug2 = $rowfrd2['slugg'];
                    $catt_name2 = $rowfrd2['en_name'];
                    $catt_name2_bn = $rowfrd2['bn_name'];
                    $catt_type2 = $rowfrd2['cat_type'];


                    echo "
                    <h3 title='#$catt_id2' class='catt cat_type2'>
                     <a href='$FRD_HURL/category/$catt_slug2'>  -- $catt_name2_bn  </a>
                    </h3>
                    ";

                    ///////// 3 s
                    $q_frd3 = "SELECT * FROM frd_categoriess WHERE cat_type = 3 and cat_father = $catt_id2 AND statuss = 1";
                    $FRQ3 = $FR_CONN->query("$q_frd3");
                    $rowsnum_frd3 = $FRQ3->rowCount();
                    for ($iii = 1; $iii <= $rowsnum_frd3; $iii++) { //For Loop S
                        $rowfrd3 = $FRQ3->fetch();
                        $catt_id3 = $rowfrd3['id'];
                        $catt_slug3 = $rowfrd3['slugg'];
                        $catt_name3 = $rowfrd3['en_name'];
                        $catt_name3_bn = $rowfrd3['bn_name'];
                        $catt_type3 = $rowfrd3['cat_type'];

                        echo "
                        <h4 title='#$catt_id3' class='catt cat_type3'>
                        <a href='$FRD_HURL/category/$catt_slug3'>  --- $catt_name3_bn  </a>
                        </h4>
                        ";


                        ///////// 4 s
                        $q_frd4 = "SELECT * FROM frd_categoriess WHERE cat_type = 4 AND cat_father = $catt_id3 AND statuss = 1";
                        $FRQ4 = $FR_CONN->query("$q_frd4");
                        $rowsnum_frd4 = $FRQ4->rowCount();
                        for ($iiii = 1; $iiii <= $rowsnum_frd4; $iiii++) { //For Loop S
                            $rowfrd4 = $FRQ4->fetch();
                            $catt_id4 = $rowfrd4['id'];
                            $catt_slug4 = $rowfrd4['slugg'];
                            $catt_name4 = $rowfrd4['en_name'];
                            $catt_name4_bn = $rowfrd4['bn_name'];


                            echo "
                            <h5 title='#$catt_id4' class='catt cat_type4'>
                            <a href='$FRD_HURL/category/$catt_slug4'>  ---- $catt_name4_bn  </a>
                            </small>
                            </h5>";
                        } /////// 4 e


                    } /////// 3 e


                } /////////2 e

            } //For Loop E



            ?>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- Catt List E -->



<?php 
require_once("frd-public/theme/frd-footer.php"); 
?>   