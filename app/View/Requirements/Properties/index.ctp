<h1>PREDIOS PERTENECIENTES AL PROYECTO <?php echo $this->Session->read('codigo');?></h1>
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
    echo $this->Paginator->prev('< ' .'Anterior', array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', 'Matrícula'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.cedula_catastral', 'Cédula Catastral'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.extension', 'Extensión'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                <td><?php echo $Property['Property']['nombre']; ?></td>
                <td><?php echo $Property['Property']['matricula']; ?></td>
                <td><?php echo $Property['Property']['cedula_catastral']; ?></td>
                <td><?php echo $Property['Property']['extension']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'properties', 'action' => 'edit', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

