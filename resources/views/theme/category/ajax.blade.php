@if (isset($data) && count($data) > 0)
    @php
        $record_id = $offset;
    @endphp
    <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    {{-- <th width="10px">
                        <input type="checkbox" name="row_check_all" class="row_check_all">
                    </th> --}}
                    <th>Name</th>
                    <th>Desc</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $v)
                    <tr class="row_{{ $v->id }}">
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->desc ?? '' }}</td>
                        <td>{{ $v->start_time ?? '' }}</td>
                        <td>{{ $v->end_time ?? '' }}</td>
                        <td>
                            @if ($v->status == 1)
                                <span style="color: green;">●</span> {{-- Green dot for status 1 --}}
                            @else
                                <span style="color: red;">●</span> {{-- Red dot for any other status --}}
                            @endif
                        </td>
                        <td>
                            <a href="#" data-id="{{ $v->id }}" class="btn btn-danger delete_btn delete{{ $v->id }} btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php $page_number++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning text-center">
        Opps, seems like records not available.
    </div>
@endif

@if ($pagination['total_records'] > $pagination['item_per_page'])
    <div class="card-header">
        <div class="pl-3">
            <div class="paging_simple_numbers">
                <ul class="pagination">
                    <?php
                    echo paginate_function($pagination['item_per_page'], $pagination['current_page'], $pagination['total_records'], $pagination['total_pages']);
                    ?>
                </ul>
            </div>
        </div>
    </div>
@endif
