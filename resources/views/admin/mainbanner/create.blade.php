@php
    $pageName = 'mainBanner';
@endphp

@extends("admin.layout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Banner</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mainBanner.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('mainBanner.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title En:</strong>
                <input type="text" name="title_en" class="form-control" placeholder="title_en" value="{{old('title_en')}}">
            </div>
            @if($errors->has('title_en'))
                <div class="error">{{ $errors->first('title_en') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title fr:</strong>
                <input type="text" name="title_fr" class="form-control" placeholder="title_fr" value="{{old('title_fr')}}">
            </div>
            @if($errors->has('title_fr'))
                <div class="error">{{ $errors->first('title_fr') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title Ar:</strong>
                <input type="text" name="title_ar" class="form-control" placeholder="title_ar" value="{{old('title_ar')}}">
            </div>
            @if($errors->has('title_ar'))
                <div class="error">{{ $errors->first('title_ar') }}</div>
            @endif
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>description En:</strong>
                <input type="text" name="description_en" class="form-control" placeholder="description_en" value="{{old('description_en')}}">
            </div>
            @if($errors->has('description_en'))
                <div class="error">{{ $errors->first('description_en') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>description fr:</strong>
                <input type="text" name="description_fr" class="form-control" placeholder="description_fr" value="{{old('description_fr')}}">
            </div>
            @if($errors->has('description_fr'))
                <div class="error">{{ $errors->first('description_fr') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>description ar:</strong>
                <input type="text" name="description_ar" class="form-control" placeholder="description_ar" value="{{old('description_ar')}}">
            </div>
            @if($errors->has('description_ar'))
                <div class="error">{{ $errors->first('description_ar') }}</div>
            @endif
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>banner photo:</strong>

                <input type="file" name="photo" class="form-control" id="photo" value="{{old('photo')}}" onchange="photoPreviewFn(this);">
            </div>

            <img id="imagePreview" style="max-width:150px; max-height:150px;" src="" alt="photo preview">

            @if($errors->has('photo'))
                <div class="error">{{ $errors->first('photo') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>

<script>
    function photoPreviewFn(inputFile){
        var file = inputFile.files[0];
        if(file) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection