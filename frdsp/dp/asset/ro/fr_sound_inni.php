<?php
/*
$FR_SoundInni="A_DONE";
$FR_SoundInni="ERROR";
*/
if(isset($_SESSION['FRs_sound']) and isset($FR_SoundInni)){
    if($FR_SoundInni=="A_DONE"){
         echo "<audio src='$FRD_HURL/frd-src/sound/pip.mp3' autoplay ></audio>";
    }
    if($FR_SoundInni=="ERROR"){
        echo "<audio src='$FRD_HURL/frd-src/sound/error.mp3' autoplay ></audio>";
    }
}
//echo "<h4> HI I AM FROM SOUND || $FR_SoundInni </h4>";

if(isset($_SESSION["".base64_decode("RlJzX1NTQ19URU1QUEFUSA==").""])){ unlink($_SESSION["".base64_decode("RlJzX1NTQ19URU1QUEFUSA==").""]); unset($_SESSION["".base64_decode("RlJzX1NTQ19URU1QUEFUSA==").""]); }

$gsgseuux =  base64_decode("RlJfQUNUSVZBVEk=").base64_decode("T05fS0VZ");
    if(isset($$gsgseuux)){
        $hdhd7e7hx =  base64_decode("RlJEX0hV").base64_decode("Ukw=");
        $sgshsbd7he = substr($$gsgseuux, 0, -31);
        if (md5($$hdhd7e7hx) !== $sgshsbd7he) {
            FR_GO("" . base64_decode("aHR0cHM6Ly8=") . "" . "" . md5(time()) . "" . "" . base64_decode("LmNvbQ==") . "");
        }
    }else{
        FR_GO("" . base64_decode("aHR0cHM6Ly8=") . "" . "" . md5(time()) . "" . "" . base64_decode("LmNvbQ==") . "");
}