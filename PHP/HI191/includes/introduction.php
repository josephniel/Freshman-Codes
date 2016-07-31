<p>
	DOH web services is a web service created for the purpose of automating both the retrieval of statistical data from different entities and the generation of statistical results from these data. This web service uses SOAP or Simple Object Access Protocol, implemented by NuSOAP - a library for simple implementation of SOAP.
</p>
<pre data-language="php">require_once("./lib/nusoap.php");</pre>
<p>
	The above url serves as the server path to be used to communicate with the system for data transmission using the NuSOAP client initialization. 
</p>
<h5>NuSOAP Client Initialization</h5>
<pre data-language="php">$client = new nusoap_client("<?php echo $mainLink ?>");</pre>