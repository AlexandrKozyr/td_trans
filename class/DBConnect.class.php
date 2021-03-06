<?php
/* 
 * @ autor Alexandr Kozyr kozyr1av@gmail.com;
 * @ phone: +380662053435;
 * @ класс DBConnect подключает БД Transbase и MySQL (используется паттерн синглтон);
 * @ приватный статический атрибут $TBase - хранит соединение с донорской БД;
 * @ приватный статический атрибут $MySQL - хранит соединение с БД-рецепиентом;
 * @ приватный магический метод __construct() - реализует паттерн Singleton не позволяя
 *   создать екземпляр класса; 
 * @ публичный статический метод TBase() - создает подключение к донорской БД которое 
 *   хранится в приватном статическом атрибуте $TBase. Возвращает приватный статический атрибут $TBase 
 *   если таковой существует или создает новый приватный статический атрибут $TBase
 *   и после этого  его возвращает.
 * @ публичный статический метод MySQL() - создает подключение к донорской БД которое 
 *   хранится в приватном статическом атрибуте $MySQL. Возвращает приватный статический атрибут $MySQL 
 *   если таковой существует или создает новый приватный статический атрибут $MySQL
 *   и после этого  его возвращает.
 * */

class DBConnect {
    
    private static $TBase = null;
    private static $MySQL = null;
    
    private function __construct() {}
      
    /**
     * 
     * @return type
     */
    public static function TBase(){
        if (is_null(self::$TBase)){
            //переменная $connectStr содержит настройки для подключения к базе данных - 
            //донору TecDoc - TECDOC_CD_1_2015(TransBase) 
            $connectionStr = "odbc:Driver={Transbase ODBC TECDOC CD 1_2015};
                              Server=localhost;                               
                              Port=3306;                               
                              Database=TECDOC_CD_1_2015";
            $user = 'tecdoc';
            $password = 'tcd_error_0';
            self::$TBase = new PDO($connectionStr, $user, $password);
        }
        return self::$TBase;
    }
    
    
    /**
     * 
     * @return type
     */
    public static function MySQL(){
        if (is_null(self::$MySQL)){
            //переменная $connectionStr содержит настройки для подключения к базе данных - 
            //рецепиенту TecDoc - tecdoc(MySQL)
            $connectionStr = 'mysql:host=localhost;dbname=tecdoc';
            $user = 'root';
            $password = '';
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
            
            self::$MySQL = new PDO($connectionStr, $user, $password, $options);
        }
        return self::$MySQL;
    }

}

