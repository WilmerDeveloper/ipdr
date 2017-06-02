<script>
    jQuery("#cp").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
</script>
<?php echo $this->Form->create("Property", array('id' => 'cp', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "upload_files/" . $this->data['Property']['id'])); ?>
<legend>Adjuntar archivo</legend>
<?php
echo $this->Form->hidden('Property.id');
echo $this->Form->hidden('Property.proyect_id');
?>
<table border="1" class="index">

    <tbody>
        <tr>
            <td>Archivo resolución</td>
            <td><?php echo $this->Form->file('Property.archivo_resolucion', array('label' => 'Cargar matrícula inmoviliaria', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Matrícula inmobiliaria</td>
            <td><?php echo $this->Form->file('Property.archivo_matricula', array('label' => 'Cargar matrícula inmoviliaria', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Certificación distrito de riego</td>
            <td><?php echo $this->Form->file('Property.distrito', array( 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Certificación resguardo indígena</td>
            <td><?php echo $this->Form->file('Property.resguardo', array('label' => 'Cargar matrícula inmoviliaria', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Certificación consejo comunitario</td>
            <td><?php echo $this->Form->file('Property.consejo', array('label' => 'Cargar matrícula inmoviliaria', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Certificación Uso del suelo</td>
            <td><?php echo $this->Form->file('Property.uso_suelo', array('label' => 'Cargar matrícula inmoviliaria', 'accept' => 'pdf')); ?></td>
        </tr>
    </tbody>
</table>



<?php echo $this->Form->end(array('label' => 'Guardar')) ?>
<br><br>
<?php
echo $this->Ajax->link($this->Html->image("regresar.gif", array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar')), array('controller' => "Properties", "action" => "property_index",$property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false), null)
?>