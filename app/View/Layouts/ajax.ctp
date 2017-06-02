<?php
echo $this->Session->flash();
echo $this->Session->flash('auth');
?>

<?php echo $this->fetch('content'); ?>
<?php echo $this->element('sql_dump'); ?> 