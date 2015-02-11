<div class="modal-header">
    <h4>{{ ($expense->id == '' || $expense->id == '0') ? 'Add income' : 'Edit income' }}</h4>
</div>
<div class="modal-body">
    <form id="add_expense" data-type="income">
        <div class="row">
            <div class="{{(!isset($busDetail->register_gst) || $busDetail->register_gst=='0') ? 'large-12' : 'large-6'}} columns">
                <label>Amount</label>
                <div class="input-group" style="width: 100%;">
                    <span class="input-group-addon">$</span>
                    <input type="text" value="{{ $expense->amount }}" id="amount">
                </div>
            </div>
            @if(isset($busDetail->register_gst) && $busDetail->register_gst=='1')
            <div class="large-6 columns">
                <label>
                    <span class="jcheckbox">
                        <input {{ ($expense->inc_gst=='1' || $expense->id == '0' || $expense->id == '')?'checked':'' }} type="checkbox" id="inc_gst">
                        <label class="fa fa-check" for="inc_gst"></label>
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCLUDE GST
                </label>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" disabled="disabled" value="{{ $expense->gst==''?'0.00':round($expense->gst,2) }}" id="gst">
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Date received</label>
                <div class="input-group-end">
                    <span class="input-group-addon fa fa-calendar-o"></span>
                    <input type="text" id="updated_at_view" value="">
                    <input type="hidden" id="updated_at" value="{{ $expense->updated_at?strtotime($expense->updated_at):strtotime('now') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Description</label>
                <textarea id="description" style="width: 100%;">{{ $expense->description }}</textarea>
            </div>
        </div>
        <div class="row">
           <!-- <div class="large-6 columns">
                <label>Category</label>
                <select id="category_id">
                    <option value="">Select Category</option>
                </select>
            </div> -->
            <div class="large-6 columns">
                <label>payment on invoice</label>
                <select id="invoice_id">
					<option value="">Select invoice</option>
					@if($invoices->count())
					@foreach($invoices as $invoice)
							<option {{$expense->invoice_id==$invoice->id ? 'selected' : ''}} value="{{ $invoice->id}}">{{$invoice->invoice_number}}</option>
					@endforeach
					@endif
                </select>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns" style="display: none;" id="add_category_form">
                <input type="text" placeholder="Category name" id="category_title" value="" class="form-control" />
                <button class="button btn-default" type="button">Cancel</button>
                <button type="button" class="button btn-primary" style="margin-right: 4px ! important;">Save</button>
            </div>
        </div>
        <input type="hidden" id="id" value="{{ $expense->id==''?0:$expense->id }}">
    </form>
</div>
<div class="modal-footer">
    <div class="row"> 
        <div class="medium-5 columns "><button class="button btn-default expand right-slider-close" type="button">Cancel</button></div> 
        <div class="medium-5 columns"><button class="button success expand btn-primary" type="button" data-type="income" id="add-income">Save</button></div>
    </div>
</div>
<script type="text/javascript">
    $('input#inc_gst[type="checkbox"]').on('change',function(){
        if($(this).is(':checked')){
            var amount = parseFloat($('#amount').val());
            if(isNaN(amount)) amount=0;
            var gst = amount/11;
            $('#gst').val(gst.toFixed(2));
        }
        else {
            $('#gst').val('0.00'); 
        }
    });  
    $('#updated_at_view').datepicker({format : 'd M, yy', autoclose: true, })
    .on('changeDate', function(ev){
        $('#updated_at').val(ev.format('yyyy-mm-dd'));
    });
    queryDate = '{{ $expense->updated_at?date("Y-m-d",strtotime($expense->updated_at)):date("Y-m-d") }}',
    dateParts = queryDate.match(/(\d+)/g)
    realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    $('#updated_at_view').datepicker('setDate', realDate);
</script>