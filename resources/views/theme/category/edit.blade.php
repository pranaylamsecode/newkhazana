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
                                    <h5>Category Details</h5>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{ $categories->id }}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ $categories->name }}" type="text" name="name"
                                            class="form-control" id="name" aria-describedby="nameHelp" required>
                                        <small id="nameHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discription">Description</label>
                                        <input value="{{ $categories->desc }}" type="text" name="desc"
                                            class="form-control" id="discription" aria-describedby="discriptionHelp"
                                            required>
                                        <small id="discriptionHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <input value="{{ $categories->start_time }}" type="time" name="start_time"
                                            class="form-control" id="start_time" aria-describedby="start_timeHelp" required>
                                        <small id="start_timeHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_time">End Time</label>
                                        <input type="time" value="{{ $categories->end_time }}" name="end_time"
                                            class="form-control" id="end_time" aria-describedby="end_timeHelp" required>
                                        <small id="end_timeHelp" class="form-text text-muted"></small>
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
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
