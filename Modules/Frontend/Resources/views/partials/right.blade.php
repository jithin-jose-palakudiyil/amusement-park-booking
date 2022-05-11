    <div class="col-xl-8 col-lg-8 content-right" id="start">
           <?php
    $Offers = \Modules\Frontend\Entities\Offers::where('status',1)->get();
    if($Offers->isNotEmpty()): ?>
	            <div id="wizard_container">
	                <div id="top-wizard">
	                    <span id="location"></span>
	                    <div id="progressbar"></div>
	                </div>
	                <!-- /top-wizard -->
	                <form  action="{{route('booking_action')}}" id="wrapped" method="POST" enctype="multipart/form-data" >
	                  {{ csrf_field() }}  
                          <input id="website" name="website" type="text" value="">
	                    <!-- Leave for security protection, read docs for details -->
	                    <div id="middle-wizard">

                                <div class="step" id="offers_div">
	                            <h2 class="section_title">Offers</h2>
	                            <h3 class="main_question">Select your Offer?</h3>
                                    <div class="form-group">
                                    <?php foreach ($Offers as $key => $value): ?>
                        
	                          
	                                <label class="container_radio version_2">
                                            {{$value->name}} 
                                            <br/>
                                            <small>{{$value->offer}}% off on all booking in {{($value->group=='both') ? 'Silverstorm+Snowstorm' : ucfirst($value->group)}}.</small>
                                            <input type="radio" name="booking_offer" value="{{\Crypt::encryptString($value->id)}}" class="required booking_offer">
	                                    <span class="checkmark"></span>
	                                </label>
	                                
	                            
                                    <?php endforeach; ?>
                                     </div>
	                            <!--<small>* Start branch radio based </small>-->
	                        </div>
	                        <!-- /step-->

                                <div class="step" id="offer_details_div" >
                                    
<!--                                    <h2 class="section_title">Category and Quantity</h2>
                                    <h3 class="main_question">Choose yor options ?</h3>
                                    <table  cellspacing="3" cellpadding="3" style="width: 100%" > 
                                        <tbody> 
                                        <tr>
                                            <td>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label class="container_check">Adult / ₹945 <br/><small>(Actual Price: ₹1050)</small>
                                                            <input type="checkbox" name="ui_designer_experience_2[]" value="Mobile Design" class="required valid">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td> 
                                            <td>  
                                                <div class="form-group">
                                                    <label for="name">Qty</label>
                                                    <input type="number" style="width: 100px" name="name" id="name" class="form-control " min="1" >
                                                </div>  
                                            </td> 
                                            <td>
                                                <div class="form-group">
                                                    <label for="name">Price</label>
                                                    <input type="number" style="width: 100px" disabled="" name="name" id="name" class="form-control"  value="" >
                                                </div> 
                                            </td>
                                        </tr>
                                        
                                       

                                        </tbody>
                                    </table>-->
				</div>
				<!-- /step-->
                                <style>
                                    .intl-tel-input { width: 100%; position: relative; display: block; }
                                    #phone{padding-left: 65px; }
                                </style>
	                        <div class="submit step" id="end" >
	                            <h2 class="section_title">Personal Information</h2>
	                            <!--<h3 class="main_question">Personal info</h3>-->
                                    <div class="form-group add_top_30">
	                                <label for="bookingdate">Choose a date for booking</label>
                                        <input type="text" name="bookingdate" readonly="" id="bookingdate" class="form-control required" >
	                            </div>
	                            <div class="form-group add_top_30">
	                                <label for="name">First and Last Name</label>
	                                <input type="text" name="name" id="name" class="form-control required">
	                            </div>
                                    <div class="form-group add_top_30">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control required" style="height: 50px;resize: none"></textarea>
                                    </div>
	                            <div class="form-group">
	                                <label for="email">Email Address</label>
	                                <input type="email" name="email" id="email" class="form-control required" >
	                            </div>
	                            <div class="form-group">
	                                <label for="phone">Phone</label>
	                                <input type="text" name="phone" id="phone" class="form-control required">
	                            </div>
								
	                            
	                        </div>
	                        <!-- /step-->

<!--	                        <div class="submit step" id="end">
	                            <div class="summary">
	                                <div class="wrapper">
	                                    <h3>Thank your for your time<br><span id="name_field"></span>!</h3>
	                                    <p>We will contat you shorly at the following email address <strong id="email_field"></strong></p>
	                                </div>
	                                <div class="text-center">
	                                    <div class="form-group terms">
	                                        <label class="container_check">Please accept our <a href="#" data-toggle="modal" data-target="#terms-txt">Terms and conditions</a> before Submit
	                                            <input type="checkbox" name="terms" value="Yes" class="required">
	                                            <span class="checkmark"></span>
	                                        </label>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>-->
	                        <!-- /step last-->

	                    </div>
	                    <!-- /middle-wizard -->
	                    <div id="bottom-wizard">
	                        <button type="button" name="backward" class="backward">Prev</button>
	                        <button type="button" name="forward" class="forward ForwardBtn">Next</button>
	                        <button type="submit" name="process" class="submit">Submit</button>
	                    </div>
	                    <!-- /bottom-wizard -->
	                </form>
	            </div>
	            <!-- /Wizard container -->
                      <?php else: ?>
        <h1>Sorry, No Offers Found</h1>
    <?php endif; ?>
	        </div>