<?PHP
use OCP\Util;

Util::addStyle('amulecontroller', 'simple-grid.min');
Util::addScript('amulecontroller', 'vendor/angular-1.5.3/angular.min');
Util::addScript('amulecontroller', 'maincontroller');
?>


<div ng-app="amuleApp">
	<div class="container" ng-controller="MainController">
		<div class="row">
			<div class="col-1"><h5>aMule: </h5></div>
			<div class="col-8"><a href="http://benti.s7a.cloud:4711">http://benti.s7a.cloud:4711</a></div>
		</div>
		
		<div class="row">
		 	<div class="col-1"><h5>Attiva: </h5></div>
			<div class="col-1"><button ng-click="amuleService ('attiva')">Start</button></div>
		</div>
		
		 <div class="row">
		 	<div class="col-1"><h5>Disattiva: </h5></div>
			<div class="col-1"><button ng-click="amuleService ('disattiva')">Stop</button></div>
		</div>
		
		<div class="row">
		 	<div class="col-1"><h5>Stato: </h5></div>
		 	<div class="col-1"><button ng-click="amuleService ('aggiorna')">Refresh</button></div>
			<div class="col-10"><h5 id="stato">{{lbStato}}</h5></div>
			
		</div>
	</div>
	
	<br/>
</div>

