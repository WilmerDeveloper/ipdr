<?php echo $this->Session->flash(); ?>

<h1>REVISIONES DE DATOS CORRESPONDIENTES AL BENEFICIARIO <?php echo $codigo["Beneficiary"]["nombres"] . " " . $codigo["Beneficiary"]["primer_apellido"] . " " . $codigo["Beneficiary"]["segundo_apellido"] ?></h1>
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
                <td><?php echo $revision['BeneficiaryReview']['id'] ?></td>  
                <td><?php echo $revision['BeneficiaryReview']['concepto'] ?></td>
                <td><?php echo $revision['User']['nombre'] . " " . $revision['User']['primer_apellido'] . " " . $revision['User']['segundo_apellido'] ?></td>
                <td><?php echo $revision['BeneficiaryReview']['fecha'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'BeneficiaryReviews', 'action' => 'add', $codigo["Beneficiary"]["id"]), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?>
<br><br>