<?php 
class Home extends AppModel {

	public $name="Home";
	public $belongsTo=array('Candidate',);
	public $hasMany=array('Device','HomeSpace','LiveStock','PublicService',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>