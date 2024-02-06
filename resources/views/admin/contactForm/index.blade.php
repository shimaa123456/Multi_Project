@php
    $pageName = 'ContactForm';
@endphp

<style>
    .isNotRead {
        font-weight: bolder;
        color: blue;
    }
</style>


@extends("admin.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>contact Form</h2>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mainBanner.create') }}"> Create New Banner </a>
            </div> --}}
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($contactForm) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Subject</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($contactForm as $oneContactForm)
            <tr>
                <td class="{{ $oneContactForm->isRead == 0 ? 'isNotRead' : ''}}">{{ ++$i }}</td>
                <td class="{{ $oneContactForm->isRead == 0 ? 'isNotRead' : ''}}">{{ $oneContactForm->name }}</td>
                <td class="{{ $oneContactForm->isRead == 0 ? 'isNotRead' : ''}}">{{ $oneContactForm->subject }}</td>
                <td>
                    <form action="{{ route('contactForm.destroy',$oneContactForm->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('contactForm.show',$oneContactForm->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('contactForm.edit',$oneContactForm->id) }}">Edit</a>

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
            <h3>No messages created yet .</h3>
        </div>
    @endif
    

    <div id="paginationNumbers">
        {!! $contactForm->links('pagination::bootstrap-5') !!}
    </div>

    {{-- {!! $products->links() !!} --}}


    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
@endsection