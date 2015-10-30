var base = $('base').attr('href')

var app = angular.module('app', []);

app.controller('globalCtrl', function ($scope) {

});

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