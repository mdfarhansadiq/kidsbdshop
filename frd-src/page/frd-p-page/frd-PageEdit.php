<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Page Edit";//PAGE TITLE
$p="PageList";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Page Edit </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
 //FRD_VC____________________________________:-
 if (!isset($FRurl[1]) or $FRurl[1] == "") {
    header("location:$FR_THISHURL/panels/?FRH=gsgsrbx");
}
$FRc_PageId = $FRurl[1]; //WRITER ID

$FR_THIS_PAGE = "$FR_THISHURL/page-PageEdit/$FRc_PageId";






/////////////////////////////////////////////////    
///////////prosess id reciving ///////////////////
//////////////////////////////////////////////////    
 if(isset($_POST['prosess_id'])){
    $prosess_id=$_POST['prosess_id'];
 }
    
    
    
    
    
    

    
    
/////////////////////////////////////////////////
////////// updating page ////////////////////////
/////////////////////////////////////////////////
if(isset($_POST['f_pagename_en'])){
    $pic_1_name=$_FILES['pic1']['name'];
    $f_pagename_en=$_POST['f_pagename_en']; 
    $f_pagebody_en=$_POST['f_pagebody_en']; 
    

        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_name_en = :page_name_en, 
                page_body_en = :page_body_en 
                WHERE id = $FRc_PageId";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_name_en', $f_pagename_en, PDO::PARAM_STR);
                $FRQ->bindParam(':page_body_en', $f_pagebody_en, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("$UsrName Page Update Done","","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Page Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
    
    
    
    
                //////////////// PIC 1 Proses Start ///////////////    
                if(!empty($pic_1_name)){
                $pic_1_name=$_FILES['pic1']['name'];
                $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
                $pic_1_size=$_FILES['pic1']['size'];
                //+
                $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
                $pic_1_width=$pic1_wdthheight[0];    
                $pic_1_height=$pic1_wdthheight[1];
                //+    
                $pic_1_extention_explor= explode('.',$pic_1_name);
                $pic_1_extention = strtolower( end($pic_1_extention_explor) );
                $pic_1_store_name =uniqid().'_frd.'.$pic_1_extention;
                $pic_1_storelocation = $FR_PATH_HD."frd-data/img/page_baner/$pic_1_store_name";
                
                if($pic_1_width==1200 and $pic_1_height==300){
                if($pic_1_extention=='jpg'||$pic_1_extention=='png'){
                     if($pic_1_size>=100000){
                        echo "<h6 class='TAC r'> Maximum 100kb image you can uplode! (IMG 4) </h6>";
                    }else{
                         if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){
                                try{
                                    $FR_CONN->exec("UPDATE frd_pages SET baner_pic = '$pic_1_store_name' WHERE id = $FRc_PageId");
                                    FR_TAL("Page Baner Picture Update  Done!","success");
                                }catch(PDOException $e){
                                    FR_TAL("Page Baner Picture Update  Failed!","error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                         }
                        }
                }else{
                    echo "<h5 class='TAC r'>You Can Uplode Only JPG Or PNG Images</h5>";
                }
               
                }else{ 
                   echo "<h5 class='TAC r'>
                   <span class='pip_pip_1s'>Alert</span> <br/>
                   Thumbel Picture add failed <br/> Picture width height is not correct! <br/> The size of the picture should be 1200 X 300 <br/> Please edit your Page Baner image! </h5>";
                }
               
                }
            //////////////// PIC 1 Proses End ///////////////
    
    
}    
    
    
    
    
    

    
$q_frd="SELECT * FROM frd_pages WHERE id = $FRc_PageId";
require_once("$rtd_path/1_frd.php");   
require("$rtd_path/pages_t_frd.php");


?>   
</section>
<!-- 1 SCRIPT END -->    

   








<section>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h2 class="TAC"><?php echo $page_name_en?></h2>
                <hr>
            </div>
        </div>
    </div>
</section>
   
   
   
   
   
   
   
   
<!-- edit-form -->   
<section>
    <div class="container">
        <div class="col-md-11">

            <div class="row">
            <div class="col-md-12 jumbotron">
              <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                 
                 <img src="<?php echo "$page_baner_pic_path";?>" alt="" class="img-responsive">
                 <br>
                 <span> Page Baner Picture </span><br/>
                 <input class="form-control" type="file"  name="pic1">

                <br>
                <span>Page Name * </span><br>
                <input class="form-control" type="text" name="f_pagename_en" value="<?php echo $page_name_en?>">

                <br/><br/>
                <span>Page Body *  <small> <br>
                <?php if($page_format_link !=""){echo "<a href='$page_format_link' target='_blank'><span class='glyphicon glyphicon-new-window'></span> View $page_name_en Page Formate Idea</a></small></span> ";}?>
                <textarea class="form-control" name="f_pagebody_en" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>

                <div class='text-right'>
                    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                </div>  
              </form>
            </div> 
            </div>


        </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   