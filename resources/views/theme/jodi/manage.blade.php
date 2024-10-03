@extends('theme.layouts.app')
@section('content')
    <div class="container-fluid px-5">
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
                    @if ($edit)
                        <input type="hidden" value="{{ $data->id }}" name="id">
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="row form_sec">
                                <div class="col-12">
                                    <h5>Basic Details</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Date</label>
                                        <input type="date" name="name" class="form-control" id="name"
                                            aria-describedby="nameHelp">
                                        <small id="nameHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="day">
                                            <option value="">Select Role</option>

                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>

                                            <option value="thursday">
                                                Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>


                                        </select>
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
                                @if ($edit)
                                    Update Changes
                                @else
                                    Add
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
