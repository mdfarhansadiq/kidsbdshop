<?php
if(isset($_POST['idd'])){
    $idd=explode('/',$_POST['idd']);
    $cat_father_id=$idd[0];
    $cat_type=$idd[1]+1;  
    $cat_father_name=$idd[2];  
    
    if($cat_type==1){$cat_type_M="Father";} 
    if($cat_type==2){$cat_type_M="Son";}
    if($cat_type==3){$cat_type_M="Grandson";}
    if($cat_type==4){$cat_type_M="Grandson child";}
    
echo "<h5> Father Name: $cat_father_name  <br/> Category Type: $cat_type_M </h5>";    
    
?>

 <form id="" action="" method="post">
     <input type="hidden" name="f_cat_type" value="<?php echo "$cat_type";?>" >
     <input type="hidden" name="f_cat_father" value="<?php echo "$cat_father_id";?>" >
     <table class="table">
         <tr>
             <td>
                 <small>Category Name *</small>
                 <input class="form-control" id="testnow" type="text"   name="f_catt_name_bn" placeholder="Input Category Name *" required>
             </td>
             <td>
                 <small>Category Slug (optional)</small>
                 <input class="form-control" type="text"  name="f_slug_name" placeholder="Input Slug name  (Ex: boys-shopping) (Optional)">
             </td>
         </tr>
     </table>
    
     <input class="btn btn-primary btn-block" type="submit" name="add_new_catt_sub" value="Confirm & add"   >
 </form> 
 
<?php } ?>