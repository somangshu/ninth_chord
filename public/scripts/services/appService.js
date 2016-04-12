greedygames.factory('appService', ['$http', '$rootScope', function ($http, $rootScope) {

	return {
		// genre's services
		getGenreData: function(callback) {
			$http({
				method: 'GET',
				url: '/v1/genres/',
			})
			.success(function(response) {
				if(callback) { callback(response); }
				// console.log(response);
			})
			.error(function (response) {
				console.error(response);
			});
		},
		saveNewGenre: function(name, callback){
			$http({
				method: 'POST',
				url: '/v1/genre/create',
				data: {
					"data" : name,
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
			})
			.error(function (response) {
				console.error(response);
			});
		},
		updateGenre: function(name, id, callback){
			$http({
				method: 'POST',
				url: '/v1/genres/'+id,
				data: {
					"data" : name,
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
			})
			.error(function (response) {
				console.error(response);
			});
		},

		//track's services
		getTracksData: function(string, callback) {
			$http({
				method: 'GET',
				url: '/v1/tracks',
				params: {
					"title": string
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
				// console.log(response);
			})
			.error(function (response) {
				console.error(response);
			});
		},
		saveNewTrack: function(name, callback){
			$http({
				method: 'POST',
				url: '/v1/track/create',
				data: {
					"data" : name,
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
			})
			.error(function (response) {
				console.error(response);
			});
		},
		updateTrack: function(name, id, callback){
			$http({
				method: 'POST',
				url: '/v1/tracks/'+id,
				data: {
					"data" : name,
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
			})
			.error(function (response) {
				console.error(response);
			});
		},
		getPaginatedObject: function(page, callback) {
			$http({
				method: 'GET',
				url: '/v1/tracks',
				params: {
					"page" : page
				}
			})
			.success(function(response) {
				if(callback) { callback(response); }
				// console.log(response);
			})
			.error(function (response) {
				console.error(response);
			});
		}
	}
}]);
