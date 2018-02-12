@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Cities</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('cities_insert') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('city_name') ? ' has-error' : '' }}">
                                <label for="city_name" class="col-md-4 control-label">City Name</label>
                                <div class="col-md-6">
                                    <input id="city_name" type="text" class="form-control" name="city_name" value="{{ old('city_name') }}" required autofocus>
                                    @if ($errors->has('city_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                    <a href="{{route('home')}}">
                                        <button type="button" class="btn btn-danger">
                                            Cancel
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
                    <div class="panel-heading">Cities List <button type="button" class="btn btn-danger pull-right" style="margin-top: -7px" id="remove">Remove</button></div>
                    <div class="panel-body">
                        <table data-toggle="table" id="cities_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">City ID</th>
                                <th data-field="city_name"  data-sortable="true">City Name</th>
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

            $('#cities_list').bootstrapTable({
                data: response,
            });

            $('#remove').click(function(){
                var ids = $.map($('#cities_list').bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });

                $.ajax({
                    url: '{{ route('remove_cities_records') }}',
                    method: 'POST',
                    data: {'table_idx': ids, '_token': '{{ csrf_token() }}'},

                    success: function(response){
                        $('#cities_list').bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                });
            })

        });
    </script>
@endsection

