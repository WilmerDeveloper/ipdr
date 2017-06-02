
<h1>Listado de predios</h1>
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
            <th><?php echo $this->Paginator->sort('Proyect.codigo', 'Proyecto'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('City.name', 'Municipio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', 'Matrícula'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.calificacion_fase0', 'Calificación fase 0'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.calificacion_fase0', 'Calificación fase 1'); ?></th>
            <th colspan="2" style="padding: 0px 0px 0px 0px">
    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Property][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Properties', 'action' => 'resolution_index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>

</th>


</tr>
</thead>
<tbody>
    <?php foreach ($Properties as $Property): ?>
        <tr>
            <td><?php echo $Property['Proyect']['codigo'] . " (" . $Property['Call']['nombre'] . ")" ?></td>
            <td><?php echo $Property['Property']['nombre']; ?></td>
            <td><?php echo $Property['City']['name'] . " (" . $Property['Departament']['name'] . ") "; ?></td>
            <td><?php echo $Property['Property']['matricula']; ?></td>
            <td style="background: 
            <?php
            if ($Property['Property']['calificacion_fase0'] == 'Cumple')
                echo '#8be57f';
            elseif ($Property['Property']['calificacion_fase0'] == 'No cumple')
                echo '#ea6874';
            else
                echo'#f1e57a';
            ?>"><?php echo $Property['Property']['calificacion_fase0']; ?></td>
            <td style="background: 
                <?php
                if ($Property['Property']['calificacion_visita'] == 'Cumple')
                    echo '#8be57f';
                elseif ($Property['Property']['calificacion_visita'] == 'No cumple')
                    echo '#ea6874';
                else
                    echo'#f1e57a';
                ?>"><?php echo $Property['Property']['calificacion_visita']; ?></td>
            <td>

                <br>


                <?php
                //if($this->Session->read('cerrado')!=1) 
                echo $this->Ajax->link('Evaluar predio fase 0', array('controller' => 'properties', 'action' => 'phase0_evaluation', $Property["Property"]["id"], 1), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                //if($this->Session->read('cerrado')!=1)
                echo $this->Ajax->link('Evaluar predio fase 1', array('controller' => 'properties', 'action' => 'visit', $Property["Property"]["id"], 1), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()'));
                ?>
                <br>
                <br>
                <?php
                //if($this->Session->read('cerrado')!=1) 
                echo $this->Ajax->link('Editar', array('controller' => 'properties', 'action' => 'edit_property', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones',));
                ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Adjuntar Archivos', array('controller' => 'properties', 'action' => 'upload_files', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Ver adjuntos', array('controller' => 'properties', 'action' => 'view_files', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php if (AuthComponent::User('group_id') == 1) echo $this->Ajax->link('Eliminar', array('controller' => 'properties', 'action' => 'delete', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro de eliminar el predio?.Se borraran los datos de las familias asociadas'); ?>
                <br>
                <br>
                <?php if (AuthComponent::User('group_id') == 1) echo $this->Ajax->link('Desasociar del proyecto', array('controller' => 'properties', 'action' => 'unregister', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Esta seguro de quitar asociación el predio?.'); ?>
                <br>
                <br>

            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?php echo $this->Ajax->link('Adicionar Predio', array('controller' => 'Properties', 'action' => 'add_property'), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?>
<?php echo $this->Js->writeBuffer(); ?>

