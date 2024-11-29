<!-- showing selected categories name  -->
<!-- showing selected brand,model,color name  -->
<section>
    <div class="container">
        <!-- SELECTED CATEGORIES  -->
        <div class="row">
            <div class="col-md-2">
                <?php
                ////////unset selected catts btn ////////     
                if (isset($_SESSION['father_catid'])) {
                    echo "
                <form action='' method='post'>
                 <input class='btn btn-success btn-block' type='submit' name='do_unset_selacted_cats_sub' value='Cancel categories'>
                 </form>
                ";
                }
                ?>
            </div>
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['father_catid'])) {
                    echo "<span class='scs_1'>" . $_SESSION['father_catname'] . " => </span>";
                }
                if (isset($_SESSION['son_catid'])) {
                    echo "<span class='scs_2'>" . $_SESSION['son_catname'] . " => </span>";
                }
                if (isset($_SESSION['grandson_catid'])) {
                    echo "<span class='scs_3'>" . $_SESSION['grandson_catname'] . " => </span>";
                }
                if (isset($_SESSION['grandsonchild_catid'])) {
                    echo "<span class='scs_4'>" . $_SESSION['grandsonchild_catname'] . "</span>";
                }
                ?>
            </div>
        </div>


        <!-- brand,model,color names-->
        <br>
        <div class="row">
            <div class="col-md-2">
                <?php
                ////////unset selected catts btn ////////     
                if (isset($_SESSION['brand_id'])) {
                    echo "
        <form action='' method='post'>
         <input class='btn btn-primary btn-block' type='submit' name='do_unset_brand_model_color_sub' value='Cancel Brand'>
         </form>
        ";
                }
                ?>
            </div>
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['brand_id'])) {
                    echo "<span class='scs_1'>Brand => " . $_SESSION['brand_name'] . "  </span>";
                }
                ?>
            </div>
        </div>


    </div>
</section>












<!-- All Category Selecter forms -->
<section>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-11">
                    <div class="col-md-4"></div>

                    <div class="col-md-4">


                        <?php if (!isset($_SESSION['father_catid'])) { ?>
                            <form action="" method="post">
                                <select name="father_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                    <option value="">Select father category</option>
                                    <?php
                                    $q_frd = "select * from frd_categoriess WHERE cat_type=1";
                                    require_once("$rtd_path/1_frd.php");
                                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                        require("$rtd_path/catt_t_frd.php");
                                        echo "
                            <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                            ";
                                    } //For Loop E  
                                    ?>
                                </select>
                            </form>
                        <?php } ?>
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <?php if (!isset($_SESSION['son_catid']) and isset($_SESSION['father_catid'])) { ?>
                            <form action="" method="post">
                                <select name="son_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                    <option value="">Select son category</option>
                                    <?php
                                    $q_frd = "select * from frd_categoriess WHERE cat_type=2 and cat_father=" . $_SESSION['father_catid'] . "";
                                    require_once("$rtd_path/1_frd.php");
                                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                        require("$rtd_path/catt_t_frd.php");
                                        echo "
                            <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                            ";
                                    } //For Loop E

                                
                                    echo "<option value='0/No son category' title='No son category'>Go Next >></option>";
                                
                                    ?>

                                </select>
                            </form>
                        <?php } ?>
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <?php if (!isset($_SESSION['grandson_catid']) and isset($_SESSION['son_catid'])) { ?>
                            <form action="" method="post">
                                <select name="grandson_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                    <option value="">Select grandson category</option>
                                    <?php
                                    $q_frd = "select * from frd_categoriess WHERE cat_type=3 and cat_father=" . $_SESSION['son_catid'] . "";
                                    require_once("$rtd_path/1_frd.php");
                                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                        require("$rtd_path/catt_t_frd.php");
                                        echo "
                            <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                            ";
                                    } //For Loop E  
                                    ?>
                                    <option value="0/No grandson category" title="No grandson category">Go Next >> </option>
                                </select>
                            </form>
                        <?php } ?>
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <!-- ++ -->
                        <?php if (!isset($_SESSION['grandsonchild_catid']) and isset($_SESSION['grandson_catid'])) { ?>
                            <form action="" method="post">
                                <select name="grandsonchild_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                    <option value="">Select grandson child category</option>
                                    <?php
                                    $q_frd = "select * from frd_categoriess WHERE cat_type=4 and cat_father=" . $_SESSION['grandson_catid'] . "";
                                    require_once("$rtd_path/1_frd.php");
                                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                        require("$rtd_path/catt_t_frd.php");
                                        echo "
                            <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                            ";
                                    } //For Loop E  
                                    ?>
                                    <option value="0/No grandson child" title="No grandson child category">Go Next >> </option>
                                </select>
                            </form>
                        <?php } ?>


                    </div>

                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
</section>







<!-- brand,model forms-->
<section>
    <?php if (isset($_SESSION['grandsonchild_catid'])) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-11">
                    <div class="col-md-4"></div>

                    <div class="col-md-4">


                        <?php if (!isset($_SESSION['brand_id'])) { ?>
                            <form action="" method="post">
                                <select name="brand_info" id="" class="chosen" onchange="this.form.submit()">
                                    <option value="">Select brand</option>
                                    <?php
                                    $q_frd = "select * from frd_brandss";
                                    require("$rtd_path/1_frd.php");
                                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                        require("$rtd_path/brands_t_frd.php");
                                        echo "
                <option value='$brand_id/$brand_bn_name'>$brand_bn_name</option>
                            ";
                                    } //For Loop E  
                                    ?>
                                </select>
                            </form>

                            <br><br>
                            <form action="" method="post">
                                <input id='frd_search_txt' class='form-control' type='text' placeholder='Search Brand'>
                            </form>

                            <div id="frd_result"></div>


                        <?php } ?>


                    </div>

                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    <?php } ?>

</section>