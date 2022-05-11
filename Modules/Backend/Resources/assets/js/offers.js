var url_prefix ='offers';
$(function() 
{      
    /* ------------------------------------------------------------------------- */ 
    /* -------------------------------- dataTable ------------------------------ */ 
    /* ------------------------------------------------------------------------- */  
 
    
    if($('#offers_list').length)
    {  
           $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px'
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    
         
        $('#offers_list').DataTable();
         
    }
    
    
    /* ------------------------------------------------------------------------- */ 
    /* ---------------------------- category change  --------------------------- */ 
    /* ------------------------------------------------------------------------- */
    
    $(document.body).on("change",".category",function()
    {   $( '.category_error' ).html(' ')
            var slug_id =  $(this).attr("data-slug");
            if(typeof slug_id !== "undefined")
            {   var split_ = slug_id.split("::");
                if(split_.length==2)
                {
                    if($(this).is(":checked")) 
                    {
                        
                        $('#actualprice_'+split_[1]).rules("add", { required:true, normalizer: function(value) { return $.trim(value);  },number:true });
                        $('#offerprice_'+split_[1]).rules("add", { required:true, normalizer: function(value) { return $.trim(value);  },number:true });
                    
                    }
                    else
                    {  
                        $('#actualprice_'+split_[1]).rules("remove",  'required' );
                        $('#offerprice_'+split_[1]).rules("remove",  'required' );
                    } 
                } 
            }
                  
    });
    
    /* ------------------------------------------------------------------------- */ 
    /* ----------------------------- keydown function  ------------------------- */ 
    /* -------------------------------------------------------------------------- */
    
    $(".actualprice").keyup(function(){
        var slug_id =  $(this).attr("data-slug");
        if(typeof slug_id !== "undefined")
        {
            var split_ = slug_id.split("::");
            if(split_.length==2)
            { var va =Number($(this).val());
                
                if(isNaN(va))
                {
                   $('#offerprice_'+split_[1]).val('null');
                }
                else
                {
                    var offer =   Number($('#offer').val());
                    if(isNaN(offer)) { $('#offerprice_'+split_[1]).val(''); }
                    else{
                        var tot = (va/100)*offer; 
                        $('#offerprice_'+split_[1]).val(tot.toFixed(2));
                    }    
                }              
            }
        }
      });
    
    $("#offer").keyup(function(){
        
        $( '.actualprice' ).each(function( index )
        {
            var slug_id =  $(this).attr("data-slug");
            if(typeof slug_id !== "undefined")
            {
                var split_ = slug_id.split("::");
                if(split_.length==2)
                { 
                    var va =Number($(this).val());

                    if(isNaN(va))
                    {
                       $('#offerprice_'+split_[1]).val('');
                    }
                    else
                    {
                        var offer =   Number($('#offer').val());
                        if(isNaN(offer)) { $('#offerprice_'+split_[1]).val(''); }
                        else{
                            var tot = ((va/100)*offer).toFixed(2);
                             
                            $('#offerprice_'+split_[1]).val(tot.toFixed(2));
                        }    
                    }              
                }
            }
        });
    });
    
    /* ------------------------------------------------------------------------- */ 
    /* ----------------------------- form validation  -------------------------- */ 
    /* -------------------------------------------------------------------------- */
    if($('#offers_form').length)
    {
        
        // Simple select without search
        $('.select').select2();

        // Styled checkboxes and radios
        $('.styled').uniform();

        $("#offers_form").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "group_id" ){  $("#group_err").html(error); } 
                else if (element.attr("name") == "status" ){  $("#status_err").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'group_id':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'name':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'offer':{required:true, normalizer: function(value) { return $.trim(value);  },number:true,max: 100 }, 
                'status':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                  
            },submitHandler: function(form)
            {
                var category =  $('.category:checked').length;
                if(category > 0)
                {
                   return true;   
                }else
                {
                    $( '.category_error' ).html('<label id="category_00-error" class="validation-error-label" for="category_00">Plase select atleast one category.</label>');
                    return false;
                } 
            }
        });
 
    }

    /* ------------------------------------------------------------------------- */ 
    /* ---------------------------- category validation  ----------------------- */ 
    /* -------------------------------------------------------------------------- */
    if($('.category').length)
    {
        $( '.category' ).each(function( index )
        {
            var slug_id =  $(this).attr("data-slug");
            if(typeof slug_id !== "undefined")
            {   var split_ = slug_id.split("::");
                if(split_.length==2)
                {
                    if($(this).is(":checked")) 
                    {
                        $('#actualprice_'+split_[1]).rules("add", { required:true, normalizer: function(value) { return $.trim(value);  },number:true });
                        $('#offerprice_'+split_[1]).rules("add", { required:true, normalizer: function(value) { return $.trim(value);  },number:true });
                    
                    }
                    else
                    {  
                        $('#actualprice_'+split_[1]).rules("remove",  'required' );
                        $('#offerprice_'+split_[1]).rules("remove",  'required' );
                    } 
                } 
            }
        });
    }
      
    

    
    
});


function ConfirmDelete(id)
    {  
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert' 
        });
       var notyConfirm =  new Noty({
                layout: 'center',
                text: 'Are you sure you want to delete it?',
                type: 'info',
                 buttons: [
                    Noty.button('Cancel', 'btn btn-light', function () {
                        notyConfirm.close();
                    }),

                    Noty.button('Yes <i class="icon-paperplane ml-2"></i>', 'btn bg-slate-600 ml-1', function () {
                         var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+id;  
                        $.ajax
                        ({
                            type: 'DELETE',
                            url: url,
                            dataType: "json",
                            async: false,
                            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data :{'id':id},
                            success: function(response){  window.location.reload(); },
                            error: function (request, textStatus, errorThrown)  {  }
                            });
                            notyConfirm.close();
                        },
                        {id: 'button1', 'data-status': 'ok'}
                    )
                ]
            }).show();
           return false;
 
         
}
