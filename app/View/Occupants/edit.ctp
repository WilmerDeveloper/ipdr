<script>

    $(document).ready(function() {
        $(".calendario").datepicker({
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });

        jQuery("#ocu").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#ocupantes",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

)
</script>
<fieldset>
    <?php echo $this->Form->create("Occupant", array("id" => "ocu", "url" => array("action" => "edit", $this->data['Occupant']['id']))); ?>
    <?php echo $this->Form->hidden('Occupant.id'); ?>
    <?php echo $this->Form->input('Occupant.nombres', array('label' => 'Nombres', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Occupant.apellidos', array('label' => 'Apellidos', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Occupant.tipo_documento', array('label' => 'Tipo documento', 'class' => 'required', 'empty' => '', 'options' => array('C.C' => 'C.C', 'TI' => 'TI'))); ?>
    <?php echo $this->Form->input('Occupant.documento', array('label' => 'Documento', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Occupant.parentesco', array('label' => 'Parentesco', 'class' => 'required', 'empty' => '', 'options' => array('Ninguno' => 'Ninguno', 'Padre o madre' => 'Padre o madre', 'Abuelo(a)' => 'Abuelo(a)', 'Hijo(a)' => 'Hijo(a)', 'Primo(a)' => 'Primo(a)', 'Tio(a)' => 'Tio(a)', 'Yerno o nuera' => 'Yerno o nuera', 'Primo(a)' => 'Primo(a)'))); ?>
    <?php echo $this->Form->input('Occupant.tipo_ocupacion', array('class' => 'required', 'label' => 'Tipo  de ocupación', 'empty' => '', 'options' => array('Arriendo' => 'Arriendo', 'Usufructo' => 'Usufructo', 'Comodato' => 'Comodato', 'Compra' => 'Compra'))); ?>
    <?php echo $this->Form->hidden('Occupant.plot_poll_id', array('label' => 'plot_poll_id')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "submit_button")) ?>
</fieldset>
