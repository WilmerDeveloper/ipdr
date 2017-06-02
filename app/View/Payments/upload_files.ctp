<script>

    $(document).ready(function() {


        jQuery("#frm").validate({
            beforeSubmit: function() {
                $(".submit_button").hide();

            }
        });
    }

)
</script>
<div>
    <?php echo $this->Form->create("Payment", array("id" => "frm", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "upload_files", $this->data['Payment']['id']))); ?>
    <table border="0">
        <tbody>

            <tr>
                <td style="width: 40% ">Adjuntar poliza:</td>
                <td><?php echo $this->Form->file('Payment.archivo_poliza', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
             <tr>
                <td>Aprobación de la póliza</td>
                <td><?php echo $this->Form->file('Payment.aprobacion', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr>
            <tr>
                <td>Certificación Bancaria Controlada </td>
                <td><?php echo $this->Form->file('Payment.certificacion_bancaria', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
            <tr>
                <td>Formato Notificación </td>
                <td><?php echo $this->Form->file('Payment.notificacion', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
            <tr>
                <td>Poder especial </td>
                <td><?php echo $this->Form->file('Payment.poder', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
            <tr>
                <td>Componentes sanitarios y reglamentos de salud pública (si aplica)</td>
                <td><?php echo $this->Form->file('Payment.componentes_sanitarios', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
            
            <tr>
                <td>Influencia de distrito de riegos (si aplica)</td>
                <td><?php echo $this->Form->file('Payment.distrito_riego', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
            <tr>
                <td>Formato De Revisión Del Equipo Técnico (F4-Pm-Ipdr-01)</td>
                <td><?php echo $this->Form->file('Payment.equipo_tecnico', array('label' => '', 'class' => '','accept'=>'pdf')); ?></td>
            </tr> 
           
           
            <tr>
                <td>
                </td>
                <td>

                    <?php echo $this->Form->hidden('Payment.proyect_id'); ?>
                    <?php echo $this->Form->hidden('Payment.id'); ?>
                </td>
            </tr> 

        </tbody>
    </table>


    <?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>
</div>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Payments', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>


