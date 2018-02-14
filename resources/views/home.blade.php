@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> Record List</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table data-toggle="table" id="record_list" data-search="true" data-pagination="true" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true" >ID</th>
                                <th data-field="case_number" data-sortable="true" >Número de registro</th>
                                <th data-field="department_name" data-sortable="true">Departamento</th>
                                <th data-field="city_name"  data-sortable="true">Pueblo</th>
                                <th data-field="location_name" data-sortable="true">Ubicación</th>
                                <th data-field="archive_identifier" data-sortable="true">Archivo</th>
                                <th data-field="box_identifier" data-sortable="true">Gaveta</th>
                                <th data-field="created_at" data-sortable="true">Fecha de Creación</th>
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

            $('#record_list').bootstrapTable({
                data: response,

            });

            var $table = $('#record_list');
            $(function () {
                $table.on('click-row.bs.table', function (e, row, $element) {
                    record_id = row.id;

                    var url_dir = "{{ route('storing_edit', ':id') }}";
                    url_dir = url_dir.replace(':id', record_id);
                    location.replace(url_dir);

                });
            });

            // $('#remove').click(function(){
            //     var ids = $.map($('#book_list').bootstrapTable('getSelections'), function (row) {
            //         return row.id;
            //     });
            //
            //     $('#book_list').bootstrapTable('remove', {
            //         field: 'id',
            //         values: ids
            //     });
            // })

            {{--var $table = $('#record_list');--}}
            {{--$(function () {--}}
                {{--$table.on('click-row.bs.table', function (e, row, $element) {--}}
                    {{--book_id = row.id;--}}

                    {{--var url_dir = "{{ route('bookdetails', ':id') }}";--}}
                    {{--url_dir = url_dir.replace(':id', book_id);--}}
                    {{--location.replace(url_dir);--}}

                {{--});--}}
            {{--});--}}


        });
    </script>
@endsection
