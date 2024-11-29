<style>
    .FrHeader3_Mob img {
        width: auto;
        max-height: 50px;
        margin: auto;
    }
</style>

<nav class="FrHeader3_Mob navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-lg-2">
                <span onclick="OpenLSN_Mob()" class="navbar-brand glyphicon glyphicon-align-justify"></span>
            </div>
            <div class="col-xs-8 col-lg-4 text-center">
                <a href="<?php echo $FRD_HURL ?>">
                    <img src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="<?php echo "$fr_cname,$fr_cmetatag,$FRD_HURL"; ?>">
                </a>
            </div>
            <div class="col-xs-2 col-lg-2">
                <?php
                if (isset($_SESSION['s_cust_id'])) {
                    echo "<span class='navbar-brand FrTrig_CustomerAllPages'><img class='img-circle' src='$FRD_HURL/frd-data/img/customer/" . $_SESSION['s_cust_pic'] . "' alt='' height='30px' width='30px'></span>";
                } else {
                    echo "<a class='navbar-brand' href='$FRD_HURL/login'><span class='glyphicon glyphicon-user'></span></a>";
                }
                ?>
            </div>

            <div class="col-xs-12 col-lg-4">
                <form class="form-inline">
                    <div class="form-group" width="100%">
                        <div class="input-group">
                            <input type="text" class="form-control" id="" placeholder="Amount">
                            <div class="input-group-addon"><span class='glyphicon glyphicon-search'></span></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div>
</nav>