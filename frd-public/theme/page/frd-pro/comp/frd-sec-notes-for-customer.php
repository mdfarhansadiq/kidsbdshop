<!-- NOTE FOR CUSTOMERs -->
<?php if($frtc_notes_s_dp == 1){ 
    //SINGLE PAGE SPACIAL NOTE or NOTICE:-
    $FRQ = $FR_CONN->query("SELECT * from frd_pages WHERE id = 14");
    $rd_spp_note_fc_kx = $FRQ->fetch();
    $frd_spp_note_fc_pt = $rd_spp_note_fc_kx['page_name_en'];
    $frd_spp_note_fcust = $rd_spp_note_fc_kx['page_body_en'];
    ?>
    <br>
    <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron ppp_note_sec">
          <div class="">
            <?php echo "$frd_spp_note_fcust"; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>