

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
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('City.name', 'Municipio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', 'Matrícula'); ?></th>
            <th><?php echo $this->Paginator->sort('Proyect.codigo', 'Proyecto'); ?></th>
            <th colspan="2" style="padding: 0px 0px 0px 0px">
    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Property][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Properties', 'action' => 'phase1_index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>

</th>


</tr>
</thead>
<tbody>
    <?php foreach ($Properties as $Property): ?>
        <tr>
            <td><?php echo $Property['Property']['nombre']; ?></td>
            <td><?php echo $Property['City']['name'] . " (" . $Property['Departament']['name'] . ") "; ?></td>
            <td><?php echo $Property['Property']['matricula']; ?></td>
            <td><?php echo $Property['Proyect']['codigo']." (".$Property['Call']['nombre'].")"  ?></td>
            <td>
                <?php echo $this->Ajax->link('Verificación beneficiarios', array('controller' => 'beneficiaries', 'action' => 'phase1_index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Verificación predio', array('controller' => 'Properties', 'action' => 'visit', $Property["Property"]["id"]), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')); ?>

            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

