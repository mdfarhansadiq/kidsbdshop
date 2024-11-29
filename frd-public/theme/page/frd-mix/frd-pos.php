<?php
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$FRc_PAGE_TITEL = "Pos - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
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
<!--<h2 class="PT"> Pos </h2>-->






<section>
  <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 jumbotron">
           <form id="FormScanProductId" action="" method="POST">
              <input class="form-control" type="number" id="f_scan_product_id" placeholder="Scane Product Barcode" autofocus>
           </form>
        </div>
        <div class="col-md-3"></div>
    </div>
  </div>
</section>

<?php
// echo "<button class='frd_dn frdtrig_atc' id='75' ProVariaTyp='1' FrAT='addtocart'>ATC</button>";
?>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


<script type="text/javascript">
      $(document).ready(function(){
        FrFunOpenCart();


        // $( "#FormScanProductId" ).on( "submit", function( event ) {
        //   event.preventDefault();

        //   let f_scan_product_id = $('#f_scan_product_id').val();

        //   if(f_scan_product_id != ""){
        //     $(".frdtrig_atc").attr('id', f_scan_product_id);
        //     $('.frdtrig_atc').trigger('click');
        //     $("#FormScanProductId").trigger("reset");

        //   }else{
        //     swal("Please Scane Product Id","", "error");
        //   }
          
        // });



        
        $( "#FormScanProductId" ).on( "submit", function( event ) {
          event.preventDefault();

          let f_scan_product_id = $('#f_scan_product_id').val();

          if(f_scan_product_id != ""){
            $("#FormScanProductId").trigger("reset");
    
              $.ajax({
                url: FRD_HURLL + "/frd-public/theme/page/mng_cart/frd-add-to-cart.php",
                method: "POST",
                data: {
                  pro_id: f_scan_product_id,
                  FrAT: 'addtocart',
                  ProVariaTyp: 1,
                },
                success: function (data) {
                  // console.log(data);
                  let o = JSON.parse(data);
                  if (o.FRA == 1) {
                    FrFunOpenCart();
                  } 
                  else if (o.FRA == 2) {
                    swal(o.FRM, "", "error");
                  }
                  else {
                    swal("Unknown Error", data, "error");
                  }
                },
              });

          }else{
            swal("Please Scane Product Id","", "error");
          }
          
        });




    });  
</script>


<?php 

require_once("frd-public/theme/frd-footer.php");  ?>
<script> FrFunAddToCartManger();</script>
<?php ob_end_flush();  ?>