<?php
//$q_frd= select * from ;
$result_frd = $FR_CONN->prepare("$q_frd");
$result_frd->execute();
$rowsnum_frd = $result_frd->rowCount();