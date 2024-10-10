<!DOCTYPE html>
<html amp lang="en-in">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>JODI CHART RECORD SATTA MATKA</title>
    <meta name="description"
        content="KHAJANA CHART MATKA BAZAR CHART RECORD LIVE KHAJANA MATKA CHARTS RECORD WITH JODIES PANNA KHAJANA PATTI OLD MATKA RECORD MATKA JODI RECORD SATTA HISTORY" />
    <link rel="canonical" href="khajana.html" />
    <link rel="shortcut icon" href="../fav/favicon.ico" />

    <style amp-custom>
        body {
            background-color: #fc9;
            text-align: center;
            font-weight: 700;
            font-family: Helvetica, sans-serif;
           /*  margin: 0;
            padding: 0; */
        }

        .logo {
            padding: 10px;
            color: #fff;
            margin-bottom: 5px;
            font-weight: 700;
            border: 3px solid #ff0016;
            border-radius: 0.75em;
        }

        .button2 {
            background-color: #a0d5ff;
            color: #220c82;
            padding: 10px 30px;
            font-size: 14px;
            border: 2px solid #000;
            font-weight: 800;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .chart-list {
            border: 2px solid #eb008b;
            margin: 0 auto 10px;
            width: 50%;
            text-align: center;
            font-weight: 600;
        }

        .chart-list h4 {
            color: #fff;
            padding: 5px 10px;
            font-size: 24px;
            margin: 0;
        }

        .chart-list a {
            display: block;
            font-size: 22px;
            padding: 5px 7px;
            text-decoration: none;
        }

        footer {
            background-color: #fff;
            color: red;
            font-weight: bold;
            font-size: 25px;
            border: 4px groove purple;
            margin: 3px;
        }

        footer p {
            margin: 10px 0;
            line-height: 35px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div>
            <h1 class="chart-h1">{{ ucwords($categories->name) }}</h1>


            <div class="chart-result">
                <div>{{ ucwords($categories->name) }}</div>
                <span>{{ ucwords($categories->desc) }}</span><br />
                <a href="{{ url()->current() }}">Refresh Result</a>
            </div>

            <div id="top"></div>
            <a href="#bottom" class="button2"> Go to Bottom </a>
            <div class="panel panel-info">
                <div class="panel-heading text-center" style="background: #3f51b5">
                    <h2
                        style="
                                font-size: 22px;
                                color: #fff;
                                text-shadow: 0px 0px;
                            ">
                        KHAJANA JODI CHART
                    </h2>
                </div>
                <div class="panel-body">
                    <table style="width: 100%; text-align: center" class="panel-chart chart-table" cellpadding="2">
                        <thead>
                            <tr>
                                <th>Date (Week Range)</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $weeks = [];
                                // Group data by week
                                foreach ($all_data_jodies as $data) {
                                    $week = \Carbon\Carbon::parse($data->name)->weekOfYear;
                                    $weeks[$week][] = $data;
                                }
                            @endphp

                            @foreach ($weeks as $weekData)
                                @php
                                    // Get the start and end date of the week
                                    $firstDayOfWeek = \Carbon\Carbon::parse($weekData[0]->name)->startOfWeek();
                                    $lastDayOfWeek = $firstDayOfWeek->copy()->addDays(5); // Up to Saturday
                                    $weekRange = $firstDayOfWeek->format('M d') . ' - ' . $lastDayOfWeek->format('M d');
                                @endphp
                                <tr>
                                    <td class="chart-95">{{ $weekRange }}</td>
                                    @php
                                        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                                        $dayData = collect($weekData)->keyBy(function ($item) {
                                            return \Carbon\Carbon::parse($item->name)->format('D');
                                        });
                                    @endphp
                                    @foreach ($daysOfWeek as $day)
                                        <td class="chart-{{ $dayData->has($day) ? $dayData[$day]->number : '*' }}">
                                            {{ $dayData->has($day) ? $dayData[$day]->number : '*' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>




                    </table>
                </div>
            </div>
        </div>
        <div class="clear">&nbsp;</div>
    </div>
</body>

</html>
