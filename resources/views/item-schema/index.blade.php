@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Item Schema</h2>

            <a href="{{ route('item-schema.create') }}" class="btn btn-warning pull-right">Add new</a>

            @if(count($itemSchemas) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>CSS Expression</td>
                        <td>Full content selector</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($itemSchemas as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->css_expression }}</td>
                            <td>{{ $item->full_content_selector }}</td>
                            <td>
                                <a href="{{ url('dashboard/item-schema/' . $item->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($itemSchemas) > 0)
                    <div class="pagination">
                        <?php echo $itemSchemas->render();  ?>
                    </div>
                @endif

            @else
                <i>No items found</i>

            @endif
        </div>
    </div>

@endsection
