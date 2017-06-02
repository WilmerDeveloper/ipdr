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
            <th><?php echo $this->Paginator->sort('Risk.id', ''); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Risks as $Risk): ?>
            <tr>
                <td>
                   
                    <div>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>¿El Predio cuenta con fuentes de captación de agua?:</th>
                                    <th>    <?php echo $Risk['Risk']['fuentes_agua']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.laguna', array('checked'=>$Risk['Risk']['id'],'disabled'=>1, 'label' => 'Laguna', 'class' => '')); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.rio', array('checked'=>$Risk['Risk']['rio'],'disabled'=>1,'label' => 'Rio', 'class' => '')); ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.cienaga', array('checked'=>$Risk['Risk']['cienaga'],'disabled'=>1,'label' => 'Cienaga', 'class' => '')); ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.nacimiento', array('checked'=>$Risk['Risk']['nacimiento'],'disabled'=>1,'label' => 'Nacimiento', 'class' => '')); ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.agual_lluvias', array('checked'=>$Risk['Risk']['agual_lluvias'],'disabled'=>1,'label' => 'Aguas lluvias', 'class' => '')); ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.acueducto_local', array('checked'=>$Risk['Risk']['acueducto_local'],'disabled'=>1,'label' => 'Acueducto local', 'class' => '')); ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php echo $this->Form->input('Risk.distrito_de_riego', array('checked'=>$Risk['Risk']['distrito_de_riego'],'disabled'=>1,'label' => 'Distrito de riego', 'class' => '')); ?>


                                    </td>

                                </tr>
                            </tbody>
                        </table>

                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Risks', 'action' => 'edit', $Risk["Risk"]["id"]), array('class' => 'acciones', 'update' => 'riego', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Risks', 'action' => 'delete', $Risk["Risk"]["id"], $property_id), array('class' => 'acciones', 'update' => 'riego', 'indicator' => 'loading'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if (count($Risks) == 0) echo $this->Ajax->link('Adicionar', array('controller' => 'Risks', 'action' => 'add', $property_id), array('class' => 'acciones', 'update' => 'riego', 'indicator' => 'loading')); ?>
