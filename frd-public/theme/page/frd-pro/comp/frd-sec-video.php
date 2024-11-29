<!-- VIDEO SECTION  -->
<div class="container">
  <?php if ($videoo !== "") { ?>
   <style>
        .ProductVideoSec{
           display: none;
        }
        .ProductVideoSec iframe{
            width: 760px;
            height: 400px;
            background: #333333;
            border-radius: 8px;
            padding: 15px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
            cursor: pointer;
        }


        /* responcive  */
        @media only screen and (max-width: 429px) and (min-width: 375px){
          .ProductVideoSec iframe {
                width: 100%;
                height: 300px;
            }
        }
        @media only screen and (max-width: 932px) and (min-width: 430px){
            .ProductVideoSec iframe {
                width: 100%;
                height: 300px;
            }
        }
        @media only screen and (max-width: 360px) and (min-width: 280px){
          .ProductVideoSec iframe {
                width: 100%;
                height: 270px;
            }
        }
        @media only screen and (max-width: 768px) and (min-width: 540px) {
          .ProductVideoSec iframe {
                width: 100%;
                height: 350px;
            }
        }
        @media only screen and (max-width: 280px) {
          .ProductVideoSec iframe {
                width: 100%;
                height: 250px;
            }
        }
    </style>
   <div class="row ProductVideoSec">
    <div class="col-md-2"></div>
    <div class="col-md-12 text-center">
       <iframe id="ProductVideo" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <div class="col-md-2">
    </div>
   </div>
   <script>
    $(document).ready(function(){
      setTimeout(function() {
          $("#ProductVideo").attr("src", 'https://www.youtube.com/embed/'+FRc_ProductVideoo);
      }, 2000);
      setTimeout(function() {
          $(".ProductVideoSec").show();
      }, 3000);
    });
   </script>
  <?php } ?> 
</div>