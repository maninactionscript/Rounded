<div class="modal-header">
    <h4>SEND INVOICE {{$invoice->invoice_number}} TO {{$client->business_name}}</h4>
</div>
<div class="modal-body">
    <form class="send-invoice">
        <input type="hidden" name="id" value="{{$invoice->id}}">
        <div class="row">
            <div class="large-12 columns">
                <label>to</label>
                <input type="email" name="email_to" value="{{$client->email}}">
            </div>
            <div class="large-12 columns">
                <label>subject</label>
                <input type="text" name="subject" value="{{$preview->invoice_subject}}">
            </div>
            <div class="large-12 columns">
                <label>mail</label>
                <textarea name="content">{{str_replace("<br>","\n",$preview->invoice_content)}}</textarea>
            </div>
            <div class="large-12 columns">
                <div class="large-5 columns no-padding">
                    <span class="jcheckbox">
                        <input id="attach_invoice" name="attach_invoice" value="1" type="checkbox">
                        <label for="attach_invoice" class="fa fa-check"></label>
                    </span>
                    <span class="label-1">ATTACH INVOICE AS PDF</span>
                </div>
                <div class="large-7 columns no-padding">
                    <span class="jcheckbox">
                        <input id="attach_link" name="attach_link" value="1" type="checkbox">
                        <label for="attach_link" class="fa fa-check"></label>
                    </span>
                    <span class="label-1">ATTACH LINK TO INVOICE ONLINE</span>
                </div>
            </div>
            <div class="large-12 columns">
                <span class="jcheckbox">
                    <input id="bbc_me" name="bbc_me" value="1" type="checkbox">
                    <label for="bbc_me" class="fa fa-check"></label>
                </span>
                <span class="label-1">BBC ME</span>
            </div>
        </div> 
    </form>
</div>
<div class="modal-footer">   
    <div class="row">
        <div class="large-5 columns"> <button class="button btn-default expand right-slider-close" type="button">Cancel</button></div>
        <div class="large-5 columns"> <button data-action="sendInvoice" class="button success expand btn-primary inv-action" type="button">send invoice</button> </div>
    </div>
</div>