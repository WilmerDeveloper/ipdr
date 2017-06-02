<table  id="tabla" class="index" >
    <thead>
        <tr>
            <th></th>
            <th>Predio</th>
            <th style="width: 10%">Documento</th>
            <th >Nombres</th>
            <th ></th>
            <th ></th>
            <th colspan="2">

    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Beneficiary][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Beneficiaries', 'action' => 'total_index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>
</th>
</tr>
</thead>
<tbody>

    <?php
    $cont = 0;
    $beneficiarios1 = $beneficiarios;
    foreach ($beneficiarios as $ben):
        ?>
        <?php
        $cont++;
        ?>
        <tr style="background-color: <?php ?>">
            <td><?php echo $cont ?></td>
            <td><?php echo $ben['Property']['nombre'] ?></td>
            <td style="width: 10%"><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
            <td><?php echo $ben['Beneficiary']['nombres'] . "<br> " . $ben['Beneficiary']['primer_apellido'] . "<br> " . $ben['Beneficiary']['segundo_apellido'] ?></td>
            <td><?php echo $ben['Beneficiary']['calificacion_visita'] . " :<br>" . $ben['Beneficiary']['concepto_visita'] ?></td>
            <td><?php
    if ($ben['Beneficiary']['beneficiary_id'] != 0 or !is_null($ben['Beneficiary']['beneficiary_id'])) {
        foreach ($beneficiarios1 as $ben1) {
            if ($ben1['Beneficiary']['id'] == $ben['Beneficiary']['beneficiary_id']) {
                echo "Conyuge de: <br> " . $ben1['Beneficiary']['nombres'] . " <br>" . $ben1['Beneficiary']['primer_apellido'];
                break;
            }
        }
    }
        ?>
            </td>
            <td>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_cedula']) and $ben['Beneficiary']['archivo_cedula'] != "")
                    echo $this->Html->link('Documento_identidad', "../files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_cedula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_policia']) and $ben['Beneficiary']['archivo_policia'] != "")
                    echo $this->Html->link('Certificado_policía', "../files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_policia'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_contraloria']) and $ben['Beneficiary']['archivo_contraloria'] != "")
                    echo $this->Html->link('Certificado_contraloría', "../files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_contraloria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_procuraduria']) and $ben['Beneficiary']['archivo_procuraduria'] != "")
                    echo $this->Html->link('Certificado_procuraduría', "../files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_procuraduria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_sisben']) and $ben['Beneficiary']['archivo_sisben'] != "")
                    echo $this->Html->link('SISBEN', "../files/Predio-" . $ben['Beneficiary']['property_id'] . "/Documentos verificacion/" . $ben['Beneficiary']['archivo_sisben'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
            </td>
            <td>
                <br>
                <?php
                if($this->Session->read('bloqueado')!=1) echo $this->Ajax->link("Evaluar_Fase_I", array('controller' => 'Beneficiaries', "action" => "visit", $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => "formularioAjax()"))
                ?>

                <br>
                <br>
                <?php
                //echo $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "edit", $ben['Beneficiary']['id'], 0, 2), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones'));
                //if($this->Session->read('bloqueado')!=1) 
                    echo $this->Ajax->link("Editar", array('controller' => 'BeneficiaryReviews', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php if (AuthComponent::User('group_id') == 1) echo $this->Ajax->link("Eliminar", array('controller' => 'Beneficiaries', "action" => "delete", $ben['Beneficiary']['id'], $ben['Beneficiary']['property_id'], 1), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), 'Tambien se borrará el filtro realizado al aspirante, sus familiares y los filtros realizados a ellos.') ?>
                <br>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<br>
<br>