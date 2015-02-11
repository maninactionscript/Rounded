{{--*/ $lastImport = $bank->lastImport /*--}}
@if(!isset($addNew) || $addNew == true)
<li data-id="{{ $bank->id }}" class="item-bank">
    <div class="large-12 columns">
        <div class="large-3 columns">
            <div class="box">
                <span class="jcon large jcon-credit">&nbsp;</span>
            </div>
        </div>
        <div class="large-8 columns info">
            <h5>{{ strtoupper($bank->account_name) }}</h5>
            @if($lastImport != NULL)
            <p id="info-new-trans">Last transactions imported from {{ date('j F, Y',strtotime($bank->lastImport->imported_from))  }} 
                to {{ date('j F, Y',strtotime($bank->lastImport->imported_to)) }}</p>
            @else
            <p class="info-new-trans">No transaction found.</p>
            @endif
            
        </div>
        <button class="button form-modal" data-bank-id="{{ $bank->id }}" data-modal="import_modal" data-form="import" href="#"><span>import</span></button>
        <div class="bank-action picker-drop">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <span class="picker-hidden">&nbsp;</span>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" data-bank-id="{{ $bank->id }}" class="form-modal" data-modal="addbank_modal" data-form="addbank">Rename</a></li>
                <li><a href="#" style="color: #c8c8c8;" id="bdelete">Delete</a></li>
            </ul>
        </div>
    </div>
</li>
@else
{{ strtoupper($bank->account_name) }}
@endif
