<script>

    $(document).ready(function() {

$( "#calendario" ).datepicker();
        jQuery("#frm").validate({
            
        });
    }

)
</script>
<div>
    <?php echo $this->Form->create("Accompaniment", array("id" => "frm" , 'enctype' => 'multipart/form-data', 'type' => 'file','url' => array("action" => "add", $proyect_id))); ?>
    <table border="0">
        <tbody>
            <tr>
                <td>Fecha</td>
                <td><?php echo $this->Form->input('Accompaniment.fecha', array('label' => '', 'id' => 'calendario', 'type' => 'text')); ?></td>
            </tr> 
            <tr>
                <td>Adjuntar soportes</td>
                <td><?php echo $this->Form->file('Accompaniment.archivo', array('label' => '', 'accept' => 'pdf')); ?></td>
            </tr> 
            <tr>
                <td>Observaciones</td>
                <td><?php echo $this->Form->input('Accompaniment.observaciones', array('label' => '', 'class' => 'required')); ?></td>
            </tr> 
        </tbody>
    </table>

    <?php echo $this->Form->hidden('Accompaniment.proyect_id', array('value' => $proyect_id, 'class' => '')); ?>

    <?php echo $this->Form->end("Guardar") ?>
</div>


