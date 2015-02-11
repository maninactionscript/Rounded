@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'invoice', 'user' => $user, 'setting' => false, 'newInvoice' => true))
@if($invoice->sent == 0 || $invoice->sent=='0')
{{--*/ $img = 'detail-draft.png' /*--}}
{{--*/ $state = 'draft' /*--}}
@elseif($invoice->getPaid() >= $invoice->total)
{{--*/ $img = 'detail-paid.png' /*--}}
{{--*/ $state = 'paid' /*--}}
@elseif(strtotime($invoice->due_date.' 23:59:59') < strtotime("now"))
{{--*/ $img = 'detail-overdue.png' /*--}}
{{--*/ $state = 'due' /*--}}
@elseif(strtotime($invoice->due_date.' 23:59:59') > strtotime("now"))
{{--*/ $img = $invoice->sent == '0' ? 'detail-outstanding.png' : 'detail-sent.png' /*--}}
{{--*/ $state = $invoice->sent == '0' ? 'outstanding' : 'sent' /*--}}
@endif
<div class="container-fluid">
  <div class="large-12 columns no-padding" style="margin-top: 2rem;">
    <div class="large-9 columns">
      <div class="invoice-container large-12 columns">
        <img src="{{URL::to('assets/images/'.$img)}}" alt="" style="position: absolute; right: -35px; top: -50px;">
        <form id="invoice_form">
          <div class="large-12 columns no-padding invoice-header">
            <div class="large-4 columns">
              <img src="{{URL::to($invoiceSetting->logo)}}" alt="logo">
            </div>
            <div class="large-4 columns">
              <h4 style="padding-top: 2rem;">TAX INVOICE</h4>
            </div>
          </div>
          <div class="large-12 columns no-padding">
            <div class="large-6 columns">
              <div class="large-6 columns no-padding">
                <label>FROM</label>
                <p>{{$invoice->company_name}}<br>{{$invoice->company_legal}}</p>
                <p>{{$invoice->company_address}}&nbsp;</p>
                <p>ABN : {{$invoice->company_abn}}&nbsp;</p>
              </div>
              <div class="large-6 columns no-padding">
                <label>TO</label>
                <p>{{$invoice->client_name}}<br>{{$invoice->client_legal}}</p>
                <p>{{$invoice->client_address}}&nbsp;</p>
                <p>ABN : {{$invoice->company_abn}}&nbsp;</p>

              </div>
            </div>
            <div class="large-6 columns">
              <div class="large-4 columns no-padding">
                <label>invoice #</label>
                <p>{{$invoice->invoice_number}}</p>
              </div>
              <div class="large-4 columns no-padding">
                <label>Date issued</label>
                <p>{{date('j. M, Y',strtotime($invoice->issued_date))}}</p>
              </div>
              <div class="large-4 columns no-padding">
                <label>Date due</label>
                <p>{{date('j. M, Y',strtotime($invoice->due_date))}}</p>
              </div>
            </div>
          </div>
          <div class="large-12 columns no-padding">
            <label>General Description</label>
            <span>{{$invoice->description}}</span>
          </div>
          <div class="large-12 columns no-padding price-content">
            <table class="no-border">
              <thead>
                <tr>
                  <th>DESCRIPTION</th>
                  <th>QUANTITY</th>
                  <th>UNIT PRICE</th>
                  <th>GST</th>
                  <th>AMOUNT</th>
                </tr>
              </thead>
              <tbody>
                @if($invoice != null && $invoice->prices->count() > 0)
                @foreach($invoice->prices as $price)
                <tr>
                  <td>{{$price->desc}}</td>
                  <td>{{$price->quantity}}</td>
                  <td>${{$price->price}}</td>
                  <td>{{$price->inc_gst == '1' ? '<i style="color: #24d0e9;" class="fa fa-check"></i>' : ''}}</td>
                  <td>${{$price->amount}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table> 
          </div>
          <div class="large-12 columns no-padding">
            <div class="large-3 columns">
              <label>&nbsp;</label>
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
              <label id="cal_gst" style="color: #808080;font-size: 0.7rem;">${{$invoice->id == null ? '0.00' : ($invoice->total - $invoice->subtotal)}}</label>
              <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice->gst}}" name="gst">
              <label id="cal_total" style="color: #808080;font-size: 1rem;">${{$invoice->id == null ? '0.00' : $invoice->total}}</label>
              <input type="hidden" value="{{$invoice->id == null ? '0' : $invoice->total}}" name="total">
            </div>
          </div>
          <div class="large-12 columns no-padding">
            <div class="large-12 columns invoice-footer">
             {{$invoiceSetting->footer}}
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="large-3 columns">
      <div class="large-12 customize-button invoice-btn">
        @if($state == 'paid')
        <button type="button" data-form="sendThankYou" data-id="{{$invoice->id}}"  class="button right-slider expand">Send thank you email</button>
        @endif
        @if($state == 'due')
        <button type="button" data-form="sendReminder" data-id="{{$invoice->id}}"  class="button right-slider expand">Send reminder</button>
        @endif
        @if($state == 'sent')
        <button type="button" data-form="sendInvoice" data-id="{{$invoice->id}}"  class="button right-slider expand">Resend invoice</button>
        @endif
        @if($state == 'outstanding')
        <button type="button" data-form="sendReminder" data-id="{{$invoice->id}}"  class="button right-slider expand">Send reminder</button>
        @endif
        <div class="large-4 columns no-padding">
          <a href="#" data-id="{{$invoice->id}}" data-action="pdf" class="button expand inv-action">Create pdf</a>
        </div>
        <div class="large-4 columns no-padding">
          <a href="#" data-id="{{$invoice->id}}" data-action="duplicate" class="button expand inv-action">DULPICATE</a>
        </div>
        <div class="large-4 columns no-padding">
          <a href="#" data-id="{{$invoice->id}}" style="color: #ccc;" class="delete-invoice button expand">Delete</a>
        </div>
      </div>
      <div class="large-12">
        @if($state == 'due')
        <h6>OVERDUE :</h6>
        <span style="font-size: 3rem; color: rgb(254, 132, 29);">${{number_format($invoice->total-$invoice->getPaid(),2)}}</span>
        @endif
        @if($state == 'outstanding' || $state == 'sent')
        <h6>OUTSTANDING :</h6>
        <span style="font-size: 3rem; color: rgb(254, 132, 29);">${{number_format($invoice->total-$invoice->getPaid(),2)}}</span>
        @endif
        @if($state == 'paid')
        <h6>PAID IN TOTAL :</h6>
        <span style="font-size: 3rem; color: #1ca936">${{number_format($invoice->getPaid(),2)}}</span>
        @endif 
      </div>
      @if($state == 'due' || $state == 'outstanding' || $state == 'sent')
      <div class="large-12 columns payment no-padding">
        <div class="payment-header large-12 columns">
          <h6>ADD A PAYMENT</h6>
        </div>
        <div class="payment-body large-12 columns">
          <form id="payment_form">
            <div class="large-12 columns">
              <label>amount</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" id="amount" name="amount" value="">
              </div>
            </div>
            @if(isset($user->businessDetail) && $user->businessDetail->register_gst=='1')
            <div class="large-12 columns">
              <label>
                <span class="jcheckbox">
                  <input type="checkbox" id="inc_gst" name="inc_gst">
                  <label class="fa fa-check" for="inc_gst"></label>
                </span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCLUDE GST
              </label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" disabled="disabled" value="" id="gst" name="gst">
              </div>
            </div>
            @endif
            <div class="large-12 columns">
              <label>date</label>
              <div class="input-group-end">
                <span class="input-group-addon fa fa-calendar-o"></span>
                <input type="text" name="created_date_view">
                <input type="hidden" name="created_date" >
              </div>
            </div>
            <div class="large-12 columns">
              <label>Payment notes</label>
              <input type="text" name="note" value="{{ $invoice->payment !== null ? $invoice->payment->note : '' }}">
            </div>
            <div class="large-10 columns end">
              <a href="#" id="record_payment" class="button expand">Record payment</a>
            </div>
            <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
          </form>
        </div>
      </div> 
      @endif
    </div>
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
  queryDate = '{{date("Y-m-d")}}';
  dateParts = queryDate.match(/(\d+)/g);  
  realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
  $('input[name=created_date_view]').datepicker({format : 'd M, yy', autoclose: true})
  .on('changeDate', function(ev){
    $('input[name=created_date]').val(ev.format('yyyy-mm-dd'));
  }).datepicker('setDate' , realDate);
  document.title = 'Rounded - Invoice {{$invoiceNumber}}';
</script>
<style type="text/css">
  .amount {
    display: block;
    font-size: 1rem;
    padding-top: 0.5rem;
  }
</style>