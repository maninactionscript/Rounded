<div class="modal-header">
    <h4>Add Goal</h4>
</div>
<div class="modal-body">
    <form id="add_goal">
        <div class="row">
            <div class="large-12 columns">
                <label>Month</label> 
                <input value="{{$goal->month}}" type="text" name="month">
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Quarter</label> 
                <input value="{{$goal->quarter}}" type="text" name="quarter">
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>financial year</label> 
                <input value="{{$goal->financial_year}}" type="text" name="financial_year">
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns"> <button id="add_goal_btn" class="button success expand btn-primary" type="button">Save</button> </div>
        </div>
    </form>
</div>