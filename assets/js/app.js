var base = $('base').attr('href')

var app = angular.module('app', []);

app.controller('globalCtrl', function ($scope) {

});

app.controller('addFlightCtrl', function ($scope,$http) {
	$scope.tgl_berangkat = 'NA'
	$scope.dewasa = $scope.anak = $scope.balita = 0
	$( "[name=maskapai]" ).autocomplete({
	      source: "api/maskapai",
	      minLength: 2,
	      select: function( event, ui ) {
	      		$scope.id_maskapai = ui.item.data.id
	      		// return false
	      	}
	})
	 $( "[name=asal],[name=tujuan]" ).autocomplete({
	      source: "api/bandara",
	      minLength: 2,
	      select: function( event, ui ) {
	      	if($(this).attr('name')=="asal")
	      		$scope.id_asal = ui.item.data.id
	      	else
	      		$scope.id_tujuan = ui.item.data.id
	      }
	})
      $('#tgl_berangkat').datetimepicker({ format: 'DD-MM-YYYY' });
      $('#berangkat,#tiba').datetimepicker({ format: 'HH:mm' });
      $scope.submit_airplane = function(){
      	$scope.tgl_berangkat = $('#tgl_berangkat').val()
      	$scope.berangkat = $('#berangkat').val()
      	$scope.tiba = $('#tiba').val()
      	var url = 'api/add_flight?id_maskapai='+$scope.id_maskapai+'&id_asal='+$scope.id_asal+'&id_tujuan='+$scope.id_tujuan+'&tgl_berangkat='+$scope.tgl_berangkat+'&berangkat='+$scope.berangkat+'&tiba='+$scope.tiba+'&dewasa='+$scope.dewasa+'&anak='+$scope.anak+'&balita='+$scope.balita+'&description='+$scope.description
      	$http.get(url)
    	.success(function(response) {
    		if(response.status=="ok"){
    			$('[name=maskapai]').val(null)
    			$('[name=asal]').val(null)
    			$('[name=tujuan]').val(null)
		      	$('#berangkat').val(null)
		      	$('#tiba').val(null)
    			$scope.id_maskapai = $scope.id_asal = $scope.id_tujuan = $scope.tgl_berangkat = $scope.berangkat = $scope.tiba = $scope.dewasa = $scope.anak = $scope.balita = $scope.description = null
    			$scope.status = "SUKSES"
    		}else{
    			$scope.status = "ERROR"

    		}
    	});
    		setTimeout(function(){	$scope.status="" }, 1000);

      }
})
app.controller('flightCtrl', function ($scope,$http) {
	$scope.tgl_berangkat = $scope.tgl_pulang = 'NA'
	$scope.dewasa = $scope.anak = $scope.balita = 0
	 $( "[name=asal],[name=tujuan]" ).autocomplete({
	      source: "api/bandara",
	      minLength: 2,
	      select: function( event, ui ) {
	      	if($(this).attr('name')=="asal")
	      		$scope.id_asal = ui.item.data.id
	      	else
	      		$scope.id_tujuan = ui.item.data.id
	      }
	})
      $('#tgl_berangkat,#tgl_pulang').datetimepicker({ format: 'DD-MM-YYYY' });
      $scope.submit_flight = function(){
      	$scope.tgl_berangkat = $('#tgl_berangkat').val()
      	$scope.tgl_pulang = $('#tgl_pulang').val()
      	var url = "api/penerbangan?ap=3928.3896&dt=02-11-2015.17-11-2015&ps=2.1.1"
      	// var url = 'api/penerbangan?ap='+$scope.id_asal+'.'+$scope.id_tujuan+'&dt='+$scope.tgl_berangkat+'.'+$scope.tgl_pulang+'&ps='+$scope.dewasa+'.'+$scope.anak+'.'+$scope.balita
      	$http.get(url)
	    	.success(function(response) {
	    		$scope.data = response
	    	});
      }
})
app.controller('ongkirCtrl', function ($scope,$http) {

 	$scope.ongkir = []
	 $( "[name=asal],[name=tujuan]" ).autocomplete({
	      source: "api/kota",
	      minLength: 2,
	      select: function( event, ui ) {

	      }
	    });

	$('#submit_ongkir').click(function(){
		if(!$( "[name=asal]").val()){
			alert("isi dahulu kota asal")
			return false
		}
		if(!$( "[name=tujuan]").val()){
			alert("isi dahulu kota tujuan")
			return false
		}
		if(!$( "[name=berat]").val()){
			alert("isi Berat barang")
			return false
		}
		var url = base+"api/ongkir"
		var param = "?asal="+$( "[name=asal]" ).val() +"&tujuan="+ $( "[name=tujuan]" ).val()+"&berat="+$( "[name=berat]" ).val()

		$http.get(url+param)
	    .success(function(response) 
	    	{
	    		if(response.status){
	    			$scope.ongkir = []
					$scope.unavailable = "Data tidak tersedia..."
	    		}else{
	    			$scope.asal = response.output.city.origin
					$scope.tujuan = response.output.city.destination
					$scope.berat = response.output.weight
					if (response.output.price){
						$scope.ongkir = response.output.price
					}else{
						$scope.ongkir = []
						$scope.unavailable = "Data tidak tersedia..."
					}
	    		}
				// console.log($scope.ongkir.length)
	    	});
		})
});