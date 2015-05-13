<?php
$version = phpversion();
$module_name = 'php-5.6.0_sqlanywhere';
if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
    $module_ext = '.dll';
} else {
    $module_ext = '.so';
}
/*
extension_loaded('sqlanywhere');*/
/*dl( $module_name.$module_ext );*/
$conn = sasql_connect("HOST=192.168.0.4;DBN=iscte;UID=iscte;PWD=iscte123;ServerName=iscte");
/* check connection */
if (sasql_errorcode()) {
    printf("Connect failed: %s\n", sasql_error());
    exit();
}
echo "Connected successfully\n";

$query = "SELECT * FROM Utilizador";

if ($result = sasql_query($conn, $query)) {

    /* fetch associative array */
    while ($row = sasql_fetch_assoc($result)) {
        foreach($row as $key=>$value)
            printf("%s (%s)", $key, $value);
        echo "\n";
    }

    /* free result set */
    sasql_free_result($result);
}

/* close connection */
sasql_close($conn);
