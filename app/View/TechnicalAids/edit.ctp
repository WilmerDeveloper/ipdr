<script>

    $(document).ready(function() {


        jQuery("#formAst").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#asistencia",
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
    <?php echo $this->Form->create("TechnicalAid", array("id" => "formAst", 'url' => array('controller' => 'TechnicalAids', "action" => "edit", $this->data['TechnicalAid']['id']))); ?>
    <?php echo $this->Form->input('TechnicalAid.id', array('label' => 'id', 'class' => '')); ?>
    <table border="1">
        <thead>
            <tr>
                <th> ¿Recibió asistencia técnica?</th>
                <th> <?php echo $this->Form->input('TechnicalAid.recibe', array('label' => 'recibe', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>¿En qué?</td>
                <td>(si respondió no)¿Por qué?</td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.gestion', array('label' => 'Gestión', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.costos', array('label' => 'Costos', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.credito', array('label' => 'Crédito', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.no_requiere', array('label' => 'No requiere', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td>    <?php echo $this->Form->input('TechnicalAid.produccion', array('label' => 'Producción', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.desconocimiento', array('label' => 'Desconocimiento', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td>    <?php echo $this->Form->input('TechnicalAid.sanidad', array('label' => 'Sanidad', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.no_importante', array('label' => 'No lo considera importante', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td>    <?php echo $this->Form->input('TechnicalAid.ambiental', array('label' => 'Ambiental', 'class' => '')); ?></td>
                <td>    <?php echo $this->Form->input('TechnicalAid.otro_cual', array('label' => 'otro_cual', 'class' => '')); ?></td>

            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.organizacion', array('label' => 'Organización', 'class' => '')); ?></td>
                <td>  </td>
            </tr>
        </tbody>
    </table>


    <table border="1">
        <thead>
            <tr>
                <th>¿Quién prestó la asistencia técnica?</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>    <?php echo $this->Form->input('TechnicalAid.particular', array('label' => 'Particular (Profesionales, técnicos del sector)', 'class' => '')); ?></td>
            </tr>
            <tr>
                <td> 
                    <?php echo $this->Form->input('TechnicalAid.intitucional', array('label' => 'Institucional (Sena, Umatas, Universidades, Secretarías)', 'class' => '')); ?>

                </td>
            </tr>
            <tr>
                <td> 
                    <?php echo $this->Form->input('TechnicalAid.casa_comercial', array('label' => 'Organizaciones gremiales', 'class' => '')); ?>

                </td>
            </tr>
            <tr>
                <td> 
                    <?php echo $this->Form->input('TechnicalAid.otros', array('label' => 'Otros', 'class' => '')); ?>

                </td>
            </tr>
            <tr>
                <td> 
                    <?php echo $this->Form->input('TechnicalAid.no_informa', array('label' => 'No informa', 'class' => '')); ?>

                </td>
            </tr>

    </table>

    <table border="1">
        <thead>
            <tr>
                <th>¿En que requiere asistencia técnica?</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>  
                    <?php echo $this->Form->input('TechnicalAid.requiere_comercio', array('label' => 'Comercio', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.requiere_produccion', array('label' => 'produccion', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.requiere_credito', array('label' => 'Credito', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.requiere_sanidad', array('label' => 'Sanidad', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.requiere_ambiental', array('label' => 'Ambiental', 'class' => '')); ?>
                    <br>                   
                    <?php echo $this->Form->input('TechnicalAid.requiere_organizacion', array('label' => 'Organizacion', 'class' => '')); ?>                    
                </td>
            </tr>

    </table>












    <table border="1">
        <thead>
            <tr>
                <th colspan="2">    <?php echo $this->Form->input('TechnicalAid.area_finca', array('label' => 'Área de la finca', 'class' => '')); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td >Área productiva</td>
                <td >Área no  productiva</td>

            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.agricola', array('label' => 'Agrícola', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.bosques', array('label' => 'Bosques', 'class' => '')); ?></td>

            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.pecuaria', array('label' => 'Pecuaria', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.cuencas', array('label' => 'Cuencas', 'class' => '')); ?></td>

            </tr>
            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.acuicola', array('label' => 'Acuícola', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.rastrojos', array('label' => 'Rastrojos', 'class' => '')); ?></td>
            </tr>

            <tr>
                <td><?php echo $this->Form->input('TechnicalAid.otra_si', array('label' => 'Otra', 'class' => '')); ?></td>
                <td><?php echo $this->Form->input('TechnicalAid.otra_no', array('label' => 'Otra', 'class' => '')); ?></td>
            </tr>

        </tbody>
    </table>
    <table border="1">
        <thead>
            <tr>
                <th>¿Tiene sistema de riego?   </th>
                <th><?php echo $this->Form->input('TechnicalAid.sistema_riego', array('label' => '', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?> </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo $this->Form->input('TechnicalAid.gravedad', array('label' => 'Gravedad', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.aspersion', array('label' => 'Aspersión', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->input('TechnicalAid.goteo', array('label' => 'Goteo', 'class' => '')); ?>
                    <br>
                    <?php echo $this->Form->hidden('TechnicalAid.productive_baseline_id'); ?>
                </td>
            </tr>

        </tbody>
    </table>
    <?php echo $this->Form->hidden('TechnicalAid.sincronizado', array('value' => 0)); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>
