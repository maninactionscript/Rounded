{{--*/ $sign = json_decode(str_replace('\'','"',$client->sign)) /*--}}
@if($addNew)
<tr data-id={{$client->id}}>
    @endif
    <td style="width: 40%;">
        <span class="sign-preivew" style="background-color: {{$sign->col}};border-color:{{$sign->col}}">{{$sign->char}}</span>
        <span>{{$client->business_name}}</span>
    </td>
    <td style="width: 15%;">
        <span class="ov-text">OVERDUE</span><br>
        <span class="i-number">$ 0</span><span class="d-number">.00</span>
    </td>
    <td style="width: 15%;">
        <span class="ou-text">OUTSTANDING</span><br>
        <span class="i-number">$ 0</span><span class="d-number">.00</span>
    </td>
    <td style="width: 25%;">
        <span class="ou-text">0% TOTAL OF INCOME</span>
    </td>
    <td style="width: 5%;">
        <div class="picker-drop">
            <button data-toggle="dropdown" class="dropdown-toggle" type="button">
                <span class="caret"></span>
            </button>
            <span class="picker-hidden"></span>
            <ul role="menu" class="dropdown-menu">
                <li><a class="right-slider" data-form="client" data-id="{{$client->id}}" href="#">Edit</a></li>
                <li><a data-page="invoice" data-client="{{$client->id}}" href="#">Create invoice</a></li>
                <li><a href="#">View all invoices</a></li>
                <li><a class="delete-client" href="#">Delete client</a></li>
            </ul>
        </div>
    </td>
    @if($addNew)
</tr>
@endif