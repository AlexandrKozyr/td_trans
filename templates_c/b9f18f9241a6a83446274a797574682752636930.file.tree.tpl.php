<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-28 13:32:52
         compiled from "view\tree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2505855b63ea5df68f9-23511178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9f18f9241a6a83446274a797574682752636930' => 
    array (
      0 => 'view\\tree.tpl',
      1 => 1438075950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2505855b63ea5df68f9-23511178',
  'function' => 
  array (
    'menu' => 
    array (
      'parameter' => 
      array (
        'parentId' => 10001,
        'lvl' => 'l',
      ),
      'compiled' => '',
    ),
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55b63ea62faa33_34402201',
  'variables' => 
  array (
    'title' => 0,
    'lvl' => 0,
    'parentId' => 0,
    'data' => 0,
    'item' => 0,
    'typeId' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b63ea62faa33_34402201')) {function content_55b63ea62faa33_34402201($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('view/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="hero-unit">
    <caption style='font-family: Georgia'><h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2></caption>
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
                            <a href='#'>
                                <div class="elements-decoration">
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

                                </div>
                                <div class="arrow_menu_font">>
                                </div>
                            </a>
                            <?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['data']->value,'parentId'=>$_smarty_tpl->tpl_vars['item']->value['id'],'lvl'=>$_smarty_tpl->tpl_vars['lvl']->value++));?>

                        </li>
                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['gotChild']==0) {?>
                        <li class='has-sub nochildren'>
                            <a href='tecdoc.php?brandId=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&typeId=<?php echo $_smarty_tpl->tpl_vars['typeId']->value;?>
'>
                                <div class="elements-decoration">
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

                                </div>
                                <div class="arrow_menu_font">>
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
   


</div>
<?php echo $_smarty_tpl->getSubTemplate ('view/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
