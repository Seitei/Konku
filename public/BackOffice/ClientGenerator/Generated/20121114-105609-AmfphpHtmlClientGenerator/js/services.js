var amfphp;
if(!amfphp){
	amfphp = {};
}

amfphp.services = {};

amfphp.entryPointUrl = "http://localhost/BackOffice/../Amfphp/";


amfphp.services.ExampleService = {};

	
amfphp.services.ExampleService.returnOneParam = function(onSuccess, onError, param){
	var callData = JSON.stringify({"serviceName":"ExampleService", "methodName":"returnOneParam","parameters":[param]});
	    $.post(amfphp.entryPointUrl + "?contentType=application/json", callData, onSuccess)
	    	.error(onError);
	
}
