@php
    $pageName = 'ourWork';
@endphp

@extends("admin.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Our Work</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ourWork.create') }}"> Create New Work</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($ourWork) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>English title</th>
                <th>English Description</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($ourWork as $oneOurWork)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $oneOurWork->title_en }}</td>
                <td>{{ $oneOurWork->description_en }}</td>
                <td>
                    <form action="{{ route('ourWork.destroy',$oneOurWork->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('ourWork.show',$oneOurWork->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('ourWork.edit',$oneOurWork->id) }}">Edit</a>

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
            <h3>No Work created yet .</h3>
        </div>
    @endif


    <div id="paginationNumbers">
        {!! $ourWork->links('pagination::bootstrap-5') !!}
    </div>

    {{-- {!! $products->links() !!} --}}


    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
@endsection
