<script>
    $(document).ready(function() {
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true ,
            active: false
        }
    );
        $(function() {
            $( "#social_tabs" ).tabs();
        });
      
        $( '#identificacion' ).load('<?php echo $this->Html->url(array('controller' => 'FamilyPolls', 'action' => 'identification_index', $family_poll_id)) ?>');
        $( '#control_operativo' ).load('<?php echo $this->Html->url(array('controller' => 'FamilyPolls', 'action' => 'operative_index', $family_poll_id)) ?>');
        $( '#familiares' ).load('<?php echo $this->Html->url(array('controller' => 'Families', 'action' => 'baseline_index', $beneficiary_id)) ?>');
        $( '#generalidades' ).load('<?php echo $this->Html->url(array('controller' => 'Beneficiaries', 'action' => 'generalidades', $beneficiary_id)) ?>');
        $( '#social' ).load('<?php echo $this->Html->url(array('controller' => 'Beneficiaries', 'action' => 'social_index', $beneficiary_id)) ?>');
        $( '#asc' ).load('<?php echo $this->Html->url(array('controller' => 'FamilyPolls', 'action' => 'asociation_index', $family_poll_id)) ?>');
        $( '#gastos' ).load('<?php echo $this->Html->url(array('controller' => 'Expenses', 'action' => 'index', $family_poll_id)) ?>');
        $( '#genero_y_apoyo' ).load('<?php echo $this->Html->url(array('controller' => 'GenderInstitutionalSupports', 'action' => 'index', $family_poll_id)) ?>');
        $( '#calidad_de_vida' ).load('<?php echo $this->Html->url(array('controller' => 'QualityOfLives', 'action' => 'index', $family_poll_id)) ?>');

    }
);

</script>

<div id="accordion">

    <h3><a href="#">I. IDENTIFICACIÓN</a></h3>
    <div id="identificacion" >


    </div>
    <h3><a href="#">II. GENERALIDADES</a></h3>
    <div id="generalidades" >

        
    </div>
    <h3><a href="#">Familiares</a></h3>
    <div id="familiares" >

       
    </div>
    <h3><a href="#">III. ASPECTOS SOCIALES Y ORGANIZACIONALES</a></h3>
    <div id="social_tabs" >
        <ul>
            <li><a href="#social">Social:</a></li>
            <li><a href="#asc">Asociación: </a></li>
        </ul>
        <div id="social">

        </div>
        <div id="asc">
            rwerwer
        </div>

    </div>
    <h3><a href="#">IV. GÉNERO Y APOYO INSTITUCIONAL</a></h3>

    <div id="genero_y_apoyo" >


    </div>
    <h3><a href="#">V. CALIDAD DE VIDA</a></h3>
    <div id="calidad_de_vida" >


    </div>
    <h3><a href="#">VI. INGRESOS Y GASTOS</a></h3>
    <div id="gastos" >


    </div>
    <h3><a href="#">CONTROL OPERATIVO</a></h3>
    <div id="control_operativo" >


    </div>

</div>
<table style="border: 1px solid" width="50%" align="center">
    <tbody>
        <tr>
            <td align="center">
                <?php echo $this->Ajax->link("Regresar", array('controller' => 'FamilyPolls', "action" => "baseline_index",$beneficiary_id), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading')) ?>
            </td>
        </tr>
    </tbody>
</table>