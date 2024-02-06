@php
    $pageName = 'mainBanner';
@endphp

@extends("admin.layout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show message</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contactForm.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name :</strong>
                {{ $contactForm->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject : </strong>
                {{ $contactForm->subject }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>email : </strong>
                {{ $contactForm->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>message : </strong>
                {{ $contactForm->message }}
            </div>
        </div>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>date : </strong>
                {{ $contactForm->created_at }}
            </div>
        </div>
        

        {{-- 
            
            continue ....
            
            --}}
    </div>
    
</div>


@endsection