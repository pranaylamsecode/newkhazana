@if (isset($data) && count($data) > 0)
    @php
        $record_id = $offset;
    @endphp
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    
                    <th>Date</th>
                    <th>Day</th>
                    <th>Number</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $v)
                    <tr class="row_{{ $v->id }}">
                        <td>{{ $v->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($v->name)->format('l') }}</td>
                        <td>{{ $v->number }}</td>
                        <td>{{ $v->category_name }}</td>
                        <td>
                            @if ($v->status == 1)
                                <span style="color: green;">●</span>
                            @else
                                <span style="color: red;">●</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" data-id="{{ $v->id }}"
                                class="btn btn-danger delete_btn delete{{ $v->id }} btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php $page_number++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning text-center">
        Oops, seems like records are not available.
    </div>
@endif

@if ($pagination['total_records'] > $pagination['item_per_page'])
    <div class="card-header">
        <div class="d-flex justify-content-center">
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

<?php
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) {
        $right_links = $current_page + 3;
        $previous = $current_page - 3;
        $next = $current_page + 1;
        $first_link = true;

        if ($current_page > 1) {
            $previous_link = $previous <= 0 ? 1 : $previous;
            $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="1" title="First">&laquo;</a></li>';
            $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="' . $previous_link . '" title="Previous">&lt;</a></li>';
            for ($i = $current_page - 2; $i < $current_page; $i++) {
                if ($i > 0) {
                    $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
                }
            }
            $first_link = false;
        }

        $pagination .= '<li class="page-item active"><a class="paginate_link page-link">' . $current_page . '</a></li>';

        for ($i = $current_page + 1; $i < $right_links; $i++) {
            if ($i <= $total_pages) {
                $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($current_page < $total_pages) {
            $next_link = $i > $total_pages ? $total_pages : $i;
            $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="' . $next_link . '" title="Next">&gt;</a></li>';
            $pagination .= '<li class="page-item"><a class="paginate_link page-link" href="#" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>';
        }
    }
    return $pagination;
}
?>
