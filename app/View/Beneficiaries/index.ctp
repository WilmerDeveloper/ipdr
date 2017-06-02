 
<?php echo $this->Ajax->link("Agregar Beneficiario *", array('controller' => 'Beneficiaries', "action" => "add", $property_id, 0, 0), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading')) ?>
<br>
<br>
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros de cabezas de familia de %count% totales, empezando en %start%, terminando en %end%'
        )
);
?>


<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>


<h1>Beneficiarios del predio <?php echo $predio['Property']['nombre'] ?></h1>
<table  id="tabla" class="index" >
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort("Beneficiary.numero_identificacion", "Documento Identidad") ?></th>
            <th><?php echo$this->Paginator->sort("Beneficiary.nombres", "Nombres") ?></th>
            <th><?php echo $this->Paginator->sort("Beneficiary.primer_apellido", "Primer Apellido") ?></th>
            <th><?php echo $this->Paginator->sort("Beneficiary.segundo_apellido", "Segundo Apellido") ?></th>
            <th><?php echo $this->Paginator->sort("Beneficiary.tipo", "Tipo") ?></th>
            <th colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($beneficiaries as $ben): ?>
            <tr>
                <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
                <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
                <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>
                <td><?php echo $ben['Beneficiary']['segundo_apellido'] ?></td>
                <td><?php echo $ben['Beneficiary']['tipo'] ?></td>
                <td>
                    <?php if ($call_id != 1): ?>

                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_cedula']) and $ben['Beneficiary']['archivo_cedula'] != "")
                            echo $this->Html->link('Documento_identidad', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_cedula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_policia']) and $ben['Beneficiary']['archivo_policia'] != "")
                            echo $this->Html->link('Certificado_policía', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_policia'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_contraloria']) and $ben['Beneficiary']['archivo_contraloria'] != "")
                            echo $this->Html->link('Certificado_contraloría', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_contraloria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_procuraduria']) and $ben['Beneficiary']['archivo_procuraduria'] != "")
                            echo $this->Html->link('Certificado_procuraduría', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_procuraduria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_sisben']) and $ben['Beneficiary']['archivo_sisben'] != "")
                            echo $this->Html->link('SISBEN', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_sisben'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    <?php endif; ?>
                </td>

                <td >
                    <br>
                    <?php echo $this->Ajax->link("Familiares", array('controller' => 'Families', "action" => "index", $ben['Beneficiary']['id'], $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                    <br>
                    <br>
                    <?php echo $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "edit", $ben['Beneficiary']['id'], 0, 0), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                    <br>
                    <br>
                    <?php echo $this->Ajax->link("Eliminar", array('controller' => 'Beneficiaries', "action" => "delete", $ben['Beneficiary']['id'], $property_id, 0), array('update' => 'content', 'complete' => 'cargar()', 'indicator' => 'loading', 'class' => 'acciones'), 'Tambien se borrará el filtro realizado al aspirante, sus familiares y los filtros realizados a ellos.') ?>
                    <br>
                    <br>
                    <?php echo $this->Ajax->link("Ver", array('controller' => 'Beneficiaries', "action" => "view", $ben['Beneficiary']['id'], $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')) ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link("Agregar Beneficiario ", array('controller' => 'Beneficiaries', "action" => "add", $property_id, 0, 0), array('update' => 'content', 'class' => 'acciones', 'complete' => 'formularioAjax()', 'indicator' => 'loading')) ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>




