<?php echo $this->Session->flash(); ?>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table  id="tabla" class="index" >
    <thead>
        <tr>
            <th></th>
            <th>Documento Identidad</th>
            <th>Primer nombre</th>
            <th>Primer Apellido</th>
            <th>Tipo</th>
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cont = 0;
        foreach ($beneficiarios as $ben):
            ?>
            <?php
            App::Import('model', 'BeneficiaryRequirement');
            $BeneficiaryRequirement = new BeneficiaryRequirement();
            $color = "#aef584";
            if ($requisitos = $BeneficiaryRequirement->find('all', array('recursive' => -1, 'conditions' => array('BeneficiaryRequirement.beneficiary_id' => $ben['Beneficiary']['id']), 'fields' => array('BeneficiaryRequirement.calificacion')))) {

                foreach ($requisitos as $requisito) {

                    if ($requisito['BeneficiaryRequirement']['calificacion'] == "No cumple") {
                        $color = "#e49f90";
                        break;
                    } elseif (is_null($requisito['BeneficiaryRequirement']['calificacion'])) {
                        $color = "#e2da3d";
                    }
                }
            } else {
                $color = "#e2da3d";
            }
            $cont++;
            ?>
            <tr style="background-color: <?php echo $color ?>">


                <td><?php echo $cont ?></td>
                <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
                <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
                <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>

                <td><?php echo "Titular " . $ben['Beneficiary']['tipo'] ?></td>
                <td>
                    <?php $property_id = $ben['Beneficiary']['property_id']; ?>
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


                </td>
                <td><?php echo $this->Ajax->link("Revisar_requisitos", array('controller' => 'BeneficiaryRequirements', "action" => "index", $ben['Beneficiary']['id']), array('update' => 'aspirantes', 'indicator' => 'loading', 'class' => 'acciones')) ?></td>
            </tr>

            <?php
            App::Import('model', 'Beneficiary');
            $colorCon = "#aef584";
            $Beneficiary = new Beneficiary();
            if ($conyuge = $Beneficiary->find('first', array('conditions' => array('Beneficiary.beneficiary_id' => $ben['Beneficiary']['id']), 'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.property_id', 'Beneficiary.archivo_sisben')))) {
                $cont++;
                if ($requisitosCon = $BeneficiaryRequirement->find('all', array('recursive' => -1, 'conditions' => array('BeneficiaryRequirement.beneficiary_id' => $conyuge['Beneficiary']['id']), 'fields' => array('BeneficiaryRequirement.calificacion')))) {

                    foreach ($requisitosCon as $requisitocon) {

                        if ($requisitocon['BeneficiaryRequirement']['calificacion'] == "No cumple") {
                            $colorCon = "#e49f90";
                            break;
                        } elseif (is_null($requisitocon['BeneficiaryRequirement']['calificacion'])) {
                            $colorCon = "#e2da3d";
                        }
                    }
                } else {
                    $colorCon = "#e2da3d";
                }
                ?>
                <tr style="background-color: <?php echo $color ?>">


                    <td><?php echo $cont; ?></td>
                    <td><?php echo $conyuge['Beneficiary']['numero_identificacion'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['nombres'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['primer_apellido'] ?></td>

                    <td><?php echo "Conyuge " . $conyuge['Beneficiary']['tipo'] ?></td>
                    <td>
                        <?php $property_id = $conyuge['Beneficiary']['property_id']; ?>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_cedula']) and $conyuge['Beneficiary']['archivo_cedula'] != "")
                            echo $this->Html->link('Documento_identidad', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_cedula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_policia']) and $conyuge['Beneficiary']['archivo_policia'] != "")
                            echo $this->Html->link('Certificado_policía', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_policia'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_contraloria']) and $conyuge['Beneficiary']['archivo_contraloria'] != "")
                            echo $this->Html->link('Certificado_contraloría', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_contraloria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_procuraduria']) and $conyuge['Beneficiary']['archivo_procuraduria'] != "")
                            echo $this->Html->link('Certificado_procuraduría', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_procuraduria'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?> 
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_sisben']) and $conyuge['Beneficiary']['archivo_sisben'] != "")
                            echo $this->Html->link('SISBEN', "../files/Predio-" . $property_id . "/Documentos verificacion/" . $conyuge['Beneficiary']['archivo_sisben'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    </td>
                    <td><?php echo $this->Ajax->link("Revisar_requisitos", array('controller' => 'BeneficiaryRequirements', "action" => "index", $conyuge['Beneficiary']['id']), array('update' => 'aspirantes', 'indicator' => 'loading', 'class' => 'acciones')) ?></td>
                </tr>

            <?php } ?>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>