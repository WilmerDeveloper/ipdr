<?php

class Visit extends AppModel {

    public $name = "Visit";
    public $belongsTo = array('Proyect');
    public $hasMany = array('Photography', 'Product');

}

?>