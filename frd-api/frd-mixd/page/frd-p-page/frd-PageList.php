<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Page List";//PAGE TITLE
$p="PageList";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Page List</h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    

   


<br>
<section>
<div class="container">
<div class="col-md-11">


   <div class="row">
    <div class="col-md-12 jumbotron">
        <?php
          $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE page_tye = 'page' ORDER BY id ASC","ALL");
          if($FRR['FRA']==1){ 
                 echo "<table class='table table-bordered'>";
                 echo "
                     <tr class='h4 alert alert-success'>
                            <td>Page Title</td>
                            <td class='text-right'>Edit</td>
                     </tr>
                 ";
          
                         $FRc_SL = 1;
                         foreach($FRR['FRD'] as $FR_ITEM){
                             extract($FR_ITEM);
                                 echo "
                                     <tr>
                                         <td>$page_name_en</td>
                                         <td class='text-right'>
                                             <a class='btn btn-success btn-sm' href='$FR_THISHURL/page-PageEdit/$id'> <span class='glyphicon glyphicon-pencil'></span></a>
                                         </td>
                                     </tr> 
                                 ";
                                 
                             $FRc_SL = ($FRc_SL + 1);
                         }
                 
                 echo "</table>";
          } else{ 
              PR($FRR);
            echo "<div class='text-center alert alert-danger'>No Data Found</div>";
          } 
        ?>
    </div>
   </div>


</div>
</div>
</section>






<?php require_once('frd1_footer.php'); ?>   