function FrFunAddToCartManger() {
  $(".frdtrig_showpopupcheckoutf")
    .unbind()
    .click(function () {
      var f_product_id = $(this).attr("id");
      $.ajax({
        url: FRD_HURLL + "/frd-public/theme/api/frdapi-PopupCheckoutForm.php",
        method: "POST",
        data: {
          f_product_id: f_product_id,
          f_spiderecommerce: "spiderecommerce.com",
        },
        success: function (data) {
          $("#FR_SPIDER_MODEL_DATA").html(data);
          $("#FR_SPIDER_MODEL .modal-dialog").addClass(
            "modal-sm modal-dialog-centered"
          );
          $("#FR_SPIDER_MODEL").modal("show");
        },
      });
    });
  $(".frdtrig_atc")
    .unbind()
    .click(function () {
      var pro_id = $(this).attr("id");
      var ProVariaTyp = $(this).attr("ProVariaTyp");
      var FrAT = $(this).attr("FrAT");
      $.ajax({
        url: FRD_HURLL + "/frd-public/theme/page/mng_cart/frd-add-to-cart.php",
        method: "POST",
        data: {
          pro_id: pro_id,
          FrAT: FrAT,
          ProVariaTyp: ProVariaTyp,
        },
        success: function (data) {
          // console.log(data);
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            //  swal(o.FRM ,"", "success");
            //  toastr.success(o.FRM);
            FrFunOpenCart();
            if (o.FR_AT == "ordernow") {
              setTimeout(function () {
                FrFun_CheckOutStart();
              }, 100);
            }
            if (o.FR_AT == "addtocart") {
              $("#FR_SPIDER_MODEL_DATA").html("");
              $("#FR_SPIDER_MODEL").modal("hide");
              setTimeout(function () {
                FRfun_CartHeid();
              }, 3000);
            }

            if (frplug_capii == 1) {
              FrFun_CAPI_AddToCartEventFire(o.FR_GTM_DATA);
            }
            if (frtex_PixelTrackk == 2) {
              FrFun_PIXEL_AddToCartEventFire(o.FR_GTM_DATA);
            }
            if (frtcplug_GTMdataLayerr == 1) {
              FrFun_GTM_AddToCartEventFire(o.FR_GTM_DATA);
            }
          } else if (o.FRA == 2) {
            swal(o.FRM, "", "error");
            if (o.FR_AT == "ordernow") {
              FrFun_CheckOutStart();
            }
          } else if (o.FRA == 3) {
            FrFunColorVariaShow(o.FR_V_MP_ID, o.FR_AT);
          } else if (o.FRA == 4) {
            FrFunSizeVariaShow(o.FR_V_MP_ID, o.FR_AT);
          } else if (o.FRA == 5) {
            // window.location.replace();
            window.open(o.FR_WPOL, "_blank");
          } else {
            swal("Unknown ACTION", data, "error");
          }
        },
      });
    });

  function FrFun_CheckOutStart() {
    window.location.replace(FRD_HURLL + "/checkout");
  }

  function FrFunSizeVariaShow(a, b) {
    $.ajax({
      url: FR_HURL_APII + "/ItemSizeVariaShow",
      method: "POST",
      data: { f_v_mp_id: a, f_at: b },
      success: function (data) {
        $("#FR_SPIDER_MODEL_DATA").html(data);
        $("#FR_SPIDER_MODEL").modal("show");
      },
    });
  }

  function FrFunColorVariaShow(a, b) {
    $.ajax({
      url: FR_HURL_APII + "/ItemColorVariaShow",
      method: "POST",
      data: { f_v_mp_id: a, f_at: b },
      success: function (data) {
        $("#FR_SPIDER_MODEL_DATA").html(data);
        $("#FR_SPIDER_MODEL").modal("show");
      },
    });
  }

  function FrFun_GTM_AddToCartEventFire(datagtm) {
    let ogtm = JSON.parse(datagtm);

    dataLayer.push({ ecommerce: null }); // Clear the previous ecommerce object.
    dataLayer.push({
      event: "add_to_cart",
      client_id: "" + FRc_USER_AGENTT + "",
      ip_override: "" + FRc_USER_IPP + "",
      user_id: "" + FRc_USER_UIDD + "",
      plugin: "SpiderEcommerceGTM4DL",
      ecommerce: {
        currency: "BDT",
        value: parseFloat(ogtm.price),
        affiliation: "" + ogtm.affiliation + "",
        coupon: "NA",
        items: [
          {
            item_id: "" + ogtm.item_id + "",
            item_name: "" + ogtm.item_name + "",
            affiliation: "" + ogtm.affiliation + "",
            coupon: "NA",
            currency: "BDT",
            discount: parseFloat(ogtm.discount),
            price: parseFloat(ogtm.price),
            index: 0,
            item_brand: "" + ogtm.item_brand + "",
            item_category: "" + ogtm.item_category + "",
            item_category2: "" + ogtm.item_category2 + "",
            item_category3: "" + ogtm.item_category3 + "",
            item_category4: "" + ogtm.item_category4 + "",
            item_category5: "NA",
            item_list_id: "NA",
            item_list_name: "NA",
            item_variant: "" + ogtm.item_variant + "",
            location_id: "NA",
            quantity: 1,
          },
        ],
      },
    });
  }

  function FrFun_PIXEL_AddToCartEventFire(data) {
    let opixel = JSON.parse(data);
    if (typeof fbq === "function") {
      fbq(
        "track",
        "AddToCart",
        {
          currency: "BDT",
          value: opixel.price,
          content_name: "" + opixel.item_name + "",
          content_ids: "" + opixel.item_id + "",
          content_type: "product",
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
          event_id: "atc" + FRc_EVENT_IDD,
        }
      );
    }
  }

  function FrFun_CAPI_AddToCartEventFire(data) {
    let ocapi = JSON.parse(data);

    const data_AddToCart = {
      event_name: "AddToCart",

      client_ip_address: FRc_USER_IPP,
      client_user_agent: FRc_USER_AGENTT,
      event_id: FRc_EVENT_IDD,
      external_id: FRc_EXTERNAL_IDD,

      value: ocapi.price,
      content_type: "product",
      content_ids: ocapi.item_id,
      content_name: ocapi.item_name,
      content_category: ocapi.item_category,
      num_items: 1,
      quantity: 1,
      user_role: "guest",
      page_title: FRc_CT_PAGE_TITELL,
      event_url: FRc_THIS_PAGE_URLL,
      event_source_url: FRc_THIS_PAGE_URLL,
    };
    fetch(`${FR_HURL_APII}/IniCAPI`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data_AddToCart),
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
  }
}

function FrFun_CartManeger() {
  $(".Frtrig_RemovCartItem")
    .unbind()
    .click(function () {
      var cart_item_id = $(this).attr("id");
      $.ajax({
        url: FR_HURL_APII + "/CartItemRemove",
        method: "post",
        data: {
          cart_item_id: cart_item_id,
        },
        success: function (data) {
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            //   swal(o.FRM ,"", "success");
            FrFunOpenCart();
          } else if (o.FRA == 2) {
            swal(o.FRM, "", "error");
          } else {
            swal("Unknown", data, "error");
          }
        },
      });
    });

  $(".FRtrig_CartClose").click(function () {
    FRfun_CartHeid();
  });

  $(".Frtrig_CartQtyUp")
    .unbind()
    .click(function () {
      var item_id = $(this).attr("value");
      $.ajax({
        url: FR_HURL_APII + "/CartQtyUp",
        method: "post",
        data: {
          item_id: item_id,
        },
        success: function (data) {
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            // swal(o.FRM ,"", "success");
            FrFunOpenCart();
          } else if (o.FRA == 2) {
            swal(o.FRM, "", "error");
          } else {
            swal("Unknown", data, "error");
          }
        },
      });
    });

  $(".Frtrig_CartQtyDown")
    .unbind()
    .click(function () {
      var item_id = $(this).attr("id");
      $.ajax({
        url: FR_HURL_APII + "/CartQtyDown",
        method: "post",
        data: {
          item_id: item_id,
        },
        success: function (data) {
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            // swal(o.FRM ,"", "success");
            FrFunOpenCart();
          } else if (o.FRA == 2) {
            swal(o.FRM, "", "error");
          } else {
            swal("Unknown", data, "error");
          }
        },
      });
    });
}

function FrFunOpenCart() {
  $.ajax({
    url: FRD_HURLL + "/frd-public/theme/page/mng_cart/frd-view-cart-ini.php",
    method: "POST",
    data: { ruf: "ruf" },
    success: function (data) {
      $("#sidenaveright_viewcartdata").html(data);
      document.getElementById("mySidenav_right").style.width = "330px";
      // $("#FR_DATA_CART").html(data);
    },
  });
}
$(".view_cart_trig").click(function () {
  FrFunOpenCart();
});

function FRfun_CartHeid() {
  $.ajax({
    url: FRD_HURLL + "/frd-public/theme/page/mng_cart/frd-close-cart.php",
    method: "post",
    data: {
      ruf: "ruf",
    },
    success: function (data) {
      $("#sidenaveright_viewcartdata").html(data);
    },
  });
}

$(".FRtrig_CartClose").click(function () {
  FRfun_CartHeid();
});
function frfun_ShowLeftSideNave() {
  $.ajax({
    url: FR_HURL_APII + "/LeftSideNave",
    method: "POST",
    data: { abc: "abc" },
    success: function (data) {
      $("#Data_LeftSiveNave").html(data);
      document.getElementById("FRLeftSideNaveMob").style.width = "200px";
      document.getElementById("FRLeftSideNaveMob").style.display = "block";
      $(".frtrig_sn1_show").addClass("frd_dn");
      $(".frtrig_sn1_hide").removeClass("frd_dn");
    },
  });
}
$(".frtrig_sn1_show").click(function () {
  frfun_ShowLeftSideNave();
});

function frfun_HideLeftSideNave() {
  document.getElementById("FRLeftSideNaveMob").style.width = "0";
  document.getElementById("FRLeftSideNaveMob").style.display = "none";
  $(".frtrig_sn1_show").removeClass("frd_dn");
  $(".frtrig_sn1_hide").addClass("frd_dn");
}
$(".frtrig_sn1_hide").click(function () {
  frfun_HideLeftSideNave();
});
