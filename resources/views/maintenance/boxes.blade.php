@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><i aria-hidden="true" class="fa fa-chevron-circle-right"></i> Manage Boxes</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('boxes_insert') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('box_identifier') ? ' has-error' : '' }}">
                                <label for="box_identifier" class="col-md-4 control-label">Box Identifier</label>
                                <div class="col-md-6">
                                    <input id="box_identifier" type="text" class="form-control" name="box_identifier" value="{{ old('box_identifier') }}" required autofocus>
                                    @if ($errors->has('box_identifier'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('box_identifier') }}</strong>
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
                                        <i aria-hidden="true" class="fa fa-plus"></i> Create
                                    </button>
                                    <a href="{{route('home')}}">
                                        <button type="button" class="btn btn-danger">
                                            <i aria-hidden="true" class="fa fa-ban"></i> Cancel
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
                    <div class="panel-heading"><i aria-hidden="true" class="fa fa-list"></i> Boxes List <button type="button" class="btn btn-danger pull-right" style="margin-top: -7px" id="remove"><i aria-hidden="true" class="fa fa-trash-o"></i> Remove</button></div>
                    <div class="panel-body">
                        <table data-toggle="table" id="boxes_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                {{--<th data-field="id" data-sortable="true">Box ID</th>--}}
                                <th data-field="box_identifier"  data-sortable="true">Box Identifier</th>
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

            $('#boxes_list').bootstrapTable({
                data: response,
            });

            $('#remove').click(function(){
                var ids = $.map($('#boxes_list').bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });

                $.ajax({
                    url: '{{ route('remove_boxes_records') }}',
                    method: 'POST',
                    data: {'table_idx': ids, '_token': '{{ csrf_token() }}'},

                    success: function(response){
                        $('#boxes_list').bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                });
            })

        });
    </script>
@endsection
