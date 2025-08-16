<?php

$has_cURL = function_exists("curl_init");
echo $has_cURL;

// Show all information, defaults to INFO_ALL
phpinfo();

?>