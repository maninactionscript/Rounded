@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'invoice', 'user' => $user, 'setting' => false, 'newInvoice' => true))

<div class="container-fluid">
    <div class="large-12 columns no-padding" style="margin-top: 2rem;">
        <div class="large-9 columns">
            <div class="invoice-container large-12 columns">
                <form id="invoice_form">
                    <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice->id}}" name="id">
                    <input type="hidden" value="{{$invoice->invoice}}" name="invoice_pdf">
                    <div class="large-12 columns no-padding invoice-header">
                        <div class="large-4 columns">
                            <img src="{{URL::to($invoiceSetting->logo)}}" alt="logo">
                        </div>
                        <div class="large-4 columns">
                            <h4 style="padding-top: 2rem;">TAX INVOICE</h4>
                        </div>
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-4 columns">
                            <label style="color: #000;">FROM</label>
                            <label>Company name</label>
                            <input type="text" value="{{$invoice->id == null ? $businessDetal->business_name : $invoice->company_name}}" name="company_name">
                        </div>
                        <div class="large-4 columns">
                            <label>&nbsp;</label>
                            <label>client</label>
                            <select class="select_client">
                                <option value="">--Select client--</option>
                                @if(isset($user->clients) && $user->clients->count() > 0)
                                @foreach($user->clients as $c)
                                <option value="{{$c->id}}">{{$c->business_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <input type="hidden" value="" name="client_id">
                        </div>
                        <div class="large-4 columns">
                            <label>&nbsp;</label>
                            <label>Date issued</label>
                            <div class="input-group-end">
                                <span class="input-group-addon fa fa-calendar-o"></span>
                                <input type="text" value="" id="issued_date_view">
                                <input type="hidden" value="{{ $invoice->id == null ? date('Y-m-d') : $invoice->issued_date  }}" name="issued_date" id="issued_date">
                            </div>
                        </div>
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-4 columns">
                            <label>your name</label>
                            <input type="text" value="{{$invoice->id == null ? $businessDetal->name : $invoice->company_legal}}" name="company_legal">
                        </div>
                         <div class="large-4 columns client" style="display: none;">
                            <label>Contact name</label>
                            <input type="text" value="" name="client_legal">
                        </div>                                                                        
                        <div class="large-4 columns">
                            <label>Due date</label>
                            <div class="input-group-end">
                                <span class="input-group-addon fa fa-calendar-o"></span>
                                <input type="text" value="" id="due_date_view">
                                {{--*/ $tt = '+ '.$invoiceSetting->payment_term; /*--}}
                                {{--*/ $tt .= (int)$invoiceSetting->payment_term > 1 ? ' days' : 'day'; /*--}}
                                <input type="hidden" value="{{$invoice->id == null ? date('Y-m-d', strtotime($tt)) : $invoice->due_date}}" name="due_date" id="due_date">
                            </div>
                            <input type="hidden" value="{{$invoiceSetting->payment_term}}" name="payment_term">
                        </div> 
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-4 columns">
                            <label>address</label>
                            <textarea name="company_address">{{ $invoice->id == null ? $businessDetal->address : $invoice->company_address}}</textarea>
                        </div>
                         <div class="large-4 columns client" style="display: none;">
                            <label>address</label>
                            <textarea name="client_address" ></textarea>
                        </div>
                        <div class="large-4 columns client" style="display: none;">
                            <label>invoice #</label>
                            <span style="float: left; margin: 0.5rem 0.5rem 0px 0px;"></span> <input type="text" value="" name="invoice_number">
                        </div>
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-4 columns end">
                            <label>abn</label>
                            <input name="company_abn" value="{{$invoice->id == null ? $businessDetal->abn : $invoice->company_abn}}" type="text" />
                        </div>
                    </div>
                    <div class="large-12 columns">
                            <label>General Description</label>
							<textarea name="description">{{$invoice->id == null ? $businessDetal->description : $invoice->description}}</textarea>
                    </div>
                    <div class="large-12 columns price-header">
                        <div class="large-2 columns">
                            <label>Description</label>
                        </div>
                        <div class="large-2 columns">
                            <label>quantity</label>
                        </div>
                        <div class="large-3 columns">
                            <label>unit price</label>
                        </div>
                        <div class="large-2 columns">
                            <label>gst</label>
                        </div>
                        <div class="large-3 columns">
                            <label>amount</label>
                        </div>
                    </div>
                    <div class="large-12 columns no-padding price-content"> 
                        @if($invoice != null && $invoice->prices->count() > 0)
                        @foreach($invoice->prices as $price)
                        {{--*/ $s = md5(str_replace('.','-',uniqid(rand(),true))) /*--}}
                        {{--*/ $gid =  substr($s,0,8) . '-' . substr($s,8,4) . '-' . substr($s,12,4). '-' . substr($s,16,4). '-' . substr($s,20) /*--}} 
                        <?php //echo "<pre>";var_dump($price);die();     ?>
                        <div class="row">
                            <div class="large-2 columns">
                                <input type="text" value="{{$price->desc}}" name="desc">
                            </div>
                            <div class="large-2 columns">
                                <input type="text" value="{{$price->quantity}}" name="quantity">
                            </div>
                            <div class="large-3 columns">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" value="{{$price->price}}" name="unit_price">
                                </div>
                            </div>
                            <div style="padding-top: 0.5rem;" class="large-2 columns">
                                <span class="jcheckbox">
                                    <input type="checkbox" id="gst_{{$gid}}" name="inc_gst" value="1" {{$price->inc_gst==1 ? 'checked="checked"' : ''}}>
                                    <label for="gst_{{$gid}}" class="fa fa-check">
                                    </label>
                                </span>
                            </div>
                            <div class="large-3 columns">
                                <span class="amount">${{$price->amount}}</span>
                                <input type="hidden" name="amount" value="{{$price->amount}}">
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-3 columns">
                            <input type="button" id="add_new_line" class="button btn-primary" value="add new line" />
                        </div>
                        <div class="large-2 columns">
                            <label>&nbsp;</label>
                        </div>
                        <div class="large-2 columns">
                            <label>&nbsp;</label>
                        </div>
                        <div class="large-2 columns">
                            <label style="color: #808080;font-size: 0.7rem;">Subtotal</label>
                            <label style="color: #808080;font-size: 0.7rem;">gst</label>
                            <label style="color: #808080;font-size: 1rem;">total</label>
                        </div>
                        <div class="large-3 columns">
                            <label id="cal_subtotal" style="color: #808080;font-size: 0.7rem;">${{$invoice->id == null ? '0.00' : $invoice->subtotal}}</label>
                            <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice-> subtotal}}" name="subtotal">
                            <label id="cal_gst" style="color: #808080;font-size: 0.7rem;">${{$invoice->id == null ? '0.00' : $invoice->total}}</label>
                            <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice->gst}}" name="gst">
                            <label id="cal_total" style="color: #808080;font-size: 1rem;">${{$invoice->id == null ? '0.00' : $invoice->total}}</label>
                            <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice->total}}" name="total">
                        </div>
                    </div>
                    <div class="large-12 columns no-padding">
                        <div class="large-12 columns invoice-footer">
                            <p>{{$invoiceSetting->footer}}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="large-12 customize-button invoice-btn">
                <ul class="button-group" style="padding: 0px;">
                    <li style="width: 80%; margin: 0px;">
                        <button type="button" data-save="save" class="button save-invoice expand">
                            SAVE
                        </button>
                    </li>
                    <li class="customize-button" style="width: 20%;">
                        <button type="button" class="button dropdown-toggle expand" data-toggle="dropdown" style="font-size: 5px; padding: 9px 0px 8px; height: 38px;">
                            <i class="fa fa-circle"></i>
                            <i class="fa fa-circle"></i>
                            <i class="fa fa-circle"></i>
                        </button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a class="inv-action" data-id="{{$invoice->id}}" data-action="pdf" href="#">CREATE PDF</a></li>
                            <li><a class="save-invoice" data-save="duplicate" href="#">DUPLICATE</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <input type="button" id="ready_send" value="send" data-id="" data-send="invoice" data-form="sendInvoice" class="right-slider button" style="display: none;">
            <input type="button" value="ready to send ?" data-save="save_send" class="save-invoice button btn-primary expand">
        </div>
    </div>
</div>
@if(isset($user->businessDetail) && $user->businessDetail->register_gst == '0')
<style type="text/css">
     .price-header > div:nth-child(4),
     .price-content > .row > div:nth-child(4){
       display: none;
     }
</style>
@endif
<script type="text/javascript">
    queryDate = '{{$invoice->id == null ? date("Y-m-d") : $invoice->issued_date }}';
    dateParts = queryDate.match(/(\d+)/g);  
    realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    pmt = $('input[name="payment_term"]').val() == '' ? 7 : parseInt($('input[name="payment_term"]').val());  
    function addDays(theDate, days) {
        return new Date(theDate.getTime() + days*24*60*60*1000);
    }
    function paymentTerm(day1, day2, days, status){
        day1 = day1.match(/(\d+)/g);
        day1 = new Date(day1[0], day1[1]-1, day1[2]); 
        day2 = day2.match(/(\d+)/g);
        day2 = new Date(day2[0], day2[1]-1, day2[2]);
        if(status == 'changeday'){
            day2 = new Date(day1.getTime() + days*24*60*60*1000);
            $('#due_date_view').datepicker('setDate' , day2)
        }
        else{
            days = (day1.getTime() - day2.getTime())/(24*60*60*1000);
            $('input[name="payment_term"]').val(days);
        }
        return true;

    }
    $('input[name="payment_term"]').keyup(function(){
        var days = parseInt($(this).val());
        paymentTerm($('#issued_date').val(),$('#due_date').val(), days, 'changeday');
    })
    $('#issued_date_view').datepicker({format : 'd M, yy', autoclose: true})
    .datepicker('setDate' , realDate)
    .on('changeDate', function(ev){
        $('#issued_date').val(ev.format('yyyy-mm-dd'));
        paymentTerm($('#due_date').val(), $('#issued_date').val());
    });
    $('#due_date_view').datepicker({format : 'd M, yy', autoclose: true})
    .datepicker('setDate' , addDays(realDate,pmt))
    .on('changeDate', function(ev){
        $('#due_date').val(ev.format('yyyy-mm-dd'));
        paymentTerm($('#due_date').val(), $('#issued_date').val());
    });
    var generateUid = function () {
        var delim = "-";
        function S4() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        }
        return (S4() + S4() + delim + S4() + delim + S4() + delim + S4() + delim + S4() + S4() + S4());
    };
    $('.select_client').change(function(){
        var id = $(this).find('option:selected').val();
        $('input[name="client_id"]').val(id);
        if(id !== '' && parseInt(id) > 0){
          $.ajax({
              method : 'get',
              url  : '{{URL::to("ajax/client")}}',                                           
              data : {
                id : id,
                _token : window._token()
              },
              success : function(res){
                $('.client').find('textarea[name="client_address"]').val(res.address);
                $('.client').find('input[name="client_legal"]').val(res.contact_name);
                $('.client').find('span').html(res.invoice_prefix);
                $('.client').find('input[name="invoice_number"]').val(res.invoice_number);
                $('.client').slideDown(); 
                $('ready_send').addClass('right-slider');   
              } 
          })
        } else {
          $('.client').slideUp();
          $('ready_send').removeClass('right-slider');
        }
    })
    document.title = 'Rounded - Invoice {{$invoiceNumber}}';
</script>
<style type="text/css">
    .amount {
        display: block;
        font-size: 1rem;
        padding-top: 0.5rem;
    }
</style>