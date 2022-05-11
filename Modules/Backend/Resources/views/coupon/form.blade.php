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
            
            <div class="col-md-3">
                <div class="form-group ">
                    <label for="name">Coupon code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="coupon_code" name="coupon_code"  placeholder="Enter coupon code" value="{{$coupon['coupon_code']? $coupon['coupon_code']:old('coupon_code')}}" >
                </div> 
            </div> 
            <div class="col-md-3">
                <div class="form-group">
                    <label>Type: <span class="text-danger">*</span></label>
                    <select name="type" id="type" data-placeholder="Type" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                       <option value="percentage" @if(isset($coupon['type']) && $coupon['type']== 'percentage') selected @endif>Percentage </option> 
                     </select>
                <div id="type_err"> </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group ">
                    <label for="offer">Offer  in <span id="offer_type"></span> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="offer" name="offer"  placeholder=" Offer " value="{{$coupon['offer']? $coupon['offer']:old('offer')}}" >
                </div> 
            </div>  
             
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" data-placeholder="status" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                        <option value="1"  @if(isset($coupon['status']) && $coupon['status']==1) selected @endif >Active</option>
                        <option value="2" @if(isset($coupon['status']) && $coupon['status']==2) selected @endif>Close</option> 
                     </select>
                <div id="status_err"> </div>
                </div>
            </div> 
            
        </div> 
    </div>
</div> 
 
<div class="col-md-12 ">
    <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px" id="SubmitBtn">Submit</button> 
</div>
@section('js')
    <script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('Modules/Backend/Resources/assets/js/coupon.js')}}"></script> 
@stop