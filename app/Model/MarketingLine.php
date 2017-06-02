<?php 
class MarketingLine extends AppModel {

	public $name="MarketingLine";
	public $belongsTo=array('ProductivePoll','ProductiveActivity',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>