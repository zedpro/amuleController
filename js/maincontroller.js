
var app = angular.module ('amuleApp',[]);

app.controller ('MainController', function ($scope, $http) {

	$scope.nomeTest = "aMule";
	
	$scope.amuleService = function (azione) {
		var baseUrl = OC.generateUrl('/apps/amulecontroller');
		
		action = '/amulestart';
		if (azione == 'disattiva')	action = '/amulestop';
		else if (azione == 'aggiorna')	action = '/amulerefresh';
		
		// Siccome usiamo un provider diverso da jquery, dobbiamo informare nextcloud.
		// In particolare bisogna modificare il parametro requesttoken dell'header della richiesta
		// assegnandogli il valore della variabile globale di nextcloud oc_requesttoken
		$http.defaults.headers.common.requesttoken = oc_requesttoken;

		baseUrl = $scope.lbStato;

		// Utilizziamo il provider di angular anzichè quello di jquery perchè
		// altrimenti perderemmo lo $scope 
		$http({
	        url: baseUrl + action,
	        method: "POST",
	    })
	    .then(function(response) {
	    	console.log ("SUCCESS");
	    	
			if (response["status"] == 200) {
				$scope.lbStato = response["data"]["messaggio"];
			}
	    }, 
	    function(response) { 
	    	console.log ("ERROR");
	    });
	}

});