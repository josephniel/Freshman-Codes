<p>
	After initializing the server to communicate with, it is essential to call first the <i>connect function</i> of the server to authenticate the user.  
</p>
<h5>Connect Function Call</h5>
<pre data-language="php">
define("USERID", "Your User ID");
define("PASSWORD", "Your Password");

$connect = $client->call("connect", array(USERID, PASSWORD));
</pre>
<p>
	Once connected, functions are readily available for transmission.
</p>