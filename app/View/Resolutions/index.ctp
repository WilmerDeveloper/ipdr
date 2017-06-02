
<h1>Resoluciones proyecto: <?php echo $codigo . "" ?></h1>
<div>
    <table id="tabla"  >
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 15%">Fecha</th>
                <th style="width: 10%" >Número</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Resolutions as $Resolution): ?>
                <?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo  /" . $Resolution['Resolution']['adjunto'];
                ?>
            <tr>
                <td><?php echo $Resolution['Resolution']['id']; ?></td>
                <td><?php echo $Resolution['Resolution']['fecha']; ?></td>
                <td><?php echo $Resolution['Resolution']['numero']; ?></td>
                <td>
                    <table  cellpadding="5px" cellspacing="5px">
                        <tr>
                            <td>
                                    <?php 
                                    if($this->Session->read('bloqueado')!=1){
                                        echo $this->Ajax->link('Editar', array('controller' => 'Resolutions', 'action' => 'edit', $Resolution['Resolution']['id']), array('complete' => 'formularioAjax()', 'class' => 'acciones','update' => 'content', 'indicator' => 'loading'));
                                    }else if(AuthComponent::User('group_id') == 1 or AuthComponent::User('group_id') == 7)
                                        {
                                        echo $this->Ajax->link('Editar', array('controller' => 'Resolutions', 'action' => 'edit', $Resolution['Resolution']['id']), array('complete' => 'formularioAjax()', 'class' => 'acciones','update' => 'content', 'indicator' => 'loading'));
                                        } 
                                       ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    <?php echo $this->Html->link('Imprimir', array('controller' => 'Resolutions', 'action' => 'print_letter', $Resolution['Resolution']['id']), array('target' => 'blank', 'class' => 'acciones')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    <?php if($this->Session->read('bloqueado')!=1){echo $this->Ajax->link('Eliminar', array('controller' => 'Resolutions', 'action' => 'delete', $Resolution['Resolution']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?');}else if(AuthComponent::User('group_id') == 1 or AuthComponent::User('group_id') == 7){echo $this->Ajax->link('Eliminar', array('controller' => 'Resolutions', 'action' => 'delete',$Resolution['Resolution']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?');} ?>

                            </td>
                        </tr>
                    </table>
                </td>

                <td>

                    <table cellpadding="5px" cellspacing="5px">
                        <tr>
                            <td>
                                    <?php
                                    if (file_exists("../webroot/files/$proyect_id-$codigo/" . $Resolution['Resolution']['adjunto']) and $Resolution['Resolution']['adjunto'] != "")
                                        echo $this->Html->link('Adjunto resolución ', "../files/$proyect_id-$codigo/" . $Resolution['Resolution']['adjunto'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                                    ?>
                            </td>
                        <tr>
                            <td>

                                    <?php $this->Ajax->link('Corrección de información', array('controller' => 'Proyects', 'action' => 'correccion_de_informacion'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'actions')); ?> 

                            </td>
                        </tr>
                        <tr>
                            <td>
                                    <?php $this->Ajax->link('Resoluciones modificatorias', array('controller' => 'ResolutionCorrections', 'action' => 'index', $Resolution['Resolution']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'actions')); ?> 

                            </td>
                        </tr>
                    </table>  

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>  
<br><br><br>
<?php
///if (empty($Resolutions))
    if($this->Session->read('bloqueado')!=1){echo $this->Ajax->link('Adicionar', array('controller' => 'Resolutions', 'action' => 'add', $proyect_id), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'actions'));}
    else if(AuthComponent::User('group_id') == 1 or AuthComponent::User('group_id') == 7){echo $this->Ajax->link('Adicionar', array('controller' => 'Resolutions', 'action' => 'add', $proyect_id), array('update' => 'content', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'actions'));} 
?>