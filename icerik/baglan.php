<?php
// Database connection configuration
// You need to update these values according to your local setup

$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePassword = '';
$databaseName = 'bol';

// MySQL compatibility layer for deprecated mysql_* functions
if (!function_exists('mysql_connect')) {
    function mysql_connect($host, $user, $password) {
        global $databaseConnection;
        $databaseConnection = mysqli_connect($host, $user, $password);
        return $databaseConnection;
    }
    
    function mysql_select_db($database, $connection) {
        return mysqli_select_db($connection, $database);
    }
    
    function mysql_set_charset($charset, $connection) {
        return mysqli_set_charset($connection, $charset);
    }
    
    function mysql_query($query, $connection = null) {
        global $databaseConnection;
        if ($connection === null) $connection = $databaseConnection;
        return mysqli_query($connection, $query);
    }
    
    function mysql_fetch_array($result) {
        return mysqli_fetch_array($result);
    }
    
    function mysql_fetch_assoc($result) {
        return mysqli_fetch_assoc($result);
    }
    
    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }
    
    function mysql_real_escape_string($string, $connection = null) {
        global $databaseConnection;
        if ($connection === null) $connection = $databaseConnection;
        return mysqli_real_escape_string($connection, $string);
    }
    
    function mysql_error($connection = null) {
        global $databaseConnection;
        if ($connection === null) $connection = $databaseConnection;
        return mysqli_error($connection);
    }
    
    function mysql_close($connection) {
        return mysqli_close($connection);
    }
}

// Create database connection
$databaseConnection = mysql_connect($databaseHost, $databaseUser, $databasePassword);

if (!$databaseConnection) {
    die('Veritabanı bağlantısı başarısız: ' . mysql_error());
}

// Select database
mysql_select_db($databaseName, $databaseConnection);

// Set charset
mysql_set_charset('utf8', $databaseConnection);

// Database connection function
function vtBaglan() {
    global $databaseConnection;
    
    if (!$databaseConnection) {
        // Reconnect if connection is lost
        $databaseConnection = mysql_connect($databaseHost, $databaseUser, $databasePassword);
        if (!$databaseConnection) {
            die('Veritabanı bağlantısı başarısız: ' . mysql_error());
        }
        mysql_select_db($databaseName, $databaseConnection);
        mysql_set_charset('utf8', $databaseConnection);
    }
    
    return $databaseConnection;
}

// Security function for input sanitization
function guvenlikKontrol($variable, $style) {
    if (empty($variable)) {
        return '';
    }
    
    switch ($style) {
        case "ultra":
            $before = array("'", "<", ">", "\"", "\\", "document", "cookie", Chr(10), Chr(34), Chr(255));
            $after = array("", "", "", "", "", "", "", "", "", "");
            $variable = trim(intval(strip_tags($variable)));
            $variable = str_replace($before, $after, $variable);
            break;
        case "hard":
            $before = array("'", "<", ">", "\"", "\\", Chr(255));
            $after = array("", "", "", "", "\\", "");
            $variable = str_replace($before, $after, $variable);
            $variable = trim(strip_tags($variable));
            break;
        case "med":
            $before = array("'", "<", ">", "\"");
            $after = array("&#039;", "&lt;", "&gt;", "&quot;");
            $variable = str_replace($before, $after, $variable);
            $variable = trim(strip_tags($variable));
            break;
        case "low":
            $before = array("", "", "", "");
            $after = array("", "", "", "");
            $variable = strip_tags($variable);
            $variable = str_replace($before, $after, $variable);
            break;
    }
    return trim($variable);
}

// Security decode function
function guvenlikDecode($text) {
    $text = str_replace("&#039;", "'", $text);
    $text = str_replace("&lt;", "<", $text);
    $text = str_replace("&gt;", ">", $text);
    $text = str_replace("&quot;", "\"", $text);
    return $text;
}
?>
