<?php 
class PropertyRequirement extends AppModel {

	public $name="PropertyRequirement";
	public $belongsTo=array('InitialRequirement','Property');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>