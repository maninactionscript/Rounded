@if($addNew)
<tr data-id="{{ $expense->id }}" class="form-modal" data-form="{{ $expense->type }}" data-modal="{{ $expense->type }}_modal">
    @endif
    <td style="text-align: center;">
        <span class="jcheckbox">
            <input value="{{ $expense->id }}" type="checkbox" class="check" id="{{ $expense->id }}">
            <label class="fa fa-check" for="{{ $expense->id }}"></label>
        </span>
    </td>
    <td>{{ date('j M, y', strtotime($expense->updated_at)) }}</td>
    <td>{{ $expense->type=='income'?ucfirst($expense->type):'Expense' }} {{ $expense->recurring != null ? ' <span class="litle-text">(Recurring)</span>' : '' }}</td>
    <td>{{ $expense->description }}</td>
    <td>
		@if($expense->type == 'income')
		N/A
		@else
        {{ $expense->category?$expense->category->title:'Uncategorized'}}
		@endif
    </td>
    <td><a href="#{{$expense->attachment}}" data-form="receipt" class="receipt-modal" data-modal="receipt_modal">{{ basename($expense->attachment) }}</a></td>
    <td>${{ number_format($expense->amount,2) }}</td>
    <td>${{ number_format($expense->gst,2) }}</td>
    @if($addNew)
</tr>
@endif