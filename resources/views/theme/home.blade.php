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

        @foreach ($dashboard_cards as $card)
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card-hover">

                    <?php $today = \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d'); ?>
                    <h4>Today's : {{ \Carbon\Carbon::parse($today)->format('l') }} {{ $today }}</h4><br />
                    <h2>Result </h2>

                </a>
            </div>
        @endforeach
    </div>
@endsection
