@extends('dashboard.mainSupplier')

@section('title','Panelim')
@endsection

@section('page_level_styles')
    <link href="{{asset('/dashboard')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('/dashboard')}}/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/dashboard')}}/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/dashboard')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
          type="text/css">

@endsection

@section('page_level_content')

    <div class="row">
        @if($errors->has())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i>{{ $error }}
                </div>
            @endforeach
        @endif

        @if(\Illuminate\Support\Facades\Session::has('success'))
            @foreach (\Illuminate\Support\Facades\Session::pull('success') as $success)
                <div class="alert alert-success">
                    <i class="icon-remove-sign"></i>{{ $success }}
                </div>
            @endforeach
        @endif
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar" style="width: 300px;">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{$user->userable->profile_image}}" style="width: 125px; height: 125px;"
                             align="center " class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{$user->userable->shop_name}}
                        </div>
                        <div class="profile-usertitle-job">
                            {{$user->userable->city}}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <a href="https://www.instagram.com/{{$user->userable->instagramAccount->username}}">
                            <button type="button" class="btn btn-circle green-haze btn-sm">Instagram'a git</button>
                        </a>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active"></li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light">
                    <!-- STAT -->

                    <!-- END STAT -->
                    <div>
                        <h4 class="profile-desc-title">{{$user->userable->shop_name}}</h4>
                        <span class="profile-desc-text"> {!!$user->userable->description !!} </span>

                    </div>
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">GENEL BAKIŞ</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                    </a>
                                    <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                                    </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title="">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#overview_1" data-toggle="tab" aria-expanded="true">
                                                Ürünleriniz </a>
                                        </li>
                                        <li class="">
                                            <a href="#overview_2" data-toggle="tab" aria-expanded="false">
                                                Onay Bekleyen Ödemeler </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="overview_1">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Ürün Adı
                                                        </th>
                                                        <th>
                                                            Fiyatı
                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>
                                                                <a href="@if($product->image!=null) {{ action('FileEntryController@show',$product->image)}}@else {{$product->instagram->image_url}}  @endif"
                                                                   class="fancybox-button" data-rel="fancybox-button">
                                                                    {{$product->title}} </a>

                                                            </td>
                                                            <td>
                                                                {{$product->price}}  {{$product->current_unit}} TRY
                                                            </td>
                                                            <td>
                                                                <a href="{{ action('Dashboard\ProductController@edit',$product->id)  }}"
                                                                   class="btn default btn-xs green-stripe">
                                                                    Düzenle </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="overview_2">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Müşteri İsmi
                                                        </th>
                                                        <th>
                                                            Tutar
                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($checkouts as $checkout)
                                                        <?php $payment= \App\Payment::where('id',$checkout->payment_id)->first();?>

                                                        <tr>
                                                            <td class="highlight">
                                                                <div class="success">
                                                                </div>
                                                                <a href="javascript:;">
                                                                    {{ $payment->checkOuts()->first()->customer->user->name }} {{ $payment->checkOuts()->first()->customer->user->surname }}  </a>
                                                            </td>
                                                            <td>
                                                                {{$checkout->total}} TRY
                                                            </td>
                                                            <td>
                                                                <a href="{{action('Dashboard\SupplierController@waitingPaymentDetail',$payment->id)}}" class="btn default btn-xs purple">

                                                                    <i class="fa fa-edit"></i> İncele </a>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="overview_4">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Customer Name
                                                        </th>
                                                        <th>
                                                            Date
                                                        </th>
                                                        <th>
                                                            Amount
                                                        </th>
                                                        <th>
                                                            Status
                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                David Wilson </a>
                                                        </td>
                                                        <td>
                                                            3 Jan, 2013
                                                        </td>
                                                        <td>
                                                            $625.50
                                                        </td>
                                                        <td>
														<span class="label label-sm label-warning">
														Pending </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Amanda Nilson </a>
                                                        </td>
                                                        <td>
                                                            13 Feb, 2013
                                                        </td>
                                                        <td>
                                                            $12625.50
                                                        </td>
                                                        <td>
														<span class="label label-sm label-warning">
														Pending </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Jhon Doe </a>
                                                        </td>
                                                        <td>
                                                            20 Mar, 2013
                                                        </td>
                                                        <td>
                                                            $125.00
                                                        </td>
                                                        <td>
														<span class="label label-sm label-success">
														Success </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Bill Chang </a>
                                                        </td>
                                                        <td>
                                                            29 May, 2013
                                                        </td>
                                                        <td>
                                                            $12,125.70
                                                        </td>
                                                        <td>
														<span class="label label-sm label-info">
														In Process </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Paul Strong </a>
                                                        </td>
                                                        <td>
                                                            1 Jun, 2013
                                                        </td>
                                                        <td>
                                                            $890.85
                                                        </td>
                                                        <td>
														<span class="label label-sm label-success">
														Success </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Jane Hilson </a>
                                                        </td>
                                                        <td>
                                                            5 Aug, 2013
                                                        </td>
                                                        <td>
                                                            $239.85
                                                        </td>
                                                        <td>
														<span class="label label-sm label-danger">
														Canceled </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;">
                                                                Patrick Walker </a>
                                                        </td>
                                                        <td>
                                                            6 Aug, 2013
                                                        </td>
                                                        <td>
                                                            $1239.85
                                                        </td>
                                                        <td>
														<span class="label label-sm label-success">
														Success </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="btn default btn-xs green-stripe">
                                                                View </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End: life time stats -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- BEGIN PORTLET -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <i class="fa fa-users font-green-sharp"></i>
                                    <span class="caption-subject font-blue-madison bold">Müşteri Yorumları</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div data-spy="scroll" class="scrollspy-example">
                                    <div class="general-item-list">
                                        @foreach($comments as $comment)
                                            <?php $commentObject = \App\Comment::where('id', $comment->comment_id)->first()?>
                                            <div class="item">
                                                <div class="item-head">
                                                    <div class="item-details">
                                                        <img class="item-pic"
                                                             src="{{ $commentObject->user->userable->instagramAccount->profile_picture  }}">
                                                        <a href=""
                                                           class="item-name primary-link">{{ $commentObject->user->name}}</a>
                                                        <span class="item-label">{{ $commentObject->created_at }}</span>
                                                    </div>
                                                    <span class="item-status"><a target="_blank"
                                                                                 href="{{ action('Frontend\ProductController@show',$commentObject->commentable_id) }}"><span
                                                                    class="badge badge-empty badge-success"></span>
                                                            Ürüne Git</a></span>
                                                </div>
                                                <div class="item-body">
                                                    {{ $commentObject->comment_body }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET -->
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>

@endsection

@section('page_level_plugins')

    <script src="{{asset('/dashboard')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script src="{{asset('/dashboard')}}/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script type="text/javascript"
            src="{{asset('/dashboard')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>

@endsection

@section('page_level_scripts')
    <script src="{{asset('/dashboard')}}/assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            Profile.init(); // init page demo
        });
    </script>
@endsection