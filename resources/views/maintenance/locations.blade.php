@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><i aria-hidden="true" class="fa fa-chevron-circle-right"></i> Manage Locations</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('locations_insert') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('location_name') ? ' has-error' : '' }}">
                                <label for="location_name" class="col-md-4 control-label">Location Name</label>
                                <div class="col-md-6">
                                    <input id="location_name" type="text" class="form-control" name="location_name" value="{{ old('location_name') }}" required autofocus>
                                    @if ($errors->has('location_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--<div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">--}}
                                {{--<label for="department_id" class="col-md-4 control-label">Department</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<select class="form-control" name="department_id">--}}
                                        {{--<option>Select One Category</option>--}}
                                        {{--@foreach($departments as $department)--}}

                                            {{--<option value="{{$department->id}}">{{$department->department_name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}

                                    {{--@if ($errors->has('department_id'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('department_id') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Create
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
                    <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> Locations List <button type="button" class="btn btn-danger pull-right" style="margin-top: -7px" id="remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</button></div>
                    <div class="panel-body">
                        <table data-toggle="table" id="locations_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">Location ID</th>
                                <th data-field="location_name"  data-sortable="true">Location Name</th>
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

            $('#locations_list').bootstrapTable({
                data: response,
            });

            $('#remove').click(function(){
                var ids = $.map($('#locations_list').bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });

                $.ajax({
                    url: '{{ route('remove_locations_records') }}',
                    method: 'POST',
                    data: {'table_idx': ids, '_token': '{{ csrf_token() }}'},

                    success: function(response){
                        $('#locations_list').bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                });
            })

        });
    </script>
@endsection

