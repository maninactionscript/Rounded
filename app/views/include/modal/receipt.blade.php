<div class="modal-header">
    <h4>Receipt</h4>
</div>
<div class="modal-body">
    <form id="receipt-form">
        <div>
        <img src="{{ URL::to($expense->attachment) }}" alt="{{  basename($expense->attachment) }}" width="100%">
    </div>
    <input type="hidden" value="{{ $expense->id }}" id="id">
    </form>
</div>
<div class="modal-footer">
     <button class="btn btn-primary" type="button" id="delete_receipt">Delete</button>
     <button data-dismiss="modal" class="btn btn-default md-close-custom" type="button">Cancel</button>
</div>