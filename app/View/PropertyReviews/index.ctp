<?php echo $this->Session->flash(); ?>

<h1>REVISIONES DE DATOS CORRESPONDIENTES AL PREDIO CON MATRÍCULA <?php echo $codigo["Property"]["matricula"] ?> Y NOMBRE <?php echo $codigo["Property"]["nombre"] ?> </h1>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table  id="tabla"  >
    <thead>
        <tr>
            <th>Id</th>
            <th>Concepto</th>
            <th>Responsable</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($revisiones as $revision): ?>
            <tr>
                <td><?php echo $revision['PropertyReview']['id'] ?></td>  
                <td><?php echo $revision['PropertyReview']['concepto'] ?></td>
                <td><?php echo $revision['User']['nombre'] . " " . $revision['User']['primer_apellido'] . " " . $revision['User']['segundo_apellido'] ?></td>
                <td><?php echo $revision['PropertyReview']['fecha'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'PropertyReviews', 'action' => 'add', $codigo["Property"]["id"]), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?>
<br><br>