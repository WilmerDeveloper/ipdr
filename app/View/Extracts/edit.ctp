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
echo $this->Form->create('Extract', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['Extract']['id']));
?>
<fieldset>
    <?php echo $this->Form->hidden('Extract.id'); ?>
    <?php echo $this->Form->hidden('Extract.proyect_id'); ?>
    <?php echo $this->Form->input('Extract.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text', 'required' => 'required')); ?>
    <?php echo $this->Form->input('Extract.observaciones', array('label' => 'Observaciones', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('Extract.saldo',array('label' => 'Valor del saldo en cuenta')); ?>
    <h2>Archivo escaneado</h2>
    <?php echo $this->Form->file("Extract.archivo", array('accept' => 'pdf')); ?>
    <?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>
</fieldset>