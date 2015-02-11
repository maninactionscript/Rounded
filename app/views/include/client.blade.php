<table class="no-border no-strip">
    <thead>
      <tr>
        <th>Client Name</th>
        <th>Overdue</th>
        <th>Outstanding</th>
        <th>% of total income</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="no-border-y">
        @if(count($clients))
        @foreach($clients as $cln)
        {{--*/ $sign = json_decode(str_replace('\'','"',$cln->sign)) /*--}}
        <tr data-id={{$cln->id}}>
            <td style="width: 40%;">
                <span class="sign-preivew" style="background-color: {{$sign->col}};border-color:{{$sign->col}}">{{$sign->char}}</span>
                <span>&nbsp;&nbsp;&nbsp;{{$cln->business_name}}</span>
            </td>
            <td style="width: 15%;">
                {{--*/ $n = explode('.',number_format($cln->overdue,2)) /*--}}
                <span class="i-number">$ {{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span>
            </td>
            <td style="width: 15%;">
                {{--*/ $n = explode('.',number_format($cln->outstanding,2)) /*--}}
                <span class="i-number">$ {{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span>
            </td>
            <td style="width: 25%;">
                <span class="ou-text">{{number_format($cln->income,2)}}%</span>
            </td>
            <td style="width: 5%;">
                <div class="picker-drop">
                    <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                        <span class="caret"></span>
                    </button>
                    <span class="picker-hidden"></span>
                    <ul role="menu" class="dropdown-menu">
                        <li><a class="right-slider" data-form="client" data-id="{{$cln->id}}" href="#">Edit</a></li>
                        <li><a data-page="invoice" data-client="{{$cln->id}}" href="#">Create invoice</a></li>
                        <li><a href="#">View all invoices</a></li>
                        <li><a class="delete-client" href="#">Delete client</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr data-id="0">
            <td colspan="5">No client found</td>
        </tr>
        @endif
    </tbody>
</table>