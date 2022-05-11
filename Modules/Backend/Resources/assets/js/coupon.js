var url_prefix ='coupon';
$(function() 
{      
    /* ------------------------------------------------------------------------- */ 
    /* -------------------------------- dataTable ------------------------------ */ 
    /* ------------------------------------------------------------------------- */  
 
    
    if($('#coupon_list').length)
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
    
         
        $('#coupon_list').DataTable();
         
    }
     
    /* ------------------------------------------------------------------------- */ 
    /* ----------------------------- form validation  -------------------------- */ 
    /* -------------------------------------------------------------------------- */
    if($('#coupon_form').length)
    {
        
        // Simple select without search
        $('.select').select2();

        // Styled checkboxes and radios
        $('.styled').uniform();

        $("#coupon_form").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "status" ){  $("#status_err").html(error); } 
                else if (element.attr("name") == "type" ){  $("#type_err").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'coupon_code':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'offer':{required:true, normalizer: function(value) { return $.trim(value);  },number:true }, 
                'status':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'type':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                   
            } 
        });
 
    }

    /* ------------------------------------------------------------------------- */ 
    /* ---------------------------- category validation  ----------------------- */ 
    /* -------------------------------------------------------------------------- */
    $('#offer').rules("remove",  'max' );
    if($("#type option:selected").val() == 'percentage')
    {
      $('#offer').rules("add", { max:100 });         
    }
        
    $(document.body).on("change","#type",function()
    {  
        $('#offer').rules("remove",  'max' );
        var type = $( "#type option:selected" ).text();
        if($("#type option:selected").val() == 'percentage')
        {
           $('#offer').rules("add", { max:100 });         
        }
        
        $( "#offer_type" ).html(type);
        
    });
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
