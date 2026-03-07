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
                Notes - {{ $module->module_name ?? 'NA' }}
                <a href="{{ url()->previous() }}" type="button" style="float:right" class="btn btn-sm btn-info rounded-pill">Back</a>
                <button type="button" style="float:right; margin-right:10px" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addNoteModal">Add Note</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Topic Name</th>
                                <th>Topic Content</th>
                                <th>Video Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topics as $key => $topic)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $topic->topic_name ?? 'NA' }}</td>
                                    <td><?php echo $topic->topic_content ?? 'NA'; ?></td>
                                    <td>{{ $topic->topic_video_link ?? 'NA' }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateNote{{ $topic->id }}">Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteNote{{ $topic->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div id="updateNote{{ $topic->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Note</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form method="POST" action="{{ route('teacherUpdateModuleNote', ['moduleId' => $module->id]) }}">
                                                @csrf
                                                <div class="card-body">
                                                    <input type="hidden" name="id" value="{{ $topic->id }}">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label>Topic Name<sup>*</sup></label>
                                                            <input type="text" class="form-control" name="topic_name" value="{{ $topic->topic_name }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-12">
                                                            <label>Topic Content<sup>*</sup></label>
                                                            <textarea name="topic_content" class="form-control" rows="6" required><?php echo $topic->topic_content; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-12">
                                                            <label>Video Link</label>
                                                            <input type="text" class="form-control" name="topic_video_link" value="{{ $topic->topic_video_link }}">
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

                                <div id="deleteNote{{ $topic->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Note</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form method="POST" action="{{ route('teacherDeleteModuleNote', ['moduleId' => $module->id]) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $topic->id }}">
                                                    <p>Delete this note?</p>
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
                                    <td colspan="5" class="text-center">No notes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addNoteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Note</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{ route('teacherAddModuleNote', ['moduleId' => $module->id]) }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Topic Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="topic_name" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <label>Topic Content<sup>*</sup></label>
                            <textarea name="topic_content" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <label>Video Link</label>
                            <input type="text" class="form-control" name="topic_video_link">
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
