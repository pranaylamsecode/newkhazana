@extends('theme.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="col-md-12 form_page">
                <form action="{{ $form_action }}" class="" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row form_sec">
                                <div class="col-12">
                                    <h5>Panel Details</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Date</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            aria-describedby="nameHelp" value="{{ $current_date }}" readonly>
                                        <small id="nameHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        @php
                                            // Initialize an array with all days
                                            $allDays = [
                                                'monday' => '',
                                                'tuesday' => '',
                                                'wednesday' => '',
                                                'thursday' => '',
                                                'friday' => '',
                                                'saturday' => '',
                                            ];

                                            // Check if $all_data_for_date has any values
                                            if ($all_data_for_date && !$all_data_for_date->isEmpty()) {
                                                // Convert the model data to an array to access the attributes
                                                $dataArray = $all_data_for_date->toArray();

                                                // Assign the available days from the data
                                                $days = [
                                                    'monday' => $dataArray[0]['monday'] ?? '',
                                                    'tuesday' => $dataArray[0]['tuesday'] ?? '',
                                                    'wednesday' => $dataArray[0]['wednesday'] ?? '',
                                                    'thursday' => $dataArray[0]['thursday'] ?? '',
                                                    'friday' => $dataArray[0]['friday'] ?? '',
                                                    'saturday' => $dataArray[0]['saturday'] ?? '',
                                                ];

                                                // Filter out days that already have values
                                                $availableDays = array_filter($days, function ($value) {
                                                    return empty($value);
                                                });
                                            } else {
                                                // If no data, make all days available
                                                $availableDays = $allDays;
                                            }
                                        @endphp

                                        @if (count($availableDays) > 0)
                                            <select class="form-control" name="day">
                                                <option value="">Select Day</option>
                                                @foreach ($availableDays as $day => $value)
                                                    <option value="{{ $day }}">{{ ucfirst($day) }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p class="text-warning">All days are filled.</p>
                                        @endif

                                        <small id="domainHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tagline">Number </label>
                                        <input type="text" name="number" class="form-control" id="tagline"
                                            aria-describedby="taglineHelp">
                                        <small id="taglineHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />

                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary add_site">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
