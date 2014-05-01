<?php

// CONFIGURANÇÕES DO SITE -------------------------->
/**
 * define('db_host','YOUR HOST NAME HERE ');
 * define('db_name','YOUR DATABASE NAME HERE');
 * define('db_user','YOUR DATABASE USER HERE');
 * define('db_pass','YOUR DATABASE PASS HERE ');
 */
define('db_host', 'localhost');
define('db_name', '');
define('db_user', 'root');
define('db_pass', '');

// AUTO LOAD DE CLASSES ---------------------------->
function __autoload($Class) {
    $cDir = ['Conn'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php") && !$is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
            include_once(__DIR__ . "\\{$dirName}\\{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;
    if (!$iDir):
        trigger_error("Não Foi Possivel Incluir {$Class}.class.php", E_USER_ERROR);
        Die;
    endif;

    if (file_exists("{$dirName}/{$Class}.class.php")):
        require_once ("{$dirName}/{$Class}.class.php");
    else:
        die("Erro ao includir {$dirName}/{$Class}.class.php<hr>");
    endif;
}

// TRATAMENTO DE ERROS ----------------------------->
/**
 * Css --> Tratamento de Erros
 * Personalização de Erros!
 * define('TI_ACCEPT', 'YOUR CSS CLASS HERE');
 * define('TI_INFOR', 'YOUR CSS CLASS HERE');
 * define('TI_ALERT', 'YOUR CSS CLASS HERE');
 * define('TI_ERROR', 'YOUR CSS CLASS HERE');
 */
define('TI_ACCEPT', 'alert alert-success');
define('TI_INFOR', ' alert alert-info');
define('TI_ALERT', 'alert');
define('TI_ERROR', 'alert alert-error');

//TIErro --> exibe erros Lançados --> Front
function TIErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? TI_INFOR : ($ErrNo == E_USER_WARNING ? TI_ALERT : ($ErrNo == E_USER_ERROR ? TI_ERROR : $ErrNo)));

    echo "<div class=\"{$CssClass}\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
             {$ErrMsg}
          </div>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro --> personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? TI_INFOR : ($ErrNo == E_USER_WARNING ? TI_ALERT : ($ErrNo == E_USER_ERROR ? TI_ERROR : $ErrNo)));

    echo "<div class=\"{$CssClass}\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong>Eroo Na Linha: {$ErrLine}</strong> {$ErrMsg}<br>
            <small>{$ErrFile}</small>
         </div>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
