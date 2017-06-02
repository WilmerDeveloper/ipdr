<script>

    $(document).ready(function () {
        $(".calendario1").datepicker({
            showOn: 'both',
            dateFormat: 'yy-mm-dd',
            maxDate: '<?php echo date('Y-m-d') ?>',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });
    }

    )
</script> 
<?php

echo $this->Form->create('Follow', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['Follow']['id'])); 
?>

<fieldset>
    <?php echo $this->Form->hidden('Follow.id'); ?>
    <?php echo $this->Form->hidden('Follow.final_evaluation_id'); ?>
    <?php echo $this->Form->input('Follow.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'text', 'required' => 'required')); ?>

    <?php echo $this->Form->input('Follow.tipo', array('label' => 'Tipo modificación', 'options'=> array('empty'=>'','Sustancial'=>'Sustancial','No Sustancial'=>'No Sustancial'))); ?>
    <?php echo $this->Form->input('Follow.observaciones', array('label' => 'Observaciones', 'class' => 'txtarea')); ?>

    <h2>Archivo escaneado</h2>
    <?php echo $this->Form->file("Follow.archivo_plan_inversion", array('accept' => 'pdf')); ?>

    <?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>
</fieldset>