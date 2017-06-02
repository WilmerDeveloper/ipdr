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
            <th><?php echo $this->Paginator->sort('TechnicalAid.id', ''); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($TechnicalAids as $TechnicalAid): ?>
            <tr>
                <td>

                    <table border="1">
                        <thead>
                            <tr>
                                <th> ¿Recibió asistencia técnica?</th>
                                <th> <?php echo $TechnicalAid['TechnicalAid']['recibe']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>¿En qué?</td>
                                <td>(si respondió no)¿Por qué?</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->Form->input('TechnicalAid.gestion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['gestion'], 'label' => 'Gestión',)); ?></td>
                                <td><?php echo $this->Form->input('TechnicalAid.costos', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['costos'], 'label' => 'Costos', 'class' => '')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->Form->input('TechnicalAid.credito', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['credito'], 'label' => 'Crédito', 'class' => '')); ?></td>
                                <td><?php echo $this->Form->input('TechnicalAid.no_requiere', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['no_requiere'], 'label' => 'No requiere', 'class' => '')); ?></td>
                            </tr>
                            <tr>
                                <td>    <?php echo $this->Form->input('TechnicalAid.produccion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['produccion'], 'label' => 'Producción', 'class' => '')); ?></td>
                                <td><?php echo $this->Form->input('TechnicalAid.desconocimiento', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['desconocimiento'], 'label' => 'Desconocimiento', 'class' => '')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->Form->input('TechnicalAid.sanidad', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['sanidad'], 'label' => 'Sanidad', 'class' => '')); ?></td>
                                <td><?php echo $this->Form->input('TechnicalAid.no_importante', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['no_importante'], 'label' => 'No lo considera importante', 'class' => '')); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->Form->input('TechnicalAid.ambiental', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['ambiental'], 'label' => 'Ambiental', 'class' => '')); ?></td>
                                <td>Otro,¿Cuál? <?php echo $TechnicalAid['TechnicalAid']['otro_cual']; ?></td>

                            </tr>
                            <tr>
                                <td><?php echo $this->Form->input('TechnicalAid.organizacion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['organizacion'], 'label' => 'Organización', 'class' => '')); ?></td>
                                <td>  </td>
                            </tr>
                        </tbody>
                    </table>


                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿Quién prestó la asistencia técnica?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>    <?php echo $this->Form->input('TechnicalAid.particular', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['particular'], 'label' => 'Particular (Profesionales, técnicos del sector)', 'class' => '')); ?></td>
                            </tr>
                            <tr>
                                <td> 
                                    <?php echo $this->Form->input('TechnicalAid.intitucional', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['intitucional'], 'label' => 'Institucional (Sena, Umatas, Universidades, Secretarías)', 'class' => '')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <?php echo $this->Form->input('TechnicalAid.casa_comercial', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['casa_comercial'], 'label' => 'Organizaciones gremiales', 'class' => '')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <?php echo $this->Form->input('TechnicalAid.otros', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['otros'], 'label' => 'Otros', 'class' => '')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <?php echo $this->Form->input('TechnicalAid.no_informa', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['no_informa'], 'label' => 'No informa', 'class' => '')); ?>

                                </td>
                            </tr>

                    </table>

                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿En que requiere asistencia técnica?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>  
                                    <?php echo $this->Form->input('TechnicalAid.requiere_comercio', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_comercio'], 'label' => 'Comercio', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.requiere_produccion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_produccion'], 'label' => 'Producion', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.requiere_credito', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_credito'], 'label' => 'Credito', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.requiere_sanidad', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_sanidad'], 'label' => 'Sanidad', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.requiere_ambiental', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_ambiental'], 'label' => 'Ambiental', 'class' => '')); ?>
                                    <br>                   
                                    <?php echo $this->Form->input('TechnicalAid.requiere_organizacion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['requiere_organizacion'], 'label' => 'Organizacion', 'class' => '')); ?>                    
                                </td>
                            </tr>

                    </table>












                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2">    Área de la finca<?php echo $TechnicalAid['TechnicalAid']['area_finca']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >Área productiva</td>
                                <td >Área no  productiva</td>

                            </tr>
                            <tr>
                                <td>Àgricola:<?php echo $TechnicalAid['TechnicalAid']['agricola'] ?></td>
                                <td>Bosques: <?php echo $TechnicalAid['TechnicalAid']['bosques'] ?></td>

                            </tr>
                            <tr>
                                <td>Pecuaria:<?php echo $TechnicalAid['TechnicalAid']['pecuaria'] ?></td>
                                <td>Cuencas:<?php echo $TechnicalAid['TechnicalAid']['cuencas']; ?></td>

                            </tr>
                            <tr>
                                <td>Acuícola:<?php echo $TechnicalAid['TechnicalAid']['acuicola']; ?></td>
                                <td>Rastrojos:<?php echo $TechnicalAid['TechnicalAid']['rastrojos']; ?></td>
                            </tr>

                            <tr>
                                <td>Otra:<?php echo $TechnicalAid['TechnicalAid']['otra_si']; ?></td>
                                <td>Otra:<?php echo $TechnicalAid['TechnicalAid']['otra_no'] ?></td>
                            </tr>

                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿Tiene sistema de riego?   </th>
                                <th><?php echo $TechnicalAid['TechnicalAid']['sistema_riego'] ?> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $this->Form->input('TechnicalAid.gravedad', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['gravedad'], 'label' => 'Gravedad', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.aspersion', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['aspersion'], 'label' => 'Aspersión', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->input('TechnicalAid.goteo', array('disabled' => 1, 'checked' => $TechnicalAid['TechnicalAid']['goteo'], 'label' => 'Goteo', 'class' => '')); ?>
                                    <br>
                                    <?php echo $this->Form->hidden('TechnicalAid.productive_baseline_id', array('label' => 'productive_baseline_id', 'value' => $productive_baseline_id)); ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'TechnicalAids', 'action' => 'edit', $TechnicalAid["TechnicalAid"]["id"]), array('update' => 'asistencia', 'class' => 'acciones', 'indicator' => 'loading')); ?>
                    <br>
                    <br>
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'TechnicalAids', 'action' => 'delete', $TechnicalAid["TechnicalAid"]["id"], $productive_baseline_id), array('update' => 'asistencia', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea eliminra el registo?'); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if (count($TechnicalAids) == 0) echo $this->Ajax->link('Adicionar', array('controller' => 'TechnicalAids', 'action' => 'add', $productive_baseline_id), array('update' => 'asistencia', 'class' => 'acciones', 'indicator' => 'loading')); ?>
