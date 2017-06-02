<table width="100%" border="0"  CellSpacing=10  align="center"  >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link('Ver todos', array('controller' => 'Properties', 'action' => 'property_index', 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>

            <td><?php echo $this->Html->link('descargar reporte', array('controller' => 'Properties', 'action' => 'phase0_report'), array('update' => 'content', 'indicator' => 'loading', 'target' => '_blank', 'class' => 'acciones')); ?></td>
        </tr>
    </tbody>
</table>
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros  de %count% totales, empezando en %start%, terminando en %end%'
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
            <th><?php echo $this->Paginator->sort('Call.nombre', 'Año'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Nombre'); ?></th>

            <th><?php echo $this->Paginator->sort('City.name', 'Municipio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', 'Matrícula'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.area_total_ha', 'Extensión (ha)'); ?></th>
            <th colspan="2" style="padding: 0px 0px 0px 0px">
    <form style="clear: both" class="frmbuscar">
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Property][busqueda]"  ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Properties', 'action' => 'property_index', 0), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>
</th>
</tr>
</thead>
<tbody>
    <?php foreach ($Properties as $Property): ?>
        <tr>
            <td><?php echo $Property['Call']['nombre']; ?></td>
            <td><?php echo $Property['Property']['nombre']; ?></td>
            <td><?php echo $Property['City']['name'] . " (" . $Property['Departament']['name'] . ") "; ?></td>
            <td><?php echo $Property['Property']['matricula']; ?></td>
            <td><?php echo $Property['Property']['area_total_ha'] . " Ha " . $Property['Property']['area_total_m'] . " mt2"; ?></td>
            <td>
                <?php if ($Property['Property']['proyect_id'] == 0) echo $this->Ajax->link('Editar', array('controller' => 'properties', 'action' => 'edit_property', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?>
                <br><br>
                <?php if ($this->Session->read('cerrado') != 1 or $Property['Property']['proyect_id'] == 0) echo $this->Ajax->link('Familias_beneficiarias', array('controller' => 'beneficiaries', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br><br>
                <?php echo $this->Ajax->link('Ver', array('controller' => 'properties', 'action' => 'view', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php if ($this->Session->read('cerrado') != 1 or $Property['Property']['proyect_id'] == 0) echo $this->Ajax->link('Eliminar', array('controller' => 'properties', 'action' => 'delete', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro de eliminar el predio?.Se borraran los datos de las familias asociadas'); ?>
                <br>
            </td>
            <td>
                <?php echo $this->Ajax->link('Adjuntar_Archivos', array('controller' => 'properties', 'action' => 'upload_files', $Property["Property"]["id"]), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Ver adjuntos', array('controller' => 'properties', 'action' => 'view_files', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php if ($this->Session->read('cerrado') != 1 or $Property['Property']['proyect_id'] == 0) echo $this->Ajax->link('Evaluar', array('controller' => 'properties', 'action' => 'phase0_evaluation', $Property["Property"]["id"], 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Estudio titulos', array('controller' => 'title_studies', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Properties', 'action' => 'add_property'), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?>