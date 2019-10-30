@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Links</h2>

            <div class="alert alert-success" style="display: none"></div>

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
                            <td>
                                <select class="item_schema" data-id="{{ $link->id }}" data-original-schema="{{$link->item_schema_id}}">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($itemSchemas as $item)
                                        <option value="{{$item->id}}" {{ $item->id==$link->item_schema_id?"selected":"" }}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply" style="display: none">Apply</button>
                            </td>
                            <td>
                                @if($link->item_schema_id != "" && $link->main_filter_selector != "")
                                    <button type="button" class="btn btn-primary btn-scrape" title="pull the latest items">Scrape <i class="glyphicon glyphicon-repeat fast-right-spinner" style="display: none"></i></button>
                                @else
                                    <span style="color: red">fill main filter selector and item schema first</span>
                                @endif
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

@section('script')
    <script>
        $(function () {
            $("select.item_schema").change(function () {
                if($(this).val() != $(this).attr("data-original-schema")) {
                    $(this).siblings('.btn-apply').show();
                }
            });

            $('.btn-apply').click(function () {

                var btn = $(this);

                var tRowId = $(this).parents("tr").attr("data-id");
                var schema_id = $(this).siblings('select').val();

                $.ajaxSetup({
                    headers: {
                        'X-XSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ url('dashboard/links/set-item-schema') }}",
                    data: {link_id: tRowId, item_schema_id: schema_id, _token: "{{ csrf_token() }}", _method: "patch"},
                    method: "post",
                    dataType: "json",
                    success: function (response) {
                        alert(response.msg);

                        btn.hide();
                    }
                });
            });

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
@endsection
