<?php echo $this->Session->flash(); ?>
<table id="tabla" class="tabla" width="100%">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Proyectos Asignados</th>
            <th>Convocatoria</th>
            <th>Calificación formulación</th>
            <th>Calificación evaluación</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($user)): ?>
            <?php foreach ($user as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['User']['username'] ?> </td>
                    <td><?php echo $usuario['Proyect']['codigo'] ?> </td>
                    <td><?php echo $usuario['Call']['nombre'] ?> </td>
                    <td>
                        <?php
                        App::import('model','Formulation');
                        $Formulation=new Formulation();
                       $formulacion= $Formulation->find('first',array('recursive'=>-1,'fields'=>array('Formulation.calificacion_evaluador'), 'conditions'=>array('Formulation.proyect_id'=>$usuario['UserProyect']['proyect_id'] ),'order'=>array('Formulation.id DESC') ) );
                      
                       echo $formulacion['Formulation']['calificacion_evaluador'];
                        ?> 
                    </td>
                    <td>
                        <?php
                        App::import('model','InitialEvaluation');
                        $InitialEvaluation=new InitialEvaluation();
                       $evaluacion= $InitialEvaluation->find('first',array('recursive'=>-1,'fields'=>array('InitialEvaluation.calificacion_integral'), 'conditions'=>array('InitialEvaluation.user_id'=>$user_id,'InitialEvaluation.proyect_id'=>$usuario['UserProyect']['proyect_id'] ),'order'=>array('InitialEvaluation.id DESC') ) );
                        echo $evaluacion['InitialEvaluation']['calificacion_integral'];
                        ?> 
                    </td>
                    <td><?php echo $this->Ajax->link($this->Html->image("delete.png", array('width' => '30', 'heigth' => '30', 'alt' => 'Eliminar')), array('controller' => "UserProyects", "action" => "delete", $usuario['UserProyect']['id'], $usuario['UserProyect']['user_id']), array('escape' => false, 'update' => 'content', 'complete' => 'cargar()', 'indicator' => 'loading'), '¿Esta seguro de eliminar esta asignación? ') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<table border="0"  CellSpacing=10  align="center">
    <thead >
        <tr>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $this->Ajax->link($this->Html->image("regresar.gif", array('width' => '30', 'heigth' => '30', 'alt' => 'regresar', 'align' => 'center')), array('controller' => 'Users', "action" => "list_users"), array('escape' => false, 'update' => 'content', 'indicator' => 'loading')); ?></td>
            <td></p><?php echo $this->Ajax->link($this->Html->image("adicionar.png", array('width' => '35', 'heigth' => '35', 'alt' => 'Adicionar proyecto')), array('controller' => 'UserProyects', "action" => "add", $user_id), array('escape' => false, 'update' => 'content', 'indicator' => 'loading')); ?></td>
        </tr>
    </tbody>
</table>

<?php
echo "<br>";
?>

<div id="adicionar"></div>