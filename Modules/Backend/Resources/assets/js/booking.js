var url_prefix ='booking';
$(function() 
{      
    /* ------------------------------------------------------------------------- */ 
/* -------------------------------- dataTable ------------------------------ */ 
/* ------------------------------------------------------------------------- */ 

    if($('#booking_list').length)
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
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });

            var url=$('#booking_list').attr('data-url');
            $('#booking_list').DataTable
            ({
                processing: true,
                serverSide: true, 
                ajax: url,
                columns: [ 
                            
                            {
                                data: "amount_paid", sortable: true, 
                                render: function (data, type, full) {  return  '₹'+full.amount_paid; } 
                            },
                             {
                                data: "booking_date", sortable: true, 
                                render: function (data, type, full) {  return full.booking_date; } 
                            },
                            {
                                data: "booking_offer.name", sortable: true,
                                render: function (data, type, full) {  return  full.booking_offer.name; } 
                            },
                            {
                                 data: "null","searchable": false, sortable: false,
                                render: function (data, type, full)
                                {  
                                     var  u ='<a href="'+base_url+'/'+admin_prefix +'/booking-show/'+full.id+'"><i class=" icon-eye"></i> show</a>';return u;
//                                    var d="Onclick='return ConfirmDelete("+full.id+");'";
//                                    var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
//                                    '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
//                                    '<li><a href="'+base_url+'/coo/country/'+full.id+'/edit"><i class=" icon-pen"></i> Edit Country </a></li>'+
//                                    '<li><a '+d+' class="delete_single" href="#"><i class="icon-trash"></i> Delete Country</a></li>'+
//                                    '</ul></li></ul>';                     
//                                    return u;
                                } 
                            }
                ] 
            });
        }

    
    
});


 