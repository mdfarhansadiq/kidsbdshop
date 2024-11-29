if (typeof FRD_HURLL !== "undefined") {
  function fr_openSearch() {
    document.getElementById("FRsearchOverlay").style.display = "block";
  }
  function fr_closeSearch() {
    document.getElementById("FRsearchOverlay").style.display = "none";
  }

  //------------------------------------ FRD START FRO PC -----------------------------------------------------------//

  ////////////// Side Nave Open & Close S /////////////
  //Side Nave JS
  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
  function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("btn_open_sidenave").style.display = "none";
    document.getElementById("btn_close_sidenave").style.display = "block";
    document.body.style.marginLeft = "170px";
  }

  /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("btn_close_sidenave").style.display = "none";
    document.getElementById("btn_open_sidenave").style.display = "block";
    document.body.style.marginLeft = "0px";
    //document.body.style.marginLeft = "7%";
  }

  /////////////// Side Nave Open & Close E ////////////

  /////////////// Side Nave Right  Open & Close S /////////////
  //Side Nave Right JS
  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
  function openNav_right() {
    document.getElementById("mySidenav_right").style.width = "330px";
    document.body.style.marginRight = "330px";
  }

  /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
  function closeNav_right() {
    document.getElementById("mySidenav_right").style.width = "0";
    document.body.style.marginRight = "0px";
  }

  /////////////// Side Nave Right Open & Close E ////////////

  ///////////////////
  $(".counter").counterUp({
    delay: 10,
    time: 1000,
  });
  ///////////////////

  ////////////////////////////////////////////////////////////
  ///////////////// FRD COUNT DOWN ///////////////////////////
  ////////////////////////////////////////////////////////////
  function FRjfun_CD(fr_c, fr_ca) {
    let FRcountDownText = document.getElementById("FR_CD");
    let count = fr_c;
    let count_alert = fr_ca;

    function timer() {
      if (count > 0) {
        FRcountDownText.innerText = count;
        count--;
      } else if (count === 0) {
        $("#FR_CD").html(count_alert);
      }
    }
    setInterval(timer, 1000);
  }

  ////////////////////////////////////////////////////////////////////////////
  //###################### SCROLL TO TOP SCRIPT START #######################//
  ///////////////////////////////////////////////////////////////////////////
  //Get the button
  var mybutton = document.getElementById("myScrollTopBtn");
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 700;
  }
  //###################### SCROLL TO TOP SCRIPT END #######################//

  //FRD FLASH SALES END TIME COUNT DOWN:-
  function FrFun_FlashSalesCD(FrEndTime) {
    const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

    let FrEndTimeCD = FrEndTime,
      countDown = new Date(FrEndTimeCD).getTime(),
      x = setInterval(function () {
        let now = new Date().getTime(),
          distance = countDown - now;

        if (distance > 0) {
          (document.getElementById("FRdays").innerText = Math.floor(
            distance / day
          )),
            (document.getElementById("FRhours").innerText = Math.floor(
              (distance % day) / hour
            )),
            (document.getElementById("FRminutes").innerText = Math.floor(
              (distance % hour) / minute
            )),
            (document.getElementById("FRseconds").innerText = Math.floor(
              (distance % minute) / second
            ));
        }

        //do something later when date is reached
        if (distance < 0) {
          $("#FRcountDownSEC").hide();
        }
        //seconds
      }, 0);
  }
  //END>>
  // $(document).ready(function () {
  //   FrFun_FlashSalesCD(FR_FLASH_SALES_END_TIME);
  // });

  //////////////////////////////////////////////////////////////////////////////////
  // FRD PRODUCT SEARCH TIME TAG SAPALING HINKS FOR CUSTOMER:-
  //////////////////////////////////////////////////////////////////////////////////
  $("#f_pro_name").keyup(function () {
    var fr_produ = $(this).val();
    //alert(fr_produ);
    if (fr_produ != "") {
      //alert('AJAX INNI DONE');
      $.ajax({
        url:
          FRD_HURLL +
          "/frd-public/theme/inc/frd_product/inc/jq_ajx/f_pro_ss_frd.php",
        method: "POST",
        data: { fr_produ: fr_produ },
        success: function (data) {
          $("#fr_pro_ss").fadeIn("fast").html(data);
        },
      });
    } else {
      //alert('AJAX INNI FAILED');
      $("#fr_pro_ss").fadeOut();
    }
  });
  //+++
  $(document).on("click", "#fr_pro_ss li", function () {
    $("#f_pro_name").val($(this).text());
    $("#fr_pro_ss").fadeOut();
    $("#frd_prosearchform").submit();
  });
  //END>>

  $("#FrTrig_ChatOptionShow")
    .unbind()
    .click(function () {
      $("#FrChatIptionModel").modal("show");
    });

  $(".frtrig_logout").click(function () {
    window.location.replace(FRD_HURLL + "/logout");
  });

  $(".FrTrig_CustomerAllPages")
    .unbind()
    .click(function () {
      $.ajax({
        url: FR_HURL_APII + "/CustomerAllPages",
        method: "POST",
        data: { a: "a" },
        success: function (data) {
          $("#FR_SPIDER_MODEL_DATA").html(data);
          $("#FR_SPIDER_MODEL .modal-dialog").addClass(
            "modal-sm modal-dialog-centered"
          );
          $("#FR_SPIDER_MODEL").modal("show");
        },
      });
    });

  //FRD SST START:-
  if (frplug_capii == 1) {
    document.addEventListener("DOMContentLoaded", function () {
      //FRD INI CAPI => PageView:-
      setTimeout(function () {
        const data = {
          event_name: "PageView",
          event_source_url: FRc_THIS_PAGE_URLL,
          client_ip_address: FRc_USER_IPP,
          client_user_agent: FRc_USER_AGENTT,
          event_id: FRc_EVENT_IDD,
          external_id: FRc_EXTERNAL_IDD,
          page_title: FRc_CT_PAGE_TITELL,
          event_url: FRc_THIS_PAGE_URLL,
          user_role: "guest",
        };

        fetch(`${FR_HURL_APII}/IniCAPI`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        });

        // .then(response => response.text())
        //     .then(responseText => {
        //         console.log(responseText);
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //     });

        // .then(response => response.json())
        // .then(response => {
        //     if (response.FRA === 1) {
        //         console.log(response.FRM);
        //         toastr.success(response.FRM);
        //     } else {
        //         console.log(response.FRM);
        //         toastr.success(response.FRM);
        //     }
        // })
        // .catch(error => {
        //     console.error('Error:', error);
        // });
      }, 1000);
      //FRD INI CAPI => PageView END>>

      //FRD INI CAPI => ViewContent:-
      if (FR_PG_RR == "product") {
        setTimeout(function () {
          const data = {
            event_name: "ViewContent",
            event_source_url: FRc_THIS_PAGE_URLL,
            client_ip_address: FRc_USER_IPP,
            client_user_agent: FRc_USER_AGENTT,
            event_id: FRc_EVENT_IDD,
            external_id: FRc_EXTERNAL_IDD,

            value: FRc_CT_ItemSealPricee,
            content_type: "product",
            content_ids: FRc_CT_ItemIdd,
            content_name: FRc_CT_ItemNamee,
            content_category: FRc_CT_ItemCatNamee,

            page_title: FRc_CT_PAGE_TITELL,
            event_url: FRc_THIS_PAGE_URLL,
            user_role: "guest",
          };
          fetch(`${FR_HURL_APII}/IniCAPI`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          });
          // .then(response => response.json())
          // .then(response => {
          //     if (response.FRA === 1) {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     } else {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     }
          // })
          // .catch(error => {
          //     console.error('Error:', error);
          // });
        }, 2000);
      }
      //FRD INI CAPI => ViewContent END>>

      //FRD INI CAPI => InitiateCheckout:-
      if (FR_PG_RR == "checkout") {
        setTimeout(function () {
          const data = {
            event_name: "InitiateCheckout",
            event_source_url: FRc_THIS_PAGE_URLL,
            client_ip_address: FRc_USER_IPP,
            client_user_agent: FRc_USER_AGENTT,
            event_id: FRc_EVENT_IDD,
            external_id: FRc_EXTERNAL_IDD,

            value: FRc_CT_ItemSealPricee,
            content_type: "product",
            content_ids: FRc_CT_ItemIdd,
            content_name: FRc_CT_ItemNamee,
            content_category: FRc_CT_ItemCatNamee,
            num_items: FRc_CT_CartItems_CC,

            page_title: FRc_CT_PAGE_TITELL,
            event_url: FRc_THIS_PAGE_URLL,
            user_role: "guest",
          };
          fetch(`${FR_HURL_APII}/IniCAPI`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          });

          // .then(response => response.json())
          // .then(response => {
          //     if (response.FRA === 1) {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     } else {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     }
          // })
          // .catch(error => {
          //     console.error('Error:', error);
          // });
        }, 3000);
      }
      //FRD INI CAPI => InitiateCheckout END>>

      //FRD INI CAPI => InitiateCheckout (FOR PRODUCT LANDING PAGE):-
      if (FR_PG_RR == "product") {
        if (fr_p_lpss == 2 || fr_p_lpss == 4) {
          setTimeout(function () {
            const data = {
              event_name: "InitiateCheckout",
              event_source_url: FRc_THIS_PAGE_URLL,
              client_ip_address: FRc_USER_IPP,
              client_user_agent: FRc_USER_AGENTT,
              event_id: FRc_EVENT_IDD,
              external_id: FRc_EXTERNAL_IDD,

              value: FRc_CT_ItemSealPricee,
              content_type: "product",
              content_ids: FRc_CT_ItemIdd,
              content_name: FRc_CT_ItemNamee,
              content_category: FRc_CT_ItemCatNamee,
              num_items: 1,

              page_title: FRc_CT_PAGE_TITELL,
              event_url: FRc_THIS_PAGE_URLL,
              user_role: "guest",
            };
            fetch(`${FR_HURL_APII}/IniCAPI`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(data),
            });

            // .then(response => response.json())
            // .then(response => {
            //     if (response.FRA === 1) {
            //         console.log(response.FRM);
            //         toastr.success(response.FRM);
            //     } else {
            //         console.log(response.FRM);
            //         toastr.success(response.FRM);
            //     }
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
          }, 3000);
        }
      }
      //FRD INI CAPI => InitiateCheckout (FOR PRODUCT LANDING PAGE) END>>

      //FRD INI CAPI => Purchase:-
      if (FR_PG_RR == "checkout-complete") {
        setTimeout(function () {
          const data = {
            event_name: "Purchase",
            event_source_url: FRc_THIS_PAGE_URLL,

            client_ip_address: FRc_USER_IPP,
            client_user_agent: FRc_USER_AGENTT,
            event_id: FRc_EVENT_IDD,
            external_id: FRc_EXTERNAL_IDD,
            em: FR_CT_USR_EMAILL,
            ph: FR_CT_USR_PHONN,
            fn: FR_CT_USR_FULL_NAMEE,
            ln: FR_CT_USR_FULL_NAMEE,

            value: FRc_CT_ItemSealPricee,
            content_type: "product",
            content_ids: FRc_CT_ItemIdd,
            content_name: FRc_CT_ItemNamee,
            content_category: FRc_CT_ItemCatNamee,
            num_items: FRc_CT_CartItems_CC,

            page_title: FRc_CT_PAGE_TITELL,
            event_url: FRc_THIS_PAGE_URLL,
            user_role: "guest",

            order_id: FRc_CT_ORDER_IDD,
            user_name: FR_CT_USR_FULL_NAMEE,
            user_mobile: FR_CT_USR_PHONN,
            user_address: FRc_CT_USR_ADDRESSS,
          };
          fetch(`${FR_HURL_APII}/IniCAPI`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          });
          // .then(response => response.json())
          // .then(response => {
          //     if (response.FRA === 1) {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     } else {
          //         console.log(response.FRM);
          //         toastr.success(response.FRM);
          //     }
          // })
          // .catch(error => {
          //     console.error('Error:', error);
          // });
        }, 1000);
      }
      //FRD INI CAPI => Purchase END>>
    });
  }
  //FRD SST END>>

  //FRD PIXEL START:-
  if (frtex_PixelTrackk == 2) {
    document.addEventListener("DOMContentLoaded", function () {
      //FRD INI => PageView:-
      //   setTimeout(function () {}, 1000);
      //FRD INI => PageView END>>

      //FRD INI => ViewContent:-
      if (FR_PG_RR == "product") {
        setTimeout(function () {
          if (typeof fbq === "function") {
            fbq(
              "track",
              "ViewContent",
              {
                currency: "BDT",
                value: FRc_CT_ItemSealPricee,
                product_price: FRc_CT_ItemSealPricee,
                content_category: FRc_CT_ItemCatNamee,
                category_name: FRc_CT_ItemCatNamee,
                content_ids: FRc_ProductIdxx,
                content_name: FRc_CT_ItemNamee,
                content_type: "product",
                content_url: FRc_THIS_PAGE_URLL,
                landing_page: FRc_THIS_PAGE_URLL,
                post_id: FRc_ProductIdxx,
                post_type: "product",
                user_role: "guest",

                domain: FRD_HURLL,
                page_title: FRc_CT_PAGE_TITELL,
                event_url: FRc_THIS_PAGE_URLL,
                event_source_url: FRc_THIS_PAGE_URLL,
                event_day: FR_NOW_DAY_FF,
                event_month: FR_NOW_MONTH_FF,
                event_time: FR_NOW_TIMEE,
                fbc: FRc_fbcc,
                fbp: FRc_fbpp,
                plugin: "PixelYourSiteBySpider",
              },
              {
                event_id: "vc" + FRc_EVENT_IDD,
              }
            );
          }
        }, 1000);
      }
      //FRD INI => ViewContent END>>

      //FRD INI => InitiateCheckout:-
      //   if (FR_PG_RR == "checkout") {
      //     setTimeout(function () {}, 3000);
      //   }
      //FRD INI => InitiateCheckout END>>

      //FRD INI => Purchase:-
      //   if (FR_PG_RR == "checkout-complete") {
      //     setTimeout(function () {}, 1000);
      //   }
      //FRD INI => Purchase END>>
    });
  }
  //FRD PIXEL END>>
}

document.write(
  unescape(
    "%3c%73%63%72%69%70%74%3e%0d%0a%24%28%64%6f%63%75%6d%65%6e%74%29%2e%72%65%61%64%79%28%66%75%6e%63%74%69%6f%6e%20%28%29%20%7b%20%24%28%22%66%6f%6f%74%65%72%22%29%2e%61%70%70%65%6e%64%28%22%3c%64%69%76%20%63%6c%61%73%73%3d%27%66%72%64%63%72%65%64%69%74%73%27%3e%20%3c%73%70%61%6e%3e%20%3c%73%70%61%6e%20%69%64%3d%27%66%72%5f%66%6f%74%5f%64%65%76%65%6c%6f%70%65%64%5f%62%79%5f%74%78%74%27%3e%3c%2f%73%70%61%6e%3e%3a%20%3c%61%20%68%72%65%66%3d%27%68%74%74%70%73%3a%2f%2f%73%70%69%64%65%72%65%63%6f%6d%6d%65%72%63%65%2e%63%6f%6d%27%20%74%61%72%67%65%74%3d%27%5f%62%6c%61%6e%6b%27%3e%53%70%69%64%65%72%20%65%43%6f%6d%6d%65%72%63%65%3c%2f%61%3e%20%3c%2f%73%70%61%6e%3e%20%3c%2f%64%69%76%3e%22%29%3b%20%24%28%27%23%66%72%5f%66%6f%74%5f%64%65%76%65%6c%6f%70%65%64%5f%62%79%5f%74%78%74%27%29%2e%68%74%6d%6c%28%66%72%5f%66%6f%74%5f%64%65%76%65%6c%6f%70%65%64%5f%62%79%5f%74%78%74%74%29%3b%7d%29%3b%0d%0a%3c%2f%73%63%72%69%70%74%3e"
  )
);

//FRD COUPON APPLY:-
$(document).ready(function () {
  $(".FrTrig_CouponApply").on("click", function () {
    event.preventDefault();
    let f_coupon_code = $("#f_coupon_code").val();

    //FRD REQUIRED FILED ALERT:-
    if (f_coupon_code == "") {
      swal(
        "প্রথমে আপনার কুপন কোড লিখুন তারপর এই বাটনে ক্লিক করুন",
        "",
        "warning"
      );
    }

    //FRD MAIN OPARATION START:-
    if (f_coupon_code != "") {
      $(".FrTrig_CouponApply").hide();
      $("#CouponApplyingAlert").html(
        "<h6 class='text-center'> <img src='" +
          FRD_HURLL +
          "/frd-public/theme/asset/img/order-placing-wait.gif' alt='#' height='100px' width='auto'> <br> Dear " +
          +" <br> Please Wait Your Coupon Is Processing... </h6>"
      );

      const data_obj = {
        f_coupon_code: f_coupon_code,
        FRc_Invoice_Id_xx: FRc_Invoice_Id_xx,
        FRc_Invoice_EncId_xx: FRc_Invoice_EncId_xx,
        f_spiderecommerce: "spiderecommerce.com",
      };

      //FRD AJAX START:-
      $.ajax({
        url: FRD_HURLL + "/frdsp/dp/page/frd-p-coupon/frdapi-CouponApply.php",
        method: "POST",
        data: data_obj,
        success: function (data) {
          console.log(data);
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            setTimeout(function () {
              window.location.replace(o.FRA_NEXT_URL);
            }, 3000);
            swal(o.FRM, "", "success");
            $(".FrTrig_CouponApply").show();
            $("#CouponApplyingAlert").html("");
          } else if (o.FRA == 2) {
            swal("Hi", o.FRM, "error");
            $(".FrTrig_CouponApply").show();
            $("#CouponApplyingAlert").html("");
          } else {
            alert("NA ERROR" + data);
            $(".FrTrig_CouponApply").show();
            $("#CouponApplyingAlert").html("");
          }
        },
      });
      //FRD AJAX END>>
    }
    //FRD MAIN OPARATION END>>
  });
});
//COUPON APPLY END>>
