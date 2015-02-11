<div class="modal-header">
    <h4>{{ ($expense->id == '' || $expense->id == '0') ? 'Add expense' : 'Edit expense' }}</h4>
</div>
<div class="modal-body">
    <form id="add_expense" data-type="purchase">
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
                <label>Category</label>
                <select id="category_id">
					<option value="">Uncatogorized</option>
                    @if($categories->count() > 0)
                    @foreach($categories as $category)
                    <option {{ $expense->category_id == $category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                    @endif
                    <option value="create_category">Create category...</option>
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
        <div class="row">
            <div class="large-6 columns">
                <label>purchase Date</label>
                <div class="input-group-end">
                    <span class="input-group-addon fa fa-calendar-o"></span>
                    <input type="text" id="updated_at_view" value="">
                    <input type="hidden" id="updated_at" value="{{ $expense->updated_at?strtotime($expense->updated_at):strtotime('now') }}">
                </div>
            </div>
            <div class="large-6 columns">
                <label>Recurring expense ?</label>
                <select id="recurring_expense">
                    <option {{ $expense->recurring != NULL ? 'selected' : '' }} value="1">Yes</option>
                    <option {{ $expense->recurring == NULL ? 'selected' : '' }} value="0">No</option>
                </select>
            </div>
        </div>
        <div class="row frequency" {{ $expense->recurring != null ? '' : 'style="display:none"' }}>
            <div class="large-4 columns">
                <label>Frequency</label>
                <select id="frequency" {{ $expense->recurring != null ? '' : 'disabled="disabled"' }}>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='daily')?'selected':'' }} value="daily">Daily</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='weekly')?'selected':'' }} value="weekly">Weekly</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='two_weeks')?'selected':'' }} value="two_weeks">2 weeks</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='four_weeks')?'selected':'' }} value="four_weeks">4 weeks</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='monthly')?'selected':'' }} value="monthly">Monthly</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='two_months')?'selected':'' }} value="two_months">2 months</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='six_months')?'selected':'' }} value="six_months">6 months</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->frequency=='yearly')?'selected':'' }} value="yearly">Yearly</option>
                </select>
            </div> 
            <div class="large-4 columns">
                <label>Until</label>
                <select id="until" {{ $expense->recurring != null ? '' : 'disabled="disabled"' }}>
                    <option {{ ($expense->recurring != null && $expense->recurring->until=='forever')?'selected':'' }} value="forever">Forever</option>
                    <option {{ ($expense->recurring != null && $expense->recurring->until=='date')?'selected':'' }} value="date">Date</option>
                </select>
            </div> 
            <div class="large-4 columns">
                <label>Date</label>
                <div class="input-group-end">      
                    <span class="input-group-addon fa fa-calendar-o"></span>
                    <input type="text" id="until_date_view" value="" {{ ($expense->recurring != null && $expense->recurring->until=='date')?'':'disabled="disabled"' }}  class="form-control" >
                    <input type="hidden" id="until_date" value="{{  $expense->recurring != null ? date('Y-m-d',strtotime($expense->recurring->until_date)) : date('Y-m-d') }}"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-6 columns">
                <label>Business use</label>
                <select id="business_use">
                    {{ $i=100 }}
                    @while($i>=0)
                    <option {{ ($expense->business_use != NULL && $expense->business_use == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}%</option>
                    {{ $i=$i-10 }}
                    @endwhile
                </select>
            </div> 
            <div class="large-6 columns">
                <label>Expense type</label>
                <select id="expense_type">
                    <option {{ $expense->expense_type == '1' ? 'selected' : '' }} value="1">Non-capital</option>
                    <option {{ $expense->expense_type == '2' ? 'selected' : '' }} value="2">Capital</option>
                </select>
            </div> 
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Description</label>
                <textarea id="description">{{ $expense->description }}</textarea>
            </div>
        </div>
        <input type="hidden" id="id" value="{{ $expense->id==''?0:$expense->id }}" />
        <input type="hidden" id="recur_id" value="{{ $expense->recur_id?$expense->recur_id:0 }}" />
        <!-- <div class="col-sm-6">
        <div class="col-sm-5">
        <label>Amount</label>
        <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" value="{{ $expense->amount }}" id="amount" class="form-control">
        </div>
        </div>
        <div class="col-sm-7">
        <label class="col-sm-12">Inc. GST</label>
        <div class="col-sm-3" style="padding-top: 6px;padding-left: 14px">
        <input tabindex="5" {{ $expense->inc_gst=='1'?'checked':'' }} type="checkbox" id="inc_gst">
        </div>
        <div class="input-group col-sm-9">
        <span class="input-group-addon">$</span>
        <input type="text" disabled="disabled" value="{{ $expense->gst==''?'0.00':round($expense->gst,2) }}" id="gst" class="form-control">
        </div>
        </div>
        <div class="col-sm-12">
        <label>Category</label>
        <div class="input-group col-sm-12">
        <select class="form-control" id="category_id">
        @if($categories->count() > 0)
        @foreach($categories as $category)
        <option {{ $expense->category_id == $category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
        @endif
        <option value="create_category">Create category...</option>
        </select>
        </div>
        <div class="col-sm-12 input-group" style="display: none;" id="add_category_form">
        <input type="text" placeholder="Category name" id="category_title" value="" class="form-control" style="width: 50%;" />
        <button class="btn btn-default" type="button">Cancel</button>
        <button type="button" class="btn btn-primary" style="margin-right: 4px ! important;">Save</button>
        </div>
        </div>
        <div class="col-sm-5">
        <label>Date purchased</label>
        <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
        <input type="text" id="updated_at_view" value="{{ $expense->updated_at?date('j M, y',strtotime($expense->updated_at)):date('j M, y') }}" class="form-control">
        <input type="hidden" id="updated_at" value="{{ $expense->updated_at?date('Y-m-d',strtotime($expense->updated_at)):date('Y-m-d') }}" class="form-control">
        </div>
        </div>
        <div class="col-sm-7">
        <label class="col-sm-12">Recurring expense ?</label>
        <div class="col-sm-3" style="padding-top: 6px;padding-left: 14px">
        <input tabindex="5" type="checkbox" id="recurring_expense" {{ $expense->recurring != null ? 'checked="checked"' : '' }}>
        </div>
        </div>
        <div class="col-sm-12 frequency {{ $expense->recurring != null ? '' : 'hide' }}">
        <div class="col-sm-4">
        <label>Frequency</label>
        <div class="col-sm-12">
        <select id="frequency" class="form-control" {{ $expense->recurring != null ? '' : 'disabled="disabled"' }}>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='daily')?'selected':'' }} value="daily">Daily</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='weekly')?'selected':'' }} value="weekly">Weekly</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='two_weeks')?'selected':'' }} value="two_weeks">2 weeks</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='four_weeks')?'selected':'' }} value="four_weeks">4 weeks</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='monthly')?'selected':'' }} value="monthly">Monthly</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='two_months')?'selected':'' }} value="two_months">2 months</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='six_months')?'selected':'' }} value="six_months">6 months</option>
        <option {{ ($expense->recurring != null && $expense->recurring->frequency=='yearly')?'selected':'' }} value="yearly">Yearly</option>
        </select>
        </div>
        </div> 
        <div class="col-sm-4">
        <label>Until</label>
        <div class="col-sm-12">
        <select id="until" class="form-control" {{ $expense->recurring != null ? '' : 'disabled="disabled"' }}>
        <option {{ ($expense->recurring != null && $expense->recurring->until=='forever')?'selected':'' }} value="forever">Forever</option>
        <option {{ ($expense->recurring != null && $expense->recurring->until=='date')?'selected':'' }} value="date">Date</option>
        </select>
        </div>
        </div> 
        <div class="col-sm-4">
        <label>Date</label>
        <div class="col-sm-12 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
        <input type="text" id="until_date_view" value="{{ $expense->recurring != null ? date('j M, y',strtotime($expense->recurring->until_date)) : date('j M, y') }}" {{ ($expense->recurring != null && $expense->recurring->until=='date')?'':'disabled="disabled"' }}  class="form-control" >
        <input type="hidden" id="until_date" value="{{  $expense->recurring != null ? date('Y-m-d',strtotime($expense->recurring->until_date)) : date('Y-m-d') }}"  class="form-control">
        </div>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="col-sm-4">
        <label>Business use</label>
        <div class="col-sm-12">
        <select id="business_use" class="form-control">
        {{ $i=100 }}
        @while($i>=0)
        <option {{ ($expense->business_use != NULL && $expense->business_use == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}%</option>
        {{ $i=$i-10 }}
        @endwhile
        </select>
        </div>
        </div> 
        <div class="col-sm-4" style="padding-left: 10px;">
        <label>Expense type</label>
        <div class="col-sm-12">
        <select id="expense_type" class="form-control">
        <option {{ $expense->expense_type == '1' ? 'selected' : '' }} value="1">Non-capital</option>
        <option {{ $expense->expense_type == '2' ? 'selected' : '' }} value="2">Capital</option>
        </select>
        </div>
        </div> 
        </div>
        <div class="col-sm-12">
        <label>Description</label>
        <div class="col-sm-12">
        <textarea id="description" style="width: 100%;">{{ $expense->description }}</textarea>
        </div>
        </div>
        <input type="hidden" id="id" value="{{ $expense->id==''?0:$expense->id }}" />
        <input type="hidden" id="recur_id" value="{{ $expense->recur_id?$expense->recur_id:0 }}" />
        </div>
        <div class="col-sm-6 upload-content">
        <div class="file-drag">
        <input type="file" id="attachment">
        <a data-target="#attachment" class="btn custom-file" href="#"><i class="fa fa-folder-o" style="width: 25px;"></i><span>Or select file</span></a>
        <span style="position: absolute; top: 50%; left: 22%;">Drag and drop an attachment here.</span>
        </div>
        <div class="file-preview" {{ $expense->attachment != '' ? 'style="display:block"' : '' }}>
        <a href="#" class="jclose"></a>
        <img src="{{ URL::to($expense->attachment) }}" alt="" width="100%" height="100%">
        <input type="hidden" value="{{ $expense->attachment }}" id="p_attachment" />
        </div>
        </div>-->
    </form>
</div>
<div class="modal-footer">
    <div class="row"> 
        <div class="medium-5 columns "><button class="button btn-default expand right-slider-close" type="button">Cancel</button></div> 
        <div class="medium-5 columns"><button class="button success expand btn-primary" type="button" data-type="purchase" id="add-purchase">Save</button></div>
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
    $('select#recurring_expense').on('change',function(){
        if($(this).val() == '1'){
            $('.frequency').slideDown(500);
            $('.frequency').find('select').removeAttr('disabled');
            var ulti = $('#until').val();
            if(ulti == 'forever') $('#until_date').attr('disabled','disabled');
            if(ulti == 'date')    $('#until_date').removeAttr('disabled','disabled');
        }
        else {
            $('.frequency').slideUp(500);
            $('.frequency').find('select, input').attr('disabled','disabled');
        }
    });
    $('#until').change(
        function(){
            var ulti = $('#until').val();
            if(ulti == 'forever') $('#until_date_view').attr('disabled','disabled');
            if(ulti == 'date')    $('#until_date_view').removeAttr('disabled','disabled');
    })
    $('#updated_at_view').datepicker({format : 'd M, yy', autoclose: true})
    .on('changeDate', function(ev){
        $('#updated_at').val(ev.format('yyyy-mm-dd'));
    });
    $('#until_date_view').datepicker({format : 'd M, yy', autoclose: true})
    .on('changeDate', function(ev){
        $('#until_date').val(ev.format('yyyy-mm-dd'));
    });
    queryDate = '{{$expense->updated_at?date("Y-m-d",strtotime($expense->updated_at)):date("Y-m-d")}}',
    dateParts = queryDate.match(/(\d+)/g)
    realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    $('#updated_at_view').datepicker('setDate', realDate);

    queryDate = '{{ $expense->recurring != null ? date("Y-m-d",strtotime($expense->recurring->until_date)) : date("Y-m-d") }}';
    dateParts = queryDate.match(/(\d+)/g)
    realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    $('#until_date_view').datepicker('setDate', realDate);
</script>