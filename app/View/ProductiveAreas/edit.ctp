<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#area"
                });
            }
        });  }
        
)
        
</script>
<div id="area">

    <?php echo $this->Form->create("ProductiveArea", array('id' => 'formulario', "action" => "edit/" . $this->data['ProductiveArea']['id'])); ?>
    <fieldset>
        <?php echo $this->Form->input('ProductiveArea.tipo_actividad', array('label' => '5.3.2 Tipo de actividad agropecuaria', 'class' => 'required', 'empty' => '', 'options' => array('Agrícola' => 'Agrícola', 'Pecuaria' => 'Pecuaria'))); ?>
        <?php echo $this->Form->input('ProductiveArea.productive_activity_id', array('label' => '5.3.3 Nombre de los cultivos solos o asociados, o explotación pecuaria', 'class' => 'required')); ?>
        <?php echo $this->Form->input('ProductiveArea.asociado', array('label' => '5.3.4 Tipo de Cultivo', 'class' => '', 'empty' => '', 'options' => array('Solo' => 'Solo', 'Asociado' => 'Asociado'))); ?>
        <?php echo $this->Form->input('ProductiveArea.unidad', array('label' => '5.3.5 Unidad de Superficie', 'class' => 'required', 'empty' => '', 'options' => array('ha' => 'ha', 'metro' => 'metro', 'metro cuadrado' => 'metro cuadrado'))); ?>
        <?php echo $this->Form->input('ProductiveArea.area', array('label' => '5.3.6 Área Total en el cultivo o explotación pecuaria ', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('ProductiveArea.otra_unidad', array('label' => 'Otra ¿Cuál?', 'class' => '')); ?>
        <?php echo $this->Form->input('ProductiveArea.densidad', array('label' => '5.3.7 Densidad (# plantas, peces, árboles, animales totales) ', 'class' => '')); ?>
        <?php echo $this->Form->input('ProductiveArea.frecuencia_produccion', array('label' => '5.4.3 Frecuencia de producción', 'class' => '', 'empty' => '', 'options' => array('Semanal' => 'Semanal', 'Quincenal' => 'Quincenal', 'Mensual' => 'Mensual', 'Trimestral' => 'Trimestral', 'Semanal' => 'Semanal', 'Anual' => 'Anual'))); ?>
        <?php echo $this->Form->input('ProductiveArea.volumen_producion', array('label' => '5.4.4 Producción total por frecuencia', 'class' => '')); ?>
        <?php echo $this->Form->input('ProductiveArea.unidad_produccion', array('label' => '5.4.5 Unidad de medida', 'class' => '', 'empty' => '', 'options' => array('Unidad'=>'Unidad','Tonelada' => 'Tonelada', 'Kilogramo' => 'Kilogramo', 'Bulto' => 'Bulto', 'Litro' => 'Litro'))); ?>
        <?php echo $this->Form->input('ProductiveArea.cosechas', array('label' => '5.4.6 Número de Cosechas al año', 'class' => '')); ?>
        <?php echo $this->Form->input('ProductiveArea.sistema_riego', array('label' => '5.4.7 ¿Tiene sistema de riego?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('ProductiveArea.tipo_riego', array('label' => '5.4.8 ¿Cuál?', 'class' => '', 'empty' => '', 'options' => array('Gravedad' => 'Gravedad', 'Aspersión' => 'Aspersión', 'Goteo' => 'Goteo'))); ?>
        <?php echo $this->Form->input('ProductiveArea.analisis_suelos', array('label' => '5.4.9a ¿Tiene análisis de Suelos?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('ProductiveArea.fecha_analisis', array('label' => '5.4.9b Fecha análisis', 'class' => 'calendario', 'type' => 'text')); ?>
        <?php echo $this->Form->hidden('ProductiveArea.id'); ?>
        <?php echo $this->Form->hidden('ProductiveArea.productive_poll_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>