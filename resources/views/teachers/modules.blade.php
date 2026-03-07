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

<div id="teacher-modules-message" class="mt-2"></div>

<div class="progress mt-2" style="height: 18px; display:none;" id="teacherModulesProgressWrap">
    <div class="progress-bar" id="teacherModulesProgress" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>

<div class="row">
    <div class="col-12">
        <div id="teacherModulesAjaxRoot">
            @include('teachers.partials.modulesAjax')
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function getCleanText(html) {
                return String(html || '')
                    .replace(/<[^>]*>/g, '')
                    .replace(/&nbsp;/g, ' ')
                    .trim();
            }

            const messageWrap = document.getElementById('teacher-modules-message');
            const progressWrap = document.getElementById('teacherModulesProgressWrap');
            const progressBar = document.getElementById('teacherModulesProgress');

            function displayMessage(type, message) {
                if (!messageWrap) return;
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                messageWrap.innerHTML = `
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }

            function extractErrorMessage(payload) {
                if (!payload) return 'Request failed';
                if (payload.message) return payload.message;
                if (payload.errors) {
                    const firstKey = Object.keys(payload.errors)[0];
                    if (firstKey && payload.errors[firstKey] && payload.errors[firstKey][0]) {
                        return payload.errors[firstKey][0];
                    }
                }
                return 'Request failed';
            }

            function setProgress(percent) {
                if (!progressBar) return;
                progressBar.style.width = percent + '%';
                progressBar.setAttribute('aria-valuenow', String(percent));
                progressBar.textContent = percent + '%';
            }

            function hideProgressSoon() {
                setTimeout(function () {
                    if (progressWrap) progressWrap.style.display = 'none';
                }, 600);
            }

            function initTeacherModulesAjax() {
                const root = document.getElementById('teacherModulesAjaxRoot');
                if (!root) return;

                root.querySelectorAll('form.js-module-form').forEach(function (form) {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        if (window.tinymce && typeof window.tinymce.triggerSave === 'function') {
                            window.tinymce.triggerSave();
                        }

                        const textarea = form.querySelector('textarea[name="module_content"]');
                        if (textarea) {
                            const value = textarea.value;
                            if (getCleanText(value).length === 0) {
                                textarea.focus();
                                return;
                            }
                        }

                        if (progressWrap) progressWrap.style.display = 'block';
                        setProgress(0);

                        const xhr = new XMLHttpRequest();
                        const actionUrl = form.getAttribute('action');
                        const formData = new FormData(form);

                        xhr.open('POST', actionUrl, true);
                        xhr.setRequestHeader('Accept', 'application/json');
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                        xhr.upload.onprogress = function (event) {
                            if (event && event.lengthComputable) {
                                const percent = Math.round((event.loaded / event.total) * 100);
                                setProgress(percent);
                            } else {
                                setProgress(60);
                            }
                        };

                        xhr.onreadystatechange = function () {
                            if (xhr.readyState !== 4) return;

                            let payload = null;
                            try {
                                payload = JSON.parse(xhr.responseText);
                            } catch (err) {
                                payload = null;
                            }

                            if (xhr.status >= 200 && xhr.status < 300 && payload && payload.success) {
                                setProgress(100);
                                if (payload.html) {
                                    root.innerHTML = payload.html;
                                }

                                const modalEl = form.closest('.modal');
                                if (modalEl && window.bootstrap) {
                                    const inst = window.bootstrap.Modal.getInstance(modalEl);
                                    if (inst) inst.hide();
                                }

                                displayMessage('success', payload.message || 'Saved successfully');
                                initTeacherModulesAjax();
                            } else {
                                displayMessage('error', extractErrorMessage(payload));
                            }

                            hideProgressSoon();
                        };

                        xhr.send(formData);
                    });
                });
            }

            initTeacherModulesAjax();
        });
    </script>
@endsection
