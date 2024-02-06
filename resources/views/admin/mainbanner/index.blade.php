@php
    $pageName = 'mainBanner';
@endphp

@extends("admin.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Main Banner</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mainBanner.create') }}"> Create New Banner </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($mainBanner) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>English title</th>
                <th>English Description</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($mainBanner as $oneMainBanner)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $oneMainBanner->title_en }}</td>
                <td>{{ $oneMainBanner->description_en }}</td>
                <td>
                    <form action="{{ route('mainBanner.destroy',$oneMainBanner->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('mainBanner.show',$oneMainBanner->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('mainBanner.edit',$oneMainBanner->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                        {{-- <a href="" class="btn btn-danger">Delete</a> --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @else
        <div class="pull-left alert alert-success">
            <h3>No mainBanner created yet .</h3>
        </div>
    @endif
    

    <div id="paginationNumbers">
        {!! $mainBanner->links('pagination::bootstrap-5') !!}
    </div>

    {{-- {!! $products->links() !!} --}}


    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
@endsection