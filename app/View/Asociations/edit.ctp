<script>


    $(document).ready(function() {
        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
           
            
        });
        jQuery("#form2").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
           
            
        });
       
        $('#convenios').load('<?php echo $this->Html->url(array('controller' => 'Conventions', 'action' => 'index', $this->data['Asociation']['id'])) ?>');
    });
</script>
<?php echo $this->Form->create("Asociation", array("id" => "form1", "action" => "edit/".$this->data['Asociation']['id'])); ?>
<?php echo $this->Form->input('Asociation.id'); ?>
<fieldset><legend>6.1 ¿Pertenece a alguna Organización? </legend>
    <?php echo $this->Form->input('Asociation.nombre', array('label' => 'Nombre organización', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Asociation.comercializacion', array('label' => '6.2 ¿Comercializan a través de la organización? ', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('Asociation.informacion_financiera', array('label' => '6.3 ¿Conoce la situación financiera de su organización?   ', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('Asociation.infraestructura', array('label' => '6.4 ¿La organización tiene infraestructura propia', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No',))); ?>
</fieldset>
<fieldset><legend>6.5 ¿Qué tipo de infraestructura tiene su organización?</legend>


    <table border="0">

        <tbody>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.tierras', array('label' => 'Tierras', 'class' => '')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.oficinas', array('label' => 'Oficinas', 'class' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.maquinaria', array('label' => 'Maquinaria', 'class' => '')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.herramientas', array('label' => 'Herramientas', 'class' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.cultivos', array('label' => 'Cultivos', 'class' => '')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.centros_acopio', array('label' => 'Centros de acopio', 'class' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.otro_estructura', array('label' => 'otro ¿Cual?', 'class' => '')); ?>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

</fieldset>


    <fieldset><legend>6.6 ¿Cómo toman decisiones en la organización?</legend>


    <table border="0">

        <tbody>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.decision_consenso', array('label' => 'Consenso', 'class' => '')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.decision_consejo', array('label' => 'Consejo directivo', 'class' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.decision_director', array('label' => 'Director', 'class' => '')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.decision_asamblea', array('label' => 'Asamblea', 'class' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.decision_no_sabe', array('label' => 'No sabe', 'class' => '')); ?>
                </td>

                <td>
                    <?php echo $this->Form->input('Asociation.decision_otro', array('label' => 'otro ¿Cual?', 'class' => '')); ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>

   <fieldset><legend> 6.7 Frecuencia con que se presentan las siguientes situaciones  en la asociación</legend>
    <table border="0">

        <tbody>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.apoyo_agricola', array('label' => 'Apoyo mutuo en las labores agrícolas ', 'class' => 'required', 'empty' => '', 'options' => array('Nunca' => 'Nunca', 'Casi nunca' => 'Casi nunca', 'A veces' => 'A veces', 'Siempre' => 'Siempre',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.apoyo_familiar', array('label' => 'Apoyo ante problemas familiares ', 'class' => 'required', 'empty' => '', 'options' => array('Nunca' => 'Nunca', 'Casi nunca' => 'Casi nunca', 'A veces' => 'A veces', 'Siempre' => 'Siempre',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.experiencias_agricultores', array('label' => 'Intercambio de experiencias entre agricultores', 'class' => 'required', 'empty' => '', 'options' => array('Nunca' => 'Nunca', 'Casi nunca' => 'Casi nunca', 'A veces' => 'A veces', 'Siempre' => 'Siempre',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.participacion', array('label' => 'Participación activa en las actividades programadas ', 'class' => 'required', 'empty' => '', 'options' => array('Nunca' => 'Nunca', 'Casi nunca' => 'Casi nunca', 'A veces' => 'A veces', 'Siempre' => 'Siempre',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.reuniones', array('label' => 'Reuniones de integración ', 'class' => 'required', 'empty' => '', 'options' => array('Nunca' => 'Nunca', 'Casi nunca' => 'Casi nunca', 'A veces' => 'A veces', 'Siempre' => 'Siempre',))); ?>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</fieldset>

<?php echo $this->Form->hidden('Asociation.beneficiary_id'); ?>



<legend>6.8 ¿La asociación cuenta con convenios o alianzas con otros productores /asociaciones / empresas e instituciones?  </legend>

<div id="convenios">

</div>
<?php echo $this->Form->create("Asociation", array("id" => "form2", "action" => "edit/".$this->data['Asociation']['id'])); ?>
<?php echo $this->Form->input('Asociation.id'); ?>
<fieldset>
    <legend>7.1	Señale el nivel de confianza que tiene con los siguientes actores?</legend>
    <table border="0">

        <tbody>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_lideres', array('label' => 'Líderes de la asociación', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_socios', array('label' => 'Socios de la asociación', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_vecinos', array('label' => 'Vecinos de la localidad ', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_intermediarios', array('label' => 'Intermediarios', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_comerciantes', array('label' => 'Los comerciantes mayoristas', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_empresarios', array('label' => 'Empresarios', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_autoridades', array('label' => 'Autoridades locales', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Asociation.confianza_tecnicos', array('label' => 'Técnicos agropecuarios', 'class' => 'required', 'empty' => '', 'options' => array('Nada' => 'Nada', 'Poca' => 'Poca', 'Mediana' => 'Mediana', 'Alta' => 'Alta',))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->Form->input('Asociation.observaciones', array('label' => 'observaciones', 'class' => 'required')); ?>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</fieldset>
<?php echo $this->Form->hidden('Asociation.beneficiary_id'); ?>
<?php echo $this->Form->end("Guardar") ?>
