<fieldset>
    <?php echo $this->Form->create("Proyect", array('class' => 'form', "action" => "edit_proyect/" . $this->data['Proyect']['id'])); ?>
    <?php echo $this->Form->hidden('Proyect.sincronizado', array('value' => 0)); ?>
    <fieldset><legend></legend>

        <table border="0" style="width: 70%">

            <tbody>
                <tr>

                    <td><h1>ASIGNAR PREDIOS AL PROYECTO <?php echo $this->data['Proyect']['codigo'] ?></h1></td>
                    <td><?php echo $this->Form->input('Proyect.id'); ?></td>
                </tr>

                <?php foreach ($Properties as $Property): ?>
                    <tr
                        style="background: 
                        <?php
                        if ($Property['Property']['calificacion_fase0'] == 'Cumple')
                            echo '#8be57f';
                        elseif ($Property['Property']['calificacion_fase0'] == 'No cumple')
                            echo '#ea6874';
                        else
                            echo'#f1e57a';
                        ?>"
                        >

                        <td><?php echo "(".$Property['Call']['nombre'].")    ".$Property['Property']['nombre'] . " Matricula: ".$Property['Property']['matricula']." " . $Property['City']['name'] . " (" . $Property['Departament']['name'] . ")" ?></td>
                        <td><?php echo $this->Form->checkbox('', array('name' => "lista[]", "checked" => "", 'hiddenField' => false, 'label' => '', 'value' => $Property['Property']['id'])); ?></td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>

    </fieldset>
</fielset>

<?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

</fieldset>


<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>