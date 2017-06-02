<br> 
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Proyects', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()','class'=>'acciones')); ?>
<br>
<br>
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros de %count% totales, empezando en %start%, terminando en %end%'
        )
);
?>
<div class="paging">


    <?php
    echo $this->Paginator->options(array('update' => '#content','indicator' => '#loading', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table class="index">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Proyect.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Call.nombre', 'Convocatoria'); ?></th>
            <th><?php echo $this->Paginator->sort('Proyect.codigo', 'Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Proyect.valor', 'valor'); ?></th>
            <th><?php echo $this->Paginator->sort('Departament.name', 'Regional'); ?></th>
            <th colspan="2">
    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Proyect][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Proyects', 'action' => 'index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>

</th>
</tr>
</thead>
<tbody>
    <?php foreach ($Proyects as $Proyect): ?>
        <tr>
            <td><?php echo $Proyect['Proyect']['id']; ?></td>
            <td><?php echo $Proyect['Call']['nombre']; ?></td>
            <td><?php echo $Proyect['Proyect']['codigo']; ?></td>
            <td><?php echo $Proyect['Proyect']['valor']; ?></td>
            <td><?php echo $Proyect['Departament']['name'] . " (" . $Proyect['City']['name'] . ")"; ?></td>
            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Proyects', 'action' => 'edit', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?></td>
            <td><?php echo $this->Ajax->link('Asignar predios', array('controller' => 'Proyects', 'action' => 'edit_proyect', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Proyects', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()','class'=>'acciones')); ?>
