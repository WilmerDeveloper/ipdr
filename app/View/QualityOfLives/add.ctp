<script>
    $(document).ready(function() {
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#calidad_de_vida",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }
    )
</script>
<?php echo $this->Form->create("QualityOfLife", array('id' => 'formulario', "action" => "add/" . $poll_id)); ?>
<?php echo $this->Form->hidden('QualityOfLife.family_poll_id', array('value' => $poll_id)); ?>
<fieldset>
    <legend>CALIDAD DE VIDA</legend>
    <?php
    echo $this->Form->input('QualityOfLife.tenencia_de_la_vivienda', array('empty' => '', 'label' => '5.1 Tenencia de la vivienda',
        'options' => array(
            'Propia' => 'Propia',
            'totalmente pagada' => 'totalmente pagada',
            'Propia' => 'Propia',
            'la están pagando' => 'la están pagando',
            'En arriendo o subarriendo' => 'En arriendo o subarriendo',
            'Tenedor o poseedor no propietario' => 'Tenedor o poseedor no propietario',
            'Otra forma de tenencia' => 'Otra forma de tenencia'
    )));
    ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.fuente_compra', array('empty' => '', 'label' => '5.2 ¿Cuáles de las siguientes fuentes utilizaron para la compra o construcción de la vivienda?',
        'options' => array(
            'Recursos propios' => 'Recursos propios',
            'Crédito hipotecario o de consumo' => 'Crédito hipotecario o de consumo',
            'Préstamo parientes o amigos' => 'Préstamo parientes o amigos',
            'Ahorro programado' => 'Ahorro programado',
            'Subsidio' => 'Subsidio',
            'Otra' => 'Otra'
    )));
    ?>
    <hr/>
    <h3>5.3 ¿Con cuáles de los servicios Públicos cuenta la vivienda?</h3>
    <?php echo $this->Form->input('QualityOfLife.acueducto', array('label' => 'Acueducto')); ?>
    <?php echo $this->Form->input('QualityOfLife.electricidad', array('label' => 'Electricidad')); ?>
    <?php echo $this->Form->input('QualityOfLife.celular', array('label' => 'Celular')); ?>
    <?php echo $this->Form->input('QualityOfLife.internet', array('label' => 'Conexión a internet')); ?>
    <?php echo $this->Form->input('QualityOfLife.alcantarillado', array('label' => 'Alcantarillado')); ?>
    <?php echo $this->Form->input('QualityOfLife.telefonia', array('label' => 'Telefonía')); ?>
    <?php echo $this->Form->input('QualityOfLife.pozo_septico', array('label' => 'Pozo séptico')); ?>
    <?php echo $this->Form->input('QualityOfLife.planta_electrica', array('label' => 'Planta eléctrica')); ?>
    <?php echo $this->Form->input('QualityOfLife.otro', array('label' => 'Otro')); ?>
    <?php echo $this->Form->input('QualityOfLife.otro_cual', array('label' => '¿Cuál?')); ?>
    <?php echo $this->Form->input('QualityOfLife.ninguno', array('label' => 'Ninguno')); ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.material_pisos', array('empty' => '', 'label' => '5.4 Material predominante de los pisos',
        'options' => array(
            'tierra' => 'tierra',
            'baldosa' => 'baldosa',
            'cemento' => 'cemento',
            'madera' => 'madera',
            'alfombra' => 'alfombra',
            'otro' => 'otro'
    )));
    ?>
    <?php echo $this->Form->input('QualityOfLife.otro_material_piso', array('label' => 'Otro, ¿Cuál?')); ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.material_paredes', array('empty' => '', 'label' => '5.5 Material predominante de las paredes exteriores',
        'options' => array(
            'ladrillo bloque' => 'ladrillo bloque',
            'adobe' => 'adobe',
            'bahareque o guadua' => 'bahareque o guadua',
            'madera' => 'madera',
            'otro' => 'otro'
    )));
    ?>
    <?php echo $this->Form->input('QualityOfLife.otro_material_paredes', array('label' => 'Otro, ¿Cuál?')); ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.material_techo', array('empty' => '', 'label' => '5.6 Material predominante de los techos',
        'options' => array(
            'tejas de barro' => 'tejas de barro',
            'tejas eternit' => 'tejas eternit',
            'zinc' => 'zinc',
            'madera' => 'madera',
            'plástico' => 'plástico',
            'paja o palma' => 'paja o palma',
            'otro' => 'otro'
    )));
    ?>
    <?php echo $this->Form->input('QualityOfLife.otro_material_techo', array('label' => 'Otro, ¿Cuál?')); ?>
    <hr/>
    5.7 ¿De dónde obtiene el agua la vivienda?
   
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_acueducto_publico', array('label' => 'Acueducto público')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_acueducto_comunal', array('label' => 'Acueducto comunal')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pila_publica', array('label' => 'Pila pública')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pozo_sin_bomba', array('label' => 'Pozo sin bomba, aljibe o barreno')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_rio', array('label' => 'Río, quebrada, manantial, nacimiento')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pozo_con_bomba', array('label' => 'Pozo con bomba')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_lluvia', array('label' => 'Agua lluvia')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_carrotanque', array('label' => 'Carrotanque')); ?>
    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_aguatero', array('label' => 'Aguatero')); ?>
    <hr/>
    <h3>5.8 Disponibilidad del agua para consumo humano</h3>
    <?php
    echo $this->Form->input('QualityOfLife.disponibilidad_agua_verano', array('empty' => '', 'label' => 'Disponibilidad agua verano',
        'options' => array(
            'abundante' => 'abundante',
            'necesaria' => 'necesaria',
            'escasa' => 'escasa'
    )));
    ?>
    <?php
    echo $this->Form->input('QualityOfLife.disponibilidad_agua_invierno', array('empty' => '', 'label' => 'Disponibilidad agua invierno',
        'options' => array(
            'abundante' => 'abundante',
            'necesaria' => 'necesaria',
            'escasa' => 'escasa'
    )));
    ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.cocina', array('empty' => '', 'label' => '5.9 ¿Con qué cocinan principalmente en el hogar?',
        'options' => array(
            'leña o carbón de leña' => 'leña o carbón de leña',
            'gas natural' => 'gas natural',
            'estufa de gasolina' => 'estufa de gasolina',
            'gas propano' => 'gas propano',
            'estufa eléctrica' => 'estufa eléctrica',
            'otro' => 'otro'
    )));
    ?>
    <?php echo $this->Form->input('QualityOfLife.cocina_otro', array('label' => 'Otro, ¿Cuál?')); ?>
    <hr/>
    <?php echo $this->Form->input('QualityOfLife.anios_construccion_vivienda', array('label' => '5.10 Años de construcción de la vivienda')); ?>
    <hr/>

    <?php
    echo $this->Form->input('QualityOfLife.servicio_sanitario', array('empty' => '', 'label' => '5.11 ¿Con qué tipo de servicio sanitario cuenta el hogar?',
        'options' => array(
            'inodoro conectado a alcantarillado' => 'inodoro conectado a alcantarillado',
            'inodoro sin conexión' => 'inodoro sin conexión',
            'no tiene servicio sanitario' => 'no tiene servicio sanitario',
            'inodoro conectado a pozo séptico' => 'inodoro conectado a pozo séptico',
            'letrina o bajamar' => 'letrina o bajamar'
    )));
    ?>
    <hr/>
    <?php
    echo $this->Form->input('QualityOfLife.eliminacion_basura', array('empty' => '', 'label' => '5.12 ¿Cómo eliminan principalmente la basura en este hogar?',
        'options' => array(
            'la queman' => 'la queman',
            'la entierran' => 'la entierran',
            'la tiran al río, caño, quebrada, o laguna' => 'la tiran al río, caño, quebrada, o laguna',
            'la tiran al patio, lote, zanja o baldío' => 'la tiran al patio, lote, zanja o baldío',
            'la recoge un servicio informal' => 'la recoge un servicio informal'
    )));
    ?>
    <hr/>    
    <?php echo $this->Form->hidden('QualityOfLife.sincronizado', array('value' => 0, 'type' => 'text')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

</fieldset>