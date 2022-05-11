@extends('backend::layouts.master') 
 
@section('content') 
 
 
<!-- Basic datatable -->
<div class="panel panel-flat">
    <table class="table datatable-basic"    data-url=" " id="offers_list">
        <thead> 
            <tr>
            <th>Name</th>
            <th>Offer in %</th>
            <th>Group</th> 
            <th>Status</th>
            <th class="text-center">Actions</th>
            </tr> 
        </thead>
        <tbody> 
            <?php 
            if(isset($offers)): 
                foreach ($offers as $key => $value):
                    ?>
                    <tr>
                        <td>{{$value->name}}</td> 
                        <td>{{$value->offer}}</td>
                        <td>{{$value->group}}</td>
                        <td>
                            <?php 
                            if($value->status == 1):
                               echo '<span class="label label-success">Active</span>' ;
                            elseif ($value->status == 2):
                                echo '<span class="label label-danger">Closed</span>'; 
                            endif;
                            ?>      
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="text-primary-600" style="margin-right: 15px"><a href="{{route('offers.edit',[$value->id])}}"><i class="icon-pencil7"></i></a></li>
                                <li class="text-danger-600" style="margin-right: 15px" onclick="return ConfirmDelete({{$value->id}});" ><a href="#"><i class="icon-trash"></i></a></li> 
                            </ul>
                        </td>
                    </tr> 
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
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
    <script src="{{asset('Modules/Backend/Resources/assets/js/offers.js')}}"></script>    
@stop
