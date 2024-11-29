<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FRD_HURL'>
<meta property='og:type' content='website'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cmetatag,spiderecommerce.com,spider ecommerce'>
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
//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_hpconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); exit; }
//END>>
?>
<script src="<?php echo "$FRD_HURL/frd-public/theme/asset/js/frd-this-function.js?v=$FR_SOFT_VERSION"?>"></script>

<?php
$FRR = FR_QSEL("SELECT * FROM frd_hpserial WHERE fr_hp_sec_stat = 1 AND fr_hp_sec_serial > 0 ORDER BY fr_hp_sec_serial ASC","ALL");
if($FRR['FRA']==1){  
  foreach($FRR['FRD'] as $FR_ITEM){
    extract($FR_ITEM);
    require_once("compo-hp/$fr_hp_sec_name.php");
  }
 } else{ PR($FRR);}
?>


 


<script type="text/javascript">
       $(document).ready(function(){

        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_populcats').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:4000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:false,    
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:8
                    }
                }
        });
         //END>>


        /////////////////////////////////////////// 
        //FRD POPULER BRAND OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_popu_brand').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:false,    
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:8
                    }
                }
        });
         //END>>

        /////////////////////////////////////////// 
        //FRD HAPPY CUSTOMER COUNT OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_hapy_cust_c').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:9000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:true,    
                responsive:{
                    0:{
                        items:3
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
        });
         //END>>


        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_popu_writers').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                smartSpeed: 2000,
                dots:true,    
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:8
                    }
                }
        });
         //END>>


         /////////////////////////////////////////////////
        // OWL CAROSOL:-
        // FRD SUB CATEGORY LINK CAROSOL:-
        //////////////////////////////////////////////////
            $('.fr_oc_hp_3').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                smartSpeed: 3000,    
                dots:false,
                autoWidth:true,    
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:12
                    }
                }
            });
        //END>>

        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_gain_cust_trust').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:6000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:true,    
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:5
                    },
                    1000:{
                        items:5
                    }
                }
        });
         //END>>


        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_flasseals').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:false,    
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:8
                    }
                }
        });
         //END>>
  
  });//F D R E    
</script>


<?php require_once("frd-public/theme/frd-footer.php"); ?>