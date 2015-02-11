<div class="modal-header">
    <h4>{{ ($client->id == '' || $client->id == '0') ? 'Add Client' : 'Edit Client' }}</h4>
</div>
<div class="modal-body">
    <form id="add_client">
        <div class="row">
            <div class="large-6 columns">
                <div class="row">
                    <label>business name</label>
                    <input type="text" value="{{ $client->business_name }}" id="business_name">
                </div>
                <div class="row">
                    <label>contact name</label>
                    <input type="text" value="{{ $client->contact_name }}" id="contact_name">
                    <span class="tip">Who do you address invoices to?</span>
                </div>
                <div class="row">
                    <label>invoice number perfix</label>
                    <input type="text" value="{{ $client->invoice_prefix ? $client->invoice_prefix : 'MCD' }}" id="invoice_prefix">
                    <span class="tip">Example: MCD-0001</span>
                </div>
                 {{--*/ $sign = json_decode(str_replace('\'','"',$client->sign)) /*--}}
                <div class="row">
                    <label>client icon</label>
                    <div class="tip large-12">Select colour and an initial to easy<br>identify your clients within Rounded.</div>
                    <div id="picker" style="background-color:{{ $sign != null ? $sign->col : '#cb2c72' }};border-color:{{ $sign != null ? $sign->col : '#cb2c72' }}"></div>
                    <input type="text" id="colhex" value="{{ $sign != null ? $sign->col : '#cb2c72' }}">
                    <input type="text" id="char"value="{{ $sign != null ? $sign->char : 'ex' }}">
                    <input type="hidden" id="sign"value="{{$client->sign}}" >
                </div>
                <div class="row">
                    <label>preview</label>
                    <span class="sign-preivew" style="background-color:{{ $sign != null ? $sign->col : '#cb2c72' }};border-color:{{ $sign != null ? $sign->col : '#cb2c72' }}">
                        {{ $sign != null ? $sign->char : 'ex' }}
                    </span>
                </div>
            </div>
            <div class="large-6 columns">
                <div class="row">
                    <label>abn</label>
                    <input type="text" value="{{ $client->abn }}" id="abn">
                </div>
                <div class="row">
                    <label>contact email</label>
                    <input type="text" value="{{ $client->email }}" id="email">
                    <span class="tip">Who do you send invoices to?</span>
                </div>
                <div class="row">
                    <label>business address</label>
                    <textarea id="address">{{ $client->address }}</textarea>
                </div>
            </div>
        </div>
        <input type="hidden" id="id" value="{{ $client->id==''?0:$client->id }}">
    </form>
</div>
<div class="modal-footer">
    <div class="row"> 
        <div class="medium-5 columns "><button class="button btn-default expand right-slider-close" type="button">Cancel</button></div> 
        <div class="medium-5 columns"><button class="button success expand btn-primary" type="button" id="add_client_btn">Save</button></div>
    </div>
</div>
<script>
    function preview(){
        var style = $('#picker').attr('style');
        var c = $('#char').val();
        c = c=='' ? 'ex' : c;
        var p = $('#add_client .sign-preivew');
        var obj ={
            'col' : $('#colhex').val(),
            'char' : c,
        };
        $('#sign').val(JSON.stringify(obj)); 
        p.attr('style',style).html(c);  
    }
    $('#picker').colpick({
        layout:'hex',
        submit:0,
        color :$('#colhex').val(), 
        onChange:function(hsb,hex,rgb,el,bySetColor) {
            $(el).css({'background-color' : '#'+hex, 'border-color' : '#'+hex});
            if(!bySetColor) $('#colhex').val('#'+hex);
            preview();
        }
    }).css('background-color',$('#colhex').val());
    $('#colhex').keyup(function(){
        $('#picker').colpickSetColor(this.value);
        var reg = /^#{1}/;
        if(!reg.test(this.value)) $(this).val('#'+this.value);
    });
    $('#colhex').click(function(){
       $('#picker').click(); 
    });
    $('#char').keyup(function(){
        if(this.value.length > 2){
            $(this).val(this.value.substring(0,2));
        };
        preview(); 
    });
    $('#business_name').keyup(function(){
        var sign = ip = this.value
        if(this.value.length > 2){
            sign = this.value.substring(0,2);
        };
        if(this.value.length > 3){
            ip = this.value.substring(0,3);
        };
        $('#char').val(sign.toUpperCase());
        $('#invoice_prefix').val(ip.toUpperCase());
        preview(); 
    });
</script>