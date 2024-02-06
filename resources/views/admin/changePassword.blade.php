@php
    $pageName = 'ChangePasssword';
@endphp

@extends("admin.layout")

@section("content")


<div class="card card-default p-3">
    <h3>Change password</h3>

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

    @if ($message = Session::get('failed'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    
    <div class="card-body">
        <form class="horizontal-form" action="{{route('updatePassword')}}" method="POST">
            @csrf
            @method('POST')
            
            <div class="form-group row">
                <div class="col-12 col-lg-12">
                    <div class="col-12 col-sm-12">
                        <label for="oldPassword">كلمة المرور القديمة</label>
                    </div>
                    <div class="col-12 col-sm-12">                            
                        <input type="password" class="form-control" name="oldPassword" placeholder="old password" style="margin-top: 0px; margin-bottom: 0px;">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12 col-lg-12">
                    <div class="col-12 col-sm-12">
                        <label for="newPassword">new password</label>
                    </div>
                    <div class="col-12 col-sm-12">                            
                        <input type="password" class="form-control" name="newPassword" placeholder="new password" style="margin-top: 0px; margin-bottom: 0px;">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12 col-lg-12">
                    <div class="col-12 col-sm-12">
                        <label for="confirmNewPassword">confirm new password</label>
                    </div>
                    <div class="col-12 col-sm-12">                            
                        <input type="password" class="form-control" name="confirmNewPassword" placeholder="type new password again" style="margin-top: 0px; margin-bottom: 0px;">
                    </div>
                </div>
            </div>
                            
            <div class="form-footer pt-5 border-top">
                <button type="submit" class="btn btn-primary btn-info">update password</button>
            </div>
        </form>
    </div>

</div>

@endsection