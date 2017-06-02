<fieldset>
    <?php
    echo $this->Form->create('UserProyect');
    echo $this->Form->hidden("UserProyect.user_id");
    echo $this->Form->input("UserProyect.codigo", array('label' => 'Ingrese Código Proyecto'));

    foreach ($convocatorias as $convocatoria) {
        $options[$convocatoria['Call']['id']] = $convocatoria['Call']['nombre'];
    }

    echo $this->Form->input('UserProyect.convocatoria', array('label' => 'Convocatoria', 'options' => $options))
    ?>
    <div id="loading" style="display: none;">
        <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
    </div>
    <?php
    echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'UserProyects', 'action' => 'add', $this->data['UserProyect']['user_id']), 'update' => 'content', 'indicator' => 'loading'));
    echo $this->Form->end();
    ?>
</fieldset>
<?php echo $this->Ajax->link($this->Html->image("regresar.gif", array('width' => '30', 'heigth' => '30', 'alt' => 'regresar', 'align' => 'center')), array('controller' => 'UserProyects', "action" => "index", $this->data['UserProyect']['user_id']), array('escape' => false, 'update' => 'content', 'indicator' => 'loading')); ?>
