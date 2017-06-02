<?php 
class PropertyControl extends AppModel {

	public $name="PropertyControl";
	public $belongsTo=array('Property',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>