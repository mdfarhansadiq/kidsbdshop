<?php 
////////// Barcode  S
$barcodeText="$barcode_frd"; // This varivel value will dicrel form others place daynamaclay 
$barcodeType="code128";
$barcodeDisplay="horizontal"; 
//$barcodeDisplay="vertical";
$barcodeSize="40";
$printText="true";
$sourch_code="$FRD_HURL/frd-src/inc/php/barcode.php?";
$Barcode_FRD='<img class="barcode"  alt="'.$barcodeText.'" src="'.$sourch_code.'text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>';
//echo "$Barcode_FRD";    
////////// Barcode  E