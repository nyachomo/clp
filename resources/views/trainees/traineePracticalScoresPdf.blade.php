<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Practical Scores</title>
    <style>
        body { font-family: Tahoma, sans-serif; font-size: 12px; }
        h1, h2, h3 { margin: 0; padding: 0; }
        .meta { margin: 10px 0 15px 0; }
        .module { margin-top: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #000033; padding: 6px; vertical-align: top; }
        thead { background-color: #000033; color: #ffffff; }
    </style>
</head>
<body>
    <center>
        @if(!empty($imageSrc))
            <img src="{{ $imageSrc }}" width="120px">
        @endif
        <h1 style="color:#07294d">TECHSPHERE TRAINING INSTITUTE</h1>
        <p style="font-size:17px; border-bottom:4px solid #07294d">
            View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
            Web: <b style="color:blue;"><u>https://www.techsphereinstitute.co.ke</u></b> | Email: <b style="color:blue;"><u>Info@techsphereinstitute.co.ke</u></b> |<br>
            Phone: <b style="color:#33d6ff">+254768919307</b>
        </p>
    </center>

    @php
        $moduleAvgSum = 0;
        $moduleAvgCount = 0;

        foreach ($grouped as $items) {
            $sum = 0;
            $count = 0;
            foreach ($items as $x) {
                $max = $x->practical->marks ?? null;
                $score = $x->student_score ?? null;
                if (!is_null($max) && (float) $max > 0 && $score !== null && $score !== '' && is_numeric($score)) {
                    $sum += (((float) $score) / (float) $max) * 100;
                    $count++;
                }
            }
            if ($count > 0) {
                $moduleAvgSum += ($sum / $count);
                $moduleAvgCount++;
            }
        }

        $cumulativeScore = $moduleAvgCount > 0 ? round($moduleAvgSum / $moduleAvgCount, 2) : null;
    @endphp

    <table style="width:100%; border:0; margin-top:10px;">
        <tr>
            <td style="border:0; padding:0;">
                <h2>Students Progress Report</h2>
            </td>
            <td style="border:0; padding:0; text-align:right;">
                <h3 style="font-weight: normal;">Cumulative Score: <b>{{ $cumulativeScore !== null ? ($cumulativeScore . '%') : 'NA' }}</b></h3>
            </td>
        </tr>
    </table>

    <div class="meta">
        <div><strong>Trainee:</strong> {{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</div>
        <div><strong>Email:</strong> {{ $student->email }}</div>
        <div><strong>Course:</strong> {{ $student->course->course_name ?? 'NA' }}</div>
        <div><strong>Class:</strong> {{ $student->clas->clas_name ?? 'NA' }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 18%">Module</th>
                <th style="width: 25%">Exam Name</th>
                <th style="width: 15%">Score (100%)</th>
                <th style="width: 20%">Comment</th>
                <th style="width: 17%">Module Average
Score (100%)</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @forelse($grouped as $moduleName => $items)
                @php $rowspan = max(1, $items->count()); @endphp
                @php
                    $sum = 0;
                    $count = 0;
                    foreach ($items as $x) {
                        $max = $x->practical->marks ?? null;
                        $score = $x->student_score ?? null;
                        if (!is_null($max) && (float) $max > 0 && $score !== null && $score !== '' && is_numeric($score)) {
                            $sum += (((float) $score) / (float) $max) * 100;
                            $count++;
                        }
                    }
                    $moduleAvg = $count > 0 ? round($sum / $count, 2) : null;
                @endphp
                @foreach($items as $k => $ans)
                    <tr>
                        @if($k === 0)
                            <td rowspan="{{ $rowspan }}">{{ $i++ }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $moduleName }}</td>
                        @endif
                        <td>{{ $ans->practical->name ?? 'NA' }}</td>
                        <td>
                            @php
                                $max = $ans->practical->marks ?? null;
                                $score = $ans->student_score ?? null;
                            @endphp
                            @if(!is_null($max) && (float)$max > 0 && $score !== null && $score !== '' && is_numeric($score))
                                {{ round((((float)$score) / (float)$max) * 100, 2) }}%
                            @else
                                NA
                            @endif
                        </td>
                        <td>{{ $ans->comment ?? 'NA' }}</td>
                        @if($k === 0)
                            <td rowspan="{{ $rowspan }}">{{ $moduleAvg !== null ? ($moduleAvg . '%') : 'NA' }}</td>
                        @endif
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="6">No practical scores found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
