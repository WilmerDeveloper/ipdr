<?php echo $this->Form->create("Property", array('id' => 'cp', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "upload_files/" . $this->data['Property']['id'])); ?>
<legend>Adjuntar archivo</legend>
<?php
echo $this->Form->hidden('Property.id');
echo $this->Form->hidden('Property.proyect_id');
?>
<table border="1" class="index">
    <tbody>
        <?php if ($this->data['Property']['tipo_tenencia'] != "Poseedor"): ?>
            <tr>
                <td>Archivo resolución</td>
                <td><?php echo $this->Form->file('Property.archivo_resolucion', array('label' => 'Cargar matrícula inmobiliaria', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Matrícula inmobiliaria</td>
                <td><?php echo $this->Form->file('Property.archivo_matricula', array('label' => 'Cargar matrícula inmobiliaria', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Certificación distrito de riego</td>
                <td><?php echo $this->Form->file('Property.distrito', array('label' => 'Cargar Certificación distrito de riego', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Certificación resguardo indígena</td>
                <td><?php echo $this->Form->file('Property.resguardo', array('label' => 'Cargar matrícula inmobiliaria', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Certificación consejo comunitario</td>
                <td><?php echo $this->Form->file('Property.consejo', array('label' => 'Cargar matrícula inmobiliaria', 'accept' => 'pdf')); ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td>Declaración extrajuicio</td>
                <td><?php echo $this->Form->file('Property.declaracion_extrajuicio', array('label' => 'Cargar declaración extrajuicio', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Junta acción comunal</td>
                <td><?php echo $this->Form->file('Property.junta_accion_comunal', array('label' => 'Cargar junta acción comunal', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Sana posesión</td>
                <td><?php echo $this->Form->file('Property.sana_posesion', array('label' => 'Cargar sana posesión', 'accept' => 'pdf')); ?></td>
            </tr>
            <tr>
                <td>Manifiesto de colindancias</td>
                <td><?php echo $this->Form->file('Property.manifiesto_colindancias', array('label' => 'Cargar manifiesto colindancias', 'accept' => 'pdf')); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>Certificación uso del suelo</td>
            <td><?php echo $this->Form->file('Property.uso_suelo', array('label' => 'Cargar matrícula inmobiliaria', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Concepto ambiental</td>
            <td><?php echo $this->Form->file('Property.concepto_ambiental', array('label' => 'Cargar concepto ambiental', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Parques nacionales</td>
            <td><?php echo $this->Form->file('Property.parques_nacionales', array('label' => 'Cargar parques nacionales', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Ministerio del medio ambiente</td>
            <td><?php echo $this->Form->file('Property.ministerio_medio_ambiente', array('label' => 'Cargar Ministerio del medio ambiente', 'accept' => 'pdf')); ?></td>
        </tr>
        <tr>
            <td>Cruce ambiental preliminar SGD</td>
            <td><?php echo $this->Form->file('Property.cruce_ambiental_preliminar', array('label' => 'Cargar cruce ambiental preliminar', 'accept' => 'pdf')); ?></td>
        </tr>
    </tbody>
</table>

<?php echo $this->Form->end(array('label' => 'Guardar')) ?>
<br><br>
<?php
echo $this->Ajax->link($this->Html->image("regresar.gif", array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar')), array('controller' => "Properties", "action" => "property_index", $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false), null)
?>