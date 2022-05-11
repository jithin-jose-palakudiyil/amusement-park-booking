@extends('backend::layouts.master') 
 
@section('content') 
  
<!-- Basic datatable -->
<div class="panel panel-flat">
    <table class="table datatable-basic" id="booking_list" data-url="{{route('admin_booking_list')}}">
        <thead> 
            <tr>
            <th>amount paid</th>
            <th>booking date</th>  
            <th>offer name</th>
            <th class="text-center">show</th>
            </tr> 
        </thead>
       
    </table>
</div>                                
<!-- Basic datatable -->                          
@stop

@section('js') 
<style>
    .btn-light {
    color: #000 !important;
    margin-right: 10px !important;
}
</style>
    <script src="{{asset('public/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>   
    <script src="{{asset('public/global_assets/js/plugins/notifications/noty.min.js')}}"></script> 
    <script src="{{asset('Modules/Backend/Resources/assets/js/booking.js')}}"></script>    
@stop
