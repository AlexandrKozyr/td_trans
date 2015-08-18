<?php
error_reporting(E_ALL | E_STRICT) ;
ini_set('display_errors', 'On');
/*
 * @ autor Alexandr Kozyr kozyr1av@gmail.com;
 * @ phone: +380662053435;
 * this file aggregates all moves for public customer TecDoc using
 */
session_start();

header("Content-Type: text/html; charset=utf-8");
require_once 'libs/Smarty.class.php';
require_once 'class/DBConnect.class.php';
require_once 'class/TDController.class.php';
require_once 'class/TDModel.class.php';

$smarty = new Smarty;
$cont = new TDController();

$cont->process();







