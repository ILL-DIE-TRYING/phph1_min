# phph1_min
The minimal version of the PHPH1 class wrapper for the Harmony None API v2 to be used with PHP projects

Download the package and extract it to a directory
You can get the package at the Github project releases page.
Extract the package and upload all files to your web host. The package contents can sit in your document root or any sub directory.

You will have to handle the archive a little differently depending on whether you downloaded the .zip or the .tar.gz file.

The .zip file, if extracted with no directory options will extract all the files to the current directory which can be messy. If using the zip file on a Linux/Unix machine, be sure to extract it into a directory where no other files exist or use the unzip -d option.

The tar.gz package will extract within a directory that matches the release name.

It is highly suggested whether using the zip or tar.gz, you extract the package outside of your project and then copy it to where you want it. This will ensure nothing gets accidentally overwritten.

- Check and adjust the settings to your liking in inc/config.php

**$phph1_apiaddresses**
This is a multi-dimensional array that holds the node and shard information. By default this array contains the official Harmony nodes but you can comment them out and add your own personal nodes as shown where the array is set. if you do add your own node address, be sure to also set $default_network and $default_shard as well

**$default_network**
Sets the default network (also the network used by the rpc script). It MUST use a network listed in the $phph1_apiaddresses array. For example by default it is set to use "mainnet".

**$default_shard**
Sets the default shard (also the shard used by the rpc script). It MUST use a shard listed in the $phph1_apiaddresses array. For example by default it is set to use "0".

**$default_pagesize**
The default page size for methods that return multiple pages of data

**$max_pagesize**
This is the maximum number of items per page when a method returns multiple pages of data. This prevents a client from reuesting large datasets in a single call which will put a heavy load on the web server.

- Include the required files in your page (There is an example index.php for reference)
```
include('config.php');
include('phph1.php');
```
Create a PHPH1 class handle
```
$phph1 = new phph1($phph1_apiaddresses,$max_pagesize,$default_pagesize, $default_network, $default_shard);
```

Refer to the documentation for all of the methods and their required inputs.
Each method has a validation method that starts with val_ and the actual method that starts with hmyv2_

When running the validation methods, if there are errors they are stored in the class array variable errors, you can retrieve them as an array using $phph1->get_errors()

```
if($phph1->val_getBlockByNumber('26974649',TRUE,FALSE,TRUE,TRUE)){
	$blockdata = $phph1->hmyv2_getBlockByNumber('26974649',TRUE,FALSE,TRUE,TRUE);
	// This is just here to show you what output is available
	print_r($blockdata);
}else{
	// This is just here to show you what errors exist
	print_r($phph1->get_errors());
}
```

When running the hmyv2_ methods, data is returned in a JSON encoded format.

- You can decode the data using PHP's json_decode() but be warned, converting large data with PHP can put a heavy memory load on the server

- You can decode the data by passing the PHP object off to javascript. This is the recommended way and performs seemingly well with large data returns.

```
<p id="block_hash">Loading</p>
<p id="block_epoch">Loading</p>

<?php
// Include the config and class
include('config.php');
include('phph1.php');

// Create the phph1 class handle
$phph1 = new phph1($phph1_apiaddresses,$max_pagesize,$default_pagesize, $default_network, $default_shard);

// Using hmyv2_getBlockByNumber with block number 26974649 as an example
if($phph1->val_getBlockByNumber('26974649',TRUE,FALSE,TRUE,TRUE)){
	
	// Make the API call
	$blockdata = $phph1->hmyv2_getBlockByNumber('26974649',TRUE,FALSE,TRUE,TRUE);
	
	// This line below is for debugging. Uncomment the line to see it
	// print_r($blockdata);
}else{
	// This line below is for debugging. Uncomment the line to see it
	// print_r($phph1->get_errors());
	
	// Iterate through the errors
	foreach($phph1->get_errors() as $anError){
		echo "<p>".$anError."<p>";
	}
}
?>
<script>
// Notice I used the "block_hash" id so the text goes into the proper container defined above
var hash_id = document.getElementById("block_hash");

// Notice I used the "block_epoch" id so the text goes into the proper container defined above
var epoch_id = document.getElementById("block_epoch");

// This is where the PHP object gets injected into Javascript
var obj = <?=$blockdata?>;

// Put the block's hash data in the <p> container we defined above
hash_id.innerHTML = obj["result"]["hash"];

// Put the block's epoch data in the <p> container we defined above
epoch_id.innerHTML = JSON.stringify(obj, "epoch", 2);

</script>
```
