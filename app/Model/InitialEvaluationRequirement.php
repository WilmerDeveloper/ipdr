<?php

class InitialEvaluationRequirement extends AppModel {

    public $name = "InitialEvaluationRequirement";
    public $belongsTo = array('InitialEvaluation', 'Requirement',);
   
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>