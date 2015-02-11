@if($addNew)
<tr data-id="{{ $expense->id }}">
    @endif
    <td>{{ date('j M, y', strtotime($expense->updated_at)) }}</td>
    <td>{{ $expense->description }}</td>
    <td>${{ number_format($expense->amount,2) }}</td>
    <td>${{ number_format($expense->gst,2) }}</td>
    <td>
        {{ $expense->inc_gst == '1'?'<i class="fa fa-check-square-o"></i>':'<i class="fa fa-ban"></i>' }}
    </td>
    <td>
        <a class="action" data-modal="modal" data-action="edit" href="#">Edit</a>
        <a class="action" data-action="delete" href="#">Delete</a>
    </td>
    @if($addNew)
</tr>
@endif