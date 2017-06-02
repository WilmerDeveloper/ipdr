<fieldset>
    <?php echo $this->Form->create("Proyect", array('class' => 'form', "action" => "add_proyect")); ?>
    <?php echo $this->Form->hidden('Proyect.sincronizado', array('value' => 0)); ?>
    <fieldset><legend></legend>

        <table border="0">

            <tbody>
                <tr>
                    <td><?php echo $this->Form->input('Proyect.call_id', array('label' => 'Convocatoria', 'class' => 'required')); ?></td>
                    <td><?php echo $this->Form->input('Proyect.codigo', array('label' => 'Código', 'class' => 'required')); ?></td>
                    <td><?php echo $this->Form->input('Property.nombre', array('label' => 'Nombre del predio', 'class' => '')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.matricula', array('label' => 'Número de Matrícula', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('Property.cedula_catastral', array('label' => 'Número de Cédula Catastral', 'class' => '', 'type' => 'number')); ?></td>
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
                    <td><?php echo $this->Form->input('Property.origen', array('label' => 'Origen del predio', 'empty' => '', 'options' => array('FNA' => 'FNA (Fondo Nacional del Ahorro)', 'DNE' => 'DNE (Dirección Nacional de Estupefacientes)', 'Baldíos' => 'Baldíos', 'Acuicultura' => 'Acuicultura', 'Compra Directa' => 'Compra Directa'))); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </fieldset>


    <fieldset><legend>Resolucíon de adjudicación</legend>
        <table border="0">

            <tbody>
                <tr>
                    <td><?php echo $this->Form->input('Property.numero_resolucion', array('label' => 'Número  de la resolución', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('Property.fecha_resolucion', array('label' => 'Fecha de la resolución', 'class' => 'calendario', 'type' => 'text')); ?></td>
                    <td><?php echo $this->Form->input('Property.area_total', array('label' => 'Área total (ha)')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.area_productiva', array('label' => 'Área productiva (ha)')); ?></td>
                    <td><?php echo $this->Form->input('Property.uaf', array('label' => 'UAF')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_campesinas', array('label' => 'Número familias campesinas')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.familias_desplazadas', array('label' => 'Número familias desplazados')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_negritudes', array('label' => 'Número familias negritudes')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_indigenas', array('label' => 'Número familias indigenas')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('Property.madres_cabeza', array('label' => 'Número  madres cabeza de familia')); ?></td>
                    <td><?php echo $this->Form->input('Property.otras_familias', array('label' => 'Número otras familias')); ?></td>
                    <td><?php echo $this->Form->input('Property.familias_indigenas', array('label' => 'Número familias indigenas')); ?></td>
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
            </tbody>
        </table>



        </fielset>

        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

    </fieldset>


    <table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>