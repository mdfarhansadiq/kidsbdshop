<?php 
if(isset($_POST['FR_SelectDivis'])){
   $FR_SelectDivis = $_POST['FR_SelectDivis'];
}

//FRD_VC____1:-
if(!isset($FR_SelectDivis)){ header("LOCATION:https://google.com"); exit; }
?>


<?php if($FR_SelectDivis=="Barishal"){ ?>
    <option class='op' value=''>Select District </option>
    <option id="barguna" value="Barguna">Barguna</option>
    <option id="barishal" value="Barishal">Barishal</option>
    <option id="bhola" value="Bhola">Bhola</option>
    <option id="jhalokathi" value="Jhalokathi">Jhalokathi</option>
    <option id="patuakhali" value="Patuakhali">Patuakhali</option>
    <option id="pirojpur" value="Pirojpur">Pirojpur</option>
<?php exit; } ?>




<?php if($FR_SelectDivis=="Chittagong"){ ?>
    <option value="">Select District </option>
    <option id="bandarban" value="Bandarban">Bandarban</option>
    <option id="brahmanbaria" value="Brahmanbaria">Brahmanbaria</option>
    <option id="chandpur" value="Chandpur">Chandpur</option>
    <option id="chittagong" value="Chittagong">Chittagong</option>
    <option id="comilla" value="Comilla">Comilla</option>
    <option id="cox’s-Bazar" value="Coxs_Bazar">Cox’s Bazar</option>
    <option id="feni" value="Feni">Feni</option>
    <option id="khagrachari" value="Khagrachari">Khagrachari</option>
    <option id="lakshmipur" value="Lakshmipur">Lakshmipur</option>
    <option id="noakhali" value="Noakhali">Noakhali</option>
    <option id="rangamati" value="Rangamati">Rangamati</option>
<?php exit;} ?>






<?php if($FR_SelectDivis=="Dhaka"){ ?>
    <option value="">Select District </option>
    <option id="dhaka" value="Dhaka">Dhaka</option>
    <option id="faridpur" value="Faridpur">Faridpur</option>
    <option id="gazipur" value="Gazipur">Gazipur</option>
    <option id="gopalganj" value="Gopalganj">Gopalganj</option>
    <option id="kishoreganj" value="Kishoreganj">Kishoreganj</option>
    <option id="madaripur" value="Madaripur">Madaripur</option>
    <option id="manikganj" value="Manikganj">Manikganj</option>
    <option id="munshiganj" value="Munshiganj">Munshiganj</option>
    <option id="narayanganj" value="Narayanganj">Narayanganj</option>
    <option id="narshingdi" value="Narshingdi">Narshingdi</option>
    <option id="rajbari" value="Rajbari">Rajbari</option>
    <option id="shariatpur" value="Shariatpur"> Shariatpur</option>
    <option id="tangail" value="Tangail">Tangail</option>
<?php exit; } ?>





<?php if($FR_SelectDivis=="Khulna"){ ?>
 <!-- Khulna Division -->
    <option value="">Select District </option>
    <option id="bagherhat" value="Bagherhat">Bagherhat</option>
    <option id="chuadanga" value="Chuadanga">Chuadanga</option>
    <option id="jessore" value="Jessore">Jessore</option>
    <option id="jinaidaha" value="Jinaidaha">Jinaidaha</option>
    <option id="Kushtia" value="Kushtia">Kushtia</option>
    <option id="khulna" value="Khulna">Khulna</option>
    <option id="magura" value="Magura">Magura</option>
    <option id="meherpur" value="Meherpur">Meherpur</option>
    <option id="narail" value="Narail">Narail</option>
    <option id="satkhira" value="Satkhira">Satkhira</option>
<?php exit;} ?>





<?php if($FR_SelectDivis=="Mymensingh"){ ?>
<!-- Mymensingh Division -->
    <option value="">Select District </option>
    <option id="mymensingh" value="Mymensingh">Mymensingh</option>
    <option id="netrokona" value="Netrokona">Netrokona</option>
    <option id="jamalpur" value="Jamalpur">Jamalpur</option>
    <option id="sherpur" value="Sherpur">Sherpur</option>
<?php exit;} ?>






<?php if($FR_SelectDivis=="Rajshahi"){ ?>
<!-- Rajshahi Division -->
    <option value="">Select District </option>
    <option id="bogra" value="Bogra">Bogra</option>
    <option id="chapinawabganj" value="Chapinawabganj">Chapinawabganj</option>
    <option id="joypurhat" value="Joypurhat">Joypurhat</option>
    <option id="naogaon" value="Naogaon">Naogaon</option>
    <option id="natore" value="Natore">Natore</option>
    <option id="pabna" value="Pabna">Pabna</option>
    <option id="rajshahi" value="Rajshahi">Rajshahi</option>
    <option id="sirajganj" value="Sirajganj">Sirajganj</option>
<?php exit;} ?>






<?php if($FR_SelectDivis=="Rangpur"){ ?>
<!-- Rangpur Division -->
    <option value="">Select District </option>
    <option id="dinajpur" value="Dinajpur">Dinajpur</option>
    <option id="gaibandha" value="Gaibandha">Gaibandha</option>
    <option id="kurigram" value="Kurigram">Kurigram</option>
    <option id="lalmonirhat" value="Lalmonirhat">Lalmonirhat</option>
    <option id="nilphamari" value="Nilphamari">Nilphamari</option>
    <option id="panchagarh" value="Panchagarh">Panchagarh</option>
    <option id="rangpur" value="Rangpur">Rangpur</option>
    <option id="thakurgaon" value="Thakurgaon">Thakurgaon</option>
<?php exit;} ?>





<?php if($FR_SelectDivis=="Sylhet"){ ?>
 <!-- Sylhet Division -->
    <option value="">Select District </option>
    <option id="hobiganj" value="Hobiganj">Hobiganj</option>
    <option id="moulvibazar" value="Moulvibazar">Moulvibazar</option>
    <option id="sunamganj" value="Sunamganj">Sunamganj</option>
    <option id="sylhet" value="Sylhet">Sylhet</option>
<?php exit;} ?>