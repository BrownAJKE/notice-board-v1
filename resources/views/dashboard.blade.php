@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('shared.errors')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        My Notices
                        <a href="{{ route('notice.create') }}" class="btn btn-dark btn-sm">Add Notice</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($notices as $notice)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a class="text-decoration-none"
                                    href="{{ route('notice.show', $notice->id) }}">{{ $notice->title }}</a>
                                <div class="d-flex actions justify-content-between">
                                    <div style="margin-right: 3px">
                                        <span
                                            class="badge bg-{{ $notice->approved == true ? 'success' : 'danger' }}">{{ $notice->approved == true ? 'Approved' : 'Pending' }}</span>
                                    </div>
                                    @if ($notice->user_id == auth()->user()->id ||
                                        auth()->user()->isAdmin())
                                        <form action="{{ route('notice.destroy', $notice->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm ml-1 btn-outline-danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <p class="text-center mt-2">You do not have any published notices</p>
                        @endforelse
                    </ul>
                    <div class="card-body">
                        {{ $notices->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
