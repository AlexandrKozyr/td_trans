<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-27 18:08:18
         compiled from "view\step2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:296455b24d3fb64806-92562226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be6728f4c8efc8243cd6eb85ef587dc917548ca7' => 
    array (
      0 => 'view\\step2.tpl',
      1 => 1438006090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '296455b24d3fb64806-92562226',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55b24d3fc3db98_67090581',
  'variables' => 
  array (
    'mfrList' => 0,
    'item' => 0,
    'value' => 0,
    'curMfr' => 0,
    'modList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b24d3fc3db98_67090581')) {function content_55b24d3fc3db98_67090581($_smarty_tpl) {?><!DOCTYPE>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">

        <title>Каталог</title>
        <link rel="stylesheet" href="css/selectbox.css">
        <link rel="stylesheet" href="css/step2.css">

        <?php echo '<script'; ?>
 src="js/jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/selectbox.js" type="text/javascript"><?php echo '</script'; ?>
>



    </head>
    <body>
        <div style="margin: 0 auto; width: 92%;">
            <div class="car_check">
                <div class="car_check_title">Поиск модели вашего автомобиля</div>
                <div class="car_check_sub_header">Выбор вашего автомобиля</div>
                <div class="car_check_body">
                    <div class="carpartsNavigation">
                        <form>

                            <div class="carpartsNavigationControls">
                                <select class="carMfr" name="carMfr" id="carMfr" onchange="selectcars('vendor', 'carMfr');">
                                    <option value="0">Выберите производителя</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mfrList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
                                            <?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['curMfr']->value) {?>
                                                <option  selected value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
                                            <?php } else { ?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
                                            <?php }?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="carpartsNavigationControls">
                                <select class="carModel" name="carModel" id="carModel" onchange="selectcars('model', 'carModel');">
                                    <option value="0">Выберите модель</option>
                                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value[1];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="carpartsNavigationControls">
                                <select class="carType" name="carType" id="carType" onchange="selectcars('type', 'carType');">
                                    <option value="0">Выберите модификацию</option>
                                </select>
                            </div>
                        </form>
                        <div class="btn_choose">
                            <a><img src="img/choose_btn.png"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps">
                <table style="border: 0;font: 'Segoe UI';"><tbody>
                        <tr>
                            <td><img src="img/1.png"></td>
                            <td style="background: #FFEEA7; width: 267px;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 1</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите марку и модель своего автомобиля</div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/2.png"></td>
                            <td style="background: #FFDE46;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 2</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите тип запчасти из каталога</div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/3.png"></td>
                            <td style="background: #FF9D00;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 3</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Получите запчасти и аналоги для вашего автомобиля</div>
                            </td>
                        </tr>
                    </tbody></table>
            </div> 
        </div>
        <?php echo '<script'; ?>
 src="js/step2.js" type="text/javascript"><?php echo '</script'; ?>
>
        <div id='cssmenu'>
            asdjkadljlkdsasld
        </div>	
    </div> 	
</body>
</html><?php }} ?>
