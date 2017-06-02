<?php 
class FamilyPoll extends AppModel {

	public $name="FamilyPoll";
	public $belongsTo=array('Property','City');
        public $hasMany=array('QualityOfLife', 'GenderInstitucionalSupport');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>