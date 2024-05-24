@extends('layouts.admin')

@section('content')
    <h2>Project details</h2>

    <div class="card m-4">
        <div class="d-flex">
            <div class="card-img-box">
                <img src="{{ asset('storage/' . $project->img) }}" class="card-img-top" alt="{{ $project->title }}"
                    onerror="this.src = '/img/img-placeholder.png'">
            </div>
            <div class="card-body">
                <h5>{{ $project->title }}</h5>
                <p>{{ $project->description }}</p>

                @if ($project->type)
                    <div class="text-end">
                        <span class="badge rounded-pill text-bg-primary">{{ $project->type->name }}</span>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
