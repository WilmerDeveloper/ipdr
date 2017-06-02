<?php

class PlotPoll extends AppModel {

    public $name = "PlotPoll";
    public $belongsTo = array('Beneficiary', 'User');
    public $hasMany = array('ForestPoll', 'Liability', 'Typology');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>