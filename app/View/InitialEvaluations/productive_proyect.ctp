<script>
$( "#formul" ).validate({
  rules: {
    'data[InitialEvaluation][archivo]': {
      required: true
    
    }
  }
});
</script>

<?php echo $this->Form->create("InitialEvaluation", array('enctype' => 'multipart/form-data', 'type' => 'file', "id" => "formul", "action" => "productive_proyect/" . $this->data['InitialEvaluation']['id'])); ?>
<?php echo $this->Form->file('InitialEvaluation.archivo',array('accept'=>'xls|xlsx')); ?>
<?php echo $this->Form->hidden('InitialEvaluation.id'); ?>
<?php echo $this->Form->hidden('InitialEvaluation.proyect_id'); ?>
<?php echo $this->Form->end("Guardar")?>