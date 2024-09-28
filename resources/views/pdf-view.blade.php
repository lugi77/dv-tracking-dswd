<!DOCTYPE html>
<html>

<head>
    <title>Processed and Unprocessed DVs</title>
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            text-align: center; /* Centering the heading */
            font-size: 24px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .total-row {
            font-weight: bold;
            background-color: #ecf0f1;
        }

        .container {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .processed,
        .unprocessed {
            display: table-cell;
            width: 50%;
            padding: 0 10px;
        }
    </style>
</head>

<body>
    <h1>Processed and Unprocessed DVs</h1>
    <div class="container">
        <div class="processed">
            <h3>Processed DVs on Hand</h3>
            <table>
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>No. of Processed DVs</th>
                        <th>Total Amount Processed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processedPrograms as $processed)
                        <tr>
                            <td>{{ $processed->program }}</td>
                            <td>{{ $processed->total_processed_dvs ?? 0 }}</td>
                            <td>{{ number_format($processed->total_processed_amount, 2) ?? 0.00 }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $processedPrograms->sum('total_processed_dvs') ?? 0 }}</td>
                        <td>{{ number_format($processedPrograms->sum('total_processed_amount'), 2) ?? 0.00 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="unprocessed">
            <h3>Unprocessed DVs on Hand</h3>
            <table>
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>No. of Unprocessed DVs</th>
                        <th>Total Amount Unprocessed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unprocessedPrograms as $unprocessed)
                        <tr>
                            <td>{{ $unprocessed->program }}</td>
                            <td>{{ $unprocessed->total_unprocessed_dvs ?? 0 }}</td>
                            <td>{{ number_format($unprocessed->total_unprocessed_amount, 2) ?? 0.00 }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $unprocessedPrograms->sum('total_unprocessed_dvs') ?? 0 }}</td>
                        <td>{{ number_format($unprocessedPrograms->sum('total_unprocessed_amount'), 2) ?? 0.00 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
