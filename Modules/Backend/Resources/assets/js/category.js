var url_prefix ='category';
$(function() 
{      
    /* ------------------------------------------------------------------------- */ 
    /* -------------------------------- dataTable ------------------------------ */ 
    /* ------------------------------------------------------------------------- */  
 
    
    if($('#category_list').length)
    {  
           $.extend( $.fn.dataTable.defaults, {
        autoWidth: true,
        columnDefs: [{ 
            orderable: false,
//            width: '100px'
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
    
         
        $('#category_list').DataTable();
         
    }
     
 

    
    
});


 