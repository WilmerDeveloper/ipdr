
<table>
    <thead>
        <tr>
            <td>
                <?php
                if (empty($this->data))
                    echo $this->Ajax->link('Adicionar', array('controller' => 'QualityOfLives', 'action' => 'add', $poll_id), array('class'=>'acciones', 'update' => 'calidad_de_vida', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
                else
                    echo $this->Ajax->link('Editar', array('controller' => 'QualityOfLives', 'action' => 'edit', $this->data['QualityOfLife']['id']), array('class'=>'acciones', 'update' => 'calidad_de_vida', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
                ?>
            </td>
        </tr>
    </thead>
    <?php if (!empty($this->data)):?>
    <tbody>

        <tr>
            <td>
                <fieldset>
                    <legend>CALIDAD DE VIDA</legend>
                    <?php
                    echo $this->Form->input('QualityOfLife.tenencia_de_la_vivienda', array('empty' => '', 'disabled' => 1, 'label' => '5.1 Tenencia de la vivienda',
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
                    echo $this->Form->input('QualityOfLife.fuente_compra', array('empty' => '', 'disabled' => 1, 'label' => '5.2 ¿Cuáles de las siguientes fuentes utilizaron para la compra o construcción de la vivienda?',
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
                    <?php echo $this->Form->input('QualityOfLife.acueducto', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.electricidad', array('disabled' => 1, 'label' => 'Electricidad')); ?>
                    <?php echo $this->Form->input('QualityOfLife.celular', array('disabled' => 1, 'label' => 'Celular')); ?>
                    <?php echo $this->Form->input('QualityOfLife.internet', array('disabled' => 1, 'label' => 'Conexión a internet')); ?>
                    <?php echo $this->Form->input('QualityOfLife.alcantarillado', array('disabled' => 1, 'label' => 'Alcantarillado')); ?>
                    <?php echo $this->Form->input('QualityOfLife.telefonia', array('disabled' => 1, 'label' => 'Telefonía')); ?>
                    <?php echo $this->Form->input('QualityOfLife.pozo_septico', array('disabled' => 1, 'label' => 'Pozo séptico')); ?>
                    <?php echo $this->Form->input('QualityOfLife.planta_electrica', array('disabled' => 1, 'label' => 'Planta eléctrica')); ?>
                    <?php echo $this->Form->input('QualityOfLife.otro', array('disabled' => 1, 'label' => 'Otro')); ?>
                    <?php echo $this->Form->input('QualityOfLife.otro_cual', array('disabled' => 1, 'label' => '¿Cuál?')); ?>
                    <?php echo $this->Form->input('QualityOfLife.ninguno', array('disabled' => 1, 'label' => 'Ninguno')); ?>
                    <hr/>
                    <?php
                    echo $this->Form->input('QualityOfLife.material_pisos', array('empty' => '', 'disabled' => 1, 'label' => '5.4 Material predominante de los pisos',
                        'options' => array(
                            'tierra' => 'tierra',
                            'baldosa' => 'baldosa',
                            'cemento' => 'cemento',
                            'madera' => 'madera',
                            'alfombra' => 'alfombra',
                            'otro' => 'otro'
                            )));
                    ?>
                    <?php echo $this->Form->input('QualityOfLife.otro_material_piso', array('disabled' => 1, 'label' => 'Otro, ¿Cuál?')); ?>
                    <hr/>
                    <?php
                    echo $this->Form->input('QualityOfLife.material_paredes', array('empty' => '', 'disabled' => 1, 'label' => '5.5 Material predominante de las paredes exteriores',
                        'options' => array(
                            'ladrillo bloque' => 'ladrillo bloque',
                            'adobe' => 'adobe',
                            'bahareque o guadua' => 'bahareque o guadua',
                            'madera' => 'madera',
                            'otro' => 'otro'
                            )));
                    ?>
                    <?php echo $this->Form->input('QualityOfLife.otro_material_paredes', array('disabled' => 1, 'label' => 'Otro, ¿Cuál?')); ?>
                    <hr/>
                    <?php
                    echo $this->Form->input('QualityOfLife.material_techo', array('empty' => '', 'disabled' => 1, 'label' => '5.6 Material predominante de los techos',
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
                    <?php echo $this->Form->input('QualityOfLife.otro_material_techo', array('disabled' => 1, 'label' => 'Otro, ¿Cuál?')); ?>
                    <hr/>
                    5.7 ¿De dónde obtiene el agua la vivienda?
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_acueducto_publico', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_acueducto_comunal', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pila_publica', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pozo_sin_bomba', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_rio', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_pozo_con_bomba', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_lluvia', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_carrotanque', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <?php echo $this->Form->input('QualityOfLife.agua_vivienda_aguatero', array('disabled' => 1, 'label' => 'Acueducto')); ?>
                    <hr/>
                    <h3>5.8 Disponibilidad del agua para consumo humano</h3>
                    <?php
                    echo $this->Form->input('QualityOfLife.disponibilidad_agua_verano', array('empty' => '', 'disabled' => 1, 'label' => 'Disponibilidad agua verano',
                        'options' => array(
                            'abundante' => 'abundante',
                            'necesaria' => 'necesaria',
                            'escasa' => 'escasa'
                            )));
                    ?>
                    <?php
                    echo $this->Form->input('QualityOfLife.disponibilidad_agua_invierno', array('empty' => '', 'disabled' => 1, 'label' => 'Disponibilidad agua invierno',
                        'options' => array(
                            'abundante' => 'abundante',
                            'necesaria' => 'necesaria',
                            'escasa' => 'escasa'
                            )));
                    ?>
                    <hr/>
                    <?php
                    echo $this->Form->input('QualityOfLife.cocina', array('empty' => '', 'disabled' => 1, 'label' => '5.9 ¿Con qué cocinan principalmente en el hogar?',
                        'options' => array(
                            'leña o carbón de leña' => 'leña o carbón de leña',
                            'gas natural' => 'gas natural',
                            'estufa de gasolina' => 'estufa de gasolina',
                            'gas propano' => 'gas propano',
                            'estufa eléctrica' => 'estufa eléctrica',
                            'otro' => 'otro'
                            )));
                    ?>
                    <?php echo $this->Form->input('QualityOfLife.cocina_otro', array('disabled' => 1, 'label' => 'Otro, ¿Cuál?')); ?>
                    <hr/>
                    <?php echo $this->Form->input('QualityOfLife.anios_construccion_vivienda', array('disabled' => 1, 'label' => '5.10 Años de construcción de la vivienda')); ?>
                    <hr/>

                    <?php
                    echo $this->Form->input('QualityOfLife.servicio_sanitario', array('empty' => '', 'disabled' => 1, 'label' => '5.11 ¿Con qué tipo de servicio sanitario cuenta el hogar?',
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
                    echo $this->Form->input('QualityOfLife.eliminacion_basura', array('empty' => '', 'disabled' => 1, 'label' => '5.12 ¿Cómo eliminan principalmente la basura en este hogar?',
                        'options' => array(
                            'la queman' => 'la queman',
                            'la entierran' => 'la entierran',
                            'la tiran al río, caño, quebrada, o laguna' => 'la tiran al río, caño, quebrada, o laguna',
                            'la tiran al patio, lote, zanja o baldío' => 'la tiran al patio, lote, zanja o baldío',
                            'la recoge un servicio informal' => 'la recoge un servicio informal'
                            )));
                    ?>    

            </td>
        </tr>



    </tbody>
</table>
<?php endif; ?>

<?php
if (!empty($this->data))
     echo $this->Ajax->link('Editar', array('controller' => 'QualityOfLives', 'action' => 'edit', $this->data['QualityOfLife']['id']), array('class'=>'acciones', 'update' => 'calidad_de_vida', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?>