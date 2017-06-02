
<br>    
<?php
echo $this->Paginator->counter(array(
    'format' => 'Página %page% de %pages%, Mostrando %current% registros de %count% totales, empezando en %start%, terminando en %end%'
        )
);
?>

<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . 'Anterior', array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table class="index">
    <thead>
        <tr>
           
            <th>ARCHIVOS PARA DESCARGAR</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                
               
                
                <td>

                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion']) and $Property['Property']['ruta_resolucion'] != "")
                        echo $this->Html->link('Resolución', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_resolucion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                     <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula']) and $Property['Property']['ruta_matricula'] != "")
                        echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['ruta_matricula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    
                    
                    <br><br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito']) and $Property['Property']['archivo_distrito'] != "")
                        echo $this->Html->link('Certificación_distrito_de_riego.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_distrito'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo']) and $Property['Property']['archivo_uso_suelo'] != "")
                        echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo']) and $Property['Property']['archivo_resguardo'] != "")
                        echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_resguardo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo']) and $Property['Property']['archivo_consejo'] != "")
                        echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $Property["Property"]["id"] . "/" . $Property['Property']['archivo_consejo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    ?>
                   

                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index',$property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>
<?php echo $this->Js->writeBuffer(); ?>

