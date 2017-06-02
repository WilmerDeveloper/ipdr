<script>
    $(document).ready(function() {
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#genero_y_apoyo",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  }
)
</script>
<?php echo $this->Form->create("GenderInstitutionalSupport", array('id' => 'formulario', "action" => "edit/" . $this->data['GenderInstitutionalSupport']['id'])); ?>
<?php echo $this->Form->hidden('GenderInstitutionalSupport.family_poll_id', array('value' => $this->data['GenderInstitutionalSupport']['family_poll_id'])); ?>
<?php echo $this->Form->hidden('GenderInstitutionalSupport.id'); ?>
<fieldset>
    <legend>GÉNERO Y APOYO INSTITUCIONAL</legend>
    <?php echo $this->Form->input('GenderInstitutionalSupport.propietario_mujer_cabeza_familia', array('empty' => '', 'label' => '4.1 ¿El propietario es mujer cabeza de familia?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_incoder', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Del INCORA/ INCODER')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_otra_entidad', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Otra Entidad')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.programa_diferenciado_genero_otra_entidad_cual', array('label' => '4.2. ¿Tiene o ha recibido apoyo de algún programa diferenciado de género? Nombre otra entidad')); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitutionalSupport.beneficiario_servicios_incoder', array('empty' => '', 'label' => '4.3 ¿Usted es beneficiario de los servicios que presta el INCODER?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <h2>4.4 ¿De cuáles servicios del INCODER es usted beneficiario?:</h2>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_titulacion_baldios', array('label' => 'a. Titulación de baldios')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_adecuacion_tierras', array('label' => 'b. Adecuación de tierras')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_subsidio_integral_tierras', array('label' => 'c. Subsidio integral de tierras')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_procesos_agrarios', array('label' => 'd. Procesos agrarios')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_comunidad_afro', array('label' => 'e. Comunidad Afro')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_proyecto_productivo', array('label' => 'f. Proyectos productivos')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_comunidad_indigena', array('label' => 'g. Comunidad indigena')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_FNA', array('label' => 'h. FNA')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_RUPTA', array('label' => 'i. RUPTA')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_ZRC', array('label' => 'j. ZRC')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_ZDE', array('label' => 'k. ZDE')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servicio_otro', array('label' => 'l. Otro')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.servico_otro_cual', array('label' => '¿Cuál?')); ?>
    <hr/>
    <h2>4.5 ¿Desde cuándo es beneficiario de los servicios que presta el INCODER?:</h2>
    <?php echo $this->Form->input('GenderInstitutionalSupport.meses_servicio_incoder', array('label' => 'Meses')); ?>
    <?php echo $this->Form->input('GenderInstitutionalSupport.anios_servicio_incoder', array('label' => 'Años')); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitutionalSupport.acceso_otros_servicios_estado', array('empty' => '', 'label' => '4.6 ¿Tiene o ha tenido acceso a otros servicios del Estado?', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <hr/>
    <?php echo $this->Form->input('GenderInstitutionalSupport.apoyo_institucional', array('empty' => '', 'label' => '4.7 Apoyo institucional', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>

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
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_inurbe', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_INURBE', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_INURBE', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Caja o Banco Agrario</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_banco_agrario', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_banco_agrario', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c. DPS (Acción Social)*</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_DPS', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_DPS', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>d. ICBF (Instituto Colombiano de Bienestar Familiar)</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_ICBF', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_ICBF', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>e. SENA (Servicio Nacional de Aprendizaje)</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_SENA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_SENA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>f. INCODER (Instituto Colombiano de Desarrollo Rural)</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_INCODER', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_INCODER', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>g. Federación Nacional de Cafeteros</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_federacion_cafeteros', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_federacion_cafeteros', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td rowspan="4">Local</td>
                <td>a. UMATA (Unidad Municipal de Asistencia Técnica Agropecuaria)</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_umata', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_UMATA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_UMATA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Alcaldía</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_alcaldia', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_alcaldia', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c. CONSEA</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_CONSEA', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_CONSEA', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>d. CMDR</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_CMDR', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_CMDR', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td rowspan="3">Departamental</td>
                <td>a. Gobernación</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_gobernacion', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_gobernacion', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>b. Secretaria de Agricultura y/o Desarrollo económico</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_secretaria_agricultura', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_secretaria_agricultura', array('label' => '')); ?></td>
            </tr>
            <tr>
                <td>c.Otro</td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.subsidio_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.asistencia_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.credito_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.obras_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.otra_otro', array('label' => '')); ?></td>
                <td><?php echo $this->Form->input('GenderInstitutionalSupport.cual_otro', array('label' => '')); ?></td>
            </tr>
        </tbody>
    </table>
    <hr/>
    <p>* Familias Guardabosques, Familias en Acción, RESA</p>
     <?php echo $this->Form->hidden('GenderInstitutionalSupport.sincronizado', array('value' => 0, 'type' => 'text')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
 
</fieldset>