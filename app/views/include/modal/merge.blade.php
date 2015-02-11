<div class="modal-header">
    <h4>Merge Transactions</h4>
</div>
<div class="modal-body">
    <form id="merge_expense">
        <div class="row">
            <div class="large-6 columns">
                <label>Amount</label>
                <p>$ {{ $expense[0]->amount }}</p>
            </div>
            <div class="large-6 columns">
                <label>Inc. GST</label>
                <div class="input-group col-sm-9">
                    <p>$ {{ round($expense[0]->amount/11,2) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <label style="color: red;">Select correct date</label>
            <div class="large-12 columns">
                <a class="merge_select" data-id="{{ $expense[0]->id }}" href="#">{{ $expense[0]->updated_at?date('j M, y',strtotime($expense[0]->updated_at)):date('Y-m-d') }}</a>
                <span> OR </span>
                <a class="merge_select" data-id="{{ $expense[1]->id }}" href="#">{{ $expense[1]->updated_at?date('j M, y',strtotime($expense[1]->updated_at)):date('Y-m-d') }}</a>
                <input type="hidden" value="" id="merged_id">
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Attachment</label>
                <div>
                    @if($expense[0]->attachment && $expense[1]->attachment)
                    <p>{{ basename($expense[0]->attachment) }}, {{ basename($expense[1]->attachment) }}</p>
                    @elseif ( !$expense[0]->attachment && !$expense[1]->attachment )
                    <p>No attachment</p>
                    @elseif($expense[0]->attachment)
                    <p>{{ basename($expense[0]->attachment) }}</p>
                    @else($expense[1]->attachment)
                    <p>{{ basename($expense[1]->attachment) }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                {{--*/ $desc = '' /*--}}
                @if($expense[0]->description != '' && $expense[1]->description != '')
                {{--*/ $desc = $expense[0]->description.' - '.$expense[1]->description /*--}}
                @elseif($expense[0]->description != '')
                {{--*/ $desc = $expense[0]->description /*--}}
                @else
                {{--*/ $desc = $expense[1]->description /*--}} 
                @endif
                <textarea id="description" style="width: 100%;">{{ $desc }}</textarea>
            </div>
        </div>
        <div class="row">
             <div class="large-5 columns"><button data-dismiss="modal" class="button expand btn-default md-close-custom" type="button">Cancel</button></div>
             <div class="large-5 columns"><button class="button success expand btn-primary" type="button" id="merge_transaction">Save</button></div>
        </div>
        <input type="hidden" id="id" value="{{ $expense[0]->id }},{{ $expense[1]->id }}">
    </form>
</div>