<div class="modal-header">
    <h4>Categorise select</h4>
</div>
<div class="modal-body">
    <form class="quicksetup">
        <div class="row">
            <div class="large-12 columns">
                <label>Category 2</label> 
                <select id="categorise_select_id">
                    <option value="">Select category</option>
                    @if($categories->count() > 0)
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row">
            <div class="large-5 columns"> <button class="button btn-default expand md-close-custom" type="button">Cancel</button></div>
            <div class="large-5 columns"> <button id="categorise_select" class="button success expand btn-primary" type="button">Save</button> </div>
        </div>
    </form>
</div>