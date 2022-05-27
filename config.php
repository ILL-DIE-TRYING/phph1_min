<?php
/**
* This file contains all the settings required to invoke the PHPH1 class
* The config.php should be included in your project (or the settings in your project's configuration file) before invoking the PHPH1 class
*
* Be sure to look at the commenting in the this file for more information.
*
* Settings:
*
* $phph1_apiaddresses - This is a multi-dimensional array that holds the node and shard information. By default this array contains the official Harmony nodes but you can comment them out and add your own personal nodes as shown where the array is set. if you do add your own node address, be sure to also set $default_network and $default_shard as well
*
* $default_network - Sets the default network (also the network used by the rpc script). It MUST use a network listed in the $phph1_apiaddresses array. For example by default it is set to use "mainnet".
*
* $default_shard - Sets the default shard (also the shard used by the rpc script). It MUST use a shard listed in the $phph1_apiaddresses array. For example by default it is set to use "0".
*
* $default_pagesize - The default page size for methods that return multiple pages of data
*
* $max_pagesize - This is the maximum number of items per page when a method returns multiple pages of data. This prevents a client from reuesting large datasets in a single call which will put a heavy load on the web server.
*
*/


// ARRAY OF API ADDRESSES
// This can be extended/shortened to your liking
$phph1_apiaddresses = array(
	'mainnet' => [
		0 => 'https://a.api.s0.t.hmny.io/',
		1 => 'https://rpc.s1.t.hmny.io/',
		2 => 'https://rpc.s2.t.hmny.io/',
		3 => 'https://rpc.s3.t.hmny.io/'	
	],
	'testnet' => [
		0 => 'https://rpc.s0.b.hmny.io/',
		1 => 'https://rpc.s1.b.hmny.io/',
		2 => 'https://rpc.s2.b.hmny.io/',
		3 => 'https://rpc.s3.b.hmny.io/'	
	],
	
	// This is how you would extend the node addresses
	// There can be any number of shards and they do not have to start with 0
	// The port numbers are just random and can be whatever you use, if necessary
	// You can also remove the officia harmony API addresses and only use your own
	// Just be sure to set $default_network and $default_shard appropriately as well
	/*
	
	'customnet' => [
		0 => 'https://localhost:10443',
		1 => 'https://192.168.50.4:65447/'	
	],
	
	*/
);


// Default network to use from $phph1_apiaddresses
$default_network = 'mainnet';

// Default shard on the default network set above
$default_shard = 0;

// Default number of results per page when an API call returns data in pages
$default_pagesize = 10;

// Maximum number of results per page
// Limits the number of results per page
$max_pagesize = 100;
?>