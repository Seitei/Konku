<?php 
/**
 *  This file is part of amfPHP
 *
 * LICENSE
 *
 * This source file is subject to the license that is bundled
 * with this package in the file license.txt.
 * @package Amfphp_Backoffice_Generators
 * 
 */

/**
 * include
 */
 require_once 'top.php';
?>
<ul id='menu'>
<h1>ExampleService Service UI</h1>
<script type="text/javascript">
<!--

function returnOneParamResultHandler(returned){
	$('#resultOutput').dump(returned);
}

function returnOneParamServiceCall(){
	amfphp.services.ExampleService.returnOneParam(returnOneParamResultHandler, onError,$('#returnOneParamparam').val());	
}

function onError(){
	alert("error");
}
//-->
</script>

 <li><b>returnOneParam

		<input type="text" id="returnOneParamparam"/>

		<input type="submit" value="call returnOneParam" onclick="returnOneParamServiceCall()"/>
</b></li>		

</ul>
<br/>
<div id="content">
	<div id="resultOutput">
	</div>
</div>
    </body>	
</html>
