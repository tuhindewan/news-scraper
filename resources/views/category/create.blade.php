@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Add Category</h2>

            @if(session('error')!='')
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">

                            <strong>Title:</strong>

                            <input type="text" name="title" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary" id="btn-save">Create</button>

                </div>

            </form>
        </div>
    </div>

@endsection
