@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('shared.errors')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ $notice->title }}
                        <div class="d-flex space-between justify-content-between">
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <div style="margin-right: 3px">
                                        @if ($notice->approved == false)
                                            <a href="{{ route('approve-notice', $notice->id) }}"
                                                class="btn btn-success btn-sm">Approve</a>
                                        @else
                                            <span
                                                class="badge bg-success">Approved</span>
                                        @endif
                                    </div>
                                @endif
                                @if ($notice->user_id == auth()->user()->id ||
                                    auth()->user()->isAdmin())
                                    <form action="{{ route('notice.destroy', $notice->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm ml-1 btn-outline-danger">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! $notice->description !!}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
