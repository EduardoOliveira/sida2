<?php
$version = phpversion();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$module_name = 'php-5.6.0_sqlanywhere';
if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
    $module_ext = '.dll';
} else {
    $module_ext = '.so';
}
/*
extension_loaded('sqlanywhere');*/
/*dl( $module_name.$module_ext );*/
$sybase = sasql_connect("HOST=192.168.56.1:2638;DBN=main;UID=main;PWD=main123;ServerName=main");
/* check connection */
if (sasql_errorcode()) {
    printf("Connect failed: %s\n", sasql_error());
    exit();
}

$mysql = new PDO('mysql:host=localhost;dbname=sida;charset=utf8', 'sida', '123');
$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

syncDificulties($mysql,$sybase);

unset($mysql);
/* close connection */
sasql_close($sybase);



function syncDificulties(&$mysql,&$sybase){
    $dificuldades = $mysql->prepare("INSERT INTO NivelDificuldade (idNivel,designacaoNivel,ultimaModificacao) VALUES(:id,:desig,now())");
    $query = "SELECT * FROM read_tables('Nivel_Dificuldade')";

    if ($result = sasql_query($sybase, $query)) {

        /* fetch associative array */
        while ($row = sasql_fetch_assoc($result)) {
            try{
                print_r($dificuldades->execute(array(
                    ':id' => $row['idNivel'],
                    ':desig' => $row['designacaoNivel'])));
            }catch(Exception $e){

            }
        }

        /* free result set */
        sasql_free_result($result);
    }
}
