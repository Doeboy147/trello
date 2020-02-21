<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/main.css') }}" rel="stylesheet">

</head>
<body ng-app="MainApp">
<nav>
    <div class="nav-wrapper bg-secondary">
        <a href="#" class="brand-logo right"><i class="fa fa-home"></i> </a>
        <form>
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="text" placeholder="Search..">
                </div>
            </div>
        </form>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="#"></a></li>
        </ul>
    </div>
</nav>

<div class="container-fluid" ng-controller="MainCtrl">
    <div class="row mt-2 border-top p-2">
        <div class="col-md-3"><i class="fa fa-edit fa-2x"></i><br> New Task</div>
        <div class="col-md-3"><i class="fa fa-spinner fa-2x"></i><br> Doing</div>
        <div class="col-md-3"><i class="fa fa-clock-o fa-2x"></i><br> Delayed</div>
        <div class="col-md-3"><i class="fa fa-check fa-2x"></i><br> Done</div>
        <div class="col-md-10 border mt-3">
            <div class="row">
                {{--new task--}}
                <div class="col-md-3 mt-4">
                    <div class="card p-2">
                        <strong class="mb-3 border-bottom"><i class="fa fa-edit"></i> New task</strong>
                        <button class="btn btn-sm btn-light" id="createBtn"><i class="fa fa-edit"></i></button>
                        <form id="createForm">
                            <i id="createClose" class="fa fa-close float-right shadow-sm"></i>
                            <div class="form-group row">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" ng-keyUp="typeTask(task)" ng-model="task"
                                              class="materialize-textarea"></textarea>
                                    <label for="textarea1">Enter a title for this card</label>
                                </div>
                                <button ng-click="submitTask(task)" class="btn btn-block">create</button>
                            </div>
                        </form>

                        <div class="teal-text text-center border-bottom mb-2">
                            <strong> Your tasks</strong>
                        </div>
                        <div class="list-group" ng-repeat="task in tasks">
                                <div class="list-group-item mb-2 bg-light shadow-sm">
                                    <small><% task.body %></small>

                                    <a class="badge badge-light" ng-click="changeState('doing',task.uuid)">
                                        <i class="fa fa-spinner"></i> </a>
                                    <a class="badge badge-light" ng-click="changeState('delayed',task.uuid)">
                                        <i class="fa fa-clock-o"></i> </a>
                                    <a class="badge badge-light" ng-click="changeState('done',task.uuid)">
                                        <i class="fa fa-check"></i> </a>
                                    <a class="badge badge-light modal-trigger" ng-click="deleteTask(task.uuid)">
                                        <i class="fa fa-trash"></i> </a>
                                </div>
                        </div>

                    </div>
                </div>

                {{--Doing--}}
                <div class="col-md-3 mt-4">
                    <div class="card p-2">
                        <strong class="mb-3 border-bottom"><i class="fa fa-spinner"></i> Doing</strong>
                        <div class="list-group" ng-repeat="task in doing">
                            <div id="doingDrop" class="list-group-item bg-light mb-2 shadow-sm">
                                <small class="text-muted"><% task.body %></small>

                                <a class="badge badge-light" ng-click="changeState('to-do',task.uuid)">
                                    <i class="fa fa-edit"></i> </a>
                                <a class="badge badge-light" ng-click="changeState('delayed',task.uuid)">
                                    <i class="fa fa-clock-o"></i> </a>
                                <a class="badge badge-light" ng-click="changeState('done',task.uuid)">
                                    <i class="fa fa-check"></i> </a>
                                <a class="badge badge-light" ng-click="deleteTask(task.uuid)">
                                    <i class="fa fa-trash"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Delayed--}}
                <div class="col-md-3 mt-4">
                    <div class="card p-2">
                        <strong class="mb-3 border-bottom"><i class="fa fa-clock-o"></i> Delayed</strong>
                        <div class="list-group" ng-repeat="task in delayed">
                            <div id="doingDrop" class="list-group-item bg-light mb-2 shadow-sm">
                                <small class="text-muted"><% task.body %></small>

                                <a class="waves-effect waves-light badge badge-light"
                                   ng-click="changeState('to-do',task.uuid)">
                                    <i class="fa fa-edit"></i> </a>
                                <a class="waves-effect waves-light badge badge-light"
                                   ng-click="changeState('doing',task.uuid)">
                                    <i class="fa fa-spinner"></i> </a>
                                <a class="waves-effect waves-light badge badge-light"
                                   ng-click="changeState('done',task.uuid)">
                                    <i class="fa fa-check"></i> </a>
                                <a class="waves-effect waves-light badge badge-light"
                                   ng-click="deleteTask(task.uuid)">
                                    <i class="fa fa-trash"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Done--}}
                <div class="col-md-3 mt-4">
                    <div class="card p-2">
                        <strong class="mb-3 border-bottom"><i class="fa fa-check"></i> Done</strong>
                        <div class="list-group" ng-repeat="task in done">
                            <div class="list-group-item bg-light mb-2 shadow-sm">
                                <small class="text-muted"><% task.body %></small>

                                <div class="mt-1 row">
                                    <div class="col-md-3">
                                        <a class="badge badge-light" ng-click="changeState('to-do',task.uuid)">
                                            <i class="fa fa-edit"></i> </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="badge badge-light" ng-click="changeState('delayed',task.uuid)">
                                            <i class="fa fa-clock-o"></i> </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="badge badge-light" ng-click="changeState('doing',task.uuid)">
                                            <i class="fa fa-spinner"></i> </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="badge badge-light" ng-click="deleteTask(task.uuid)">
                                            <i class="fa fa-trash"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 bg-white border-top border-right border-bottom mt-3">
            <div class="card p-2">
                <strong class="mb-3 border-bottom"> Time</strong>
                <div class="container-fluid">
                    <div class="row">
                        <div class="digital-clock bg-white">00:00:00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ url('js/popper.min.js') }}"></script>
<script src="{{ url('js/materialize.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/angular.min.js') }}"></script>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
</body>
</html>
