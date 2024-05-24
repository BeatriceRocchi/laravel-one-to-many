@extends('layouts.admin')

@section('content')
    <h2>Project details</h2>

    <div class="card m-4">
        <div class="d-flex">
            <div class="card-img-box">
                <img src="..." class="card-img-top" alt="{{ $project->title }}">
            </div>
            <div class="card-body">
                <h5>{{ $project->title }}</h5>
                <p>{{ $project->description }}</p>
            </div>
        </div>
    </div>
@endsection
