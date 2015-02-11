<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>INVOICE</title>
        <style type="text/css">
            body {
                color:#606060;
                padding:0;
                margin:0;
            }
            td {
                text-align: center;
            }
            table { 
                border-collapse: collapse; 
            }
            .table-invoice {
                width:880px;
                margin:0 auto;
            }
            .table-invoice tr:first-child {
                background:#d7dddd;
                border:none;
            }
            .table-invoice th {
                color:#6d6d6d;
                text-align:left;
                padding:20px;
            }
            .table-invoice td {
                color:#6d6d6d;
                text-align:left;
                padding:20px;
            }
            .table-invoice tr{
                border-bottom:1px solid #c1c1c1;
            }
        </style>
    </head>
    <body>
        <div style="width:595pt;margin:0 auto 45px;">
            <div style="display: inline-block;width:250px;height:120px">
                <img style="width: 100%;height:100%" src="{{URL::to($invoiceSetting->logo)}}" alt="">
            </div>
            <div style="display: inline-block;width:375pt;text-align: right"><h3 style="text-transform: uppercase;color:#606060;">Tax Invoice</h3></div>
        </div>
        <div style="width:595pt;margin:0 auto 10pt;">
            <div style="display: inline-block;width:293pt;border-right:1px solid #d7d7d7;">
                <div style="display: inline-block;width:145pt;">
                    <b style="color:#000;">FROM</b>
                    <p>{{$invoice->company_name}}<br>{{$invoice->company_legal}}</p>
                    <p>{{$invoice->company_address}}&nbsp;</p>
                    <p>ABN : {{$invoice->company_abn}}&nbsp;</p>
                </div>
                <div style="display: inline-block;width:145pt;">
                    <b style="color:#000;">TO</b>
                    <p>{{$invoice->client_name}}<br>{{$invoice->client_legal}}</p>
                    <p>{{$invoice->client_address}}&nbsp;</p>
                    <p>ABN : {{$invoice->company_abn}}&nbsp;</p>
                </div>
            </div>
            <div style="display: inline-block;width:292pt;">
                <table style="width:100%">
                    <tr>
                        <th style="color:#000;">INVOICE#</th>
                        <th style="color:#000;">DATE ISSUED</th> 
                        <th style="color:#000;">DUE DATE</th>
                    </tr>
                    <tr>
                        <td>{{$invoice->invoice_number}}</td>
                        <td>{{date('j. M, Y',strtotime($invoice->issued_date))}}</td> 
                        <td>{{date('j. M, Y',strtotime($invoice->issued_date))}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="width:595pt;margin:0 auto;">
           <label style="color:#000;">GENERATE DESCRIPTION</label>
            <p>{{$invoice->description}}</p>
        </div>
        <div class="table-invoice" style="width:595pt; margin:0 auto;">
            <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                <tr>
                    <th>DESCRIPTION</th>
                    <th>QUANTILY</th> 
                    <th>UNIT PRICE</th>
                    <th>GST</th>
                    <th>AMOUNT</th>
                </tr>
                @if($invoice != null && $invoice->prices->count() > 0)
                @foreach($invoice->prices as $price)
                <tr>
                    <td>{{$price->desc}}</td>
                    <td>{{$price->quantity}}</td>
                    <td>${{$price->price}}</td>
                    <td>{{$price->inc_gst == '1' ? 'OK' : 'NO'}}</td>
                    <td>${{$price->amount}}</td>
                </tr>
                @endforeach
                @endif
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>SUBTOTAL</td>
                    <td>${{(float) $invoice->subtotal}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>GST</td>
                    <td>${{(float) ($invoice->total - $invoice->subtotal)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span style="font-size:18px"><b>TOTAL</b></span></td>
                    <td><span style="font-size:18px"><b>${{(float) $invoice->total}}</b></span></td>
                </tr>
            </table>
        </div>
        <div style="width:595pt;margin:10pt auto 0;border:1px solid;border-radius:5px;padding:5pt">
             <p><b>{{strtoupper($invoiceSetting->footer)}}</b></p>
        </div>
    </body>
</html>