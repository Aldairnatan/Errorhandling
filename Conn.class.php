<?php

/**
 * Conn.class [CONEXÃO]
 * Classe Abstrata de conexão padrão SigleTon.
 * Retorna um Objeto PDO pelo Metodo Estatico GetConn();
 * 2014 - Aldair Natan B. N. Gomes - aldair.ngomes@gmail.com
 */
class Conn {

    private static $db_host = db_host;
    private static $db_name = db_name;
    private static $db_user = db_user;
    private static $db_pass = db_pass;
    
    /** @var PDO */
    private static $Connect = null;
    /**
     * Conecta com o Bacno de daddos com o Pattern SingleTon
     * Retorna um Objeto PDO!
     */
    private static function Connectar() {
        try{
            if(self::$Connect == nul):
                $dsn = 'mysql:host=' .self::$db_host. ';dbname=' . self::$db_name;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UFT8'];
                self::$Connect = new PDO($dsn, self::$db_user, self::$db_pass, $options);
            endif;
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }
    /** Retorna um objeto PDO SingleTon Pattern     */
    private static function getConn() {
        return self::Connectar();
    }

}
