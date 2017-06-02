<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#lineas"
                });
            }
        });  }
        
)
        
</script>
<div id="lineas">
    <fieldset>
        <?php echo $this->Form->create("MarketingLine", array("id" => "formulario", "action" => "edit/" . $this->data['MarketingLine']['id'])); ?>
        <?php echo $this->Form->hidden('MarketingLine.id'); ?>
        <?php echo $this->Form->hidden('MarketingLine.productive_poll_id'); ?>
        <?php echo $this->Form->input('MarketingLine.tipo_canal', array('empty' => '', 'label' => '5.13.1 Tipo canal', 'class' => 'required', 'options' => array('Asociación' => 'Asociación', 'Plaza de mercado' => 'Plaza de mercado', 'Intermediario' => 'Intermediario', 'Almacén de  cadena' => 'Almacén de  cadena', 'Tienda' => 'Tienda', 'Restaurante' => 'Restaurante', 'Industria' => 'Industria', 'Exportador' => 'Exportador', 'Otro ' => 'Otro ',))); ?>
        <?php echo $this->Form->input('MarketingLine.nombre_canal', array('label' => '5.13.2 Nombre del canal (empresa o ciudad)', 'class' => 'required')); ?>
        <?php echo $this->Form->input('MarketingLine.productive_activity_id', array('empty' => '', 'label' => '5.13.3 Producto', 'class' => 'required')); ?>
        <?php echo $this->Form->input('MarketingLine.variedad', array('label' => '5.13.4 Variedad', 'class' => '')); ?>
        <?php echo $this->Form->input('MarketingLine.calidad', array('empty' => '', 'label' => '5.13.5 Calidad', 'class' => '', 'options' => array('Primera' => 'Primera', 'Segunda' => 'Segunda', 'Tercera ' => 'Tercera ',))); ?>
        <fieldset>
            <legend>5.13.6 Meses de cosecha - venta (marque  los meses)</legend>
            <?php echo $this->Form->input('MarketingLine.enero', array('label' => 'Enero', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.febrero', array('label' => 'Febrero', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.marzo', array('label' => 'Marzo', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.abril', array('label' => 'Abril', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.mayo', array('label' => 'Mayo', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.junio', array('label' => 'Junio', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.julio', array('label' => 'Julio', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.agosto', array('label' => 'Agosto', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.septiembre', array('label' => 'Septiembre', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.octubre', array('label' => 'Octubre', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.noviembre', array('label' => 'Noviembre', 'class' => '')); ?>
            <?php echo $this->Form->input('MarketingLine.diciembre', array('label' => 'Diciembre', 'class' => '')); ?>
        </fieldset>
        <?php echo $this->Form->input('MarketingLine.unidad', array('label' => '5.13.7 Unidad', 'class' => '')); ?>

        <?php echo $this->Form->input('MarketingLine.unidades_anio', array('label' => '5.13.8 Cantidad Unidades/año', 'class' => '')); ?>
        <?php echo $this->Form->input('MarketingLine.precio_promedio_unidad', array('label' => '5.13.9 Precio promedio unidad', 'class' => '')); ?>
        <?php echo $this->Form->input('MarketingLine.entrega', array('empty' => '', 'label' => '5.13.10 Entrega', 'class' => '', 'options' => array('En finca' => 'En finca', 'Transporta hasta el canal' => 'Transporta hasta el canal',))); ?>
        <?php echo $this->Form->input('MarketingLine.precio_cosecha', array('empty' => '', 'label' => '5.13.11 El precio de la cosecha respecto al año anterior', 'class' => '', 'options' => array('Mejoro' => 'Mejoro', 'Empeoro' => 'Empeoro',))); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
</div>