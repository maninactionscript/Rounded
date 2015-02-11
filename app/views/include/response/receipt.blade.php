<div class="receipt-item">
    <div data-id="{{ $expense->id }}" class="item col-sm-12">
        <div class="col-sm-3"><img width="50" height="65" src="{{ URL::to($expense->attachment) }}" /></div>
        <div class="col-sm-7">
            <p>{{ $expense->description }}</p>
            <p>${{  number_format($expense->amount,2) }} &nbsp {{ date('j M, y', strtotime($expense->updated_at)) }}</p>
        </div>
        <div class="col-sm-2"><a href="#" class="action" data-action="delete"><i class="fa fa-trash-o"></i></a></div>
    </div>
</div>