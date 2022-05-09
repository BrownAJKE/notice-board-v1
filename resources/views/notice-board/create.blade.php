@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('shared.errors')
                <div class="card">
                    <div class="card-header">
                        Create Notice
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notice.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Notice Title</label>
                                <input type="text" value="{{ old('title') }}" name="title"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Enter notice title">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                <input id="x" type="hidden" class="form-control @error('description') is-invalid @enderror"
                                    value="{{ old('description') }}" name="description">
                                <trix-editor input="x"></trix-editor>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
