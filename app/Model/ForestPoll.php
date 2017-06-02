<?php

class ForestPoll extends AppModel {

    public $name = "ForestPoll";
    public $belongsTo = array('PlotPoll', 'ProductiveActivity');

}

?>