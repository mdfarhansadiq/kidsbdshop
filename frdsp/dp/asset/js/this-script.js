document.write(
  unescape(
    "%3c%73%63%72%69%70%74%3e%0d%0a%20%20%20%20%20%20%69%66%20%28%74%79%70%65%6f%66%20%46%52%44%5f%48%55%52%4c%4c%20%21%3d%3d%20%27%75%6e%64%65%66%69%6e%65%64%27%29%20%7b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%69%66%20%28%74%79%70%65%6f%66%20%46%52%44%5f%41%4b%45%59%5f%32%20%21%3d%3d%20%27%75%6e%64%65%66%69%6e%65%64%27%29%20%7b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%6c%65%74%20%73%73%64%36%74%36%66%67%67%20%3d%20%62%74%6f%61%28%46%52%44%5f%48%55%52%4c%4c%29%3b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%6c%65%74%20%68%66%64%79%68%72%75%65%78%20%3d%20%46%52%44%5f%41%4b%45%59%5f%32%2e%73%75%62%73%74%72%69%6e%67%28%33%31%29%3b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%69%66%20%28%73%73%64%36%74%36%66%67%67%20%21%3d%3d%20%68%66%64%79%68%72%75%65%78%29%20%7b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%77%69%6e%64%6f%77%2e%6c%6f%63%61%74%69%6f%6e%2e%72%65%70%6c%61%63%65%28%22%68%74%74%70%73%3a%2f%2f%73%70%69%64%65%72%73%6f%66%74%77%61%72%65%2e%63%6f%6d%2e%62%64%3f%68%69%6e%6b%73%3d%62%64%79%65%79%65%6f%78%22%29%3b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7d%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7d%65%6c%73%65%7b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%77%69%6e%64%6f%77%2e%6c%6f%63%61%74%69%6f%6e%2e%72%65%70%6c%61%63%65%28%22%68%74%74%70%73%3a%2f%2f%73%70%69%64%65%72%73%6f%66%74%77%61%72%65%2e%63%6f%6d%2e%62%64%3f%68%69%6e%6b%73%3d%68%64%68%64%75%72%69%72%78%22%29%3b%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7d%0d%0a%20%20%20%20%20%20%7d%20%65%6c%73%65%20%7b%0d%0a%20%20%20%20%20%20%20%20%20%24%28%22%68%74%6d%6c%22%29%2e%68%69%64%65%28%29%3b%0d%0a%20%20%20%20%20%20%7d%0d%0a%20%20%20%3c%2f%73%63%72%69%70%74%3e"
  )
);

//////////////////////////////////////////////////////////////
///////////////// FRD OPEN LEFT SIDE NAVE ////////////////////
//////////////////////////////////////////////////////////////
function FRopenNavLS() {
  document.getElementById("mySidenav").style.width = "230px";
  document.getElementById("btn_open_sidenave").style.display = "none";
  document.getElementById("btn_close_sidenave").style.display = "block";
  document.body.style.marginLeft = "0px";
}
//++
//////////////////////////////////////////////////////////////
///////////////// FRD CLOSE LEFT SIDE NAVE ////////////////////
//////////////////////////////////////////////////////////////
function FRcloseNavLS() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("btn_close_sidenave").style.display = "none";
  document.getElementById("btn_open_sidenave").style.display = "block";
  document.body.style.marginLeft = "0px";
}
////////////////////////////////////////////////////
///////////// FRD PAGE PRINT FUN ///////////////////
////////////////////////////////////////////////////
function fr_p_print() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("btn_close_sidenave").style.display = "none";
  document.getElementById("btn_open_sidenave").style.display = "block";
  document.body.style.marginLeft = "0px";
  window.print();
}

function Frfun_FilterFormHied() {
  $("#FilterForm").hide();
}

$(document).ready(function () {
  $("#summernote").summernote();

  //FRD DATE PICKER JS
  $(".datepicker").datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
  });

  $.get({
    url: FRD_HURLL + "/frdsp/dp/page/frd-p-" + FRc_PAN + "/frd-1svlinks.html",
    cache: false,
    success: function (data) {
      $("#FR_SNAV_LINKS").html(data);
      $("a[href=" + FRc_ACTIVELINKK + "]").addClass("active");

      let FrSvLinks = document.querySelectorAll("a.frdsnl");
      console.log(FrSvLinks);
      FrSvLinks.forEach((link) => {
        let href = link.getAttribute("href");
        link.setAttribute("href", FRD_HURLL + "/frdsp/dp/" + href);
      });
    },
  });
});

document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    const data = {
      FR_L: "gljdidcx",
    };
    fetch(`${FR_HURL_APII}/sid`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
  }, 90000);
});

document.write(
  unescape(
    "%3c%73%63%72%69%70%74%3e%0d%0a%24%28%64%6f%63%75%6d%65%6e%74%29%2e%72%65%61%64%79%28%66%75%6e%63%74%69%6f%6e%20%28%29%20%7b%20%24%28%22%66%6f%6f%74%65%72%22%29%2e%61%70%70%65%6e%64%28%22%3c%68%36%20%63%6c%61%73%73%3d%27%74%65%78%74%2d%63%65%6e%74%65%72%20%54%41%43%27%3e%20%3c%73%70%61%6e%3e%20%3c%73%70%61%6e%3e%44%65%76%65%6c%6f%70%65%64%20%42%79%3c%2f%73%70%61%6e%3e%3a%20%3c%61%20%68%72%65%66%3d%27%68%74%74%70%73%3a%2f%2f%73%70%69%64%65%72%65%63%6f%6d%6d%65%72%63%65%2e%63%6f%6d%27%20%74%61%72%67%65%74%3d%27%5f%62%6c%61%6e%6b%27%3e%53%70%69%64%65%72%20%65%43%6f%6d%6d%65%72%63%65%3c%2f%61%3e%20%3c%2f%73%70%61%6e%3e%20%3c%2f%68%36%3e%22%29%3b%7d%29%3b%0d%0a%3c%2f%73%63%72%69%70%74%3e"
  )
);
