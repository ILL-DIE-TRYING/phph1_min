<?php
	// Include the config and phph1 class files
	include('config.php');
	include('phph1.php');
	
	// create a new phph1 class handle. These variables are defined in the config file
	$phph1 = new phph1($phph1_apiaddresses, $max_pagesize, $default_pagesize, $default_network, $default_shard);

	## GET BLOCK NUMBER ##
    // If there is no input to a method you can just grab the data
	// Turn the data into a variable (array in this case):
	$blocknumberdata = $phph1->hmyv2_blockNumber();
	print_r($blocknumberdata);
	
	// RESET THE PHPH1 errors for the next request
	// This really isn't required for the previous request because it won't produce errors as it has no input to validate
	// If you were using a method that required input validation first, this would need to be used to insure no errors from the previous method bleed into the next one.
	$phph1->phph1_reset();

	## GET BLOCK BY NUMBER ##
	// If there is input, you should use the val_ method first to determine if the input data is good or not
	// This is just an example block number.
	$blocknumber = 26943165;

	if($phph1->val_getBlockByNumber($blocknumber,true,false,true,true)){
		// Turn the data into a variable (array in this case):
		$myblockdata = $phph1->hmyv2_getBlockByNumber($blocknumber,true,false,true,true);
		// Used here to display the raw return data. You would want to handle this data differently in your application.
		print_r($myblockdata);
	}else{
		// If you were to turn the data into a variable (array in this case) it would go like so:
		$myerrors = $phph1->get_errors();
		// Used here to display the raw errors data. You would want to handle this data differently in your application.
		print_r($myerrors);
	}

?>