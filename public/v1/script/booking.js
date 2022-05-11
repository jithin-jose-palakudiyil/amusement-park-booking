$(function() 
{ 
    $("#bookingdate").datepicker({dateFormat: 'dd-mm-yy', minDate: '+1d'});
    $('.ForwardBtn').prop("disabled", true);
    if( $("#phone").length){ 
   
        $("#phone").intlTelInput
        ({  
            initialCountry: 'in',localizedCountries:'in',
            separateDialCode: true,
            nationalMode: false,
            allowDropdown: false, 
            utilsScript: base_url+"/public/intlTelInput/utils.js" 
        }); 
    }
    /* ------------------------------------------------------------------------- */
    /* ---------------------------- booking offer ------------------------------ */
    /* ------------------------------------------------------------------------- */
    
    $(document.body).on("change",".booking_offer",function()
    {
        
        var off = $(this).val()  ;  
        var url=base_url+'/get-offer-details/'+off;  
        $.ajax
        ({
            type: 'GET',
            url: url,
            dataType: "json",
            async: false,
            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data :{'_token':$('meta[name="csrf-token"]').attr('content')},
            success: function(response)
            { 
                    var obj =  $.parseJSON(JSON.stringify(response));  
                     if(obj.offer_details){
                        $('#offer_details_div').html(obj.offer_details);
                        $('.ForwardBtn').removeAttr("disabled");
                     }
                     else{
                       $('#offer_details_div').html(' ');   
                     }

            },
            error: function (request, textStatus, errorThrown)  {  }
            });
                            
                            
                            
    });
    
    /* ------------------------------------------------------------------------- */
    /* ---------------------------- category options --------------------------- */
    /* ------------------------------------------------------------------------- */
    
    $(document.body).on("change",".category_options",function()
    {
        var key =  $(this).attr("data-key");
        if(typeof key !== "undefined")
        {
            if($(this).is(':checked'))
            {
                
                $('#qty_'+key).removeAttr("disabled");
                $('#qty_'+key).addClass('required');
            }
            else
            {
                $('#qty_'+key).removeClass('required');
                $('#qty_'+key).removeClass('error');
                $('#qty_'+key).val('');
                $('#price_'+key).val('');
                $('#qty_'+key).prop("disabled", true);
            }  
        }
       
        if($('.category_options:checkbox:checked').length > 0)
        {
            var inputs = $("#wizard_container").wizard('state').step.find(':input');
            if(inputs.valid())
            {
               $('.ForwardBtn').removeAttr("disabled"); 
            }else
            {
                $('.ForwardBtn').prop("disabled", true);   
            }  
        }else {  $('.ForwardBtn').prop("disabled", true); }
         price_cal();
    });
    
    /* ------------------------------------------------------------------------- */
    /* ---------------------------------- qty option --------------------------- */
    /* ------------------------------------------------------------------------- */
    
    $(document.body).on("keyup mouseup",".qty_option",function()
    {
       if (this.hasAttribute("disabled")) {
           
       }else
       {
            var qtykey =  $(this).attr("data-qtykey");
            var qty = $(this).val();
            if(typeof qtykey !== "undefined")
            {  
//                $('#price_'+qtykey).val(' ');
                var price =  $(this).attr("data-price");
                if(typeof price !== "undefined")
                {
                    if(isNaN(price) && isNaN(qty)){$(this).val('');}else
                    {
                        if(qty>0)
                        { 
                            $('#price_'+qtykey).val(price*qty); 
                        }
                    }
                }else { $(this).val('');  } 
            }else { $(this).val('');  }    
       }
        var inputs = $("#wizard_container").wizard('state').step.find(':input');
       if(inputs.valid())
       {
          $('.ForwardBtn').removeAttr("disabled"); 
       }
       price_cal();
    });
    
    /* ------------------------------------------------------------------------- */
    /* ---------------------------------- ForwardBtn --------------------------- */
    /* ------------------------------------------------------------------------- */
    
    $(document.body).on("click",".ForwardBtn",function()
    {
       var id =  $('.step.wizard-step.current').attr("id");
       var inputs = $("#wizard_container").wizard('state').step.find(':input');
       if(inputs.valid())
       {
           if(id == 'offer_details_div') {  $('.ForwardBtn').removeAttr("disabled"); }
       }else
       {
            if(id == 'offer_details_div') { $('.ForwardBtn').prop("disabled", true);  }
       }
       
    });
    
    
    
    
    
    
    
    
    
});


function price_cal()
{
    
    var price = 0;
    $(".price_option").each(function(index,element)
    {
        var price_option=parseInt($(this).val());
       
         if(!isNaN(price_option)){  price += price_option; } 
    }); 
    
    if(price > 0)
    {
        var igst = (price/100)*18;
        $("#igst").html('IGST (18%):  <b>₹'+igst.toFixed(2)+'<b>');  
        price+=igst;
        $("#TotalPrice").html('Amount Payable : <b>₹'+price.toFixed(2)+'<b>'); 
    }
    else{$("#igst").html(' ');$("#TotalPrice").html(' ');}
}