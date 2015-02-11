<table class="expense-head">
    <thead class="no-border">
        <tr>
            <th style="width: 5%;text-align: center;">
                <span class="jcheckbox">
                    <input value="all" type="checkbox" class="check-all" id="check-all">
                    <label class="fa fa-check" for="check-all"></label>
                </span>
            </th>
            <th style="width: 10%;">Date</th>
            <th style="width: 10%;">Type</th>
            <th style="width: 25%;">Description</th>
            @if( $area=='workbook' )
            <th style="width: 20%">Category</th>
            <th style="width: 15%">Attachment</th>
            @endif
            @if( $area=='banking' )
            <th>In workbook</th>
            @endif
            <th style="width: 13%">Amount</th>
            <th style="width: 12%">Gst</th>
        </tr>
    </thead>
</table>
<table data-type="{{$type}}" class="no-border no-strip">
    <tbody class="no-border-y">
        @if($expense->count())
        @foreach($expense as $exp)
        <tr data-id="{{ $exp->id }}" {{ $area=='workbook' ?  'class="right-slider"  data-form="'.$exp->type.'"' : ''  }} >
        <td style="width: 5%;text-align: center;">
            <span class="jcheckbox">
                <input value="{{ $exp->id }}" type="checkbox" class="check" id="{{ $exp->id }}">
                <label class="fa fa-check" for="{{ $exp->id }}"></label>
            </span>
        </td>
        <td style="width: 10%;">{{ date('j M, y', strtotime($exp->updated_at)) }}</td>
        <td style="width: 10%;">{{ $exp->type=='income'?ucfirst($exp->type):'Expense' }} {{ ($exp->recurring != null || $exp->recur_id != '0') ? ' <span class="litle-text">(Recurring)</span>' : '' }}</td>
        <td style="width: 25%;">{{ $exp->description }}</td>
        @if( $area=='workbook' )
        <td style="width: 20%">
            @if($exp->type == 'income')
			N/A
			@else
			{{ $exp->category?$exp->category->title:'Uncategorized'}}
			@endif
        </td>
        <td style="width: 15%"><a href="#{{$exp->attachment}}" data-form="receipt" class="receipt-modal" data-modal="receipt_modal">{{ basename($exp->attachment) }}</a></td>
        @endif
        @if( $area=='banking' )
        <td>{{ $exp->inWorkbook->count() > 0 ? 'Yes' : 'No' }}</td>
        @endif
        <td style="width: 13%;">${{ number_format($exp->amount,2) }}</td>
        <td style="width: 12%;">${{ number_format($exp->gst,2) }}</td>
        </tr>
        @endforeach
        @else
        <tr data-id="0">
            <td colspan="8">No data found</td>
        </tr>
        @endif
    </tbody>
</table>
