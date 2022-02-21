<?php
error_reporting(0);
$image = (string)$_GET['image'];
echo '<div class="img"> <img src="data:image/png;base64,' . base64_encode(file_get_contents($image)) . '" /> </div>';
?>
