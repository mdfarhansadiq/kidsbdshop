$(document).ready(function () {
  //FRD TEXT CLICK RADIO BUTTON SELECT:-
  $(".dz_radio_btn_text").on("click", function () {
    let fr_this_radio_btn_id = $(this).attr("id");
    $(".f_delivery_zone_id").attr("checked", false);
    $("#dz_radio_btn_" + fr_this_radio_btn_id).attr("checked", true);
  });
  //END>>

  //FRD :-
  $(".f_delivery_zone_id,.dz_radio_btn_text").on("click", function () {
    let deliverycharge = $(this).attr("deliverycharge");
    let f_CHECKOUT_T_BILLL = $("#f_CHECKOUT_T_BILLL").val();
    var tot = parseFloat(f_CHECKOUT_T_BILLL) + parseFloat(deliverycharge);
    $(".FR_CHECKOUT_T_BILL_DATA").html(parseFloat(tot));
  });
  //END>>

  $(".FrTrig_OrderPlace").on("click", function () {
    event.preventDefault();

    var frVC_ABC = 1;

    let f_devision = "";
    let f_district = "";
    let f_thana = "";
    let f_delivery_note = "NA";

    let f_product_id = $("#f_product_id").val();
    let f_customer_name = $("#f_customer_name").val();
    let f_customer_mobile = $("#f_customer_mobile").val();
    let f_customer_address = $("#f_customer_address").val();
    let f_customer_address_r = $("#f_customer_address_r").val();

    if (f_customer_address == "") {
      f_customer_address = "NA";
    }

    if (typeof $("#f_delivery_note").val() !== "undefined") {
      f_delivery_note = $("#f_delivery_note").val();
      if (f_delivery_note == "") {
        f_delivery_note = "NA";
      }
    }

    let f_delivery_zone_id = 1; //INSIDE DHAKA
    if (
      typeof $('input[name="f_delivery_zone_id"]:checked').val() !== "undefined"
    ) {
      f_delivery_zone_id = $('input[name="f_delivery_zone_id"]:checked').val();
    }

    if (typeof f_product_id == "undefined") {
      swal("Product Id Not Defined", "", "warning");
      frVC_ABC = "VF";
    }

    if (typeof $("#f_devision").val() !== "undefined") {
      f_devision = $("#f_devision").val();
    }
    if (typeof $("#f_district").val() !== "undefined") {
      f_district = $("#f_district").val();
    }
    if (typeof $("#f_thana").val() !== "undefined") {
      f_thana = $("#f_thana").val();
    }

    //FRD REQUIRED FILED ALERT:-
    if (f_customer_name == "") {
      swal("অর্ডার ফর্মে আপনার নাম লিখতে হবে!", "", "warning");
    }
    if (f_customer_mobile == "") {
      swal("অর্ডার ফর্মে আপনার মোবাইল নাম্বার লিখতে হবে!", "", "warning");
    }
    if (f_customer_address_r == 1) {
      if (f_customer_address == "NA") {
        swal("অর্ডার ফর্মে আপনার ডেলিভারি ঠিকানা লিখতে হবে!", "", "warning");
        frVC_ABC = "VF";
      }
    }

    if (frVC_ABC == 1 && f_customer_name != "" && f_customer_mobile != "") {
      $(".FrTrig_OrderPlace").hide();
      $("#OrderProcessinAlert").html(
        "<h6 class='text-center'> <img src='" +
          FRD_HURLL +
          "/frd-public/theme/asset/img/order-placing-wait.gif' alt='#' height='100px' width='auto'> <br> Dear " +
          f_customer_name +
          " <br> Please Wait Your Order Is Processing... </h6>"
      );

      const data_obj = {
        f_product_id: f_product_id,

        f_customer_name: f_customer_name,
        f_customer_mobile: f_customer_mobile,
        f_customer_address: f_customer_address,
        f_delivery_note: f_delivery_note,
        f_delivery_zone_id: f_delivery_zone_id,

        f_devision: f_devision,
        f_district: f_district,
        f_thana: f_thana,
      };

      $.ajax({
        url: FR_HURL_APII + "/NewOrderPlace",
        method: "POST",
        data: data_obj,
        success: function (data) {
          console.log(data);
          let o = JSON.parse(data);
          if (o.FRA == 1) {
            window.location.replace(o.FRA_NEXT_URL);
          } else if (o.FRA == 2) {
            swal("Hi C", o.FRM, "error");
            $(".FrTrig_OrderPlace").show();
            $("#OrderProcessinAlert").html("");
          } else {
            alert("NA ERROR" + data);
            $(".FrTrig_OrderPlace").show();
            $("#OrderProcessinAlert").html("");
          }
        },
      });
    }
  });
});
//END>>
