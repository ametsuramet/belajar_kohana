<div ng-controller="ongkirCtrl">
	<div class="col-md-3 col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
			   Cari Ongkir
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Asal :</label>
					<input name="asal" class="form-control">
				</div>
				<div class="form-group">
					<label>Tujuan :</label>
					<input name="tujuan" class="form-control">
				</div>
				<div class="form-group">
					<label>Berat :</label>
					<input name="berat" class="form-control" type="number" value="1">
				</div>
				<div class="form-group">
					<button class="btn btn-block btn-danger" id="submit_ongkir">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9 col-sm-6">
		<div ng-if="ongkir.length">
		<ul class="detail">
			<li><label>Daerah Asal:</label> {{asal}}</li>
			<li><label>Daerah Tujuan:</label> {{tujuan}}</li>
			<li><label>Berat:</label> {{berat}}</li>
		</ul>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Nama Service</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in ongkir" >
					<td>{{item.service_code}}</td>
					<td>{{item.service}}</td>
					<td>{{item.value  | currency:"Rp. ":0 }}</td>
				</tr>
			
			</tbody>
		</table>
		</div>
		<div ng-if="!ongkir.length">
			{{unavailable}}
		</div>
	</div>
</div>