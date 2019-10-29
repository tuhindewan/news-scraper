@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Websites</h2>

            <a href="{{ route('websites.create') }}" class="btn btn-warning pull-right">Add new</a>

            @if(count($websites) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>Url</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($websites as $website)
                        <tr>
                            <td>{{ $website->title }}</td>
                            <td><a href="{{ $website->url }}">{{ $website->url }}</a> </td>
                            <td>
                                <a href="{{ url('dashboard/websites/' . $website->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($websites) > 0)
                    <div class="pagination">
                        <?php echo $websites->render();  ?>
                    </div>
                @endif

            @else
                <i>No websites found</i>

            @endif
        </div>
    </div>

@endsection
