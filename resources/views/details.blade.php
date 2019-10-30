@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>{{ $article->title }}</h2>
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ $article->image  }}" class="pull-left img-responsive thumb margin10 img-thumbnail" />
                    <span class="label label-info"><a href="{{ url('category/'.$article->category_id) }}">{{$article->category->title}}</a></span>
                    <em>Source: </em><a class="label label-danger" href="{{ $article->source_link }}" target="_blank">{{ $article->website->title }}</a>
                    <article>
                        <p>{!! $article->content !!}</p>
                    </article>
                </div>
            </div>
        </div>
    </div>

@endsection
