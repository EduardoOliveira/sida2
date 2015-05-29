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

//getAllDificulties($mysql,$sybase);
syncPessoas($mysql,$sybase);

unset($mysql);
/* close connection */
sasql_close($sybase);


function syncPessoas(&$mysql,&$sybase){
    $pessoa = $mysql->prepare("INSERT INTO Pessoa (isEstudante, nome, senha, emailPessoa, ultimaModificacao)
                      VALUES(:isEstudante, :nome, :senha, :emailPessoa, :ultimaModificacao");
    $estudante = $mysql->prepare("INSERT INTO Estudante (emailPessoa, id, curso)
                      VALUES(:emailPessoa, :id, :curso");
    $docente = $mysql->prepare("INSERT INTO Docente (emailPessoa, id)
                      VALUES(:emailPessoa, :id");
    if ($result = sasql_query($sybase, "SELECT * FROM read_log('Docente','1991/1/1',NOW())")) {
        var_dump($result);
        /* fetch associative array */
        while ($row = sasql_fetch_assoc($result)) {
            var_dump($row);
            /*try{
                $dificuldades->execute(array(
                    ':id' => $row['idNivel'],
                    ':desig' => $row['designacaoNivel']));
            }catch(Exception $e){
                var_dump($e);
            }*/
        }

        /* free result set */
        sasql_free_result($result);
    }

}

function getAllDificulties(&$mysql,&$sybase){
    $dificuldades = $mysql->prepare("INSERT INTO NivelDificuldade (idNivel,designacaoNivel,ultimaModificacao) VALUES(:id,:desig,now())");

    if ($result = sasql_query($sybase, "SELECT * FROM read_tables('Nivel_Dificuldade')")) {

        /* fetch associative array */
        while ($row = sasql_fetch_assoc($result)) {
            try{
                $dificuldades->execute(array(
                    ':id' => $row['idNivel'],
                    ':desig' => $row['designacaoNivel']));
            }catch(Exception $e){
                var_dump($e);
            }
        }

        /* free result set */
        sasql_free_result($result);
    }
}
