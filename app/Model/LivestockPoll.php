<?php

class LivestockPoll extends AppModel {

    public $name = "LivestockPoll";
    public $belongsTo = array('PlotPoll', 'ProductiveActivity');

}

?>