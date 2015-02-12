@include('layouts.headnav-small', array('title' => 'Expense reports', 'user' => $user))
<div class="container-fluid" id="wrap_fluid" style="">
    <div class="large-12">
        <div class="large-2 columns">
            <label>Date Range</label>
            <select id="date">
                <option value="this_financial_year">This financial year</option>
                <option value="all">All time</option>
                <option value="this_month">This month</option>
                <option value="last_month">Last month</option>
                <option value="this_quarter">This quarter</option>
                <option value="last_quarter">Last quarter</option>
                <option value="last_financial_year">Last financial year</option>
                <option value="this_year">This year</option>
                <option value="last_year">Last year</option>
                <option value="custom">Custom</option>
            </select>
        </div>
        <div id="custom-area" class="large-4 columns">
            <div class="large-6 columns">
                <label>From</label>
                <input type="text" class="date_picker" id="from_view">
                <input type="hidden" value="" class="custom-date" id="from">
            </div>
            <div class="large-6 columns">
                <label>To</label>
                <input type="text" class="date_picker" id="to_view">
                <input type="hidden" value="" class="custom-date" id="to">
            </div>
        </div>
        <div class="large-2 columns">
            <label>Category</label>
            <select id="category">
                <option value="all">All Categories</option>
				<option value="">Uncategorized</option>
                @foreach($category as $fy)
                    <option value="{{ $fy['id'] }}">{{ $fy['title'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="large-2 end columns">
            <label>&nbsp;</label>
            <button class="button expand form-modal" data-form="" id="expense-report">generate report</button>
        </div>
    </div>
</div>
<div class="large-12">
    <div class="large-10 columns" id="expense-basr" style="min-height: 300px;">
    </div>
</div>
<style>
    #pcont.container-fluid{
        width: 100%;
    }
    #jmenu-page-content {

    }
    #wrap_fluid{
        position: fixed;
        float: left;
        width: 100%;
        z-index: 999;
        background: white;
    }
    .scroll-to-fixed-fixed{
        left: 200px !important;
    }
</style>
<script>
    document.title = 'Expense - Reports';
   $('#date').find('option[value="this_financial_year"]').trigger('change');
    $('#from_view').datepicker({format : 'd M, yy', autoclose: true})
            .on('changeDate', function(ev){
                $('#from').val(ev.format('yyyy-mm-dd'));
            });

    $('#to_view').datepicker({format : 'd M, yy', autoclose: true})
            .on('changeDate', function(ev){

                $('#to').val(ev.format('yyyy-mm-dd'));
            });

    $('#from_view, #to_view').change(function(){
        if($('#to_view').val() != '' && $('#from_view').val() != '') {
            $('#date').find('option[value="custom"]').prop('selected',true);
        }
        else {
            $('#date').find('option[value="all"]').prop('selected',true);
        }
    });

    $("#date").on('change',function(){

        var dated = $("#date option:selected").val();

        if(dated == 'all'){
            $("#from_view,#to_view").prop('disabled', true);
            $("#from_view,#to_view").val('');

        }   else{
            $("#from_view,#to_view").prop('disabled', false);
        }

    })  ;



</script>