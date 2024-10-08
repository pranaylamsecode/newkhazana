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

        <div class="col-md-6 col-lg-3 center">
            <a href="#" class="card-hover">

                <?php
                $today = \Carbon\Carbon::now('Asia/Kolkata')->format('d/m/Y');
                $dayOfWeek = \Carbon\Carbon::now('Asia/Kolkata')->format('l');
                ?>
                <h4>Today's : {{ $dayOfWeek }} {{ $today }}</h4><br />

                <div class="row">
                    @foreach ($category_data as $categorie)

                    @php 
       /*  $jodi_data = Jodi::where('name', $current_date)->first();

        $panel_data  = Panel::where('name', $current_date)->first(); */

        @endphp
                        <div class="col-6 mb-2"> <!-- Use Bootstrap's grid system for 2 columns -->
                            <div class="jodi-info"
                                 style="padding: 10px; border: 1px solid #ddd;">
                                <h4>{{ ucwords($categorie->name) }}</h4>
                                <strong style="color: green;">Jodi</strong>
                                <h5>Number: {{ $jodi_data->number ?? 'N/A' }}</h5>
                                <!-- Add other fields you want to display from $jodi_data -->
                            </div>
                        </div>
                        <div class="col-6 mb-2"> <!-- Use Bootstrap's grid system for 2 columns -->
                            <div class="jodi-info"
                                 style="padding: 10px; border: 1px solid #ddd;">
                                <h4>{{ ucwords($categorie->name) }}</h4>
                                <strong style="color: red;">Panel</strong>
                                <h5>Number: {{ $jodi_data->number ?? 'N/A' }}</h5>
                                <!-- Add other fields you want to display from $jodi_data -->
                            </div>
                        </div> <br/>
                    @endforeach
                </div>
            </a>
        </div>
    </div>
@endsection
