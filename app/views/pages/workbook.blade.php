@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'workbook', 'user' => $user))
<div class="container-fluid container-action">
    <div class="row">
        <div class="large-2 columns customize-button" style="width: 12%;">
            <button data-toggle="dropdown" class="button dropdown-toggle" type="button">
                &nbsp;Actions&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a id="emerge" href="#">Merge...</a></li>
                <li><a id="eremovegst" href="#">Remove GST</a></li>
                <li><a id="ecategorise" href="#">Categorise</a></li>
                <li><a id="edelete" style="color: #c8c8c8;" href="#">Delete</a></li>
            </ul>
        </div>
        <div class="large-7 columns customize-button" style="width:60%">
            <div class="small-4 columns" style="width: 170px;padding-top:9px"><label>VIEW TRANSACTIONS</label></div>
            <ul class="button-group custome-filter">
                <li>
                    <button type="button" data-type="all" class="button filter" data-target="action">All</button>
                </li>
                <li>
                    <button type="button" data-type="income" class="button filter" data-target="action">Income</button>
                </li>
                <li>
                    <button type="button" data-type="purchase" class="button filter" data-target="action">Expenses</button>
                </li>
                <li>
                    <button data-toggle="jdropdown" class="button dropdown-toggle" data-type="" type="button">Advance&nbsp;&nbsp;&nbsp; <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu">
                        <li>
                            <div class="container-fluid box-filter">
                                <div class="modal-header">
                                    <h4>Advance options</h4>
                                </div> 
                                <div class="modal-body">
                                    <form id="filter_form">
                                        <div class="row">
                                            <div class="large-12 columns customize-button">
                                                <label>Transaction type</label> 
                                                <ul class="button-group" style="margin-left: 3px;">
                                                    <li><button class="button filter blue" data-type="all" type="button">All</button></li>
                                                    <li><button class="button filter" data-type="income" type="button">Income</button></li>
                                                    <li><button class="button filter" data-type="purchase" type="button">Expenses</button></li>
                                                </ul>
                                                <input type="hidden" value="all" id="transaction_type">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="large-4 columns">
                                                <label>Dates</label> 
                                                <select id="date">
                                                    <option value="all">All</option>
                                                    <option value="custom">Custom</option>
                                                    <option value="this_month">This month</option>
                                                    <option value="last_month">Last month</option>
                                                    <option value="this_quarter">This quarter</option>
                                                    <option value="last_quarter">Last quarter</option>
                                                    <option value="this_financial_year">This financial year</option>
                                                    <option value="last_financial_year">Last financial year</option>
                                                    <option value="this_year">This year</option>
                                                    <option value="last_year">Last year</option>
                                                </select>
                                            </div>         
                                            <div class="large-4 columns">
                                                <label>From</label> 
                                                <input type="text" value="" class="custom-date" id="from_date_view">
                                                <input type="hidden" value="" class="custom-date" id="from_date">
                                            </div>
                                            <div class="large-4 columns">
                                                <label>To</label> 
                                                <input type="text" value="" class="custom-date" id="to_date_view">
                                                <input type="hidden" value="" class="custom-date" id="to_date">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <label>Description contains...</label> 
                                                <textarea placeholder="E.g Officework" id="description_contains"></textarea>
                                            </div>
                                        </div>
                                         <div class="row">
                                        <div class="large-5 columns">
                                            <button class="button btn-default custom-filter-reset" type="button">Reset</button>
                                        </div>
                                        <div class="large-5 columns">
                                            <button class="button btn-primary btn-custom-filter" type="button">Apply</button>
                                        </div>
                                    </div> 
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="large-3 columns">
            <button class="button right-slider" data-form="income">Add income</button>
            <button class="button right-slider" data-form="purchase">
                <span>Add expense</span>
            </button>
        </div>
    </div>
</div>
<div class="container-fluid" id="expense">
</div>
<a type="button" data-modal="category_modal" data-form="category" class="form-modal" style="display: none">&nbsp;</a>
<a type="button" data-modal="merge_modal" data-form="merge" class="form-modal" style="display: none">&nbsp;</a>
<style>
    .scroll-to-fixed-fixed{
        left: 200px !important;
    }
</style>
<script type="text/javascript">
    $('#from_date_view').datepicker({format : 'd M, yy', autoclose: true})
    .on('changeDate', function(ev){
        $('#from_date').val(ev.format('yyyy-mm-dd'));
    });

    $('#to_date_view').datepicker({format : 'd M, yy', autoclose: true})
    .on('changeDate', function(ev){

        $('#to_date').val(ev.format('yyyy-mm-dd'));
    });

    $('#from_date_view, #to_date_view').change(function(){
        if($('#to_date_view').val() != '' && $('#from_date_view').val() != '') {
            $('#date').find('option[value="custom"]').prop('selected',true);
        } 
        else {
            $('#date').find('option[value="all"]').prop('selected',true); 
        }
    });
    $('.right-slider').rightSlider();
    document.title = 'Rounded - Workbook';
</script>