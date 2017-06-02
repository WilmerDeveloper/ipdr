<h1>PREDIOS PERTENECIENTES AL PROYECTO <?php echo $this->Session->read('codigo'); ?></h1>
<br>    
<?php echo $this->Paginator->counter(array(
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
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('City.name', 'Municipio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', 'Matrícula'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.area_total_ha', 'Extensión (ha)'); ?></th>
            <th colspan="5" style="padding: 0px 0px 0px 0px">
    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[Property][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Properties', 'action' => 'baselines_index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
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
            <td><?php echo $Property['Property']['area_total_ha'] . " Ha " . $Property['Property']['area_total_m'] . " mt2"; ?></td>
              <td>
                    <?php
                    
                        echo $this->Ajax->link('Línea_base_predio', array('controller' => 'properties', 'action' => 'baseline', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class'=>'acciones',));
                    ?>
                </td>
                <td>
                    <?php
                  
                        echo $this->Ajax->link('Línea_base_productiva', array('controller' => 'productiveBaselines', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class'=>'acciones',));
                    
                    ?>

                </td>
                <td>
                    <?php
                    
                        echo $this->Ajax->link('Línea_base_familias', array('controller' => 'Beneficiaries', 'action' => 'baseline_index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class'=>'acciones', ));
                    
                    ?>

                </td>
                <td>
                    

                </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
