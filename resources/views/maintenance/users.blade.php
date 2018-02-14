@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-edit" aria-hidden="true"></i> Edit Users (Select an user first) <a href="{{route('register')}}"><button type="button" class="btn btn-success pull-right" style="margin-top: -7px" id="remove"><i class="fa fa-user-plus" aria-hidden="true"></i> Create Users</button></a></div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if($process == 1)
                            <form class="form-horizontal" method="POST" action="{{ route('users_update', ['id' => $user_data->id]) }}">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route('users_update', ['id' => 0]) }}">
                        @endif
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    @if($process == 1)
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user_data->name }}" required autofocus>
                                    @else
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    @endif

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        @if($process == 1)
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user_data->email }}" required>
                                        @else
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @endif


                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                                    <label for="department_id" class="col-md-4 control-label">Department</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="department_id">
                                            <option>Select One Category</option>
                                            @if($process == 1)
                                                @foreach($departments as $department)
                                                    @if($department->id == $user_data->department_id)
                                                        @php ($selected = "selected")
                                                    @else
                                                        @php ($selected = "")
                                                    @endif
                                                    <option value="{{$department->id}}" {{ $selected }}>{{$department->department_name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('department_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <label class="col-md-4 control-label">
                                        @if($process == 1 && $user_data->is_admin == 1)
                                            <input type="checkbox" id="is_admin" checked name="is_admin"> Is Admin?
                                        @else
                                            <input type="checkbox" id="is_admin" name="is_admin"> Is Admin?
                                        @endif
                                    </label>
                                </div>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit User
                                    </button>
                                    <a href="{{route('home')}}">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-ban" aria-hidden="true"></i> Cancel
                                        </button>
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> User List <button type="button" class="btn btn-danger pull-right" style="margin-top: -7px" id="remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</button></div>
                    <div class="panel-body">
                        <table data-toggle="table" id="users_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true" >User ID</th>
                                <th data-field="name" data-sortable="true">User Name</th>
                                <th data-field="email" data-sortable="true">User Email</th>
                                <th data-field="is_admin"  data-sortable="true">Is Admin?</th>
                                <th data-field="created_at" data-sortable="true">Created Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            response = {!! $data !!};
            var $table = $('#users_list');

            $table.bootstrapTable({
                data: response,
            });

            $(function () {
                $table.on('click-row.bs.table', function (e, row, $element) {
                    record_id = row.id;

                    var url_dir = "{{ route('users_edit', ':id') }}";
                    url_dir = url_dir.replace(':id', record_id);
                    location.replace(url_dir);

                });
            });

            $('#remove').click(function(){
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });

                $.ajax({
                    url: '{{ route('remove_users_records') }}',
                    method: 'POST',
                    data: {'table_idx': ids, '_token': '{{ csrf_token() }}'},

                    success: function(response){
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                });
            })

        });
    </script>
@endsection