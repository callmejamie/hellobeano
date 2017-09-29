@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Stores</div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <ul class="list-unstyled pull-left">
                                <li class="h4">old steelers cycling club</li>
                                <li><span class="label label-info">Shopify</span></li>
                            </ul>
                            <ul class="list-inline pull-right">
                                <li>
                                    <button class="btn btn-danger"><i class="fa fa-cross"></i> Disconnect</button>
                                </li>
                                <li>
                                    <a class="btn btn-default" href="/stores/1"><i class="fa fa-gears"></i> Settings</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </li>
                        <!--<li class="list-group-item">-->
                        <!--    <button class="btn btn-default"><i class="fa fa-plus"></i> Connect a store</button>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</home>
@endsection
