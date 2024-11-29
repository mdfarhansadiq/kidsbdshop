<section class="ceointroduction_secfrd hp_super_secfrd">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php
                //FRD PAGE TABLE DATA READ:-
                    $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 22","");
                    if($FRR['FRA']==1){ 
                       extract($FRR['FRD']);
                       echo "$page_body_en";
                    } else{ ECHO_4($FRR['FRM']); }
                //END>>
                ?>
            </div>
        </div>

    </div>
</section>