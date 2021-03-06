@include('layouts.headnav-small', array('title' => 'bas reports', 'user' => $user))
<div class="container-fluid">
    <div class="large-12">
        <div class="large-4 columns">
            <label>Year</label>
            <select id="year">
                @foreach($financialYear as $fy)
                <option value="{{ $fy['start'] }}-{{ $fy['end'] }}">{{ $fy['start'] }}-{{ $fy['end'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="large-4 columns">
            <label>Quarter</label>
            <select id="period">
                <option value="">Period</option>
                <option value="07-09">Jul 1 - Sep 30</option>
                <option value="10-12">Oct 1 - Dec 31</option>
                <option value="01-03">Jan 1 - Mar 31</option>
                <option value="04-06">Apr 1 - Jun 30</option>
            </select>
        </div>
        <div class="large-2 end columns">
            <label>&nbsp;</label>
            <button class="button expand form-modal" data-form="" id="generate_report">generate report</button>
        </div>
    </div>
</div>
<div class="large-12">
    <div class="large-10 columns" id="generate-basr" style="min-height: 300px;">
    </div>
</div>
<script>
    document.title = 'Rounded - Reports';
</script>