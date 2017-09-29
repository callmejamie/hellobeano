@extends('spark::layouts.app')

@section('content')
<home :team="team" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
                    <li role="presentation"><a href="#apps" data-toggle="tab">Chat Apps</a></li>
                    <li role="presentation"><a href="#users" data-toggle="tab">Users</a></li>
                </ul>
                
                <div class="tab-content m-t-lg">
                    <div role="tabpanel" class="tab-pane active" id="overview">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div data-toggle="counter" data-end="25" class="value"><span class="h4 text-info">25</span> / 50</div>
                                        <div class="desc">Messages received</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div data-toggle="counter" data-end="25" class="value">{{ $team->users()->count() }}</div>
                                        <div class="desc">Connected User(s)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div data-toggle="counter" data-end="25" class="value">1</div>
                                        <div class="desc">Connected chat app(s)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="apps">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                        <img width="100" src="https://maxcdn.icons8.com/Share/icon/Logos//facebook_messenger1600.png" class="">
                                        <ul class="list-inline m-t-md">
                                            <li><a class="btn btn-danger">Disconnect</a></li>
                                            <li><a class="btn btn-default">Settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                        <i class="fa fa-plus-circle"></i> Add app
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="users">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                        <th colspan="2">Connected Users</th>
                                    </tr>
                                    <tr>
                                        <td>jamiel@hellobeano.com</td>
                                        <td class="text-right">connected chat icons here</td>
                                    </tr>
                                    <tr>
                                        <td>visualmorphers@gmail.com</td>
                                        <td class="text-right">connected chat icons here</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection