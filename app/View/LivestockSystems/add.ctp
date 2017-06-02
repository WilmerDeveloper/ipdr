
<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#sistema_pecuario"
                });
            }
        });  }
        
)
</script>
<div>
    <?php echo $this->Form->create("LivestockSystem", array("id" => "formulario", 'url' => array('controller' => 'LivestockSystems', "action" => "add",$productive_baseline_id))); ?>
    <?php echo $this->Form->input('LivestockSystem.id', array('label' => 'id', 'class' => '')); ?>
    <fieldset>6.1 Area en pastos:
        <?php echo $this->Form->input('LivestockSystem.area_pastos_mejorados', array('label' => 'Área pastos_mejorados', 'class' => '')); ?>
        <?php echo $this->Form->input('LivestockSystem.area_pastos_corte', array('label' => 'Área pastos de corte', 'class' => '')); ?>
        <?php echo $this->Form->input('LivestockSystem.area_pastos_tradicionales', array('label' => 'Área pastos tradicionales', 'class' => '')); ?>
    </fieldset>
    <br/>
    <hr/>
    <div style="border: solid 1px; border-color: #003399"><legend>6.2 Existe ganado vacuno en el Predio el día de la entrevista  </legend>

        <div style="border: solid 1px; border-color: #003399">
            <fieldset> 
                <?php echo $this->Form->input('LivestockSystem.existe_ganado', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                <?php echo $this->Form->input('LivestockSystem.especie_predominante', array('label' => 'Raza o cruce de ganado predominante', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.numero_partos', array('label' => 'No. de partos en el último año', 'class' => '')); ?>
            </fieldset>
        </div>

        <div style="border: solid 1px; border-color: #003399">
            <fieldset> inventario de ganado:
                <?php echo $this->Form->input('LivestockSystem.machos_menores_doce', array('label' => 'Machos menores de 12 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.hembras_menores_doce', array('label' => 'Hembras menores de 12 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.machos_menores_23', array('label' => 'Machos de 12 a 23 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.hembras_menores_23', array('label' => 'Hembras de 12 a 23 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.machos_menores_36', array('label' => 'Machos de 20 a 36 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.hembras_menores_36', array('label' => 'Hembras de 20 a 36 meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.machos_mayores_36', array('label' => 'Machos mayores de 36  meses', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.hembras_mayores_36', array('label' => 'Hembras mayores 36 meses ', 'class' => '')); ?>
            </fieldset>
        </div>
        <div style="border: solid 1px; border-color: #003399">
            <fieldset> inventario de ganado:
                <?php echo $this->Form->input('LivestockSystem.orientacion_principal', array('label' => 'Orientación principal del hato', 'class' => '', 'empty' => '', 'options' => array('Leche' => 'Leche', 'Cria y levante' => 'Cria y levante', 'Ceba' => 'Ceba', 'Ciclo completo' => 'Ciclo completo', 'doble utilidad' => 'doble utilidad'))); ?>
            </fieldset>
        </div>
        <div style="border: solid 1px; border-color: #003399">
            <fieldset>¿Cuál de las siguientes tecnologías reproductivas utilizó durante el año 2012?:
                <?php echo $this->Form->input('LivestockSystem.inseminacion', array('label' => 'Inseminación artificial', 'class' => '')); ?>
                <?php echo $this->Form->input('LivestockSystem.monta_natural', array('label' => 'Monta Natural', 'class' => '')); ?>
            </fieldset>
        </div>
    </div>
    <div style="border: solid 1px; border-color: #003399">
        <fieldset>
            <?php echo $this->Form->input('LivestockSystem.marca_ganado', array('label' => '6.3 ¿Marca el ganado?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        </fieldset>
    </div>

    <div style="border: solid 1px; border-color: #003399">
        <fieldset>
            <?php echo $this->Form->input('LivestockSystem.vacuna', array('label' => '6.4 ¿Vacuna sus animales?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('LivestockSystem.aftosa', array('label' => 'Fiebre Aftosa', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('LivestockSystem.brucelosis', array('label' => 'Brucelosis', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>   
        </fieldset>
    </div>
    <div style="border: solid 1px; border-color: #003399">
        <fieldset>6.5 ¿Con qué instalaciones cuenta el Predio?
            <?php echo $this->Form->input('LivestockSystem.corrales', array('label' => 'Corrales de manejo', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.equipo_ordeno', array('label' => 'Equipo de ordeño macanizado', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.bascula', array('label' => 'Báscula', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.brete', array('label' => 'Brete', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.tanque', array('label' => 'Tanque de frío', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.otro', array('label' => 'Otro,¿Cual?', 'class' => '')); ?>
        </fieldset>
    </div>
    <div style="border: solid 1px; border-color: #003399">
        <fieldset>6.6 ¿Hubo producción de leche en el Predio al día anterior a la entrevista?  
            <?php echo $this->Form->input('LivestockSystem.produccion_leche', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
            <?php echo $this->Form->input('LivestockSystem.cantidad_vacas', array('label' => 'Cantidad de vacas en ordeño', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.cantidad_leche', array('label' => 'Cantidad de leche (Total)', 'class' => '')); ?>
            <div style="border: solid 1px; border-color: #003399">
                <fieldset>Unidades de medida:
                    <?php echo $this->Form->input('LivestockSystem.nombre_unidad', array('label' => 'Nombre de la unidad', 'class' => '')); ?>
                    <?php echo $this->Form->input('LivestockSystem.unidad_en_litros', array('label' => 'Equivalencia en litros', 'class' => '')); ?>
                </fieldset>
            </div>
            <div style="border: solid 1px; border-color: #003399">
                <fieldset>Destino de la producción de leche (Cantidad de leche)
                    <?php echo $this->Form->input('LivestockSystem.procesada_en_finca', array('label' => 'Procesada en finca', 'class' => '')); ?>
                    <?php echo $this->Form->input('LivestockSystem.consumida_en_finca', array('label' => 'Consumida en finca', 'class' => '')); ?>
                    <div style="border: solid 1px; border-color: #003399">
                        <fieldset>Vendida a:                 
                            <?php echo $this->Form->input('LivestockSystem.vendida_industria', array('label' => 'Industria', 'class' => '')); ?>
                            <?php echo $this->Form->input('LivestockSystem.vendida_intermediario', array('label' => 'Intermediario', 'class' => '')); ?>
                            <?php echo $this->Form->input('LivestockSystem.vendida_otro', array('label' => 'Otro', 'class' => '')); ?>
                        </fieldset>
                    </div>
                </fieldset>
            </div>
        </fieldset>
    </div>

    <div>
        <fieldset>
            <?php echo $this->Form->input('LivestockSystem.promedio_produccion', array('label' => 'Número de días promedio en producción lechera por vaca (Periodo de lactancia)', 'class' => '')); ?>
            <?php echo $this->Form->input('LivestockSystem.litros_vendidos', array('label' => 'Litros Vendidos/año:', 'class' => '')); ?>
        </fieldset>
    </div>
    <?php echo $this->Form->hidden('LivestockSystem.productive_baseline_id', array('label' => 'productive_baseline_id', 'type' => 'text', 'value' => $productive_baseline_id)); ?>
    <?php echo $this->Form->end("Guardar") ?>
</div>