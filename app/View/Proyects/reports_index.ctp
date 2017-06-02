<script>
$( "#tbs" ).tabs();
</script>

<div id="tbs">
  <ul>
    <li><a href="#fragment-1"><span>FASE 0</span></a></li>
    <li><a href="#fragment-2"><span>Fase 1</span></a></li>
   
  </ul>
    <div id="fragment-1">
        <table border="1">
           
            <tbody>
                <tr>
                    <td>Evaluación de requisitos Beneficiarios</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Beneficiaries','action'=>'requirements_report'),array('target'=>'_blannk','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Evaluación de requisitos de predios</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Properties','action'=>'requirements_report'),array('target'=>'_blannk','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Calificación global fase 0</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Properties','action'=>'total_report'),array('target'=>'_blannk','class'=>'acciones'))?></td>
                </tr>
               
                
            </tbody>
        </table>

    
  </div>
  <div id="fragment-2">
    <table border="1">
           
            <tbody>
                <tr>
                    <td>Consolidado</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'proyects','action'=>'total_report'),array('target'=>'_blannk','class'=>'acciones'))?></td>
                </tr>
                
               
                
            </tbody>
        </table>
  </div>
  
</div>
 
