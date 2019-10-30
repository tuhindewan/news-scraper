1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Category: {{$category->title}}</h2>

            @if(count($articles) > 0)

                @foreach($articles as $article)
                    <div class="row">
                        <div class="col-md-12">

                            @if(!empty($article->image))
                                <img src="{{ $article->image  }}" class="pull-left img-responsive thumb margin10 img-thumbnail" width="200" />
                            @endif

                            <h4><a href="{{ url('article-details/' . $article->id) }}">{{ $article->title }}</a></h4>
                            <span class="label label-info">{{$article->category->title}}</span>

                            @if(!empty($article->excerpt))
                                <article>
                                    <p>{!! $article->excerpt !!}</p>
                                </article>
                            @endif

                            <em>Source: </em><a class="label label-danger" href="{{ $article->source_link }}" target="_blank">{{ $article->website->title }}</a>
                            <a class="btn btn-warning pull-right" href="{{ url('article-details/' . $article->id) }}">READ MORE</a>
                        </div>
                    </div>
                    <hr/>
                @endforeach

                @if(count($articles) > 0)
                    <div class="pagination">
                        <?php echo $articles->render();  ?>
                    </div>
                @endif

            @else
                <i>No articles found</i>

            @endif
        </div>
    </div>

@endsection
