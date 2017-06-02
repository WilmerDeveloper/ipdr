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
            <th> IDENTIFICACIÓN</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                <td>
                    <table border="1">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Municipio: <?php echo $Property['City']['name'] ?></td>
                                <td>Departamento: <?php echo $Property['Departament']['name'] ?></td>
                                <td>Corregimiento: <?php echo $Property['Property']['corregimiento'] ?></td>

                            </tr>
                            <tr>
                                
                                <td>Corregimiento: <?php echo $Property['Property']['vereda'] ?></td>
                                <td>Nombre: <?php echo $Property['Property']['nombre'] ?></td>
                                <td>Área: <?php echo $Property['Property']['extension'] ?></td>

                            </tr>
                            <tr>
                                
                                <td>Matrícula: <?php echo $Property['Property']['matricula'] ?></td>
                                <td>Número de parcelas: <?php echo $Property['Property']['numero_parcelas'] ?></td>
                                <td>Número de habitantes: <?php echo $Property['Property']['numero_habitantes'] ?></td>

                            </tr>
                            <tr>
                                
                                <td>Nombre consejo: <?php echo $Property['Property']['nombre_consejo'] ?></td>
                                <td>Nombre resguardo: <?php echo $Property['Property']['nombre_resguardo'] ?></td>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>

                </td>
                <td><?php echo $this->Ajax->link('Editar', array('update' => 'identificacion', 'class' => 'acciones', 'controller' => 'Properties', 'action' => 'edit_identification', $Property["Property"]["id"]), array('update' => 'identificacion', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
