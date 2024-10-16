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
                                    <h5>Jodi Details</h5>
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
                                        <label for="name">Category</label>
                                        <select class="custom-select change_row_limit" name="category_id" required>
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        <small id="nameHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>




                                <div class="row p-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="left_number">Left Number</label>
                                            <input type="text" name="left_number" class="form-control" id="left_number"
                                                aria-describedby="taglineHelp">
                                            <small id="taglineHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="center_value">Center</label>
                                            <input type="text" name="" class="form-control" id="center_value"
                                                aria-describedby="taglineHelp" readonly>
                                            <small id="taglineHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="right_number">Right Number</label>
                                            <input type="text" name="right_number" class="form-control" id="right_number"
                                                aria-describedby="taglineHelp" disabled>
                                            <small id="taglineHelp" class="form-text text-muted"></small>
                                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leftNumberInput = document.getElementById('left_number');
            const rightNumberInput = document.getElementById('right_number');
            const centerValueInput = document.getElementById('center_value');

            function calculateAndUpdate() {
                // Get the input values
                const leftNumber = leftNumberInput.value;
                const rightNumber = rightNumberInput.value;

                // Initialize empty strings for sums
                let leftSum = '';
                let rightSum = '';

                // Calculate the sum of digits for the left number, only if it exists
                if (leftNumber) {
                    const sumLeft = leftNumber.split('').reduce((sum, digit) => sum + parseInt(digit), 0);
                    leftSum = sumLeft !== 0 ? sumLeft.toString() : ''; // Only add if sumLeft is not zero
                }

                // Calculate the sum of digits for the right number, only if it exists
                if (rightNumber) {
                    const sumRight = rightNumber.split('').reduce((sum, digit) => sum + parseInt(digit), 0);
                    rightSum = sumRight !== 0 ? sumRight.toString() : ''; // Only add if sumRight is not zero
                }

                // Combine non-zero sums into the center_value field
                centerValueInput.value = leftSum + rightSum;
            }

            // Enable right_number only when left_number has a value
            leftNumberInput.addEventListener('input', function() {
                if (leftNumberInput.value) {
                    rightNumberInput.disabled = false;
                } else {
                    rightNumberInput.disabled = true;
                    centerValueInput.value = ''; // Clear center value if left number is removed
                }
                calculateAndUpdate();
            });

            rightNumberInput.addEventListener('input', calculateAndUpdate);
        });
    </script>
@endsection
