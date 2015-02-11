<div class="invoice-body">
    @if($invoices !== null && count($invoices) > 0)
    @for($i=0;$i<count($invoices);$i++)
	@if($invoices[$i]->client != NULL)

    {{--*/ $totalPaid = $invoices[$i]->getPaid(); /*--}}
    @if($invoices[$i]->sent == 0 || $invoices[$i]->sent=='0')
    {{--*/ $img = 'invoice-draft.png' /*--}}
    {{--*/ $state = 'created' /*--}}
    @else
        @if($totalPaid >= $invoices[$i]->total)
           {{--*/ $img = 'invoice-paid.png' /*--}}
           {{--*/ $state = 'paid' /*--}}
        @elseif(strtotime($invoices[$i]->due_date.' 23:59:59') < strtotime("now"))
            {{--*/ $img = 'invoice-overdue.png' /*--}}
            {{--*/ $state = 'overdue' /*--}}
            {{--*/ $days = ceil((strtotime("now") - strtotime($invoices[$i]->due_date.' 23:59:59'))/86400) /*--}}
			{{--*/ $label = $days > 1 ? $days.' days '.$state : $days.' day '.'overdue' /*--}}
        @elseif(strtotime($invoices[$i]->due_date.' 23:59:59') > strtotime("now"))
            {{--*/ $img = 'invoice-outstanding.png' /*--}}
            {{--*/ $state = 'outstanding' /*--}}
            {{--*/ $days = ceil((strtotime($invoices[$i]->due_date.' 23:59:59') - strtotime("now"))/86400) /*--}}
            {{--*/ $label = 'Invoice due in ' /*--}}
            {{--*/ $label .= $days > 1 ? $days.' days ' : $days.' day ' /*--}}
        @endif
    @endif
    {{--*/ $client = $invoices[$i]->client /*--}}
    {{--*/ $sign = json_decode(str_replace('\'','"',$client->sign)) /*--}}
    @if($state=='paid')
    {{--*/ $n = explode('.',number_format($totalPaid,2)) /*--}}
    @else
    {{--*/ $n = explode('.',number_format($invoices[$i]->total-$totalPaid,2)) /*--}}
    @endif
    <div class="columns invoice-block {{ $i+1 == count($invoices) ? 'end' : ''}}" data-id="{{$invoices[$i]->id}}">
        <div class="large-12 columns">
            <span class="sign-preivew" style="background-color: {{$sign->col}};border-color:{{$sign->col}}">{{$sign->char}}</span>
            <span class="invoice-number">{{$invoices[$i]->invoice_number}}</span>
            <p class="client-name">Client: {{$client->business_name}}</p>
            <p>{{strlen($invoices[$i]->desc) > 50 ? substr($invoices[$i]->desc,50).'...' : $invoices[$i]->desc}}&nbsp;</p>
            <div class="bank-action picker-drop">
            <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                <span class="caret"></span>
            </button>
            <span class="picker-hidden">&nbsp;</span>
            <ul role="menu" class="dropdown-menu">
                <li><a href="#" class="detail-invoice">Details</a></li>
                @if($state != 'paid')
				<li><a href="#" class="edit-invoice">Edit</a></li>
                @endif
				<li><a href="#" data-id="{{$invoices[$i]->id}}" class="delete-invoice">detete</a></li>
            </ul>
        </div>
        </div>
        <div class="large-12 columns">
            <img src="{{URL::to('assets/images/'.$img)}}" alt="">
            @if($state == 'overdue' || $state == 'outstanding')
            <p style="text-transform: uppercase;">{{ $label }}</p>
            @elseif($state == 'paid')
                {{--*/ $lastPaid =$invoices[$i]->getLastPaid();  /*--}}
                {{--*/ $lastPaid =$lastPaid  ? $lastPaid : $invoices[$i]->updated_date;  /*--}}
                <p style="text-transform: uppercase;">Paid on {{date('j M, Y',strtotime($lastPaid))}}</p>
            @else
                <p style="text-transform: uppercase;">Created on {{date('j M, Y',strtotime($invoices[$i]->updated_date))}}</p>
            @endif
        </div>
        <div class="large-12 columns">
            <p style="text-align: right;"><span class="i-number">${{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span></p>
        </div>
    </div>
    @endif
    @endfor
    @else
    <p>No invoice found.</p>
    @endif
</div>