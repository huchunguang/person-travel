<?php
use Monolog\Logger;

return [ 
	
	'default' => 'kwopdo',
	
	/*
	 |--------------------------------------------------------------------------
	 | Filesystem Disks
	 |--------------------------------------------------------------------------
	 |
	 | Here you may configure as many filesystem "disks" as you wish, and you
	 | may even configure multiple disks of the same driver. Defaults have
	 | been setup for each driver as an example of the required options.
	 |
	 */
	
	'handlers' => [ 
		
		'kwopdo' => [ 
			
			'table' => 'tbl_trip_log',
			'additional_fields' => [ 
				
				'trip_id' => 'BIGINT(20) DEFAULT NULL'
			],
			'additional_indexes' => [ ],
			'level' => env('kwopdo_level', Logger::INFO)
		]
	
	]

];
