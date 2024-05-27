@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="wrapper-projects d-flex flex-column align-items-center">
            <h2>Projects records</h2>

            {{-- Messaggio di avvenuta eliminazione --}}
            @if (session('delete_msg'))
                <div class="alert alert-info" role="alert">
                    {{ session('delete_msg') }}
                </div>
            @endif

            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'id', 'toSearch' => $toSearch]) }}"
                                    class="me-2">Id</a>
                                @if ($direction === 'asc')
                                    <i class="fa-solid fa-caret-down"></i>
                                @else
                                    <i class="fa-solid fa-caret-up"></i>
                                @endif
                            </div>

                        </th>
                        <th scope="col">
                            <a href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'title', 'toSearch' => $toSearch]) }}"
                                class="me-2">Title</a>
                            @if ($direction === 'asc')
                                <i class="fa-solid fa-caret-down"></i>
                            @else
                                <i class="fa-solid fa-caret-up"></i>
                            @endif
                        </th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td scope="row">{{ $project->id }}</td>
                            <td class="text-nowrap text-uppercase fw-semibold">{{ $project->title }}</td>
                            <td class="text-nowrap">{{ $project->type?->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td>
                                <div class="thumb-custom text-center">
                                    <img src="{{ asset('storage/' . $project->img) }}" alt="{{ $project->title }}"
                                        onerror="this.src = '/img/img-placeholder.png'">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.projects.show', $project) }}"
                                        class="btn btn-custom-primary btn-link-custom me-2">
                                        <i class="fa-solid fa-info"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="btn btn-custom-secondary me-2"><i class="fa-solid fa-pen-to-square"></i></a>

                                    @include('admin.partials.delete_form')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">There are no projects in the record</div>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-custom my-4">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection
