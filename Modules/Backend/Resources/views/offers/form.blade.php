<div class="panel panel-flat"> 
    <div class="panel-body">
        @if(Session::has('flash-success-message'))
        <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Well done!</span> {!! Session::get('flash-success-message')!!}
        </div> 
        @endif

        @if(Session::has('flash-error-message')) 
        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-error-message') !!}.
        </div>
        @endif

        <div class="row">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="validation-error-label">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Group: <span class="text-danger">*</span></label> 
                    <select name="group_id" id="group_id" data-placeholder="group" class="select" data-minimum-results-for-search="-1">
                        <option></option>  
                        <option value="silverstorm"  @if(isset($offers['group']) && $offers['group']=='silverstorm') selected @endif >Silverstorm</option>  
                        <option value="snowstorm"  @if(isset($offers['group']) && $offers['group']=='snowstorm') selected @endif >Snowstorm</option> 
                        <option value="both" @if(isset($offers['group']) && $offers['group']=='both') selected @endif >Silverstorm+Snowstorm</option> 
                    </select>
                    <div id="group_err"> </div>
                </div>
            </div> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Offer Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" value="{{$offers['name']? $offers['name']:old('name')}}" >
                </div> 
            </div> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="offer">Offer  in % <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="offer" name="offer"  placeholder=" Offer % " value="{{$offers['offer']? $offers['offer']:old('offer')}}" >
                </div> 
            </div> 
        </div> 
        <div class="row">    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" data-placeholder="status" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                        <option value="1"  @if(isset($offers['status']) && $offers['status']==1) selected @endif >Activate</option>
                        <option value="2" @if(isset($offers['status']) && $offers['status']==2) selected @endif>Close</option>  
                    </select>
                <div id="status_err"> </div>
                </div>
            </div> 
            
        </div> 
    </div>
</div> 
<?php 
$category = Modules\Backend\Entities\Category::where('status',1)->get();
if($category->isNotEmpty()): ?>
<div class="row"> 
    <div class="col-md-12 ">
    <h5 class="panel-title">Category</h5>
    
    <div class="category_error"></div><br/>
    </div>
<?php foreach ($category as $key => $value) : ?>  
    
<?php
$PivotOffers = $actualprice = $offerprice = null; $category_check = 'checked="checked"';
if(isset($offers->id) && $offers):
    $PivotOffers = \Modules\Backend\Entities\PivotOffers::where('offer_id',$offers->id)->where('category_id',$value->id)->first();
    if(!$PivotOffers):
        $category_check = null;
    else:
        $actualprice =$PivotOffers->actual_price; 
        $offerprice = number_format($PivotOffers->offer_price,2); 
    endif;
endif; 
 
?>  
    <div class="col-md-12"> 
        <div class="panel panel-flat"> 
            <div class="panel-heading"> 
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="control-primary category" {{$category_check}}  name="category[{{$value->id}}]" data-slug="{{$value->slug}}::{{$value->id}}" value="{{$value->slug}}::{{$value->id}}">
                            {{$value->name}}
                    </label>
                </div> 
            </div> 
            <div class="panel-body">        
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="actualprice">Actual  Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control actualprice"  id="actualprice_{{$value->id}}" placeholder="Enter Actual Price" name="actualprice[{{$value->id}}]" data-slug="{{$value->slug}}::{{$value->id}}" value="{{$actualprice}}">
                        </div> 
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="offerprice">Reduction in Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  id="offerprice_{{$value->id}}" readonly="" placeholder="Reduction" name="offerprice[{{$value->id}}]"  value="{{$offerprice}}">
                        </div> 
                    </div> 
                </div>  
            </div>
        </div> 
    </div> 
    
<?php endforeach; ?>   
</div>
<?php  endif; ?>
<div class="col-md-12 ">
    <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px" id="SubmitBtn">Submit</button> 
</div>
@section('js')
    <script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('Modules/Backend/Resources/assets/js/offers.js')}}"></script> 
@stop