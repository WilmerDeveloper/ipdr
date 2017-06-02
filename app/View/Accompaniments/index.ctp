<?php

if($this->Session->read('bloqueado')!=1):
    ?>
<h2>Este proyecto aún no tiene calificación cumple, por tal razón no es posible cargar los datos del seguimiento</h2>
<?php endif;?>

<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Accompaniment.id', ''); ?></th>
            <th><?php echo $this->Paginator->sort('Accompaniment.user_id', 'Usuario'); ?></th>
            <th><?php echo $this->Paginator->sort('Accompaniment.observaciones', ''); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Accompaniments as $Accompaniment): ?>
        <tr>
            <td><?php echo $Accompaniment['Accompaniment']['id']; ?></td>
            <td><?php echo $Accompaniment['Accompaniment']['user_id']; ?></td>
            <td><?php echo $Accompaniment['Accompaniment']['observaciones']; ?></td>
            <td>
                <br>
                    <?php
                    
                    echo $this->Ajax->link('Editar', array('controller' => 'Accompaniments', 'action' => 'edit', $Accompaniment["Accompaniment"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'));
                    
                    ?>
                <br>
                <br>
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'Accompaniments', 'action' => 'delete', $Accompaniment["Accompaniment"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), "¿Desea borrar el registro?"); ?>
                <br>
                <br>
                    <?php
                    if (file_exists("../webroot" . "/" . "files" . "/$proyect_id-$codigo/" . $Accompaniment["Accompaniment"]["adjunto"]) and $Accompaniment['Accompaniment']['adjunto'] != "")
                        echo $this->Html->link('Ver_adjunto', "../files/$proyect_id-$codigo/" . $Accompaniment["Accompaniment"]["adjunto"], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if($this->Session->read('bloqueado')==1) echo $this->Ajax->link('Adicionar', array('controller' => 'Accompaniments', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
