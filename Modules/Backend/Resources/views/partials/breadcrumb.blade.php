<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <?php if(isset($breadcrumb_icon)){ echo '<i class="'.$breadcrumb_icon.'"  style="margin-top: -3px;margin-right: 3px;"></i>' ;}  ?> 
                <span class="font-weight-semibold">  <?php  if (isset($page_title)){ echo $page_title; } ?></span>
            </h4>
        </div>
        <?php 
            if(isset($CreateBtn['btn_txt']) && isset($CreateBtn['url'])): 
        ?>
            <a href="{{$CreateBtn['url']}}">
                <div class="heading-elements">
                    <div class="heading-btn-group">
                    <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-plus-circle2"></i></b> {{$CreateBtn['btn_txt']}}</button>
                    </div>
                </div>
            </a>
        <?php
            endif;
        ?>
    </div>

    <div class="breadcrumb-line"> 
        <div class="breadcrumb">
            <?php   
            if(isset($breadcrumb)):  
                foreach ($breadcrumb as $key => $value): 
                    if(isset($value['active'])): ?>  
                        <li class="active"> {{$value['title']}}</li>
                    <?php else: ?>
                        <li>
                            <a href="{{$value['url']}}">
                                <?php if($key == 0): ?> <i class="icon-home2 position-left"></i> <?php endif; ?> 
                                {{$value['title']}}
                            </a>
                        </li>
                    <?php endif;   
                endforeach;
            endif;
            ?> 
        </div> 
    </div>
</div>