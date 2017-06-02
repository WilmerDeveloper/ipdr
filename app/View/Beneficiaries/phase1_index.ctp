
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr> 
            <td><?php //echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'phase1_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));      ?></td>
            <td><?php echo $this->Html->link("Cartas de aceptación ", array('controller' => 'Beneficiaries', "action" => "acceptance_letters", $property_id), array('target' => 'blank', 'class' => 'acciones', 'complete' => 'formularioAjax()', 'indicator' => 'loading')) ?></td>
        </tr>
    </tbody>
</table>
<table  id="tabla" class="index" >
    <thead>
        <tr>


            <th></th>
            <th>Documento Identidad</th>
            <th>Primer nombre</th>
            <th>Primer Apellido</th>
            <th>Tipo</th>
            <th>Calificación visita</th>
            <th>Concepto  visita</th>
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $cont = 0;
        foreach ($beneficiarios as $ben):
            ?>
            <?php
            $cont++;
            ?>
            <tr style="background-color: <?php ?>">


                <td><?php echo $cont ?></td>
                <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
                <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
                <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>

                <td><?php echo "Titular " . $ben['Beneficiary']['tipo'] ?></td>
                <td><?php echo $ben['Beneficiary']['calificacion_visita'] ?></td>
                <td><?php echo $ben['Beneficiary']['concepto_visita'] ?></td>
                <td>
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
                </td>

                <td>
                    <?php //if ($this->Session->read('cerrado') != 1)
                        echo $this->Ajax->link("Calificar", array('controller' => 'Beneficiaries', "action" => "visit", $ben['Beneficiary']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                    <br>
                    <br>
                    <?php
                    //if ($this->Session->read('cerrado') != 1)
                        echo $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "edit", $ben['Beneficiary']['id'], 0, 1), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                </td>
            </tr>

            <?php
            App::Import('model', 'Beneficiary');
            $colorCon = "#aef584";
            $Beneficiary = new Beneficiary();
            if ($conyuge = $Beneficiary->find('first', array('conditions' => array('Beneficiary.beneficiary_id' => $ben['Beneficiary']['id']), 'fields' => array('Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.calificacion_visita', 'Beneficiary.concepto_visita', 'Beneficiary.beneficiary_id')))) {
                $cont++;
                ?>
                <tr style="background-color: <?php ?>">


                    <td><?php echo $cont; ?></td>
                    <td><?php echo $conyuge['Beneficiary']['numero_identificacion'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['nombres'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['primer_apellido'] ?></td>

                    <td><?php echo "Conyuge " . $conyuge['Beneficiary']['tipo'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['calificacion_visita'] ?></td>
                    <td><?php echo $conyuge['Beneficiary']['concepto_visita'] ?></td>
                    <td>
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
                    </td>

                    <td>
                        <?php 
                        //if ($this->Session->read('cerrado') != 1)
                            echo $this->Ajax->link("Calificar", array('controller' => 'Beneficiaries', "action" => "visit", $conyuge['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')) ?>
                        <br>
                        <br>
                        <?php
                        //if ($this->Session->read('cerrado') != 1)
                            echo $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "edit", $conyuge['Beneficiary']['id'], $conyuge['Beneficiary']['beneficiary_id'], 1), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    </td>
                </tr>

            <?php } ?>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php //echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'phase1_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));      ?></td>
        </tr>
    </tbody>
</table>





