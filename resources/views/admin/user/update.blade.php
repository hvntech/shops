@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a user</h3>
        </div>
        <section class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => route('user_update'), 'class' => 'form-horizontal']) !!}
                <input type="hidden" value="{{ $user->id }}" name="id"/>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" required="required" placeholder="Enter email" value="{{ old('email', $user->email) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="name">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter name" value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="">
                        <div style="color:red">Leave this textbox blank if you don't want to update password!</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Mobile phone:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" required="required" placeholder="Enter mobile phone" value="{{ old('mobile_phone', $user->mobile_phone) }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </section>
    </section>
@endsection