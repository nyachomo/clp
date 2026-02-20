<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin: 0 0 8px 0; }
        .meta { margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Students Not Submitted</h2>
    <div class="meta">
        <div><b>Assessment:</b> {{ $exam->name ?? 'NA' }}</div>
        <div><b>Class:</b> {{ $exam->clas->clas_name ?? 'NA' }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $k => $student)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phonenumber }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center">All students have submitted</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
