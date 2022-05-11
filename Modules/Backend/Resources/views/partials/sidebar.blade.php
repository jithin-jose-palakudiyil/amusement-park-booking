<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <?php 
                        $profile_img = 'public/images/user-default.png';  
                        if(Auth::guard(admin_guard)->user()->image):
                            $path = 'public/uploads/admin_user/'.Auth::guard(admin_guard)->user()->id.'/'.Auth::guard(admin_guard)->user()->image; 
                            if(File::exists($path)):  $profile_img = $path;  endif;     
                        endif;
                    ?>
                    <a href="#" class="media-left"><img src="{{asset($profile_img)}}" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{Auth::guard(admin_guard)->user()->name}}</span> 
                    </div> 
                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li> <a href="{{route('admin-logout')}}"><i class="icon-switch2"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


    <!-- Main navigation -->
    <div class="sidebar-category sidebar-category-visible">
        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li> 
                <li <?php if(isset($active) && $active == 'dashboard'){echo 'class="active"'; } ?>>
                    <a href="{{url(admin_prefix.'/dashboard')}}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li <?php if(isset($active) && $active == 'offers'){echo 'class="active"'; } ?> >
                    <a href="{{route('offers')}}">
                        <i class="icon-cart2"></i>
                        <span> Offers </span>
                    </a>
                </li> 
                <li <?php if(isset($active) && $active == 'coupon'){echo 'class="active"'; } ?> >
                    <a href="{{route('coupon')}}">
                        <i class="icon-basket"></i>
                        <span> Coupon Code </span>
                    </a>
                </li>
                <li <?php if(isset($active) && $active == 'category'){echo 'class="active"'; } ?> >
                    <a href="{{route('category')}}">
                        <i class="icon-stack2"></i>
                        <span> Category </span>
                    </a>
                </li>
                <li <?php if(isset($active) && $active == 'booking'){echo 'class="active"'; } ?> >
                    <a href="{{route('admin_booking_index')}}">
                        <i class=" icon-table2"></i>
                        <span> Booking </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navigation -->

    </div>
</div>