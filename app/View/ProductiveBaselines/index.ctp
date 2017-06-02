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
            <th><?php echo $this->Paginator->sort('ProductiveBaseline.observaciones', 'Observaciones'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveBaseline.fecha_entrevista', 'Fecha de la entrevista'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductiveBaseline.numero_visitas', 'Número de visitas'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ProductiveBaselines as $ProductiveBaseline): ?>
            <tr>
                <td><?php echo $ProductiveBaseline['ProductiveBaseline']['observaciones']; ?></td>
                <td><?php echo $ProductiveBaseline['ProductiveBaseline']['fecha_entrevista']; ?></td>
                <td><?php echo $ProductiveBaseline['ProductiveBaseline']['numero_visitas']; ?></td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $ProductiveBaseline['ProductiveBaseline']['adjunto_encuesta']) and $ProductiveBaseline['ProductiveBaseline']['adjunto_encuesta'] != "") {
                        echo $this->Html->link('Descargar encuesta', "../files/" . $proyect_id . "-" . $codigo . "/" . $ProductiveBaseline['ProductiveBaseline']['adjunto_encuesta'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                        echo"<br>";
                        echo"<br>";
                    }
                    ?>
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'ProductiveBaselines', 'action' => 'edit', $ProductiveBaseline["ProductiveBaseline"]["id"]), array('update' => 'content', 'indicator' => 'loading','class'=>'acciones')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if (count($ProductiveBaselines) == 0) echo $this->Ajax->link('Adicionar', array('controller' => 'ProductiveBaselines', 'action' => 'add', $property_id), array('update' => 'content', 'indicator' => 'loading'), '¿Desea agregar un nuevo registro?'); ?>
