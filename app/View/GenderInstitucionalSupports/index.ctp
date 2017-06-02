
<table>
    <thead>
        <tr>
            <td colspan="2">
                <?php
                if (empty($this->data))
                    echo $this->Ajax->link('Adicionar', array('controller' => 'GenderInstitucionalSupports', 'action' => 'add', $poll_id), array('update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones'));
                else
                    echo $this->Ajax->link('Editar', array('controller' => 'GenderInstitucionalSupports', 'action' => 'edit', $this->data['GenderInstitucionalSupport']['id']), array('class' => 'acciones', 'update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
                ?>
            </td>
        </tr>
    </thead>
    <?php if (!empty($this->data)): ?>
    <tbody>

        <tr>
            <td>
                <?php echo $this->Form->hidden('GenderInstitucionalSupport.id'); ?>
                <fieldset>
                    <legend>GÉNERO Y APOYO INSTITUCIONAL</legend>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.propietario_mujer_cabeza_familia', array('empty' => '', 'disabled' => 1, 'label' => '4.1 ¿El propietario es mujer cabeza de familia?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_incoder', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Del INCORA/ INCODER')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_otra_entidad', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Otra Entidad')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_otra_entidad_cual', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Nombre otra entidad')); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.beneficiario_servicios_incoder', array('empty' => '', 'disabled' => 1, 'label' => '4.3 ¿Usted es beneficiario de los servicios que presta el INCODER?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <h2>4.4 ¿De cuáles servicios del INCODER es usted beneficiario?:</h2>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_titulacion_baldios', array('disabled' => 1, 'label' => 'a. Titulación de baldios')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_adecuacion_tierras', array('disabled' => 1, 'label' => 'b. Adecuación de tierras')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_subsidio_integral_tierras', array('disabled' => 1, 'label' => 'c. Subsidio integral de tierras')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_procesos_agrarios', array('disabled' => 1, 'label' => 'd. Procesos agrarios')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_comunidad_afro', array('disabled' => 1, 'label' => 'e. Comunidad Afro')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_proyecto_productivo', array('disabled' => 1, 'label' => 'f. Proyectos productivos')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_comunidad_indigena', array('disabled' => 1, 'label' => 'g. Comunidad indigena')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_FNA', array('disabled' => 1, 'label' => 'h. FNA')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_RUPTA', array('disabled' => 1, 'label' => 'i. RUPTA')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_ZRC', array('disabled' => 1, 'label' => 'j. ZRC')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_ZDE', array('disabled' => 1, 'label' => 'k. ZDE')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_otro', array('disabled' => 1, 'label' => 'l. Otro')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.servico_otro_cual', array('disabled' => 1, 'label' => '¿Cuál?')); ?>
                    <hr/>
                    <h2>4.5 ¿Desde cuándo es beneficiario de los servicios que presta el INCODER?:</h2>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.meses_servicio_incoder', array('disabled' => 1, 'label' => 'Meses')); ?>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.anios_servicio_incoder', array('disabled' => 1, 'label' => 'Años')); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.acceso_otros_servicios_estado', array('empty' => '', 'disabled' => 1, 'label' => '4.6 ¿Tiene o ha tenido acceso a otros servicios del Estado?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitucionalSupport.apoyo_institucional', array('empty' => '', 'disabled' => 1, 'label' => '4.7 Apoyo institucional', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>

                    <table>
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Institución o Programa</th>
                                <th>Subsidio</th>
                                <th>Asistencia Técnica</th>
                                <th>Crédito</th>
                                <th>Obras</th>
                                <th>Otra</th>
                                <th>¿Cuál?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="7">Nacional</td>
                                <td>a. INURBE (Instituto Nacional de Vivienda de Interés Social)</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_inurbe', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Caja o Banco Agrario</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c. DPS (Acción Social)*</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>d. ICBF (Instituto Colombiano de Bienestar Familiar)</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>e. SENA (Servicio Nacional de Aprendizaje)</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>f. INCODER (Instituto Colombiano de Desarrollo Rural)</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>g. Federación Nacional de Cafeteros</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td rowspan="4">Local</td>
                                <td>a. UMATA (Unidad Municipal de Asistencia Técnica Agropecuaria)</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_umata', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Alcaldía</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c. CONSEA</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>d. CMDR</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td rowspan="3">Departamental</td>
                                <td>a. Gobernación</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Secretaria de Agricultura y/o Desarrollo económico</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c.Otro</td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_otro', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <p>* Familias Guardabosques, Familias en Acción, RESA</p>
            </td>
        </tr>

    </tbody>
</table>
<?php endif; ?>

<?php

if (!empty($this->data))
    echo $this->Ajax->link('Editar', array('controller' => 'GenderInstitucionalSupports', 'action' => 'edit', $this->data['GenderInstitucionalSupport']['id']), array('class' => 'acciones', 'update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
?>
