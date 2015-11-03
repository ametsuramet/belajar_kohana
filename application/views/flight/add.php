<input type="hidden" id="page" value="add_flight">
<div ng-controller="addFlightCtrl">
	
		<div class="panel panel-danger crimson">
			<div class="panel-body ">
				<h1 class="invert">Tambah Jadwal :</h1>

				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="invert">Maskapai :</label>
							<input name="maskapai" class="form-control" ng-model="maskapai">
						</div>
						<div class="form-group">
							<label class="invert">Asal :</label>
							<input name="asal" class="form-control" ng-model="asal">
						</div>
						<div class="form-group">
							<label class="invert">Tujuan :</label>
							<input name="tujuan" class="form-control" ng-model="tujuan">
						</div>
						<div class="form-group">
							<label class="invert">Tgl :</label>
							<input name="tgl_berangkat" class="form-control" ng-model="tgl_berangkat" id="tgl_berangkat">
						</div>
						<div class="form-group">
							<label class="invert">Berangkat :</label>
							<input name="berangkat" class="form-control" ng-model="berangkat" id="berangkat">
						</div>
						<div class="form-group">
							<label class="invert">Tiba :</label>
							<input name="tiba" class="form-control" ng-model="tiba" id="tiba">
						</div>
						
					</div>
					<div class="col-md-6 col-sm-6">
						
						<div class="row">
							<div class="col-md-12">
							<label class="invert">Harga :</label>
							<br>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label class="invert">Dewasa :</label>
									<input name="dewasa" class="form-control" ng-model="dewasa" type="number" value="0">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label class="invert">Anak2 :</label>
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
						<div class="form-group">
							<label class="invert">Keterangan :</label>
							<textarea name="description" class="form-control" ng-model="description" id="description" rows="5"></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-block btn-primary" ng-click="submit_airplane()">Submit</button>
							<h1 class="invert">{{status}}</h1>
						</div>
						
					</div>
				</div>
			</div>
		</div>


	
</div>
