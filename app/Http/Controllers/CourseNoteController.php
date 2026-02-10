<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $notes = CourseNote::where('course_id', $courseId)->orderBy('created_at', 'desc')->get();

        return view('courses.courseNotes', compact('course', 'notes'));
    }

    public function store(Request $request, $courseId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf'],
        ]);

        $course = Course::findOrFail($courseId);

        $file = $request->file('file');
        $fileName = 'course_note_' . $course->id . '_' . time() . '.pdf';
        $destination = public_path('course_notes');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $fileName);

        CourseNote::create([
            'course_id' => $course->id,
            'name' => $validated['name'],
            'file' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Note uploaded successfully');
    }

    public function update(Request $request, $courseId, $noteId)
    {
        $note = CourseNote::where('course_id', $courseId)->findOrFail($noteId);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf'],
        ]);

        $note->name = $validated['name'];

        if ($request->hasFile('file')) {
            $destination = public_path('course_notes');

            $oldPath = $destination . DIRECTORY_SEPARATOR . $note->file;
            if (!empty($note->file) && File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('file');
            $fileName = 'course_note_' . $courseId . '_' . time() . '.pdf';

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $fileName);
            $note->file = $fileName;
        }

        $note->save();

        return redirect()->back()->with('success', 'Note updated successfully');
    }

    public function destroy($courseId, $noteId)
    {
        $note = CourseNote::where('course_id', $courseId)->findOrFail($noteId);

        $path = public_path('course_notes/' . $note->file);
        if (!empty($note->file) && File::exists($path)) {
            File::delete($path);
        }

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully');
    }
}
