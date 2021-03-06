<script>
    $("input,textarea").keyup(function() {
        if ($(this).attr('id') != 'usr') {
            $(this).val($(this).val().toUpperCase());
        }
    });
    formularioAjax();
</script>
<fieldset>
    <?php echo $this->Form->create("Property", array('class' => 'form', "action" => "add_property")); ?>
    <fieldset>
        <table border="0">
            <tbody>
                <tr>
                    <td colspan="2">
                        <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
                        <?php
                        echo $this->Form->hidden('Property.proyect_id', array('value' => '0'));

                        echo $this->Form->input('Property.nombre', array('label' => 'Nombre del predio', 'class' => 'required'));
                        ?>
                    </td>
                    <?php echo $this->Form->input('Property.call_id', array('label' => 'convocatoria', 'class' => 'required', 'empty' => '', 'options' => array('1' => '2012', '2' => '2013', '3' => '2014', '5' => '2015'))); ?>
                    <td>
                        <?php echo $this->Form->input('Property.tipo_tenencia', array('label' => 'Tipo tenencia', 'class' => 'required', 'empty' => '', 'options' => array('Propietario' => 'Propietario', 'Poseedor' => 'Poseedor'))); ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.matricula', array('label' => 'Matrícula inmobiliria', 'class' => 'required')); ?></td>
                    <td><?php echo $this->Form->input('Property.cedula_catastral', array('label' => 'Código catastral', 'class' => '')); ?></td>
                    <td>
                        <?php
                        echo $this->Ajax->observeField('PropertyDepartamentId', array(
                            'url' => array('action' => 'select', 'controller' => 'Properties'),
                            'frequency' => 0.2,
                            'update' => 'ciudades',
                                )
                        );
                        ?>
                        <?php echo $this->Form->input('Property.departament_id', array('label' => ' Departamento', 'class' => 'required', 'empty' => 'Seleccione departamento', 'options' => $departaments, 'class' => '')); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="ciudades">
                            <?php
                            echo $this->Form->input('Property.city_id', array(
                                'label' => __(' Municipio', true),
                                'empty' => __('Seleccione ciudad', true),
                                'class' => 'required'
                                    )
                            );
                            ?>
                        </div>
                    </td>
                    <td><?php echo $this->Form->input('Property.vereda', array('label' => 'Vereda', 'class' => '',)); ?></td>
                    <td><?php echo $this->Form->input('Property.corregimiento', array('label' => 'Corregimiento', 'class' => '',)); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.oficina_registro', array('label' => 'Oficina de registro', 'class' => '',)); ?></td>
                    <td><?php echo $this->Form->input('Property.origen', array('label' => 'Origen del predio', 'empty' => '', 'options' => array('FNA' => 'FNA (Fondo Nacional Agrario)', 'DNE' => 'DNE (Dirección Nacional de Estupefacientes)', 'Baldíos' => 'Baldíos', 'Acuicultura' => 'Acuicultura', 'Compra Directa' => 'Compra Directa', 'Zonas de reserva campesina' => 'Zonas de reserva campesina', 'Distritos de riego' => 'Distritos de riego', 'Resguardos indígenas' => 'Resguardos indígenas', 'Distrito adecuación de tierras' => 'Distrito adecuación de tierras', 'Consejo comunitario' => 'Consejo comunitario'))); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <table border="0">
            <tbody>
                <tr>
                    <td><?php echo $this->Form->input('Property.area_total_ha', array('label' => 'Área del predio (Ha)')); ?></td>
                    <td><?php echo $this->Form->input('Property.area_total_m', array('label' => 'Área del predio metros')); ?></td>
                    <td><?php echo $this->Form->input('Property.area_productiva', array('label' => 'Área productiva')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.uaf', array('label' => 'UAF (Ha)')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_campesinas', array('label' => 'Número familias campesinas')); ?></td>
                    <td><?php echo $this->Form->input('Property.madres_cabeza', array('label' => 'Número  madres cabeza de familia')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.familias_desplazadas', array('label' => 'Número familias desplazados')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_negritudes', array('label' => 'Número familias negritudes')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_indigenas', array('label' => 'Número familias indigenas')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.otras_familias', array('label' => 'Número otras familias')); ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <table border="0">
            <tbody>
                <tr>
                    <td><?php echo $this->Form->input('Property.actividad_productiva', array('label' => 'Actividad productiva actual', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('Property.nombre_organizacion', array('label' => 'Nombre de la organización (Si existe)', 'class' => '', 'type' => 'text')); ?></td>
                    <td><?php echo $this->Form->input('Property.total_familias_beneficiarios', array('label' => 'No. Flias beneficiarias actual en el predio *')); ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <legend>Coordenadas geográficas del predio</legend>
        <table border="0">
            <tbody>
                <tr>
                    <td><?php echo $this->Form->input('Property.georeferencia1', array('label' => 'Georeferenciación (escribir coordenada latitud-grado)', 'class' => '', 'type' => 'number')); ?></td>
                    <td><?php echo $this->Form->input('Property.georeferencia2', array('label' => 'Georeferenciación (escribir coordenadas latitud-minuto)', 'class' => '', 'type' => 'number')); ?></td>
                    <td><?php echo $this->Form->input('Property.georeferencia3', array('label' => 'Georeferenciación (escribir coordenadas latitud-segundo)', 'class' => '', 'type' => 'number')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.georeferencia4', array('label' => 'Georeferenciación (escribir coordenadas longitud-grado)', 'class' => '', 'type' => 'number')); ?></td>
                    <td><?php echo $this->Form->input('Property.georeferencia5', array('label' => 'Georeferenciación (escribir coordenadas longitud-minuto)', 'class' => '', 'type' => 'number')); ?></td>
                    <td><?php echo $this->Form->input('Property.georeferencia6', array('label' => 'Georeferenciación (escribir coordenadas longitud-segundo)', 'class' => '', 'type' => 'number')); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $this->Form->input('Property.dato_origen', array('label' => 'Dato de origen', 'class' => '')); ?></td>
                </tr>
            </tbody>
        </table>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>
    <table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>