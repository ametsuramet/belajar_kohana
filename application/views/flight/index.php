<input type="hidden" id="page" value="flight">
<div ng-controller="flightCtrl">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-danger crimson">
			<div class="panel-body ">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="invert">Asal :</label>
							<input name="asal" class="form-control" ng-model="asal">
						</div>
						<div class="form-group">
							<label class="invert">Tujuan :</label>
							<input name="tujuan" class="form-control" ng-model="tujuan">
						</div>
						
						<div class="form-group">
							<button class="btn btn-block btn-primary" ng-click="submit_flight()">Submit</button>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="invert">Tgl :</label>
							<input name="tgl_berangkat" class="form-control" ng-model="tgl_berangkat" id="tgl_berangkat">
						</div>
						<div class="form-group">
							<label class="invert">Tgl Pulang:</label>
							<input name="tgl_pulang" class="form-control" ng-model="tgl_pulang" id="tgl_pulang">
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label class="invert">Dewasa :</label>
									<input name="dewasa" class="form-control" ng-model="dewasa" type="number" value="0">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label class="invert">Anak-anak :</label>
									<input name="anak" class="form-control" ng-model="anak" type="number" value="0">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label class="invert">Balita :</label>
									<input name="balita" class="form-control" ng-model="balita" type="number" value="0">
								</div>
							</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2" ng-show="data">
			<h3>{{data.origin.name}} {{data.origin.city}} ({{data.origin.IATA}}) - {{data.destination.name}} {{data.destination.city}} ({{data.destination.IATA}})</h3>
			<table class="table table-hover"  ng-show="data.airlines.length" >
				<thead>
					<tr>
						<th></th>
						<th>Date</th>
						<th>Departure</th>
						<th>Arrival</th>
						<th width="20px"></th>
						<th>Description</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody id="#{{item.id}}" ng-repeat="item in data.airlines">
				
					<tr >
						<th class="airlines"  colspan="7">{{item.name}}</th>
					</tr>
					<tr ng-repeat="schedule in item.schedules.trip" >
						<td></td>
						<td>{{schedule.date | date:'dd-MM-yyyy'}}</td>
						<td>{{schedule.departure | date:'HH:mm'}}</td>
						<td>{{schedule.arrival | date:'HH:mm' }}</td>
						<td>
							<span><i class="fa fa-plane"></i></span>
						</td>
						<td>{{schedule.description}}</td>
						<td>{{(data.passenger.dewasa*schedule.price_adult)+(data.passenger.anak*schedule.price_children)+(data.passenger.balita*schedule.price_toddler) | currency : "IDR " : 0}}</td>
					</tr>
					<tr ng-repeat="schedule in item.schedules.return" >
						<td></td>
						<td>{{schedule.date | date:'dd-MM-yyyy'}}</td>
						<td>{{schedule.departure | date:'HH:mm'}}</td>
						<td>{{schedule.arrival | date:'HH:mm' }}</td>
						<td>
							<span><i class="fa fa-plane rotate"></i></span>
						</td>
						<td>{{schedule.description}}</td>
						<td>{{(data.passenger.dewasa*schedule.price_adult)+(data.passenger.anak*schedule.price_children)+(data.passenger.balita*schedule.price_toddler) | currency : "IDR " : 0}}</td>
					</tr>
						
				</tbody>
			</table>
			<h4 class="table table-hover"  ng-hide="data.airlines.length" >Data Tidak Tersedia...</h4>

		</div>
	</div>
	
</div>