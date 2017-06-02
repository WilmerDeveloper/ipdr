<?php 
class InitialEvaluation extends AppModel {

	public $name="InitialEvaluation";
	public $belongsTo=array('Proyect','Formulation','User');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>