<br>    
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros de %count% totales, empezando en %start%, terminando en %end%'
        )
);
?>

<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . 'Anterior', array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table class="index">
    <thead>
        <tr>
            <th>ARCHIVOS PARA DESCARGAR</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                <td>
                    <?php if ($Property['Property']['tipo_tenencia'] == "" or empty($Property['Property']['tipo_tenencia'])): ?>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion']) and $Property['Property']['ruta_resolucion'] != "")
                            echo $this->Html->link('Resolución', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula']) and $Property['Property']['ruta_matricula'] != "")
                            echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br><br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito']) and $Property['Property']['archivo_distrito'] != "")
                            echo $this->Html->link('Certificación_distrito_de_riego.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo']) and $Property['Property']['archivo_resguardo'] != "")
                            echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo']) and $Property['Property']['archivo_consejo'] != "")
                            echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_declaracion_extrajuicio']) and $Property['Property']['archivo_declaracion_extrajuicio'] != "")
                            echo $this->Html->link('Declaración extrajuicio.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_declaracion_extrajuicio'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_junta_accion_comunal']) and $Property['Property']['archivo_junta_accion_comunal'] != "")
                            echo $this->Html->link('Junta acción comunal.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_junta_accion_comunal'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_sana_posesion']) and $Property['Property']['archivo_sana_posesion'] != "")
                            echo $this->Html->link('Sana posesión.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_sana_posesion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_manifiesto_colindancias']) and $Property['Property']['archivo_manifiesto_colindancias'] != "")
                            echo $this->Html->link('Manifiesto de colindancias.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_manifiesto_colindancias'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo']) and $Property['Property']['archivo_uso_suelo'] != "")
                            echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    <?php endif; ?>
                    <?php if ($Property['Property']['tipo_tenencia'] == "Propietario"): ?>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion']) and $Property['Property']['ruta_resolucion'] != "")
                            echo $this->Html->link('Resolución', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula']) and $Property['Property']['ruta_matricula'] != "")
                            echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br><br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito']) and $Property['Property']['archivo_distrito'] != "")
                            echo $this->Html->link('Certificación_distrito_de_riego.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo']) and $Property['Property']['archivo_resguardo'] != "")
                            echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo']) and $Property['Property']['archivo_consejo'] != "")
                            echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo']) and $Property['Property']['archivo_uso_suelo'] != "")
                            echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    <?php endif; ?>
                    <?php if ($Property['Property']['tipo_tenencia'] == 'Poseedor'): ?>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_declaracion_extrajuicio']) and $Property['Property']['archivo_declaracion_extrajuicio'] != "")
                            echo $this->Html->link('Declaración extrajuicio.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_declaracion_extrajuicio'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_junta_accion_comunal']) and $Property['Property']['archivo_junta_accion_comunal'] != "")
                            echo $this->Html->link('Junta acción comunal.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_junta_accion_comunal'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_sana_posesion']) and $Property['Property']['archivo_sana_posesion'] != "")
                            echo $this->Html->link('Sana posesión.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_sana_posesion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_manifiesto_colindancias']) and $Property['Property']['archivo_manifiesto_colindancias'] != "")
                            echo $this->Html->link('Manifiesto de colindancias.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_manifiesto_colindancias'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                        <br>
                        <br>
                        <?php
                        if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo']) and $Property['Property']['archivo_uso_suelo'] != "")
                            echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        ?>
                    <?php endif; ?>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_concepto_ambiental']) and $Property['Property']['archivo_concepto_ambiental'] != "")
                        echo $this->Html->link('Concepto ambiental.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_concepto_ambiental'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_parques_nacionales']) and $Property['Property']['archivo_parques_nacionales'] != "")
                        echo $this->Html->link('Parques nacionales.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_parques_nacionales'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_ministerio_medio_ambiente']) and $Property['Property']['archivo_ministerio_medio_ambiente'] != "")
                        echo $this->Html->link('Ministerio medio ambiente.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_ministerio_medio_ambiente'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_cruce_ambiental_preliminar']) and $Property['Property']['archivo_cruce_ambiental_preliminar'] != "")
                        echo $this->Html->link('Cruce ambiental preliminar SGD.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_cruce_ambiental_preliminar'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>