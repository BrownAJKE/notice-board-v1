@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Notice Board') }}</div>
                    <div class="list-group list-group-flush">
                        @forelse ($notices as $notice)
                            <a href="{{ route('notice.show', $notice->id) }}"
                                class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $notice->title }}</h5>
                                    <small>{{ $notice->created_at->diffForHumans() }}</small>
                                </div>
                                <small>By: {{ $notice->user->name }}</small>
                            </a>
                        @empty
                            <p class="text-center m-2">No notices published yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.Echo.channel('notices').listen('NoticeNotification', (e) => {
            alert(' new notice has been published');
        });
    </script>
@endsection
