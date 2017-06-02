<script>
    
    $(document).ready(function() {
        
        
        jQuery("#fmop").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#operativo",
                     beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  
    
        $(".calendario").datepicker({
            yearRange: '1900:2050',
            dateFormat: 'yy-mm-dd',
            showOn: 'both',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });   

    }
        
)
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("ProductiveBaseline", array("id" => "fmop", 'url' => array('controller' => 'ProductiveBaselines', "action" => "operative_edit", $this->data['ProductiveBaseline']['id']))); ?>
        <?php echo $this->Form->input('ProductiveBaseline.id', array('label' => 'id', 'class' => '')); ?>
        <?php echo $this->Form->hidden('ProductiveBaseline.sincronizado', array('value' => 0)); ?>
        <table border="1">
            <thead>
                <tr>
                    <th>6.2 ¿Realiza algún proceso de transformación en la finca?</th>
                    <th><?php echo $this->Form->input('ProductiveBaseline.proceso_de_transformacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">   <?php echo $this->Form->input('ProductiveBaseline.nombre_proceso', array('label' => '¿Cuál?', 'class' => '')); ?></td>
                </tr>
            </tbody>
        </table>
        <table border="1">
            <thead>
                <tr>
                    <th>6.3 Principales problemas en la producción, cosecha y post cosecha comercialización:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>   
                        <?php echo $this->Form->input('ProductiveBaseline.problemas_vias', array('label' => 'Vías', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('ProductiveBaseline.problemas_transporte', array('label' => 'Transporte', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('ProductiveBaseline.problemas_precio', array('label' => 'Precio', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('ProductiveBaseline.problemas_calidad', array('label' => 'Calidad', 'class' => '')); ?>
                        <br>
                        <?php echo $this->Form->input('ProductiveBaseline.problemas_competencia', array('label' => 'Competencia', 'class' => '')); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="1">
            <thead>
                <tr>
                    <th>Observaciones:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>   
                        <?php echo $this->Form->input('ProductiveBaseline.observaciones', array('label' => '', 'class' => '')); ?>   
                    </td>
                </tr>
            </tbody>
        </table>

        <table border="1">
            <thead>
                <tr>
                    <th colspan="2">CONTROL OPERATIVO</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Número de formulario</td>
                    <td><?php echo $this->Form->input('ProductiveBaseline.formulario', array('label' => '', 'class' => '')); ?></td>
                </tr>
                <tr>
                    <td>Fecha de la entrevista</td>
                    <td><?php echo $this->Form->input('ProductiveBaseline.fecha_entrevista', array('type' => 'text', 'class' => 'calendario')); ?></td>
                </tr>

                <tr>
                    <td>Número de visitas</td>
                    <td><?php echo $this->Form->input('ProductiveBaseline.numero_visitas', array('label' => '', 'class' => '')); ?></td>
                </tr>
                <tr>
                    <td>Nombre del coordinador</td>
                    <td>        <?php echo $this->Form->input('ProductiveBaseline.nombre_coordinador', array('label' => '', 'class' => '')); ?></td>
                </tr>
            </tbody>
        </table>




        <?php echo $this->Form->input('ProductiveBaseline.encuestador', array('label' => 'Encuestador', 'class' => '')); ?>
        <?php echo $this->Form->hidden('ProductiveBaseline.user_id', array('label' => 'user_id', 'class' => '')); ?>
        <?php echo $this->Form->hidden('ProductiveBaseline.property_id', array('label' => 'property_id', 'class' => '')); ?>
        <?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>