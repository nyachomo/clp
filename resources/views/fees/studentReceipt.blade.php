<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Fees Records</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Amount Paid</th>
                <th>Date Paid</th>
                <th>Payment Method</th>
                <th>Payment Ref No</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $fee)
                <tr>
                    <td>{{ $fee->id }}</td>
                    <td>{{ $fee->user_id }}</td>
                    <td>{{ $fee->amount_paid }}</td>
                    <td>{{ $fee->date_paid }}</td>
                    <td>{{ $fee->payment_method }}</td>
                    <td>{{ $fee->payment_ref_no }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
