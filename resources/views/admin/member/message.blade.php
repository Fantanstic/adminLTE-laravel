@extends('layout.app')

@section('title')
    留言列表
@endsection
@section('style')
    @include('styles.datatables')
    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            留言列表
            <small>Message list</small>
        </h1>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header">

                        <h3 class="box-title"></h3>

                        <div class="pull-right">
                            <div class="form-inline pull-right">
                                <form action="{{ route('admin.web.ins.message') }}" method="get">
                                    <fieldset>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><strong>用户昵称</strong></span>
                                            <input type="text" class="form-control" placeholder="用户昵称" name="nickname" value="{{$data['nickname']}}"></div>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><strong>用户邮箱</strong></span>
                                            <input type="text" class="form-control" placeholder="用户邮箱" name="email" value="{{$data['email']}}"></div>

                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><strong>日期</strong></span>
                                            <input id="datepicker" type="text" class="form-control" placeholder="日期" name="created_left" value="{{$data['created_left']}}"></div>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><strong>日期</strong></span>
                                            <input id="datepicker2" type="text" class="form-control" placeholder="日期" name="created_right" value="{{$data['created_right']}}"></div>

                                        <div class="btn-group btn-group-sm">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                            <a href="{{ route('admin.web.ins.message') }}" class="btn btn-warning"><i class="fa fa-undo"></i></a>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tasks" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>Email</th>
                                <th>留言内容</th>
                                <th>留言时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($message['list'] as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{route('admin.web.ins.orderList')}}?nickname={{$user->nickname}}">{{ $user->nickname }}</a></td>
                                        <td><a href="{{route('admin.web.ins.orderList')}}?email={{ $user->email }}">{{ $user->email }}</a></td>
                                        <td>{{ $user->message }}</td>
                                        <td>{{ $user->created }}</td>
                                        <td>@if($user->handle)已处理 @else <a href="?message_id={{$user->id}}">处理</a> @endif</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(!(request()->has('nickname') || request()->has('tuid')))
                    <div class="box-footer clearfix">
                        Showing <b>15</b> of <b>{{ $message['num']['count'] }}</b> entries
                        <div class="pull-right">
                            {!! $message['page'] !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('scripts.datatables')
    <script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#tasks').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'order'       : [[0, 'desc']],
                'info'        : false,
                'autoWidth'   : false
            })
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });
            $('#datepicker2').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });
        })
    </script>
@endsection