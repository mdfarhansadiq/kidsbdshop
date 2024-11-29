<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_POST = "";
//FRD VC________
    if( isset($_POST['a']) AND isset($_SESSION['FRs_Invo_Token']) ){
         $FRs_Invo_Tokenn = $_SESSION['FRs_Invo_Token'];
         $FR_VC_POST = 1; 
    }

//FRD OPARATION START:-
     if($FR_VC_POST == 1){

        $FRQ = $FR_CONN->query("SELECT frlc_tksymbol_txt,frlc_total_txt FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
        extract($FRQ->fetch());
     
            echo "
            <div class='CartItemList2 fr-mt-10'>
            <table>
            ";
                //FRD USER PROFILE DATA:-
                $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Tokenn AND fr_stat = 0 ORDER BY id DESC", "ALL");

                if ($FRR['FRA'] == 1) {

                    $FRc_FT_CartItemQty = 0;
                    $FRc_FT_CartItemPrice = 0;
                    foreach ($FRR['FRD'] as $FR_ITEM) {
                        extract($FR_ITEM);

                        // COLOE NAME FINDER
                        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $r_color");
                        $row_cnf_bx = $FRQ->fetch();
                        $cus_color_en_name = $row_cnf_bx['en_name'];
                        // SLUG NAME FINDER
                        $FRQ = $FR_CONN->query("SELECT fr_slug FROM frd_products WHERE id = $fr_pro_id");
                        extract($FRQ->fetch());


                        // ORDER SIZE CUSTOMIZE 
                        if ($fr_size_name == "") {
                        $order_size_name_lmody = "";
                        } else {
                        $order_size_name_lmody = "<br> সাইজ: $fr_size_name";
                        }
                        
                        echo "
                        <tr>    
                            <td class='text-cente'>
                                <img class='item-img' src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' alt='' width='50px' height='50px' class='img-responsive'>
                            </td>
                            <td>
                                <span><a class='item_title' href='$FRD_HURL/product/$fr_pro_id/$fr_slug'> $fr_pro_title </a> </span>
                                <br>
                                <small> রং: $cus_color_en_name </small>
                                <small> $order_size_name_lmody </small>
                                <br>
                                <span class='price'>৳ " . number_format($fr_price) . " X $fr_qty</span>
                            </td>
                            <td class='text-center'>
                                <span class='pro_qtyup_btn Frtrig2_CartQtyUp glyphicon glyphicon-plus' value='$id'></span><br>
                                <span class='cpro_qty'>$fr_qty</span><br>
                                <span class='pro_qtydown_btn Frtrig2_CartQtyDown  glyphicon glyphicon-minus' id='$id'></span>
                            </td>

                            <td class='text-right'>$fr_t_price"."$frlc_tksymbol_txt</td>

                            <td class='text-center' title='item Remove'>
                            <span class='btn_proremove Frtrig2_RemovCartItem' id='$id' role='button'> <span class='glyphicon glyphicon-remove'></span> </span>
                            </td>
                        </tr>
                        ";
            

                    $FRc_FT_CartItemQty = ($FRc_FT_CartItemQty + $fr_qty);
                    $FRc_FT_CartItemPrice = ($FRc_FT_CartItemPrice + $fr_t_price);
                } //FOREACH END>
                        echo "
                        <tr class='boldd'>    
                            <td colspan='2'>$frlc_total_txt:-</td>
                            <td class='text-center'>$FRc_FT_CartItemQty</td>
                            <td class='text-right'>".number_format($FRc_FT_CartItemPrice,2).""."$frlc_tksymbol_txt</td>
                            <td class=''></td>
                        </tr>
                        ";


                } else {
                    echo "<img src='$FRD_HURL/frd-public/theme/asset/img/cart_empty_1.jpg' alt='#' class='img-responsive frcartempty'>";
                    
                    echo "<script>$('.FrOrderPlaceBtnCF').hide();</script>";
                }
            

           echo " 
             </table>
           </div>
           ";
        
        
         
    }
?>
<script type="text/javascript">

    $(document).ready(function(){


       $('.Frtrig2_CartQtyUp').unbind().click(function(){ 
            var item_id = $(this).attr("value");
              $.ajax({
              url: FR_HURL_APII +'/CartQtyUp',
              method:"post",
              data:{
                item_id:item_id
              },
              success:function(data){  
                    let o = JSON.parse(data);
                    if(o.FRA == 1){
                        toastr.success(o.FRM);
                            $.ajax({  
                                url: FR_HURL_APII +'/CartItems2',
                                method:"post",
                                data:{a:'a'},
                                success:function(data){  
                                    $('#FF_DATA_CART_ITEMLIST_2').html(data);
                                }  
                            });
                    }
                    else if(o.FRA == 2){
                        swal(o.FRM ,"", "error");
                    }
                    else{
                      swal("Unknown" ,data, "error");
                    }
              }      
            });  
        });


            $('.Frtrig2_CartQtyDown').unbind().click(function(){  
               var item_id = $(this).attr("id");
               $.ajax({  
                url: FR_HURL_APII +'/CartQtyDown',
                method:"post",
                data:{
                  item_id:item_id
                },
                success:function(data){
                    let o = JSON.parse(data);
                    if(o.FRA == 1){
                        toastr.warning(o.FRM);
                            $.ajax({  
                                url: FR_HURL_APII +'/CartItems2',
                                method:"post",
                                data:{a:'a'},
                                success:function(data){  
                                    $('#FF_DATA_CART_ITEMLIST_2').html(data);
                                }  
                            });
                    }
                    else if(o.FRA == 2){
                        swal(o.FRM ,"", "error");
                    }
                    else{
                      swal("Unknown" ,data, "error");
                    }
                }      
              });   
            });



            $('.Frtrig2_RemovCartItem').unbind().click(function(){
                var cart_item_id = $(this).attr("id"); 
                $.ajax({  
                url: FR_HURL_APII +'/CartItemRemove',
                method:"post",
                data:{
                    cart_item_id:cart_item_id
                },
                success:function(data){  
                let o = JSON.parse(data);
                if(o.FRA == 1){
                    toastr.warning(o.FRM);
                            $.ajax({  
                                url: FR_HURL_APII +'/CartItems2',
                                method:"post",
                                data:{a:'a'},
                                success:function(data){  
                                    $('#FF_DATA_CART_ITEMLIST_2').html(data);
                                }  
                            });
                }
                else if(o.FRA == 2){
                    swal(o.FRM ,"", "error");
                }
                else{
                    swal("Unknown" ,data, "error");
                }
                }
            });     
            });



    });

            
</script>