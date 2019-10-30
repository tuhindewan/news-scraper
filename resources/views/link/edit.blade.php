@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Update Link #{{$link->id}}</h2>

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

            <form method="post" action="{{ route('links.update', $link) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PUT") }}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">

                            <strong>Url:</strong>

                            <input type="text" name="url" value="{{ $link->url }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">

                            <strong>Main Filter Selector:</strong>

                            <input type="text" name="main_filter_selector"
                                   value="{{ $link->main_filter_selector }}"
                                   class="form-control"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">

                            <strong>Website:</strong>

                            <select name="website_id" class="form-control">
                                <option value="">select</option>

                                @foreach($websites as $website)
                                    <option value="{{ $website->id }}" {{ $website->id==$link->website_id?"selected":"" }}>
                                        {{ $website->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">

                            <strong>Category:</strong>

                            <select name="category_id" class="form-control">
                                <option value="">select</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id==$link->category_id?"selected":"" }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary" id="btn-save">Update</button>

                </div>

            </form>
        </div>
    </div>

@endsection
