<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Expense List</title>
    <style type="text/css">
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;
        }

        .header img {
            max-height: 100px;
            margin-right: 20px;
        }

        .header .title {
            flex: 1;
            text-align: left;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            color: #2c3e50;
            font-weight: bold;
        }

        .header h4 {
            font-size: 18px;
            margin: 5px 0;
            color: #34495e;
        }

        .header h5 {
            font-size: 16px;
            margin: 5px 0;
            color: #7f8c8d;
        }

        .table-container {
            margin-top: 30px;
            padding: 0 20px;
        }

        .table-bg {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
            text-align: center;
        }

        .table-bg th,
        .table-bg td {
            border: 1px solid #000;
            padding: 8px;
        }

        .table-bg th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        @media print {
            @page {
                margin: 5mm;
            }

            body {
                margin: 0;
            }

            .header img {
                max-height: 80px;
            }

            .table-bg th,
            .table-bg td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="title">
            <h1>Easy Dokan</h1>
            <h2>Manage Smarter, Grow Faster</h2>
            <h4>Expense List</h4>
        </div>
        <img src="../upload\dokanlogo.png" alt="Easy Dokan Logo">
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <table class="table-bg">
            <thead>
                <tr>
                    <th width='50' class="text-center">#</th>
                    <th>খরচের টাইটেল</th>
                    <th>খরচের তারিখ</th>
                    <th>খরচের পরিমান</th>
                    <th>নোট</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalExpense = 0;
                @endphp
                @foreach ($getRecord as $key => $value)
                    @php
                        $totalExpense += $value->amount;
                    @endphpp
                    <tr>
                        <td class="text-center">{{ $getRecord->firstItem() + $key }}</td>
                        <td>{{ $value->name }}</td>

                        <td>
                            @if (!empty($value->expense_date))
                                {{ date('d-m-Y', strtotime($value->expense_date)) }}
                            @else
                                No Data
                            @endif
                        </td>
                        <td>{{ number_format($value->amount, 2) }} টাকা</td>
                        <td>
                            @if (!empty($value->remarks))
                                {{ $value->remarks }}
                            @else
                                --No Data--
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: left;">টোটাল খরচ</th>
                    <th colspan="1" style="text-align: left;">
                        {{ number_format($totalExpense, 2) }} টাকা
                    </th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div style="text-align: center; font-size: 18px; margin-top: 20px;">
            <div style="float: right; width: 300px;">
                <p>_______________________</p>
                <p style="font-weight: bold;">Authorized Signature</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
