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
                Course Notes: <strong>{{ $course->course_name ?? 'NA' }}</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Note Name</th>
                                <th>Read</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $k => $note)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $note->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary viewNoteBtn" data-bs-toggle="modal" data-bs-target="#viewNoteModal" data-file-url="{{ asset('course_notes/' . $note->file) }}">Read</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No notes available</td>
                                </tr>
                            @endforelse
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
                <h4 class="modal-title">Read Note</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" style="height:80vh">
                <iframe id="notePreviewFrame" src="" style="width:100%; height:100%;" frameborder="0"></iframe>
            </div>
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
