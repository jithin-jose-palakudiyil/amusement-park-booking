@extends('backend::layouts.master') 
 
@section('content') 
  
<!-- Basic datatable -->
<div class="panel panel-flat">
    <table class="table datatable-basic" id="category_list">
        <thead> 
            <tr>
            <th>Name</th>
            <th>slug</th>  
            <th>Status</th>
            <th class="text-center">Change Status</th>
            </tr> 
        </thead>
        <tbody> 
            <?php 
            if(isset($category)): 
                foreach ($category as $key => $value):
                    ?>
                    <tr>
                        <td>{{$value->name}}</td> 
                        <td>{{$value->slug}}</td> 
                        <td>
                            <?php 
                            if($value->status == 1):
                               echo '<span class="label label-success">Active</span>' ; 
                            elseif ($value->status == 0):
                                echo '<span class="label label-danger">Suspended</span>';
                            endif;
                            ?>      
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="text-primary-600" style="margin-right: 15px"><a href="{{route('category.edit',[$value->id])}}">
                                        <i class="icon-list-unordered"></i>
                                        <?php 
                                        if($value->status == 1):
                                            echo '<span class="label label-danger">Suspend</span>';
                                        elseif ($value->status == 0):
                                            echo '<span class="label label-success">Activate</span>' ;
                                            
                                        endif;
                                        ?>    
                                    </a></li>
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
    <script src="{{asset('Modules/Backend/Resources/assets/js/category.js')}}"></script>    
@stop
