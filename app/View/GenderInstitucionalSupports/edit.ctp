<script>
    $(document).ready(function() {
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#genero_y_apoyo"
                });
            }
        });  }
)
</script>
<?php echo $this->Form->create("GenderInstitucionalSupport", array('id' => 'formulario', "action" => "edit/" . $this->data['GenderInstitucionalSupport']['id'])); ?>
<?php echo $this->Form->hidden('GenderInstitucionalSupport.family_poll_id', array('value' => $this->data['GenderInstitucionalSupport']['family_poll_id'])); ?>
<?php echo $this->Form->hidden('GenderInstitucionalSupport.id'); ?>
<fieldset>
    <legend>GÉNERO Y APOYO INSTITUCIONAL</legend>
    <?php echo $this->Form->input('GenderInstitucionalSupport.propietario_mujer_cabeza_familia', array('empty' => '', 'label' => '4.1 ¿El propietario es mujer cabeza de familia?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_incoder', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Del INCORA/ INCODER')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_otra_entidad', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Otra Entidad')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.programa_diferenciado_genero_otra_entidad_cual', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Nombre otra entidad')); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitucionalSupport.beneficiario_servicios_incoder', array('empty' => '', 'label' => '4.3 ¿Usted es beneficiario de los servicios que presta el INCODER?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <h2>4.4 ¿De cuáles servicios del INCODER es usted beneficiario?:</h2>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_titulacion_baldios', array('label' => 'a. Titulación de baldios')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_adecuacion_tierras', array('label' => 'b. Adecuación de tierras')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_subsidio_integral_tierras', array('label' => 'c. Subsidio integral de tierras')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_procesos_agrarios', array('label' => 'd. Procesos agrarios')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_comunidad_afro', array('label' => 'e. Comunidad Afro')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_proyecto_productivo', array('label' => 'f. Proyectos productivos')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_comunidad_indigena', array('label' => 'g. Comunidad indigena')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_FNA', array('label' => 'h. FNA')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_RUPTA', array('label' => 'i. RUPTA')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_ZRC', array('label' => 'j. ZRC')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_ZDE', array('label' => 'k. ZDE')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servicio_otro', array('label' => 'l. Otro')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.servico_otro_cual', array('label' => '¿Cuál?')); ?>
    <hr/>
    <h2>4.5 ¿Desde cuándo es beneficiario de los servicios que presta el INCODER?:</h2>
    <?php echo $this->Form->input('GenderInstitucionalSupport.meses_servicio_incoder', array('label' => 'Meses')); ?>
    <?php echo $this->Form->input('GenderInstitucionalSupport.anios_servicio_incoder', array('label' => 'Años')); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitucionalSupport.acceso_otros_servicios_estado', array('empty' => '', 'label' => '4.6 ¿Tiene o ha tenido acceso a otros servicios del Estado?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitucionalSupport.apoyo_institucional', array('empty' => '', 'label' => '4.7 Apoyo institucional', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>

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
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_inurbe', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_INURBE', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Caja o Banco Agrario</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_banco_agrario', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c. DPS (Acción Social)*</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_DPS', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>d. ICBF (Instituto Colombiano de Bienestar Familiar)</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_ICBF', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>e. SENA (Servicio Nacional de Aprendizaje)</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_SENA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>f. INCODER (Instituto Colombiano de Desarrollo Rural)</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_INCODER', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>g. Federación Nacional de Cafeteros</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_federacion_cafeteros', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td rowspan="4">Local</td>
                <td>a. UMATA (Unidad Municipal de Asistencia Técnica Agropecuaria)</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_umata', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_UMATA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Alcaldía</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_alcaldia', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c. CONSEA</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_CONSEA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>d. CMDR</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_CMDR', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td rowspan="3">Departamental</td>
                <td>a. Gobernación</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_gobernacion', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Secretaria de Agricultura y/o Desarrollo económico</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_secretaria_agricultura', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c.Otro</td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.subsidio_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.asistencia_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.credito_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.obras_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.otra_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitucionalSupport.cual_otro', array('label' => '')); ?></td>
            </tr>
        </tbody>
    </table>
    <hr/>
    <p>* Familias Guardabosques, Familias en Acción, RESA</p>
    <?php echo $this->Form->end("Guardar") ?>  
</fieldset>