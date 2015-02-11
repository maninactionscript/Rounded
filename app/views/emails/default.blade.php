<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
           {{$content}}
           <br>
           @if($attach_link == '1')
            <span>Follow link :</span> <a href="{{URL::to('/?invoice='.$id)}}"></a>{{URL::to('/?invoice='.$id)}}</a>
           @endif
        </div>
    </body>
</html>
