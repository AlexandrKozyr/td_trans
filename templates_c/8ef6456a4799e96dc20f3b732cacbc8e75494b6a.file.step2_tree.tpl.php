<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 11:56:20
         compiled from "view\step2_tree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2167355b74d65e11074-70569790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ef6456a4799e96dc20f3b732cacbc8e75494b6a' => 
    array (
      0 => 'view\\step2_tree.tpl',
      1 => 1438761210,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2167355b74d65e11074-70569790',
  'function' => 
  array (
    'menu' => 
    array (
      'parameter' => 
      array (
        'parentId' => 10001,
        'lvl' => 1,
      ),
      'compiled' => '',
    ),
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55b74d66065984_81885059',
  'variables' => 
  array (
    'lvl' => 0,
    'parentId' => 0,
    'data' => 0,
    'item' => 0,
    'typeId' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b74d66065984_81885059')) {function content_55b74d66065984_81885059($_smarty_tpl) {?>
<?php if (!function_exists('smarty_template_function_menu')) {
    function smarty_template_function_menu($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['menu']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    <div class="menu_<?php echo $_smarty_tpl->tpl_vars['lvl']->value;?>
">    
        <ul>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['parentId']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['gotChild']==1) {?>
                    <li class='has-sub'>
                        <a class='has-sub children'>
                            <div class="elements-decoration">
                                <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

                                <span class="arrow_menu_font">
                                    >
                                </span>
                            </div>
                        </a>
                        <?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['data']->value,'parentId'=>$_smarty_tpl->tpl_vars['item']->value['id'],'lvl'=>$_smarty_tpl->tpl_vars['lvl']->value+1));?>

                    </li>
                <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['gotChild']==0) {?>
                    <li class='has-sub'>
                        <a class='has-sub' href='index.php?branchId=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&typeId=<?php echo $_smarty_tpl->tpl_vars['typeId']->value;?>
'>
                            <div class="elements-decoration">
                                <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

                            </div>
                        </a>
                    </li>
                <?php }?>
            <?php } ?>
        </ul>
    </div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

<?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['result']->value));?>
   


<?php }} ?>
