<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-29 15:35:39
         compiled from "view\step3.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2703455b78992c74381-25707690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2ace443c33eae2371793c8fa41aa86c1e436659' => 
    array (
      0 => 'view\\step3.tpl',
      1 => 1438169733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2703455b78992c74381-25707690',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55b78992d660d9_62437546',
  'variables' => 
  array (
    'carName' => 0,
    'result' => 0,
    'branchName' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b78992d660d9_62437546')) {function content_55b78992d660d9_62437546($_smarty_tpl) {?><!DOCTYPE>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">

        <title>Каталог</title>

        <link rel="stylesheet" href="css/step3.css">

    </head>
    <body>
        <div class="step3_container">
            <div class="auto_parts_category">Варианты запчастей для <span class="auto_parts_sub_category"><?php echo $_smarty_tpl->tpl_vars['carName']->value;?>
</span>
                <div class="edit_category"><a href="index.php?mfr=AC">Редактировать</a>
                </div>
            </div>

            <div class="table_autopats">

                <?php if (count($_smarty_tpl->tpl_vars['result']->value)>0) {?>
                    <table>
                        <tr>
                            <td><div class="h_table_autopats">Фирма</div></td>
                            <td><div class="h_table_autopats">Артикул</div></td>
                            <td><div class="h_table_autopats">Описание</div></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="h_table_autopats_line" colspan="4"></td>
                        </tr>
                        <tr>
                            <td class="subcategory_table_autopats" colspan="4"><?php echo $_smarty_tpl->tpl_vars['branchName']->value;?>
</td>
                        </tr>

                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <tr>
                                <td class="table_autopats_brand"><?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
</td>
                                <td class="table_autopats_art"><?php echo $_smarty_tpl->tpl_vars['item']->value['art_number'];?>
</td>
                                <td class="table_autopats_specs"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                <td class="table_autopats_more"><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"><img src="img/more_btn.png"></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <div class='noresult'>
                        <div class="subcategory_table_autopats">
                            К сожелению, запчасти по выбраным Вами критериям сейчас отсутсвуют.
                        </div>
                        <div class="btn_back"><a href="index.php?mfr=AC"><img src="img/back_btn.jpg"></a></div>
                    </div>

                <?php }?>

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
    </body>
</html><?php }} ?>
