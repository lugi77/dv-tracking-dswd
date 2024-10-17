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
            text-align: center;
            /* Centering the heading */
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
            page-break-inside: avoid;
            /* Avoid page breaks within the container */
        }

        .processed,
        .unprocessed {
            display: table-cell;
            width: 50%;
            padding: 0 10px;
            page-break-inside: avoid;
        }

        /* For printing legal size and pagination */
        @media print {
            @page {
                size: legal;
                margin: 1in;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                /* Ensure colors print correctly */
            }

            .container {
                page-break-before: always;
                /* Insert page break before each section */
            }

            .processed,
            .unprocessed {
                page-break-after: always;
                /* Ensure sections don't split over pages */
            }

            /* Optional: hide borders in print to reduce clutter */
            th,
            td {
                border: 1px solid black;
            }

            /* Ensuring each table fits within its own page */
            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
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
                        <!-- Fix here -->
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
                        <!-- Fix here -->
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</body>

</html>