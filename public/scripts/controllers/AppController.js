greedygames.controller('AppCtrl', function ($scope, $timeout, appService) {

});

greedygames.controller('TrackCtrl', function ($scope, $timeout, appService) {

    $scope.max = 5;
    $scope.totalItems = 0;
    $scope.currentPage = 0;
    $scope.pagerSize = 5;
    $scope.addTrackForm = false;
    $scope.alerts = [];
    $scope.tracks = [];
    $scope.trackName = null;
    $scope.trackId = null;
    $scope.selectedRating = null;
    $scope.saveData = {}
    $scope.selectedGenreArray = [];
    $scope.genres = [];
    $scope.genresTemplate = {
        "id": null,
        "name": null,
        "status": false,
    };

    /**
     * @ngdoc getTrackCallback
     * @name response
     * @description callback operation after all
     * tracks called.
     */
    $scope.getTrackCallback = function(response) {
        if (! response.errors && response.status == 200) {
            $scope.tracks =  response.data.data;
            $scope.totalItems = response.data.total;
            $scope.currentPage = response.data.current_page;
            console.log($scope.tracks);
        }
    };

    /**
    * @ngdoc getGenreCallback
    * @name response
    * @description callback operation after all
    * genres called.
    */
    $scope.getGenreCallback = function(response) {
        if (! response.errors && response.status == 200) {
            _.each(response.data, function(data, index) {
                $scope.genres.push(_.extend({}, $scope.genresTemplate, {
                    "id": data.id,
                    "name": data.name,
                    "status": false,
                }));
            });
            console.log($scope.genres);
        }
    };

    /**
     * @ngdoc getTrackData
     * @description get all tracks and genre
     */
    $scope.getTrackData = function() {
        appService.getTracksData('', $scope.getTrackCallback);
        appService.getGenreData($scope.getGenreCallback);
    };
    $scope.getTrackData();

    /**
     * @ngdoc getPaginatedObject
     * @description get next set of object by page
     */
    $scope.getPaginatedObject = function() {
        appService.getPaginatedObject($scope.currentPage, $scope.getTrackCallback)
    };

    /**
     * @ngdoc clearTrackForm
     * @description clear track create/edit form
     */
    $scope.clearTrackForm = function() {
        $scope.addTrackForm = ! $scope.addTrackForm;
        $scope.trackName = null;
        $scope.trackId = null;
        $scope.selectedRating = null;
        $scope.selectedGenreArray.splice(0, $scope.selectedGenreArray.length);
        $scope.setSelectedGenre();
    };

    /**
     * @ngdoc openTrackEditForm
     * @param id Track id
     * @param name Track name
     * @param name Track genre
     * @description open track edit form
     */
    $scope.openTrackEditForm = function(id, name, rate, genres) {
        $scope.trackName = name;
        $scope.trackId = id;
        $scope.selectedRating = rate;
        _.each(genres, function(data, index) {
            $scope.selectedGenreArray.push(data.id);
        });
        $scope.setSelectedGenre();
        $scope.addTrackForm = ! $scope.addTrackForm;
    };

    /**
     * @ngdoc addGenreToArray
     * @name id of the genre oprated
     * @description add/remove the selected genre
     */
    $scope.addGenreToArray = function(id) {
        if (_.contains($scope.selectedGenreArray, id)) {
            $scope.selectedGenreArray = _.without($scope.selectedGenreArray, id)
        } else {
            $scope.selectedGenreArray.push(id);
        }
        console.log($scope.selectedGenreArray);
        $scope.setSelectedGenre();
    };

    /**
     * @ngdoc setSelectedGenre
     * @description get the main array to make visual
     * changes for the user.
     */
    $scope.setSelectedGenre = function() {
        _.each($scope.genres, iteratee);

        function iteratee(value, key, list) {
            value.status = false;
            if (_.contains($scope.selectedGenreArray, value.id)) {
                value.status = true;
            }
        };
    };

    /**
     * @ngdoc getSearchedObject
     * @description get all object when searched for.
     */
    $scope.getSearchedObject = function() {
        appService.getTracksData($scope.searchTrackModel, $scope.getTrackCallback);
    };

    /**
     * @ngdoc saveTrackCallback
     * @name response
     * @description callback operation after the
     * track has been saved.
     */
    $scope.saveTrackCallback = function(response) {
        if (! response.errors) {
            $scope.getTrackData();
            $scope.clearTrackForm();
            $scope.genres = [];
            $scope.alerts.push({
                type: 'success',
                msg: response.message
            });
            $timeout(function() {
                $scope.closeAlert($scope.alerts.indexOf(alert));
            }, 3000);
        } else {
            $scope.alerts.push({
                type: 'danger',
                msg: response.message
            });
            $timeout(function() {
                $scope.closeAlert($scope.alerts.indexOf(alert));
            }, 3000);
        }
    };

    /**
     * @ngdoc saveTrack
     * @description save track form
     */
    $scope.saveTrack = function() {
        $scope.saveData = {
            'title': $scope.trackName,
            'rating': $scope.selectedRating,
            'genres': $scope.selectedGenreArray
        };
        if ($scope.trackId) {
            appService.updateTrack($scope.saveData, $scope.trackId, $scope.saveTrackCallback);
        } else {
            appService.saveNewTrack($scope.saveData, $scope.saveTrackCallback);
        }

    };

    // closeing alert boxes on click
    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };
});

/**
 * genre's controller
 */
greedygames.controller('GenreCtrl', function ($scope, $timeout, appService) {

    $scope.max = 5;
    $scope.addNewGenre = false;
    $scope.genres = [];
    $scope.genreName = null;
    $scope.genreId = null;
    $scope.alerts = [];
    $scope.saveData = {};

    /**
     * @ngdoc getGenreCallback
     * @name response
     * @description callback operation after all
     * genres called.
     */
    $scope.getGenreCallback = function(response) {
        console.log(response.data);
        if (! response.errors && response.status == 200) {
            $scope.genres =  response.data;
            console.log($scope.genres);
        }
    };

    /**
     * @ngdoc getGenreData
     * @description get all genres
     */
    $scope.getGenreData = function() {
        appService.getGenreData($scope.getGenreCallback);
    };
    $scope.getGenreData();

    /**
     * @ngdoc clearGenreForm
     * @description clear genre create/edit form
     */
    $scope.clearGenreForm = function() {
        $scope.addNewGenre = ! $scope.addNewGenre;
        $scope.genreName = null;
        $scope.genreId = null;
    };

    /**
     * @ngdoc openEditForm
     * @param id Genre id
     * @param name Genre name
     * @description open genre edit form
     */
    $scope.openEditForm = function(id, name) {
        $scope.genreName = name;
        $scope.genreId = id;
        $scope.addNewGenre = ! $scope.addNewGenre;
    };

    /**
     * @ngdoc saveGenreCallback
     * @name response
     * @description callback operation after the
     * genre has been saved.
     */
    $scope.saveGenreCallback = function(response) {
        if (! response.errors) {
            $scope.getGenreData();
            $scope.clearGenreForm();
            $scope.alerts.push({
                type: 'success',
                msg: response.message
            });
            $timeout(function() {
                $scope.closeAlert($scope.alerts.indexOf(alert));
            }, 3000);
        } else {
            $scope.alerts.push({
                type: 'danger',
                msg: response.message
            });
            $timeout(function() {
                $scope.closeAlert($scope.alerts.indexOf(alert));
            }, 3000);
        }
    };

    /**
     * @ngdoc saveGenre
     * @description save genre form
     */
    $scope.saveGenre = function() {
        $scope.saveData = {
            'name': $scope.genreName
        };
        if ($scope.genreId) {
            appService.updateGenre($scope.saveData, $scope.genreId, $scope.saveGenreCallback);
        } else {
            appService.saveNewGenre($scope.saveData, $scope.saveGenreCallback);
        }

    };

    // closeing alert boxes on click
    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };
});
