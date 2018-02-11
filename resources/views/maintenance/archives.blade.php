@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Archives</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('archives_insert') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('archive_identifier') ? ' has-error' : '' }}">
                                <label for="archive_identifier" class="col-md-4 control-label">Archive Identifier</label>
                                <div class="col-md-6">
                                    <input id="archive_identifier" type="text" class="form-control" name="archive_identifier" value="{{ old('archive_identifier') }}" required autofocus>
                                    @if ($errors->has('archive_identifier'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('archive_identifier') }}</strong>
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
                    <div class="panel-heading">Archives List <button type="button" class="btn btn-danger pull-right" style="margin-top: -7px" id="remove">Remove</button></div>
                    <div class="panel-body">
                        <table data-toggle="table" id="archives_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">Archive ID</th>
                                <th data-field="archive_identifier"  data-sortable="true">Archive Identifier</th>
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
        $(document).ready(function(){

            response = {!! $data !!};

            $('#archives_list').bootstrapTable({
                data: response,
            });

            $('#remove').click(function(){
                var ids = $.map($('#archives_list').bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });

                $('#archives_list').bootstrapTable('remove', {
                    field: 'id',
                    values: ids
                });
            })


        });
    </script>
@endsection

