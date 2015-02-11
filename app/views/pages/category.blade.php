@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Categories', 'user' => $user))
<div class="container-fluid">
    <div class="large-12 columns">
        <h3>Expense Categories</h3>
        <div class="large-4 column no-padding"> <input type="text" id="addNewCategoryText" ></div>
        <div class="large-4 columns"> <input type="button" class="button" value="Add" id="addNewCategoryBtn"></div>
        <div class="large-4 columns"></div>
    </div>
</div>
<div class="container-fluid">
    <div class="large-12 columns">
        <!-- content -->
        <table id="categoryTable" data-type="" class="no-strip">
            <thead class="no-border">
            <tr>
                <th style="text-align: left"><span>Title</span></th>
            </tr>
            </thead>
            <tbody class="no-border-y">
            @if(count($categories))
                @foreach($categories as $cat)
                    <tr data-id="{{ $cat->id }}" class="category-item" >
                        <td style="" id="cat-{{$cat->id}}">
                            <div class="cat-content">
                                <span class="form_title">{{$cat->title}}</span>
                                <div class="form_action action-hide">
                                    <input data-id="{{$cat->id}}" id="value-{{$cat->id}}" type="text" value="{{$cat->title}}" class="form_action_value">
                                    <input data-id="{{$cat->id}}" type="button" value="Save"  class="form_action_submit button right-slider">
                                </div>
                            </div>

                            <div class="cat-action">
                                <a  data-id="{{$cat->id}}" data-action="edit" class="cat-action-button edit">Edit</a>
                                <a  data-id="{{$cat->id}}" data-action="delete" class="cat-action-button delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr data-id="0">
                    <td colspan="8">No data found</td>
                </tr>
            @endif
            </tbody>
        </table>
            <!--end content -->
    </div>
</div>