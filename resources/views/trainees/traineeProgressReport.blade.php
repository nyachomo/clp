@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Students Progress Report</h4>
                <a href="{{ route('downloadMyProgressReportPdf') }}" class="btn btn-sm btn-secondary">Download PDF</a>
            </div>
            <div class="card-body">
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

                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <div><b>Trainee:</b> {{ $student->firstname }} {{ $student->secondname }} {{ $student->lastname }}</div>
                        <div><b>Email:</b> {{ $student->email }}</div>
                        <div><b>Course:</b> {{ $student->course->course_name ?? 'NA' }}</div>
                        <div><b>Class:</b> {{ $student->clas->clas_name ?? 'NA' }}</div>
                    </div>
                    <div class="text-end">
                        <div><b>Cumulative Score:</b> {{ $cumulativeScore !== null ? ($cumulativeScore . '%') : 'NA' }}</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 18%">Module</th>
                                <th style="width: 25%">Exam Name</th>
                                <th style="width: 15%">Score (100%)</th>
                                <th style="width: 20%">Comment</th>
                                <th style="width: 17%">Module Average Score (100%)</th>
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
                                    <td colspan="6" class="text-center">No practical scores found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
