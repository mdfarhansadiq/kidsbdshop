<?php 
 if(isset($frplug_coupon)){ if($frplug_coupon == 1){ 
?>
<!-- COUPON  -->
<section>
    <div class="container">
        <div class="row jumbotron">
            <div class="col-md-12 alert alert-success">
                <form action="" method="POST">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan='2'>আপনার যদি কুপন কোড থাকে তাহলে নিজের বক্সে কুপন কোড লিখুন এবং <b>[কুপন এপ্লাই]</b> বাটনে ক্লিক করুন এবং ডিসকাউন্ট পান!</td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control" type="text" id="f_coupon_code" name="f_coupon_code" placeholder="আপনার কুপন কোড লিখুন" required>
                            </td>
                            <td>
                                <button class="btn btn-success btn-block FrTrig_CouponApply" type="submit">কুপন এপ্লাই</button>
                                <div id="CouponApplyingAlert"></div>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</section>
<?php }} ?>