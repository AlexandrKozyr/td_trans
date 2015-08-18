<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-27 18:22:30
         compiled from "view\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1470755b63ea6430b35-57073461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc06e31d8801c32238dd8d66f4316beb4c103f55' => 
    array (
      0 => 'view\\header.tpl',
      1 => 1434611507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1470755b63ea6430b35-57073461',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55b63ea6547642_51155134',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b63ea6547642_51155134')) {function content_55b63ea6547642_51155134($_smarty_tpl) {?><html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <?php echo '<script'; ?>
 src="js/jquery.js"><?php echo '</script'; ?>
>
        <style>
            body {
                padding: 6px;
                background-color: darkgrey;
            }
            .page-header{
                background-color:  whitesmoke;
                padding: 10px;
                border: solid 1px black;
                border-radius: 8px;
            }

        </style>
    </head>
    <body background=blue;>
        <div class="page-header"  style="height: 100px">
            <h1 style="text-shadow: 2px 2px 4px black; color: grey; text-align: center;">TECDOC Search</h1>
            <a href="http://localhost/td_trans/index.php">
                <button class="btn btn-large btn-primary" type="button" style="float: right">
                    Начать заново
                </button>
            </a>
        </div>
        <div class="container">
<?php }} ?>
