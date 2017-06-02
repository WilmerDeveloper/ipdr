<?php 
class Activity extends AppModel {

	public $name="Activity";
	public $belongsTo=array('Property',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
//	public $hasMany=array('Device','HomeSpace','LiveStock','PublicService',);

} 
 ?>