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

        header {
            text-align: center;
            padding: 10px 0;
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
        }

        header h2 {
            margin: 0;
            padding: 5px 0;
            font-size: 22px;
            font-weight: normal;
        }

        h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            color: #2c3e50;
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
            page-break-inside: avoid;
        }

        .processed,
        .unprocessed {
            display: table-cell;
            width: 50%;
            padding: 0 10px;
            page-break-inside: avoid;
        }

        /* For printing A4 size and pagination */
        @media print {
            @page {
                size: A4;
                margin: 1in;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }

            .container {
                page-break-before: always;
            }

            .processed,
            .unprocessed {
                page-break-after: always;
            }

            th, td {
                border: 1px solid black;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <header>
        <h2>WEEKLY INVENTORY OF DV'S ON HAND</h2>
        <h2>FROM {{ \Carbon\Carbon::now()->subWeek()->format('F j, Y') }} TO {{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>
        <h2>ACCOUNTING SECTION</h2>
    </header>

    <h1>DV Inventory Report</h1>
    <div class="container">
        <div class="processed">
            <h3>Processed DVs on Hand</h3>
            <table>
                <thead>
                    <tr>
                        <th>Payee</th>
                        <th>No. of Processed DVs</th>
                        <th>Total Amount Processed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processedPayee as $data)
                        <tr>
                            <td>{{  $data->payee }}</td>
                            <td>{{ $data->total_processed_dvs ?? 0 }}</td>
                            <td>{{ number_format($data->total_processed_amount ?? 0, 2) }}</td> <!-- Fix here -->
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $processedPayee->sum('total_processed_dvs') ?? 0 }}</td>
                        <td>{{ number_format($processedPayee->sum('total_processed_amount') ?? 0, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="unprocessed">
            <h3>Unprocessed DVs on Hand</h3>
            <table>
                <thead>
                    <tr>
                        <th>Payee</th>
                        <th>No. of Unprocessed DVs</th>
                        <th>Total Amount Unprocessed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unprocessedPayee as $data)
                        <tr>
                            <td>{{  $data->payee }}</td>
                            <td>{{ $data->total_unprocessed_dvs ?? 0 }}</td>
                            <td>{{ number_format($data->total_unprocessed_amount , 2) }}</td> <!-- Fix here -->
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $unprocessedPayee->sum('total_unprocessed_dvs')}}</td>
                        <td>{{ number_format($unprocessedPayee->sum('total_unprocessed_amount'),2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
