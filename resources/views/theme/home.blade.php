@extends('theme.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        {{--  @foreach ($dashboard_cards as $card) --}}
        <div class="col-md-6 col-lg-3 center">
            <a href="#" class="card-hover">

                <?php
                $today = \Carbon\Carbon::now('Asia/Kolkata')->format('d/m/Y');
                $dayOfWeek = \Carbon\Carbon::now('Asia/Kolkata')->format('l');
                ?>
                <h4>Today's : {{ $dayOfWeek }} {{ $today }}</h4><br />




                @if ($jodi_data)
                    <div class="jodi-info"
                        style="display: inline-block; width: 48%; vertical-align: top; padding: 10px; border: 1px solid #ddd; margin-right: 2%;">
                        <h4>Jodi</h4>
                        <p>Number: {{ $jodi_data->number ?? 'N/A' }}</p>
                        <!-- Add other fields you want to display from $jodi_data -->
                    </div>
                @endif

                @if ($panel_data)
                    <div class="panel-info"
                        style="display: inline-block; width: 48%; vertical-align: top; padding: 10px; border: 1px solid #ddd;">
                        <h4>Panel</h4>
                        <p>Number: {{ $panel_data->number ?? 'N/A' }}</p>
                        <!-- Add other fields you want to display from $panel_data -->
                    </div>
                @endif





            </a>
        </div>
        {{-- @endforeach --}}
    </div>
@endsection
