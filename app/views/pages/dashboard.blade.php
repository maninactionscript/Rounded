@include('layouts.right-sidebar')
@include('layouts.headnav', array('user' => $user))
<div class="dashboard">
    <div class="large-10 columns">
        <div class="status">
            <div>
                <div class="stat">
                    {{--*/ $n = explode('.',number_format($quarter_income,2)) /*--}}
                    <span class="i-number">${{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span><br>
                    <span>INCOME THIS QUARTER</span>
                </div>
                <div class="rls"></div>
            </div>
            <div>
                <div class="stat">
                    {{--*/ $n = explode('.',number_format($expense,2)) /*--}}
                    <span class="i-number">${{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span><br>
                    <span>EXPENSE THIS QUARTER</span>
                </div>
                <div class="rls"></div>
            </div>
            <div>
                <div class="stat">
                    {{--*/ $n = explode('.',number_format($final_income,2)) /*--}}
                    <span class="i-number">${{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span><br>
                    <span>FINALCIAL YEAR INCOME</span>
                </div>
                <div class="rls"></div>
            </div>
            <div>
                <div class="stat">
                    {{--*/ $n = explode('.',number_format($outstanding + $overdue,2)) /*--}}
                    <span class="i-number">${{$n[0]}}</span><span class="d-number">.{{$n[1]}}</span><br>
                    <span>OWED TO YOU</span>
                </div>
                <div class="rls"></div>
            </div>
            <div>
                <div class="stat">
                    {{--*/ $n = explode('.',number_format($overdue,2)) /*--}}
                    <span style="color: #d51d1d;" class="i-number">${{$n[0]}}</span><span style="color: #d51d1d;" class="d-number">.{{$n[1]}}</span><br>
                    <span>OVERDUE INVOICES</span>
                </div>
                <div class="rls"></div>
            </div>
        </div>
        <div class="chart-report large-12 columns">
            <div class="com">
                <span><i style="color: #55ccbf;" class="fa fa-square"></i>&nbsp;&nbsp;INCOME</span>
                <span><i style="color: #dadada;margin-left: 20px;" class="fa fa-square"></i>&nbsp;&nbsp;EXPENSES</span>
            </div>
            <canvas id="chart" height="450" width="942"></canvas>
        </div>
    </div>
    <div class="large-2 columns">
        <div class="goals large-12 columns">
            <div><h6>YOURS GOALS&nbsp;&nbsp;<a class="form-modal" data-form="goal" data-modal="goal_modal" style="color: #808080" href="#"><i style="display: inline-block; border-radius: 50%; border: 2px solid; padding: 2px 3px" class="fa fa-pencil"></i></a></h6></div> 
            <div>
                <canvas id="goal1" height="145" width="145"></canvas>
                <div class="goal-label">
                    @if($goal->financial_year == 0 && $final_income == 0)
                    <span>0.00%</span><br>$0.00<br> FINANCIAL YEAR
                    @else
                    <span>{{ $goal->financial_year == 0 ? '100' : number_format($final_income/$goal->financial_year*100,2) }}%</span><br>
                    OF ${{number_format($goal->financial_year,2)}}<br>FINANCIAL YEAR
                    @endif
                </div>
            </div> 
            <div>
                <canvas id="goal2" height="145" width="145"></canvas>
                <div class="goal-label">
                    @if($goal->quarter == 0 && $quarter_income == 0)
                    <span>0.00%</span><br>$0.00<br>THIS QUARTER
                    @else
                    <span>{{$goal->quarter == 0 ? '100' : number_format($quarter_income/$goal->quarter*100,2) }}%</span><br>
                    OF ${{number_format($goal->quarter,2)}}<br> THIS QUARTER
                    @endif
                </div>
            </div> 
            <div>
                <canvas id="goal3" height="145" width="145"></canvas>
                <div class="goal-label">
                    @if($goal->month == 0 && $month_income == 0)
                    <span>0.00%</span><br>$0.00<br>THIS MONTH
                    @else
                    <span>{{$goal->month == 0 ? '100' : number_format($month_income/$goal->month*100,2) }}%</span><br>
                    OF ${{number_format($goal->month,2)}}<br>THIS MONTH
                    @endif
                </div>
            </div> 
        </div>
    </div>
</div>
@if($goal->financial_year > 0 && $final_income > 0)
{{--*/ $total_final =  ($goal->financial_year - $final_income) < 0 ? 0 :($goal->financial_year-$final_income)  /*--}}
@else
{{--*/ $total_final = '100' /*--}}
@endif
@if($goal->financial_year > 0 && $final_income > 0)
{{--*/ $total_quarter =  ($goal->quarter - $quarter_income) < 0 ? 0 :($goal->quarter-$quarter_income)  /*--}}
@else
{{--*/ $total_quarter = '100' /*--}}
@endif

@if($goal->financial_year > 0 && $final_income > 0)
{{--*/ $total_month =  ($goal->month - $month_income) < 0 ? 0 :($goal->month-$month_income)  /*--}}
@else
{{--*/ $total_month = '100' /*--}}
@endif

<script>
    $('.right-slider').rightSlider();
    document.title = 'Rounded - Dashboard';
    var ctx = [];
    ctx[0] = document.getElementById("chart").getContext("2d");
    var chartData = '{{$chartData}}';
    chartData = chartData.toUpperCase()
    var chartData = JSON.parse(chartData);
    console.log(chartData);
    var epColor = ctx[0].createLinearGradient(0, 0, 0, 500);
    epColor.addColorStop(0, 'rgba(85,203,191,1)');   
    epColor.addColorStop(1, 'rgba(103,215,157,1)');

    var inColor = ctx[0].createLinearGradient(0, 0, 0, 500);
    inColor.addColorStop(0, 'rgba(218,218,218,1)');   
    inColor.addColorStop(1, 'rgba(218,218,218,1)');
    var barChartData = {
        labels : chartData.LABELS,
        datasets : [
            {fillColor : epColor,strokeColor : epColor,data : chartData.INCOME.DATA},
            {fillColor : inColor,strokeColor : inColor,data : chartData.EXPENSE.DATA}
        ]
    }
    var scaleLable = "<%if (value > 999999){ %> <%='$ ' + (value/1000000).toFixed(0).replace('.','.') + 'M' %>"+
    " <% } else { %> <%= '$ ' + (value/1000).toFixed(0).replace('.','.') + 'K' %>"+
    " <% } %>" ;
    var gradient = ctx[0].createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(151,187,205,0.7)');   
    gradient.addColorStop(1, 'rgba(151,187,205,0)');

    var gradient2 = ctx[0].createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, 'rgba(0,51,153,0.9)');   
    gradient2.addColorStop(1, 'rgba(0,51,153,0)');
    var max = chartData.MAX;
    var steps = 4;
    window.myBar = new Chart(ctx[0]).Bar(barChartData, {
        multiTooltipTemplate: "<%= '$' + number_format(value,2,'.',',') %>",
        responsive : true,
        barDatasetSpacing  : 0,
        scaleLabel : scaleLable,
        scaleShowGridLines : true,
        barValueSpacing : 5,
        scaleOverride: true,
        scaleSteps : steps,
        scaleStepWidth: Math.ceil(max / steps),

    });
    var dataGoal1 = [
        {value: {{(float)$final_income}},color: epColor,label: 'AAA'},
        {value: {{(float)$total_final}},color: inColor,label: "BBB"}
    ]; 
    var dataGoal2 = [
        {value: {{(float)$quarter_income}},color: epColor,label: 'AAA'},
        {value: {{(float)$total_quarter}},color: inColor,label: "BBB"}
    ];
    var dataGoal3 = [
        {value: {{(float)$month_income}},color: epColor,label: 'AAA'},
        {value: {{(float)$total_month}},color: inColor,label: "BBB"}
    ];


    ctx[1] = document.getElementById("goal1").getContext("2d");
    ctx[2] = document.getElementById("goal2").getContext("2d");
    ctx[3] = document.getElementById("goal3").getContext("2d");
    var goalChartOptions = {
        responsive : true,
        segmentShowStroke : true,
        segmentStrokeColor : "#fff",
        segmentStrokeWidth : 0,
        percentageInnerCutout : 80,
        animateRotate : false,
        animateScale : false,
        showTooltips: false,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    var goal1Chart = new Chart(ctx[1]).Doughnut(dataGoal1,goalChartOptions);
    var goal2Chart = new Chart(ctx[2]).Doughnut(dataGoal2,goalChartOptions);
    var goal3Chart = new Chart(ctx[3]).Doughnut(dataGoal3,goalChartOptions);

    </script>