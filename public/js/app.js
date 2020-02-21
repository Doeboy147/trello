angular.module('MainApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('MainCtrl', function ($scope, $http) {
    $scope.getAll = function () {
        $http.get('/get-tasks').then(function (response) {
            $scope.tasks = response.data.data;
        }).catch(function (error) {
            console.log(error.data);
        });
    };
    $scope.getAll();

    $scope.deleteTask = function (uuid) {
        $http.get('/delete-task/' + uuid).then(function (response) {
            $scope.getAll();
        })
    };

    $scope.changeState = function (state, uuid) {
        $http.get('/change-state/' + state + '/' + uuid).then(function (response) {
            $scope.getAll();
            $scope.getDoing();
        }).catch(function (error) {
            console.log(error.data);
        })
    };

    $scope.data = {};
    $scope.typeTask = function (task) {
        $scope.data.task = task;
        console.log($scope.data);
    };

    $scope.submitTask = function (task) {
        let dataTask = {};
        dataTask.task = task;
        $http.post('/add-task', dataTask).then(function (response) {
            $scope.task = '';
            $('#createForm').hide();
            $('#createBtn').show();
            $scope.getAll();
        }).catch(function (error) {
            console.log(error.data)
        })
    };

    $scope.getTasks = function (state) {

        if (state === 'doing') {
            $http.get('/get-task/' + state).then(function (response) {
                $scope.doing = response.data.data;
                $scope.getTasks(state);
            }).catch(function (error) {
                console.log(error.data);
            });
        } else if (state === 'to-do') {
            $http.get('/get-task/' + state).then(function (response) {
                $scope.tasks = response.data.data;
                $scope.getTasks(state);
            }).catch(function (error) {
                console.log(error.data);
            });
        } else if (state === 'delayed') {
            $http.get('/get-task/' + state).then(function (response) {
                $scope.delayed = response.data.data;
                $scope.getTasks(state);
            }).catch(function (error) {
                console.log(error.data);
            });
        } else if (state === 'done') {
            $http.get('/get-task/' + state).then(function (response) {
                $scope.done = response.data.data;
                $scope.getTasks(state);
            }).catch(function (error) {
                console.log(error.data);
            });
        }

    };
    $scope.getTasks('doing');
    $scope.getTasks('delayed');
    $scope.getTasks('done');
    $scope.getTasks('to-do');
});


var dt = new Date();
dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

let hour    = dt.getHours();
let minutes = dt.getMinutes();
let seconds = dt.getSeconds();

$('#hours').append('<p>' + hour + '</p>');
$('#minutes').append('<p>' + minutes + '</p>');
$('#seconds').append('<p>' + seconds + '</p>');


