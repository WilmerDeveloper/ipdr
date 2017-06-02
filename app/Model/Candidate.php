<?php 
class Candidate extends AppModel {

	public $name="Candidate";
	//public $belongsTo=array('Departament','City',);
        public $hasmany=array('ProductivePoll');
        public $belongsTo=array('FamilyPoll');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>