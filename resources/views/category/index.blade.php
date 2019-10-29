@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Categories</h2>

            <a href="{{ route('categories.create') }}" class="btn btn-warning pull-right">Add new</a>

            @if(count($categories) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{ $cat->title }}</td>
                            <td>
                                <a href="{{ url('dashboard/categories/' . $cat->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($categories) > 0)
                    <div class="pagination">
                        <?php echo $categories->render();  ?>
                    </div>
                @endif

            @else
                <i>No categories found</i>

            @endif
        </div>
    </div>

@endsection
