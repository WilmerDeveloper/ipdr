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
            <th><?php echo $this->Paginator->sort('Property.id', ''); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', ''); ?></th>
            <th><?php echo $this->Paginator->sort('Property.matricula', ''); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <?php
            App::Import('model', 'PropertyRequirement');
            $PropertyRequirement = new PropertyRequirement();
            $color = "#aef584";
            if ($requisitos = $PropertyRequirement->find('all', array('conditions' => array('PropertyRequirement.property_id' => $Property['Property']['id'])))) {

                foreach ($requisitos as $requisito) {
                    
                    if ($requisito['PropertyRequirement']['calificacion'] == "No cumple") {
                        $color = "#e49f90";
                        break;
                    }elseif (is_null($requisito['PropertyRequirement']['calificacion'])) {
                        $color = "#e2da3d";
                    }
                }
            }else{
                $color = "#e2da3d";
            }
            ?>
        <tr style="background-color: <?php echo $color ?>">
                <td><?php echo $Property['Property']['id']; ?></td>
                <td><?php echo $Property['Property']['nombre']; ?></td>
                <td><?php echo $Property['Property']['matricula']; ?></td>
                <td><?php echo $this->Ajax->link('Evaluar requisitos', array('controller' => 'PropertyRequirements', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'predios', 'indicator' => 'loading')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
