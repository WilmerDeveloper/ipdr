<script>
    $(document).ready(function() {
        jQuery("#producerAdd").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#caracterizacion", 
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            },
            rules: {
                //usando el name del campo
                'data[Producer][porcentaje_plano]': {
                    required: true,
                    max: 100
                },
                'data[Producer][porcentaje_ondulado]': {
                    required: true,
                    max: 100
                },
                'data[Producer][porcentaje_quebrado]': {
                    required: true,
                    max: 100
                }
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
        <?php echo $this->Form->create("Producer", array("id" => "producerAdd", 'url' => array("action" => "add", $property_id))); ?>
        <?php echo $this->Form->input('Producer.id', array('label' => 'id',)); ?>
        <?php echo $this->Form->hidden('Producer.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->input('Producer.nombre', array('label' => '2.1 Nombre del Productor, Jefe o Cabeza de FAMILIA: ', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Producer.tipo_identificacion', array('label' => '2.2 Tipo identificación', 'class' => 'required', 'empty' => '', 'options' => array('C.C' => 'C.C', 'T.I' => 'T.I'))); ?>
        <?php echo $this->Form->input('Producer.numero_identificacion', array('label' => '2.2 Número identificación', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Producer.telefono_fijo', array('label' => '2.3 Número teléfono fijo',)); ?>
        <?php echo $this->Form->input('Producer.celular', array('label' => '2.4 Número de celular',)); ?>
        <?php echo $this->Form->input('Producer.email', array('label' => '2.4 correo electrónico', 'class' => 'email')); ?>
<?php echo $this->Form->input('Producer.relacion_predio', array('label' => '2.5 Relación con el manejo del predio', 'empty' => '', 'options' => array('Dueño del predio' => 'Dueño del predio', 'Administrador del predio' => 'Administrador del predio', 'Trabajador permanente' => 'Trabajador permanente', 'Familiar del dueño / administrador' => 'Familiar del dueño / administrador', 'Otro' => 'Otro'))); ?>
        <br>
        <br>
<?php echo $this->Form->input('Producer.tipo_adquisicion', array('label' => '2.6  ¿Cómo adquirió el predio?', 'empty' => '', 'options' => array('Compra Informal' => 'Compra Informal', 'Adjudicación' => 'Adjudicación', 'Ocupación' => 'Ocupación', 'Donación' => 'Donación', 'Permuta Informal' => 'Permuta Informal', 'Cesión' => 'Cesión', 'Arriendo' => 'Arriendo'))); ?>

        <div>
            <fieldset>2.7 ¿De cuáles servicios del INCODER es usted beneficiario?: 
                <?php echo $this->Form->input('Producer.baldios', array('label' => 'Titulación de baldios',)); ?>
                <?php echo $this->Form->input('Producer.adecuacion_tierras', array('label' => 'Adecuación de tierras',)); ?>
                <?php echo $this->Form->input('Producer.sit', array('label' => 'Subsidio integral de tierras',)); ?>
                <?php echo $this->Form->input('Producer.procesos_agrarios', array('label' => 'Procesos agrarios',)); ?>
                <?php echo $this->Form->input('Producer.comunidad_afro', array('label' => 'Comunidad Afro',)); ?>
                <?php echo $this->Form->input('Producer.proyectos_productivos', array('label' => 'Proyectos productivos',)); ?>
                <?php echo $this->Form->input('Producer.comunidad_indigena', array('label' => 'Comunidad indigena',)); ?>
                <?php echo $this->Form->input('Producer.rupta', array('label' => 'RUPTA',)); ?>
                <?php echo $this->Form->input('Producer.zrc', array('label' => 'ZRC',)); ?>
                <?php echo $this->Form->input('Producer.zde', array('label' => 'ZDE',)); ?>
<?php echo $this->Form->input('Producer.otro_cual', array('label' => 'Otro ¿Cual?',)); ?>

            </fieldset>
        </div>
        <fieldset>2.8 ¿Hace   cuánto   recibió   el   Predio  o  Subsidio  del INCODER?
            <?php echo $this->Form->input('Producer.meses_adjudicacion', array('label' => 'Meses adjudicación',)); ?>
        <?php echo $this->Form->input('Producer.anios_adjudicacion', array('label' => 'Años adjudicación',)); ?>    
        </fieldset>
        <?php echo $this->Form->input('Producer.documento_predio', array('label' => '2.9 ¿Tiene usted algún documento del predio?  ', 'empty' => '', 'options' => array('Escritura pública' => 'Escritura pública', 'Resolución INCORA' => 'Resolución INCORA', 'Resolución INCODER' => 'Resolución INCODER', 'Sentencia Judicial' => 'Sentencia Judicial'))); ?>
        <?php echo $this->Form->input('Producer.estado_resolucion', array('label' => '2.10 Estado de Resolución :', 'empty' => '', 'options' => array('Adjudicación' => 'Adjudicación', 'Modificación Parcial' => 'Modificación Parcial', 'Negociación' => 'Negociación', 'Constitución' => 'Constitución', 'Aclaración' => 'Aclaración', 'Modificación parciál' => 'Modificación parciál', 'Modificación Total' => 'Modificación Total', ' Negociación' => ' Negociación', 'Revocatoria' => 'Revocatoria'))); ?>
        <?php echo $this->Form->input('Producer.tipo_resolucion', array('label' => '2.12 La Resolución pertenece a:',)); ?>
        <?php echo $this->Form->input('Producer.direccion_teritorial', array('label' => 'Dirección teritorial',)); ?>

        <?php echo $this->Form->input('Producer.vinculo_predio', array('label' => '2.9 Vinculo con el predio:', 'empty' => '', 'options' => array('Colono' => 'Colono', 'Aparcería' => 'Aparcería', 'Propietario' => 'Propietario', 'Posesión' => 'Posesión', 'Arrendatario' => 'Arrendatario', 'Tenedor' => 'Tenedor', 'Ocupante' => 'Ocupante', 'Administrador' => 'Administrador', 'Uso Fructuario' => 'Uso Fructuario'))); ?>
        <?php echo $this->Form->input('Producer.numero_resolucion', array('label' => '2.11 Número de la Resolución:',)); ?>
        <?php echo $this->Form->input('Producer.fecha_adjudicacion', array('label' => '2.13 Fecha de expedición de la Resolución:', 'class' => 'calendario')); ?>
        <?php echo $this->Form->input('Producer.matricula_inmobiliaria', array('label' => '2.14 Folio de Matricula  Inmobiliaria  N°:',)); ?>
        <?php echo $this->Form->input('Producer.codigo_catastral', array('label' => '2.15 Código Catastral N°:',)); ?>
<?php echo $this->Form->input('Producer.uaf', array('label' => '2.16 Unidad Agrícola Familiar (UAF) de la zona a la que pertenece el predio:',)); ?>

        <br>
        <br>
        <div>
            <fieldset>2.10Topografía:
                <?php echo $this->Form->input('Producer.porcentaje_plano', array('label' => 'Porcentaje plano',)); ?>
                <?php echo $this->Form->input('Producer.porcentaje_ondulado', array('label' => 'Porcentaje ondulado',)); ?>
                <?php echo $this->Form->input('Producer.porcentaje_quebrado', array('label' => 'Porcentaje quebrado',)); ?>
<?php echo $this->Form->hidden('Producer.property_id', array('type' => 'text', 'value' => $property_id,)); ?>
            </fieldset>  
        </div>

<?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>
</div>