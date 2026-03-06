@extends('layouts.master')
@section('content')

@if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div id="error-alert"  class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Modules - {{ $teacher->course->course_name ?? 'NA' }}
                <a type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                    Add New Module
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modules as $key => $module)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $module->module_name }}</td>
                                    <td><?php echo $module->module_content; ?></td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModule{{ $module->id }}">Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModule{{ $module->id }}">Delete</a>
                                                <a class="dropdown-item" href="{{ route('teacherModuleNotes', ['moduleId' => $module->id]) }}">Manage Notes</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div id="updateModule{{ $module->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Module</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form method="POST" action="{{ route('teacherUpdateModule') }}">
                                                @csrf
                                                <div class="card-body">
                                                    <input type="text" name="id" class="form-control" value="{{ $module->id }}" hidden>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label>Module Name<sup>*</sup></label>
                                                            <input type="text" class="form-control" name="module_name" value="{{ $module->module_name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-12">
                                                            <label>What to Learn<sup>*</sup></label>
                                                            <textarea name="module_content" class="form-control" rows="6" required><?php echo $module->module_content; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success rounded-pill">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="deleteModule{{ $module->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Module</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form method="POST" action="{{ route('teacherDeleteModule') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $module->id }}">
                                                    <p>Delete this module?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success rounded-pill">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No modules found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addModuleModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Module</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{ route('teacherAddModule') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Module Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="module_name" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <label>What to Learn<sup>*</sup></label>
                            <textarea name="module_content" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
