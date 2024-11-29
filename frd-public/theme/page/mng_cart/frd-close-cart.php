<?php
session_start();
if(isset($_POST['ruf'])){
    unset($_SESSION['s_keepcartopen']);
    echo "
    <script>
       document.getElementById('mySidenav_right').style.width = '0';
       document.body.style.marginRight = '0px';
    </script>
    ";
}
exit;