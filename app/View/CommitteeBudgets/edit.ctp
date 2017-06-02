<script>

    $(document).ready(function() {
        jQuery("#frm").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

)
</script>

<?php echo $this->Form->create("CommitteeBudget", array('id' => 'frm', 'enctype' => 'multipart/form-data', 'type' => 'file', array("action" => "", $this->data['CommitteeBudget']['id']))); ?>
<?php echo $this->Form->input('CommitteeBudget.id', array('label' => 'id', 'class' => '')); ?>
<?php echo $this->Form->hidden('CommitteeBudget.committee_id'); ?>
<?php echo $this->Form->hidden('CommitteeBudget.budget_id'); ?>
<?php echo $this->Form->input('CommitteeBudget.valor', array('label' => 'valor', 'class' => 'required','type'=>'number')); ?>
<br>
<br>
<label>Adjuntar soporte</label>
<?php echo $this->Form->file('CommitteeBudget.archivo', array('label' => 'Soporte', 'class' => '', 'accept' => 'pdf')); ?>
<br>
<br>
<?php echo $this->Form->input('CommitteeBudget.observacion', array('label' => 'observación')); ?>
<?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>