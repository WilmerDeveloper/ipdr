<script>


    $(document).ready(function() {


        jQuery("#formRiego").validate({
            submitHandler: function(form) {

                jQuery(form).ajaxSubmit({
                    target: "#riego",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )

</script>
<div>
    <?php echo $this->Form->create("Risk", array("id" => "formRiego", 'url' => array('controller' => 'Risks', "action" => "add", $this->data['Risk']['property_id']))); ?>
    <?php echo $this->Form->input('Risk.id'); ?>
    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>¿El Predio cuenta con fuentes de captación de agua?</th>
                    <th>    <?php echo $this->Form->input('Risk.fuentes_agua', array('label' => '', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.laguna', array('label' => 'Laguna', 'class' => '')); ?>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.rio', array('label' => 'Rio', 'class' => '')); ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.cienaga', array('label' => 'Cienaga', 'class' => '')); ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.nacimiento', array('label' => 'Nacimiento', 'class' => '')); ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.agual_lluvias', array('label' => 'Aguas lluvias', 'class' => '')); ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.acueducto_local', array('label' => 'Acueducto local', 'class' => '')); ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <?php echo $this->Form->input('Risk.distrito_de_riego', array('label' => 'Distrito de riego', 'class' => '')); ?>


                    </td>

                </tr>
            </tbody>
        </table>
        <?php echo $this->Form->hidden('Risk.property_id', array('label' => 'property_id')); ?>
        <?php echo $this->Form->hidden('Risk.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </div>