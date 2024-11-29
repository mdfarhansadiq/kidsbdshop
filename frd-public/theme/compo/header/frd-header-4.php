<style>
    @media screen and (max-width: 991px) {
        body{
            margin-top: 90px !important;
        }

        .FrHeader4_Mob{
            display: block;
        }
        .FrHeader4_Mob{
            height: 90px;
            background: #D5D0CD;
            border: none !important;
        }
        .FrHeader4_Mob .frbtn_sidenaveopen{
           color: #222;
        }
        
        .FrHeader4_Mob .fricon_user{
           color: #222;
           display: inline-block;
           text-align: center;
           margin-left: -10px;
           overflow: hidden;
           height: 40px;
        }
        .FrHeader4_Mob .friconimg_user img{
           margin: auto;
           margin-left: -20px;
           margin-top: -7px;
        }

        .FrHeader4_Mob img#logo {
            width: auto;
            max-height: 50px;
            margin: auto;
        }
        .FrHeader4_Mob input {
            border: 2px solid #FCA204;
        }
        .FrHeader4_Mob input:focus {
            border: 2px solid #FCA204;
        }
        .FrHeader4_Mob .input-group-addon {
            border: 1px solid #FCA204;
            background: #FCA204;
            color: #222;
        }
        .FrHeader4_Mob form button {
            border: none;
            background: none;
        }

    }
    @media screen and (min-width: 991px) {
        .FrHeader4_Mob{
            display: none;
        }
    }

</style>

<nav class="FrHeader4_Mob navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-2 text-left">
                <span class="frbtn_sidenaveopen navbar-brand glyphicon glyphicon-align-justify frtrig_sn1_show"></span>
            </div>
            <div class="col-xs-8 col-lg-4 text-center">
                <a href="<?php echo $FRD_HURL ?>">
                    <img id="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="<?php echo "$fr_cname,$fr_cmetatag,$FRD_HURL"; ?>">
                </a>
            </div>
            <div class="col-xs-2 text-center">
                <?php
                if (isset($_SESSION['s_cust_id'])) {
                    echo "<span class='friconimg_user navbar-brand FrTrig_CustomerAllPages'><img class='img-circle' src='$FRD_HURL/frd-data/img/customer/" . $_SESSION['s_cust_pic'] . "' alt='' height='30px' width='30px'></span>";
                } else {
                    echo "<a class='fricon_user navbar-brand' href='$FRD_HURL/login'><span class='glyphicon glyphicon-user'></span></a>";
                }
                ?>
            </div>


                <div class="col-xs-12 text-center">
                    <form class=" form-inline" action="<?php echo "$FRD_HURL/search"?>" method="GET">
                        <div class="form-group" width="100%">
                            <div class="input-group">
                                <input type="text" class="form-control f_pro_search_text" name="productname" placeholder="<?php echo "$fr_tn_pro_search_placeh_txt";?>" required>
                                <div class="input-group-addon"><button type="sumbit"><span class='glyphicon glyphicon-search'></span></button></div>
                            </div>
                        </div>
                    </form>
                </div>
            

        </div>
    </div>
</nav>






<style>
    @media screen and (min-width: 991px) {
        body{
            margin-top: 85px !important;
        }
        .FrHeader4_PC{
            display: block;
            height: 85px;
            background: #D5D0CD;
            border: none !important;
        }

        .FrHeader4_PC img.logo {
            width: auto;
            max-height: 80px;
            margin: auto;
        }
        .FrHeader4_PC img.logo:hover {
            transform: scale(1.1);
        }
        

        .FrHeader4_PC .fr_v_center {
            margin-top: 11px;
        }

        .FrHeader4_PC .search {
            width: 100%;
            position: relative;
            display: flex;
            font-size: 14px;
            margin-top: 9px;
           text-align: center;
           position: absolute;
        }
        .FrHeader4_PC .searchTerm {
            width: 100%;
            border: 2px solid #FCA204;
            border-right: none;
            padding: 10px;
            height: 40px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: black;
        }
        .FrHeader4_PC .searchTerm:focus {
            color: #222;
        }
        .FrHeader4_PC .searchButton {
            width: 90px;
            height: 40px;
            border: 2px solid #FCA204;
            background: #FCA204;
            text-align: center;
            color: #222;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 14px;
        }

        .FrHeader4_PC .fricon_cart{
           color: #222;
           display: inline-block;
           text-align: center;
           position: absolute;
           font-size: 25px;
           cursor: pointer;
        }
        .FrHeader4_PC .fricon_cart:hover{
            transform: scale(1.1);
        }

        .FrHeader4_PC .fricon_user{
           color: #222;
           display: inline-block;
           text-align: center;
           position: absolute;
           font-size: 25px;
           padding-left: 30px;
           cursor: pointer;
        }
        .FrHeader4_PC .fricon_user:hover{
            transform: scale(1.1);
        }

        .FrHeader4_PC .fricon_home{
           color: #222;
           display: inline-block;
           text-align: center;
           position: absolute;
           font-size: 25px;
           padding-left: 30px;
           cursor: pointer;
        }
        .FrHeader4_PC .fricon_home:hover{
            transform: scale(1.1);
        }
       
        .FrHeader4_PC .fricon_sn1_showAhied span{
           color: #222;
           display: inline-block;
           text-align: right;
           position: absolute;
           font-size: 25px;
           cursor: pointer;
        }
        .FrHeader4_PC .fricon_sn1_showAhied span:hover{
            transform: scale(1.1);
        }
    }
    @media screen and (max-width: 991px) {
        .FrHeader4_PC{
            display: none;
        }
    }

</style>

<nav class="FrHeader4_PC navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-1 text-right fr_v_center">
                <div class="fricon_sn1_showAhied">
                    <span class="navbar-brand"> 
                        <b class="frtrig_sn1_show glyphicon glyphicon-align-justify"></b>  
                        <b class="frtrig_sn1_hide glyphicon glyphicon-remove frd_dn"></b> 
                    </span>
                </div>
            </div>
            <!-- <div class="col-md-1 text-center fr_v_center">
              <a href="<?php //echo $FRD_HURL ?>">
                <span class="navbar-brand fricon_home"> <span class="glyphicon glyphicon-home"></span></span>
                </a> 
            </div> -->
            <div class="col-md-2 text-left">
                <a href="<?php echo $FRD_HURL ?>">
                    <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="<?php echo "$fr_cname,$fr_cmetatag,$FRD_HURL"; ?>">
                </a>
            </div>
            <div class="col-md-7 text-center fr_v_center">
                    <form id="frd_prosearchform" action="<?php echo "$FRD_HURL/search"?>" method="GET">
                        <div class="search">
                            <input type="text" class="searchTerm f_pro_search_text"  name="productname" placeholder="<?php echo "$fr_tn_pro_search_placeh_txt"; ?>" autocomplete="on" required>
                            <button type="submit" class="searchButton">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </form>
            </div>
            <div class="col-md-1 text-center fr_v_center">
                <span class="navbar-brand fricon_cart view_cart_trig"> <span class="glyphicon glyphicon-shopping-cart cart_itemss"></span></span>
            </div>
            <div class="col-md-1 text-center fr_v_center">
                <?php
                if (isset($_SESSION['s_cust_id'])) {
                    echo "<span title='".$_SESSION['s_cust_Name']." Click To Open' class='fricon_user navbar-brand FrTrig_CustomerAllPages'><img class='img-circle' src='$FRD_HURL/frd-data/img/customer/" . $_SESSION['s_cust_pic'] . "' alt='' height='30px' width='30px'></span>";
                } else {
                    echo "<a class='fricon_user navbar-brand' href='$FRD_HURL/login'><span class='glyphicon glyphicon-user'></span></a>";
                }
                
                ?>
            </div>
        </div>
    </div>
</nav>

<?php
if (isset($_SESSION['sUsrId'])) {
    echo "<div class='text-center'> <span class='label label-danger pip_pip_1s'>" . $_SESSION['sUsrName'] . " You Ar Using Customer Panel</span> </div>";
}
?>