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
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->img }}</td>
                            {{-- TODO: aggiungere thumb immagine al posto di name usato come placeholder --}}
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.projects.show', $project) }}"
                                        class="btn btn-success btn-link-custom me-2">
                                        <i class="fa-solid fa-info"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary me-2"><i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                    @include('admin.partials.delete_form')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">There are no projects in the record</div>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
