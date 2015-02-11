@include('layouts.headnav-small', array('title' => 'invoices', 'user' => $user, 'invoices' => true))
<div class="container-fluid container-action">
    <div class="row">
        <div class="large-12 columns customize-button">
            <div style="padding-top:9px" class="small-1 columns"><label>SHOW</label></div>
            <ul class="button-group custome-filter">
                <li>
                    <button type="button" data-type="current" class="button ifilter" data-target="action">current</button>
                </li>
                <li>
                    <button type="button" data-type="paid" class="button ifilter" data-target="action">paid</button>
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
                                            <div class="large-12 columns">
                                                <label>show invoices that were</label> 
                                                <select name="state">
                                                    <option value="created">Created</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">       
                                            <div class="large-6 columns">
                                                <label>During the period</label>
                                                <div class="input-group-end">
                                                    <span class="input-group-addon fa fa-calendar-o"></span> 
                                                    <input type="text" value="" class="custom-date" id="from_date_view">
                                                    <input type="hidden" value="" class="custom-date" id="from_date">
                                                </div>
                                            </div>
                                            <div class="large-6 columns">
                                                <label>&nbsp;</label>
                                                <div class="input-group-end">
                                                    <span class="input-group-addon fa fa-calendar-o"></span> 
                                                    <input type="text" value="" class="custom-date" id="to_date_view">
                                                    <input type="hidden" value="" class="custom-date" id="to_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <label>By Client</label> 
                                                <select name="client">
													<option value="">All client</option>
                                                    @if($clients->count() > 0)
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->business_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="large-5 columns">
                                                <button class="button btn-default custom-filter-reset" type="button">Reset</button>
                                            </div>
                                            <div class="large-5 columns">
                                                <button class="button btn-primary btn-custom-filter" filter="invoice" type="button">Apply</button>
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
    </div>
</div>
<div style="display: table; clear: both;" class="large-12">
    <div class="large-9 columns" id="load_invoice">
        @include('include.invoices')
    </div>
    <div class="large-3 columns invoice-status">
        <div class="large-12 column"><label>CURRENT INVOICE SUMMARY</label></div>
    </div>   
</div>
<script type="text/javascript">
    document.title = 'Rounded - Invoices';
    $('#from_date_view').datepicker({format : 'd M, yy', autoclose: true, })
    .on('changeDate', function(ev){
        $('#from_date').val(ev.format('yyyy-mm-dd'));
    }); 
    $('#to_date_view').datepicker({format : 'd M, yy', autoclose: true, })
    .on('changeDate', function(ev){
        $('#to_date').val(ev.format('yyyy-mm-dd'));
    });
</script>