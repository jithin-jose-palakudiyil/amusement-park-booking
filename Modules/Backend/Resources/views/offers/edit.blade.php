@extends('backend::layouts.master')   
@section('content')  
    {!! Form::model($offers, ['method' => 'PATCH', 'route' => ['offers.update', $offers->id],'class'=>'form-valide','id'=>'offers_form','enctype'=>'multipart/form-data']) !!}     
    @include('backend::offers.form', compact('offers'))
    {!! Form::close() !!} 
@stop
 
             
  