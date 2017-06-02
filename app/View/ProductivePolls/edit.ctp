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
        jQuery("#form3").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form4").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true,
            active: false
        
        });
        
        $('#areas').load('<?php echo $this->Html->url(array('controller' => 'ProductiveAreas', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#consumo').load('<?php echo $this->Html->url(array('controller' => 'Consumptions', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#institucion').load('<?php echo $this->Html->url(array('controller' => 'Lenders', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#canales').load('<?php echo $this->Html->url(array('controller' => 'MarketingLines', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#practicas').load('<?php echo $this->Html->url(array('controller' => 'Practices', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#certificaciones').load('<?php echo $this->Html->url(array('controller' => 'certifications', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#transformaciones').load('<?php echo $this->Html->url(array('controller' => 'Transformations', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#empaques').load('<?php echo $this->Html->url(array('controller' => 'Wrappers', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
        $('#problemas').load('<?php echo $this->Html->url(array('controller' => 'ProductiveProblems', 'action' => 'index', $this->data['ProductivePoll']['id'])) ?>');
    }
    
    
    
);

</script>

<div id="accordion">
    <h3><a href="#">INFORMACIÓN BÁSICA</a></h3>
    <div >
        <fieldset>
            <?php echo $this->Form->create("ProductivePoll", array('id' => 'form1', "action" => "edit/" . $this->data['ProductivePoll']['beneficiary_id'])); ?>
            <?php echo $this->Form->hidden('ProductivePoll.id'); ?>
            <?php echo $this->Form->hidden('ProductivePoll.beneficiary_id'); ?>
            <?php echo $this->Form->input('ProductivePoll.cultivo_incoder', array('label' => '5.1. ¿Ud. Está cultivando o produciendo en el predio que es beneficiario del INCODER?',  'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('ProductivePoll.dominio_parcela', array('label' => '5.2. La parcela donde cultiva es: ',  'empty' => '', 'options' => array('Propia' => 'Propia', 'Alquilada' => 'Alquilada', 'Prestada' => 'Prestada', 'En sociedad' => 'En sociedad',))); ?>
            <?php echo $this->Form->end("Guardar") ?>
        </fieldset>
    </div>
    <h3><a href="#">ÁREA DE ACTIVIDADES</a></h3>
    <div id="areas">
    </div>
    <h3><a href="#">VOLUMEN DE PRODUCCIÓN Y PERDIDAS</a></h3>
    <div>
        <?php echo $this->Form->create("ProductivePoll", array('id' => 'form2', "action" => "edit/" . $this->data['ProductivePoll']['beneficiary_id'])); ?>
        <?php echo $this->Form->hidden('ProductivePoll.id'); ?>

        <fieldset><legend>5.5</legend>
            <?php echo $this->Form->input('ProductivePoll.volumen_cultivo_primario', array('label' => 'A. ¿Cómo ha sido el volumen total de producción del cultivo principal durante el último año en comparación con el promedio de hace dos años?', 'class' => '', 'empty' => '', 'options' => array('Se ha mantenido igual' => 'Se ha mantenido igual', 'Ha mejorado' => 'Ha mejorado', 'Ha disminuido' => 'Ha disminuido', 'Perdió' => 'Perdió'))); ?>
            <?php echo $this->Form->input('ProductivePoll.concepto_cultivo_primario', array('label' => 'B. ¿Por qué disminuyo o perdió?', 'class' => '')); ?>
        </fieldset>
        <fieldset><legend>5.6</legend>
            <?php echo $this->Form->input('ProductivePoll.volumen_cultivo_secundario', array('label' => 'A. ¿Cómo ha sido el volumen total de producción del cultivo secundario durante el último año en comparación con el promedio de hace dos años?', 'class' => '', 'empty' => '', 'options' => array('Se ha mantenido igual' => 'Se ha mantenido igual','Ha mejorado' => 'Ha mejorado', 'Ha disminuido' => 'Ha disminuido', 'Perdió' => 'Perdió'))); ?>
            <?php echo $this->Form->input('ProductivePoll.concepto_cultivo_secundario', array('label' => 'B. ¿Por qué disminuyo o perdió??', 'class' => '')); ?>
        </fieldset>
        <fieldset><legend>5.7</legend>
            <?php echo $this->Form->input('ProductivePoll.perdidas', array('label' => 'A. ¿En el último año tuvo pérdidas en la producción por bajos precios bajos?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('ProductivePoll.porcentaje_perdidas', array('label' => 'B. Porcentaje de perdida por precios bajos', 'class' => '', 'type' => 'number')); ?>
        </fieldset>    
        <?php echo $this->Form->end("Guardar") ?> 
    </div>
    <h3><a href="#">DISTRIBUCIÓN DE LA PRODUCCIÓN PARA EL AUTOCONSUMO </a></h3>
    <div id="consumo">

    </div>

    <h3><a href="#">ASISTENCIA TÉCNICA</a></h3>
    <div>
        <?php echo $this->Form->create("ProductivePoll", array('id' => 'form3', "action" => "edit/" . $this->data['ProductivePoll']['beneficiary_id'])); ?>
        <?php echo $this->Form->hidden('ProductivePoll.id'); ?>
        <?php echo $this->Form->hidden('ProductivePoll.beneficiary_id'); ?>
        <fieldset><legend></legend>
            <?php echo $this->Form->input('ProductivePoll.asistencia_tecnica2', array('label' => '5.9	En los últimos 12 meses, ¿Recibieron o contrataron Asistencia Técnica para el desarrollo de  actividades agrícolas, forestales o pecuarias?',  'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_tecnica', array('label' => '5.9a	La asistencia fue brindada por: ',  'empty' => '', 'options' => array('UMATA (Secretaria de Agricultura Municipal)' => 'UMATA (secretaria de Agricultura Municipal)', 'Secretaría de Agricultura Departamental' => 'Secretaría de Agricultura Departamental', 'EPSAGRO' => 'EPSAGRO', 'Gremios' => 'Gremios', 'Universidad' => 'Universidad', 'Particular (agrónomo técnico  veterinario  zootecnista o administrador agropecuario)' => 'Particular (agrónomo técnico  veterinario  zootecnista o administrador agropecuario)', 'SENA' => 'SENA', 'ONG' => 'ONG',))); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_otro', array('label' => 'Otro', 'class' =>'')); ?>

        </fieldset>

        <fieldset><legend> La  asistencia técnica se concentró en aspectos de: </legend> 
            <?php echo $this->Form->input('ProductivePoll.asistencia_ciclo_produccion', array('label' => 'Ciclo de producción', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_manejo_cultivo', array('label' => 'Manejo del cultivo', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_comercializacion', array('label' => 'Comercialización de los productos de la finca ', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_asociatividad', array('label' => 'Asociatividad', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_financiera', array('label' => 'Gestión financiera', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.asistencia_proyecto', array('label' => 'Gestión de proyectos ', 'class' => '')); ?>
        </fieldset>
        <?php echo $this->Form->end("Guardar") ?>
    </div>
    <h3><a href="#">CRÉDITO</a></h3>
    <div>
        <?php echo $this->Form->create("ProductivePoll", array('id' => 'form4', "action" => "edit/" . $this->data['ProductivePoll']['beneficiary_id'])); ?>
        <?php echo $this->Form->hidden('ProductivePoll.id'); ?>
        <?php echo $this->Form->hidden('ProductivePoll.beneficiary_id'); ?>

        <fieldset><legend></legend>
            <?php echo $this->Form->input('ProductivePoll.cuenta_bancaria', array('label' => '5.10 ¿Algún miembro del hogar tiene actualmente cuenta bancaria?  (Ya sea de ahorro o corriente)', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('ProductivePoll.solicitud_credito', array('label' => '5.11 Durante los ÚLTIMOS DOCE MESES, ¿ha solicitado crédito  para el desarrollo de sus actividades agropecuarias?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('ProductivePoll.otorgacion_credito', array('label' => '5.12a ¿Le otorgaron el crédito?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No', 'No han respondido' => 'No han respondido',))); ?>

        </fieldset>
        <fieldset>
            <legend>¿Por qué se lo negaron?</legend>
            <?php echo $this->Form->input('ProductivePoll.negado_garantias', array('label' => 'Falta de garantías', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.negado_por_historia', array('label' => 'Falta de historia crediticia', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.negado_por_reporte', array('label' => 'Esta reportado en centrales de riesgo ', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.negado_por_capacidad', array('label' => 'No demostró capacidad de pago', 'class' => '')); ?>
            <?php echo $this->Form->input('ProductivePoll.negado_por_documentos', array('label' => 'No tenia los documentos solicitados para el trámite', 'class' => '')); ?>
        </fieldset>
        <?php
        //echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'ProductivePolls', 'action' => 'edit', $this->data['ProductivePoll']['beneficiary_id']), 'update' => 'content', 'indicator' => 'loading'));
        echo $this->Form->end('Guardar');
        ?>
        <fieldset>
            <legend>5.12b b. ¿A cuáles de las siguientes entidades o personas solicitó crédito?</legend>
            <div id="institucion">

            </div>
        </fieldset>
    </div>
    <h3><a href="#">COMERCIALIZACIÓN DE PRODUCTOS</a></h3>
    <div id="canales">
    </div>
    <h3><a href="#">PRÁCTICAS</a></h3>
    <div id="practicas">
    </div>
    <h3><a href="#">CERTIFICACIÓN Y/O REGISTRO</a></h3>
    <div id="certificaciones">
    </div>
    <h3><a href="#">TRANSFORMACIÓN DE PRODUCTOS</a></h3>
    <div id="transformaciones">
    </div>
    <h3><a href="#">EMPAQUE O EMBALAJE</a></h3>
    <div id="empaques">
    </div>
    <h3><a href="#">PROBLEMAS</a></h3>
    <div id="problemas">
    </div>
</div> 