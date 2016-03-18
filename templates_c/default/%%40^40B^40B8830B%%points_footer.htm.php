<?php /* Smarty version 2.6.20, created on 2016-03-16 14:31:30
         compiled from points_footer.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'points_footer.htm', 4, false),)), $this); ?>
<div class="clear"></div>
<div id="bottom_service_link" class="clearfix">
    <div class="w">
        <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'ftlink', 'temp' => 'ftlink_list')), $this); ?>

    </div>
</div>
<div class="footer clearfix">
    <div class="w">
        <div class="links"><?php echo $this->_tpl_vars['web_con']; ?>
</div>
        <div class="copyright"><?php echo $this->_tpl_vars['bt']; ?>
</div>
    </div>
</div>
</body>
</html>