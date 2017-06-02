<?php

class ProductiveActivity extends AppModel {

    public $name = "ProductiveActivity";
    public $hasMany = array('Consumption', 'MarketingLine', 'ProductiveArea', 'ForestPoll', 'FollowArea', 'LivestockPoll');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>