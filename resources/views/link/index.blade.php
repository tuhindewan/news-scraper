@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Links</h2>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <a href="{{ route('links.create') }}" class="btn btn-warning pull-right">Add new</a>

            @if(count($links) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Url</td>
                        <td>Main Filter Selector</td>
                        <td>Website</td>
                        <td>Assigned To Category</td>
                        <td><strong>Item Schema</strong></td>
                        <td><strong>Scrape Link</strong></td>
                        <td>Actions</td>
                    </tr>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td>{{ $link->url }}</td>
                            <td>{{ $link->main_filter_selector }}</td>
                            <td>{{ $link->website->title }} </td>
                            <td><strong><span class="label label-info">{{ $link->category->title }}</span></strong> </td>
                            <td>{{ $link->itemSchema['title'] }}</td>
                            <td>
                                <a class="btn btn-primary btn-scrape" href="{{ url('dashboard/links/' . $link->id . '/scrape') }}">Scrape</a>
                            </td>
                            <td>
                                <a href="{{ url('dashboard/links/' . $link->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($links) > 0)
                    <div class="pagination">
                        <?php echo $links->render();  ?>
                    </div>
                @endif

            @else
                <i>No links found</i>

            @endif
        </div>
    </div>

@endsection

{{--@section('script')
    <script>
        $(function () {
            $(".btn-scrape").click(function () {
                var btn = $(this);

                btn.find(".fast-right-spinner").show();

                btn.prop("disabled", true);

                var tRowId = $(this).parents("tr").attr("data-id");

                $.ajaxSetup({
                    headers: {
                        'X-XSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ url('dashboard/links/scrape') }}",
                    data: {link_id: tRowId, _token: "{{ csrf_token() }}"},
                    method: "post",
                    dataType: "json",
                    success: function (response) {

                        if(response.status == 1) {
                            $(".alert").removeClass("alert-danger").addClass("alert-success").text(response.msg).show();
                        } else {
                            $(".alert").removeClass("alert-success").addClass("alert-danger").text(response.msg).show();
                        }

                        btn.find(".fast-right-spinner").hide();
                    }
                });
            });
        });
    </script>
@endsection--}}
