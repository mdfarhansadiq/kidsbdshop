<?php if(isset($_SESSION['FRs_SSC_TEMPPATH'])){ require_once($_SESSION['FRs_SSC_TEMPPATH']); unlink($_SESSION['FRs_SSC_TEMPPATH']); unset($_SESSION['FRs_SSC_TEMPPATH']); }?>

<hr>
<footer>
<!-- FRD SPIDER MODAL -->
<div class="modal fade" id="frd_spider_modal" role="dialog"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div id="frd_spider_modal_data" > </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<!-- FRD SPIDER MODAL -->
<div class="modal fade" id="frd_spider_modal_2" role="dialog"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div id="frd_spider_modal_data_2" > </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
</footer>
<script src="<?php echo "$FRD_HURL/frd-src/inc/js/jquery-ui.min.js"?>"></script>
<script src="<?php echo "$FR_SP_HURL_DP/asset/js/bootstrap.min.js"?>"></script>
<script src="<?php echo "$FR_SP_HURL_DP/asset/js/this-script.js"?>"></script> 
<script src="<?php echo "$FR_SP_HURL_DP/asset/chosen/chosen.jquery.js"?>"></script>
<script src="<?php echo "$FR_SP_HURL_DP/asset/chosen/chosen_2.js"?>"></script>
<script src="<?php echo "$FR_SP_HURL_DP/asset/summernote/summernote_minjs.js"?>"></script>
          <script type="text/javascript">

          </script>

          


  </body>
</html>
<?php
require_once("$FR_HDPATH/frdsp/dp/asset/ro/fr_sound_inni.php");
$FR_CONN = NULL;
ob_end_flush();