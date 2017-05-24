@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a User</h3>
        </div>
        <section class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => route('user_store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" required="required" placeholder="Enter email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="name">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="password" required="required" placeholder="Enter password" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 pull-left" for="description">Mobile phone:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" required="required" placeholder="Enter mobile phone" value="{{ old('mobile_phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </section>
    </section>
    <script>
        $('#email').focus();
    </script>
@endsection