<script>


    $(document).ready(function() {
       
        $('#fuentes').load('<?php echo $this->Html->url(array('controller' => 'WaterSources', 'action' => 'index', $this->data['Home']['id'])) ?>');
        $('#homes').load('<?php echo $this->Html->url(array('controller' => 'PublicServices', 'action' => 'index', $this->data['Home']['id'])) ?>');
        $('#devices').load('<?php echo $this->Html->url(array('controller' => 'devices', 'action' => 'index', $this->data['Home']['id'])) ?>');
        $('#activos').load('<?php echo $this->Html->url(array('controller' => 'Assets', 'action' => 'index', $this->data['Home']['id'])) ?>');
        $('#livestocks').load('<?php echo $this->Html->url(array('controller' => 'LiveStocks', 'action' => 'index', $this->data['Home']['id'])) ?>');
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true,
            active: false
        
        });
        
        jQuery("#form3").validate({
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
        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
          
        });
        
        
        
          
    });
</script>

<div id="accordion" >

    <h3> <a>VIVIENDA</a></h3>
    <div>
        <?php echo $this->Form->create("Home", array("id" => "form1", "action" => "edit/" . $this->data['Home']['id'])); ?>
        <?php echo $this->Form->input('Home.id'); ?>
        <fieldset>

            <?php echo $this->Form->input('Home.tenencia', array('label' => '4.1 La tenencia de su vivienda es', 'class' => 'required', 'empty' => '', 'options' => array('Arriendo' => 'Arriendo', 'Propia' => 'Propia', 'Familiar' => 'Familiar', 'Bajo su cuidado' => 'Bajo su cuidado', 'Otro' => 'Otro'))); ?>
            <?php echo $this->Form->input('Home.otro_tenencia', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
            <?php echo $this->Form->input('Home.tipo', array('label' => '4.2 Tipo de vivienda', 'class' => 'required', 'empty' => '', 'options' => array('Casa' => 'Casa', 'Apto' => 'Apto','Habitación' => 'Habitación', 'Otro' => 'Otro',))); ?>
            <?php echo $this->Form->input('Home.tipo_otro', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
        </fieldset>
        <fieldset>
            4.3 Los espacios de su vivienda son
            <table border="1">

                <tbody>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('Home.sala', array('label' => 'Sala', 'class' => '')); ?>
                        </td>
                        <td>
                            <?php echo $this->Form->input('Home.comedor', array('label' => 'Comedor', 'class' => '')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('Home.cocina', array('label' => 'Cocina', 'class' => '')); ?>
                        </td>
                        <td>
                            <?php echo $this->Form->input('Home.banio', array('label' => 'Baño', 'class' => '')); ?>
                        </td>
                    </tr>
                </tbody>
            </table>


            <?php echo $this->Form->input('Home.cantidad_habitaciones', array('label' => '4.3.1 Cantidad de habitaciones de la vivienda incluyendo cocina y áreas sociales', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Home.personas_habitan', array('label' => '4.3.2 Cantidad de personas que duermen en la vivienda', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Home.materiales', array('label' => '4.4 Material predominante de las paredes exteriores', 'class' => 'required', 'empty' => '', 'options' => array('Ladrillo bloque' => 'Ladrillo bloque', 'Adobe' => 'Adobe', 'Bahareque o guadua' => 'Bahareque o guadua', 'Madera' => 'Madera', 'Otro' => 'Otro',))); ?>
            <?php echo $this->Form->input('Home.otro_material', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
            <?php echo $this->Form->input('Home.techo', array('label' => '4.5 Material predominante de los techos', 'class' => 'required', 'empty' => '', 'options' => array('Tejas de barro' => 'Tejas de barro', 'Tejas de eternit' => 'Tejas de eternit', 'Zinc' => 'Zinc', 'Plastico' => 'Plastico', 'Paja o palma' => 'Paja o palma', 'Otro' => 'Otro',))); ?>
            <?php echo $this->Form->input('Home.techo_otro', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
        </fieldset>

        <?php echo $this->Form->hidden('Home.beneficiary_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>

    </div>
    <h3> <a>SERVICIOS PÚBLICOS</a></h3>
    <div>
        <fieldset>
            <legend>4.6 ¿Con cuáles de los servicios Públicos cuenta la vivienda?</legend>
            <div id="homes">

            </div>
        </fieldset>
        <fieldset>
            <legend> 4.8 ¿De donde obtiene el agua la vivienda?</legend>
            <div id="fuentes">

            </div>
        </fieldset>
        <?php echo $this->Form->create("Home", array("id" => "form2", "action" => "edit/" . $this->data['Home']['id'])); ?>
        <?php echo $this->Form->input('Home.id'); ?>
        <fieldset>
            <?php echo $this->Form->input('Home.piso', array('label' => '4.7 Material predominante de los pisos', 'class' => 'required', 'empty' => '', 'options' => array('Tierra' => 'Tierra', 'Baldosa' => 'Baldosa', 'Cemento' => 'Cemento', 'Otro' => 'Otro',))); ?>
            <?php echo $this->Form->input('Home.piso_otro', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
        </fieldset>



        <fieldset> <legend>4.9 ¿Con qué tipo de servicio sanitario cuenta el hogar?</legend>
            <table border="1">

                <tbody>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('Home.inodoro_alcantarillado', array('label' => 'Inodoro conectado a alcantarillado', 'class' => '')); ?>
                        </td>
                        <td>
                            <?php echo $this->Form->input('Home.inodoro_desconectado', array('label' => 'Inodoro sin conexión', 'class' => '')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('Home.inodoro_pozo', array('label' => 'c. Inodoro conectado a pozo séptico', 'class' => '')); ?>
                        </td>
                        <td>
                            <?php echo $this->Form->input('Home.letrina', array('label' => 'Letrina o bajamar', 'class' => '')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('Home.inodoro_sin', array('label' => 'No tiene servicio sanitario', 'class' => '')); ?>

                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>


        </fieldset>
        <fieldset><legend>4.10 ¿Con qué cocinan principalmente en el hogar?</legend>



            <?php echo $this->Form->input('Home.combustible_coccion', array('label' => '', 'class' => 'required', 'empty' => '', 'options' => array('Leña' => 'Leña', 'Gas propano' => 'Gas propano', 'Gas natural' => 'Gas natural', 'Estufa eléctrica' => 'Estufa eléctrica', 'Estufa gasolina' => 'Estufa gasolina', 'Otro' => 'Otro',))); ?>
            <?php echo $this->Form->input('Home.otro_combustible_coccion', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
        </fieldset>
        <?php echo $this->Form->hidden('Home.beneficiary_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>

    </div>
    <h3> <a>BIENES</a></h3>
    <div>
        <fieldset><legend> 4.11 ¿Cuáles de  bienes posee éste hogar?</legend>
            <div id="devices" >

            </div>
        </fieldset>  

        <fieldset><legend>4.12 Activos de la finca</legend>
            <div id="activos" >

            </div>
        </fieldset>  

        <fieldset><legend>4.13 Ganado vacuno, aves de corral y otras especies que posee la familia</legend>
            <div id="livestocks" >

            </div>
        </fieldset>  
    </div>
    <h3> <a>INFORMACIÓN SOBRE CONDICIONES DE VIDA</a></h3>
    <div>
        <?php echo $this->Form->create("Home", array("id" => "form3", "action" => "edit/" . $this->data['Home']['id'])); ?>
        <?php echo $this->Form->input('Home.id'); ?>

        <fieldset>
            <fieldset>
                <?php echo $this->Form->input('Home.area_adjudicada', array('label' => '4.14.	¿Cuál es el tamaño del predio que le fue adjudicado por INCODER? Expresado en hectáreas', 'class' => 'required')); ?>
            </fieldset>
            <fieldset>
                <legend>4.15  ¿Cuál o cuáles son los principales usos que  le dan a la tierra?</legend>
                <p>(Ordene por uso prioritario u orden de importancia las actividades que realiza el predio. Siendo 1 el más importante, si no realiza la actividad déjela en blanco)</p>


                <table border="0">

                    <tr>
                        <td><?php echo $this->Form->input('Home.uso_agricola', array('label' => 'Agícola', 'class' => 'required')); ?></td>
                        <td><?php echo $this->Form->input('Home.uso_pecuario', array('label' => 'Pecuario', 'class' => 'required')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Home.uso_piscicola', array('label' => 'Piscícola', 'class' => 'required')); ?></td>
                        <td><?php echo $this->Form->input('Home.uso_apicola', array('label' => 'Apícola', 'class' => 'required')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Home.uso_forestal', array('label' => 'Agroforestería', 'class' => 'required')); ?></td>
                        <td><?php echo $this->Form->input('Home.uso_pastos', array('label' => 'Pastos', 'class' => 'required')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Home.uso_avicola', array('label' => 'Avícola', 'class' => 'required')); ?></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>






            </fieldset>
            <fieldset><legend>4.16 Ingresos:</legend>
                <?php echo $this->Form->input('Home.personas_ingresos', array('label' => 'a. ¿Cuantas personas aportan ingresos al hogar? ', 'class' => '')); ?>
                <!--se agrega campo ingreso_cabeza-->
                <?php echo $this->Form->input('Home.ingreso_cabeza', array('label' => '4.16b ¿Cuál es el ingreso mensual del jefe del hogar?', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.ingreso_mensual_promedio', array('label' => '4.16c Considerando todas las entradas de dinero en su hogar, de cuanto es el  ingreso mensual promedio (Incluya el jefe del hogar)', 'class' => '')); ?>
            </fieldset>

            <fieldset><legend>4.17 ¿Cuánto gasta su familia mensualmente en... ?</legend>
                <table border="0">

                    <tbody>
                        <tr>
                            <td><?php echo $this->Form->input('Home.gasto_alimentos', array('label' => 'Alimentación', 'class' => '', 'type' => 'number')); ?></td>
                            <td>
                                <?php echo $this->Form->input('Home.gasto_servicios', array('label' => 'Servicios', 'class' => '', 'type' => 'number')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>                
                                <?php echo $this->Form->input('Home.gasto_educacion', array('label' => 'Educación', 'class' => '', 'type' => 'number')); ?>
                            </td>
                            <td>               
                                <?php echo $this->Form->input('Home.gasto_transporte', array('label' => 'Transporte', 'class' => '', 'type' => 'number')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>                
                                <?php echo $this->Form->input('Home.gasto_salud', array('label' => 'Salud', 'class' => '', 'type' => 'number')); ?>
                            </td>
                            <td>               
                                <?php echo $this->Form->input('Home.gasto_arriendo', array('label' => 'Arriendo', 'class' => '', 'type' => 'number')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>                
                                <?php echo $this->Form->input('Home.gasto_entretenimiento', array('label' => 'Entretenimiento', 'class' => '', 'type' => 'number')); ?>
                            </td>
                            <td>               
                                <?php echo $this->Form->input('Home.gasto_comunicaciones', array('label' => 'Comunicaciones', 'class' => '', 'type' => 'number')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>               
                                <?php echo $this->Form->input('Home.gasto_deudas', array('label' => 'Pago deudas', 'class' => '', 'type' => 'number')); ?>
                            </td>
                            <td>               
                                <?php echo $this->Form->input('Home.gasto_otros', array('label' => 'Otros', 'class' => '', 'type' => 'number')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">                
                                <?php echo $this->Form->input('Home.descripcion_otros_gastos', array('label' => 'Descripción otros gastos', 'class' => '')); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </fieldset>
            <fieldset><legend>4.18	De acuerdo con las siguientes actividades económicas identifique las tres que generan más ingresos para usted y su familia.   Ordene de 1 a 3,  siendo 1 el más importante. </legend>
                <?php echo $this->Form->input('Home.actividad_economica_1', array('label' => 'Primera', 'class' => 'required', 'empty' => '', 'options' => array('Agricultura' => 'Agricultura', 'Pesca' => 'Pesca', 'Ganaderia' => 'Ganaderia', 'Comercio' => 'Comercio', 'Transporte' => 'Transporte', 'Mano de obra en la comunidad' => 'Mano de obra en la comunidad', 'Mano de obra no en la comunidad' => 'Mano de obra no en la comunidad', 'Artesanias' => 'Artesanias', 'Bares y restaurantes' => 'Bares y restaurantes', 'Servicio domestico' => 'Servicio domestico', 'Jornalero' => 'Jornalero', 'Otra' => 'Otra',))); ?>
                <?php echo $this->Form->input('Home.actividad_economica_2', array('label' => 'Segunda', 'class' => '', 'empty' => '', 'options' => array('Agricultura' => 'Agricultura', 'Pesca' => 'Pesca', 'Ganaderia' => 'Ganaderia', 'Comercio' => 'Comercio', 'Transporte' => 'Transporte', 'Mano de obra en la comunidad' => 'Mano de obra en la comunidad', 'Mano de obra no en la comunidad' => 'Mano de obra no en la comunidad', 'Artesanias' => 'Artesanias', 'Bares y restaurantes' => 'Bares y restaurantes', 'Servicio domestico' => 'Servicio domestico', 'Jornalero' => 'Jornalero', 'Otra' => 'Otra',))); ?>
                <?php echo $this->Form->input('Home.actividad_economica_3', array('label' => 'Tercera', 'class' => '', 'empty' => '', 'options' => array('Agricultura' => 'Agricultura', 'Pesca' => 'Pesca', 'Ganaderia' => 'Ganaderia', 'Comercio' => 'Comercio', 'Transporte' => 'Transporte', 'Mano de obra en la comunidad' => 'Mano de obra en la comunidad', 'Mano de obra no en la comunidad' => 'Mano de obra no en la comunidad', 'Artesanias' => 'Artesanias', 'Bares y restaurantes' => 'Bares y restaurantes', 'Servicio domestico' => 'Servicio domestico', 'Jornalero' => 'Jornalero', 'Otra' => 'Otra',))); ?>
            </fieldset>
            <fieldset><legend>4.19	Medios de transporte que su familia utiliza </legend>
                <?php echo $this->Form->input('Home.transporte_carro', array('label' => 'Carro', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_moto', array('label' => 'Moto', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_bicicleta', array('label' => 'Bicicleta', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_animal', array('label' => 'Tracción animal', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_publico', array('label' => 'Publico', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_fluvial', array('label' => 'Fluvial', 'class' => '')); ?>
                <?php echo $this->Form->input('Home.transporte_otro', array('label' => 'Otro ¿Cual?', 'class' => '')); ?>
            </fieldset>
            <fieldset>
                <?php echo $this->Form->input('Home.observacion', array('label' => 'Otro ¿Cual?', 'class' => '')); ?>

            </fieldset>

        </fieldset>



        <?php echo $this->Form->hidden('Home.beneficiary_id'); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </div>



</div>








