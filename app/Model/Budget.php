<?php 
class Budget extends AppModel {

	public $name="Budget";
	public $belongsTo=array('MonitoringActivity','Follow');
         var $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>