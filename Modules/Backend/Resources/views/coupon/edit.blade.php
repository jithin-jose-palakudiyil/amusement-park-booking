@extends('backend::layouts.master')   
@section('content')  
    {!! Form::model($coupon, ['method' => 'PATCH', 'route' => ['coupon.update', $coupon->id],'class'=>'form-valide','id'=>'coupon_form','enctype'=>'multipart/form-data']) !!}     
    @include('backend::coupon.form', compact('coupon'))
    {!! Form::close() !!} 
@stop
 
             
  