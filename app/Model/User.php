<?php

class User extends AppModel {

    public $name = "User";
    public $belongsTo = array('Group', 'Branch');
    //public $hasMany = array('PlotPoll');

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

   
    public $actsAs = array(
        
        'Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ),
        'Acl' => array('type' => 'requester')
        );

}

?>