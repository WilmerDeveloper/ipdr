
<table>
    <thead>
        <tr>
            <td colspan="2">
                <?php
                if (empty($this->data))
                    echo $this->Ajax->link('Adicionar', array('controller' => 'GenderInstitutionalSupports', 'action' => 'add', $poll_id), array('update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones'));
                else
                    echo $this->Ajax->link('Editar', array('controller' => 'GenderInstitutionalSupports', 'action' => 'edit', $this->data['GenderInstitutionalSupport']['id']), array('class' => 'acciones', 'update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
                ?>
            </td>
        </tr>
    </thead>
    <?php if (!empty($this->data)): ?>
    <tbody>

        <tr>
            <td>
                <?php echo $this->Form->hidden('GenderInstitutionalSupport.id'); ?>
                <fieldset>
                    <legend>GÉNERO Y APOYO INSTITUCIONAL</legend>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.propietario_mujer_cabeza_familia', array('empty' => '', 'disabled' => 1, 'label' => '4.1 ¿El propietario es mujer cabeza de familia?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_incoder', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Del INCORA/ INCODER')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_otra_entidad', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Otra Entidad')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_otra_entidad_cual', array('disabled' => 1, 'label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Nombre otra entidad')); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.beneficiario_servicios_incoder', array('empty' => '', 'disabled' => 1, 'label' => '4.3 ¿Usted es beneficiario de los servicios que presta el INCODER?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <h2>4.4 ¿De cuáles servicios del INCODER es usted beneficiario?:</h2>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_titulacion_baldios', array('disabled' => 1, 'label' => 'a. Titulación de baldios')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_adecuacion_tierras', array('disabled' => 1, 'label' => 'b. Adecuación de tierras')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_subsidio_integral_tierras', array('disabled' => 1, 'label' => 'c. Subsidio integral de tierras')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_procesos_agrarios', array('disabled' => 1, 'label' => 'd. Procesos agrarios')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_comunidad_afro', array('disabled' => 1, 'label' => 'e. Comunidad Afro')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_proyecto_productivo', array('disabled' => 1, 'label' => 'f. Proyectos productivos')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_comunidad_indigena', array('disabled' => 1, 'label' => 'g. Comunidad indigena')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_FNA', array('disabled' => 1, 'label' => 'h. FNA')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_RUPTA', array('disabled' => 1, 'label' => 'i. RUPTA')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_ZRC', array('disabled' => 1, 'label' => 'j. ZRC')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_ZDE', array('disabled' => 1, 'label' => 'k. ZDE')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_otro', array('disabled' => 1, 'label' => 'l. Otro')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.servico_otro_cual', array('disabled' => 1, 'label' => '¿Cuál?')); ?>
                    <hr/>
                    <h2>4.5 ¿Desde cuándo es beneficiario de los servicios que presta el INCODER?:</h2>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.meses_servicio_incoder', array('disabled' => 1, 'label' => 'Meses')); ?>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.anios_servicio_incoder', array('disabled' => 1, 'label' => 'Años')); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.acceso_otros_servicios_estado', array('empty' => '', 'disabled' => 1, 'label' => '4.6 ¿Tiene o ha tenido acceso a otros servicios del Estado?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
                    <hr/>
                    <?php echo $this->Form->input('GenderInstitutionalSupport.apoyo_institucional', array('empty' => '', 'disabled' => 1, 'label' => '4.7 Apoyo institucional', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>

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
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_inurbe', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_INURBE', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Caja o Banco Agrario</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_banco_agrario', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c. DPS (Acción Social)*</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_DPS', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>d. ICBF (Instituto Colombiano de Bienestar Familiar)</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_ICBF', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>e. SENA (Servicio Nacional de Aprendizaje)</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_SENA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>f. INCODER (Instituto Colombiano de Desarrollo Rural)</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_INCODER', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>g. Federación Nacional de Cafeteros</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_federacion_cafeteros', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td rowspan="4">Local</td>
                                <td>a. UMATA (Unidad Municipal de Asistencia Técnica Agropecuaria)</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_umata', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_UMATA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Alcaldía</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_alcaldia', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c. CONSEA</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_CONSEA', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>d. CMDR</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_CMDR', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td rowspan="3">Departamental</td>
                                <td>a. Gobernación</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_gobernacion', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>b. Secretaria de Agricultura y/o Desarrollo económico</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_secretaria_agricultura', array('disabled' => 1, 'label' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>c.Otro</td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_otro', array('disabled' => 1, 'label' => '')); ?></td>
                                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_otro', array('disabled' => 1, 'label' => '')); ?></td>
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
    echo $this->Ajax->link('Editar', array('controller' => 'GenderInstitutionalSupports', 'action' => 'edit', $this->data['GenderInstitutionalSupport']['id']), array('class' => 'acciones', 'update' => 'genero_y_apoyo', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
?>
