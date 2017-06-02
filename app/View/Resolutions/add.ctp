<script>
    $(document).ready(function () {

        $('.form').validate();

    })
</script>
<fieldset>
<?php echo $this->Form->create("Resolution", array("class" => "form",'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "add/" . $proyect_id)); ?>

<?php echo $this->Form->input('Resolution.fecha', array('label' => 'Fecha de la resolución', 'type' => 'text', 'class' => 'calendario')); ?>
<?php echo $this->Form->input('Resolution.numero', array('label' => 'Número de la resolución', 'class' => 'required')); ?>
<?php 
if($cont>0){
   echo $this->Form->input('Resolution.tipo', array('class' => 'required','label' => 'Tipo de resolución', 'empty'=> 'Seleccione un tipo...','options' => array('MODIFICATORIA O ACLARATORIA' => 'MODIFICATORIA O ACLARATORIA', 'REVOCATORIA'=> 'REVOCATORIA'))); 
}else{
   echo $this->Form->input('Resolution.tipo', array('class' => 'required','label' => 'Tipo de resolución', 'empty'=> 'Seleccione un tipo...','options' => array('ADJUDICACIÓN' => 'ADJUDICACIÓN', 'MODIFICATORIA O ACLARATORIA' => 'MODIFICATORIA O ACLARATORIA', 'REVOCATORIA'=> 'REVOCATORIA')));
}
 ?>
<?php echo $this->Form->input('Resolution.reviso', array('label' => 'Nombre de quien revisó la resolución')); ?>
<?php echo $this->Form->input('Resolution.proyecto', array('label' => 'Nombre de la persona que proyectó la resolución')); ?>
<?php echo $this->Form->input('Resolution.comentario', array('label' => 'Comentario sobre la resolución expedida')); ?>
<?php echo $this->Form->hidden('Resolution.proyect_id', array('label' => '', 'value' => $proyect_id)); ?>
<?php echo $this->Form->hidden('Resolution.initial_evaluation_id', array('value' => $evaluation_id)); ?>
<?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>

</fieldset>