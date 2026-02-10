@extends('layouts.master')
@section('content')

<div id="response"></div>

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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Manage Notes: <strong>{{ $course->course_name ?? 'NA' }}</strong>
                <button type="button" style="float:right" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addNoteModal"><i class="uil-plus"></i> Add Note</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $k => $note)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $note->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary viewNoteBtn" data-bs-toggle="modal" data-bs-target="#viewNoteModal" data-file-url="{{ asset('course_notes/' . $note->file) }}">View</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#updateNoteModal_{{ $note->id }}">Update</button>

                                        <form method="POST" action="{{ route('courseNotes.destroy', ['courseId' => $course->id, 'noteId' => $note->id]) }}" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <div id="updateNoteModal_{{ $note->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Note</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form method="POST" action="{{ route('courseNotes.update', ['courseId' => $course->id, 'noteId' => $note->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $note->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Replace PDF (optional)</label>
                                                        <input type="file" name="file" class="form-control" accept="application/pdf">
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="viewNoteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Note</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" style="height:80vh">
                <iframe id="notePreviewFrame" src="" style="width:100%; height:100%;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<div id="addNoteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Course Note</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{ route('courseNotes.store', ['courseId' => $course->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">PDF File</label>
                        <input type="file" name="file" class="form-control" accept="application/pdf" required>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('viewNoteModal');
        const frame = document.getElementById('notePreviewFrame');

        document.querySelectorAll('.viewNoteBtn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const url = this.getAttribute('data-file-url');
                frame.src = url || '';
            });
        });

        modalEl.addEventListener('hidden.bs.modal', function () {
            frame.src = '';
        });
    });
</script>

@endsection
