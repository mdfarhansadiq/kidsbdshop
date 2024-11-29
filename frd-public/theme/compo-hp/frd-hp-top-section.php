<!-- TOP SECTION START -->
<section id="top_secfrd" class="">
    <?php
    $q_frd = "SELECT * from frd_sliderr where id=1";
    require("$rtd_path/1_frd.php");
    require("$rtd_path/slider_t_frd.php");
    ?>
    <div class="container-flueid">
        <div class="TopSlider">
            <!-- Carousel Slider s-->
            <div id="slider1" class="carousel slider" data-ride="carousel" data-interval="4000">

                <div class="carousel-inner">
                    <!-- carousel-inner -->

                    <div class="item active">
                        <a href="<?php echo "$sli_pic_1_link"; ?>">
                            <img src="<?php echo "$sli_pic_1_url";?>" alt="" class="animated bounceInDown" />
                        </a>
                    </div>


                    <div class="item">
                        <a href="<?php echo "$sli_pic_2_link"; ?>">
                            <img class="img-responsive" src="<?php echo "$sli_pic_2_url"; ?>" alt="" class="animated bounceInUp" />
                        </a>
                    </div>

                    <div class="item">
                        <a href="<?php echo "$sli_pic_3_link"; ?>">
                            <img src="<?php echo "$sli_pic_3_url"; ?>" alt="" class="animated slideInLeft" />
                        </a>
                    </div>

                    <div class="item">
                        <a href="<?php echo "$sli_pic_4_link"; ?>">
                            <img src="<?php echo "$sli_pic_4_url"; ?>" alt="" class="animated slideInRight" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo "$sli_pic_5_link"; ?>">
                            <img src="<?php echo "$sli_pic_5_url"; ?>" alt="" class="animated rotateIn" />
                        </a>
                    </div>

                    <!-- Left and right controls -->
                    <a href="#slider1" class="carousel-control left" data-slide="prev"><span class="icon-prev"></span></a>
                    <a href="#slider1" class="carousel-control right" data-slide="next"><span class="icon-next"></span></a>

                </div><!-- carousel-inner Stop -->
            </div>
            <!-- Carousel Slider Stop -->
        </div>

    </div>
</section>




<?php if ($FRcf_ParcelBooki == "1") { ?>
    <section class="hp_super_secfrd">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="<?php echo "$FRD_HURL/parcels_delivery"; ?>">
                        <img src="<?php echo "$FRD_HURL/frd-data/img/staticc/parcel-booking-baner-1.jpg"; ?>" alt="" class="img-responsive">
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php } ?>