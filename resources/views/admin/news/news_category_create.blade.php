@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a Category</h3>
        </div>
        <section class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li><a style="cursor: pointer" href="{{ route('news_lists') }}">News</a></li>
                    <li  class="active"><a style="cursor: pointer" href="{{ route('news_category_lists') }}">Category</a></li>
                </ul>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => route('news_category_store'), 'class' => 'form-horizontal']) !!}
                    <div class="col-md-4">
                        <div class="form-group">
                            <p>
                                <label for="category">{{ trans('Category Name') }}:</label>
                            </p>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success">{{ trans('Submit') }}</button>
                            <button type="reset" class="btn btn-danger">{{ trans('Reset') }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

        </section>
    </section>
@endsection