@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Store Records</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('storing_record') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('case_number') ? ' has-error' : '' }}">
                                <label for="case_number" class="col-md-4 control-label">Case Number</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="case_number" value="{{ old('case_number') }}" autofocus>

                                    @if ($errors->has('case_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('case_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                                <label for="department_id" class="col-md-4 control-label">Department</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="department_id">
                                        <option>Select One Category</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('department_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <label for="city_id" class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="city_id">
                                        <option>Select One Category</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('city_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
                                <label for="location_id" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="location_id">
                                        <option>Select One Category</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('location_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('archive_id') ? ' has-error' : '' }}">
                                <label for="archive_id" class="col-md-4 control-label">Archive</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="archive_id">
                                        <option>Select One Category</option>
                                        @foreach($archives as $archive)
                                            <option value="{{$archive->id}}">{{$archive->archive_identifier}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('archive_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('archive_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('box_id') ? ' has-error' : '' }}">
                                <label for="box_id" class="col-md-4 control-label">Box</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="box_id">
                                        <option>Select One Category</option>
                                        @foreach($boxes as $box)
                                            <option value="{{$box->id}}">{{$box->box_identifier}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('box_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('box_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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
@endsection