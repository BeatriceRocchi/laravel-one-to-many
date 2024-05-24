@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>{{ $title_text }}</h2>

        <div class="form-custom-alerts">

            {{-- Lista errori inserimento/modifica --}}
            {{-- @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="m-0">Errors were found when filling out the form:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        </div>

        <form action="{{ $route }}" class="form-custom" method="POST">
            @csrf
            @method($method)
            {{-- Title input --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    placeholder="Add project's title" name="title" value="{{ old('title', $project?->title) }}">

                @error('title')
                    <div id="title" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Type select --}}
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type_id">
                    <option value="">Select a project type</option>
                    @foreach ($types as $type)
                        <option @if (old('type_id', $project->type?->id) == $type->id) selected @endif value="{{ $type->id }}">
                            {{ $type->name }}</option>
                    @endforeach
                </select>

            </div>

            {{-- Description textarea --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="6" placeholder="Add project's description">{{ old('description', $project?->description) }}</textarea>

                @error('description')
                    <div id="description" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Image input --}}
            {{-- TODO: aggiungere caricamento funzionante --}}
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" placeholder="Add project's image" name="img">
            </div>

            <button class="btn btn-custom-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" type="reset">Reset</button>
        </form>
    </div>
@endsection
