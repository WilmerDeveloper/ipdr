<?php

class PlotProduction extends AppModel {

    public $name = "PlotProduction";
    public $belongsTo = array('PlotPoll');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>