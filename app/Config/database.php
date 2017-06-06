<?php

class DATABASE_CONFIG {

    public $default = array(
		'datasource' => 'Database/Sqlserver',
		'persistent' => false,
		'host' => 'SRVDBADR01\PORTALESTADISTIC',
		'login' => 'usr_usaid',
		'password' => 'Usaid2017*',
		'database' => 'ipdr',
                'port'=>'1433'
		//'prefix' => '',
		//'encoding' => 'utf8',
	);
    public $remoto = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => '192.168.1.13',
        'login' => 'wilavel',
        'password' => 'marmota8126',
        'database' => 'pruebapba',
        'prefix' => '',
        'encoding' => 'utf8',
        
    );
    public $test = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'user',
        'password' => 'password',
        'database' => 'test_database_name',
        'prefix' => '',
            //'encoding' => 'utf8',
    );

}