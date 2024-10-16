@extends('theme.layouts.app')
@section('content')
    <div class="container">
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
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $form_action }}" class="" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row form_sec">
                                <div class="col-12">
                                    <h5>Basic Details</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="site_name">Name</label>
                                        <input type="text" name="site_name" class="form-control"
                                            value="{{ $settings['site_name']['value'] }}" id="site_name"
                                            aria-describedby="site_nameHelp">
                                        <small id="site_nameHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="site_url">URL</label>
                                        <input type="text" name="site_url" class="form-control"
                                            value="{{ $settings['site_url']['value'] }}" id="site_url"
                                            aria-describedby="site_urlHelp">
                                        <small id="site_urlHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control"
                                            value="{{ $settings['tagline']['value'] }}" id="tagline"
                                            aria-describedby="taglineHelp">
                                        <small id="taglineHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="front_title">Front Title</label>
                                        <input type="text" name="front_title" class="form-control"
                                            value="{{ $settings['front_title']['value'] ?? '' }}" id="front_title"
                                            aria-describedby="front_titleHelp">
                                        <small id="front_titleHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="front_image">Front Image</label>
                                        <input type="file" name="front_image" class="form-control" id="front_image"
                                            accept="image/*" aria-describedby="front_imageHelp">
                                        <small id="front_imageHelp" class="form-text text-muted">Please upload an image for
                                            the front.</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="front_color_background">Front Color Background</label>
                                        <input value="{{ $settings['front_color_background']['value'] ?? '' }}"
                                            type="color" name="front_color_background" class="form-control"
                                            id="front_color_background" aria-describedby="front_color_backgroundHelp">
                                        <small id="front_color_backgroundHelp" class="form-text text-muted">Please select a
                                            color for the front background.</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="front_color_card_header">Front Color Card Header</label>
                                        <input value="{{ $settings['front_color_card_header']['value'] ?? '' }}"
                                            type="color" name="front_color_card_header" class="form-control"
                                            id="front_color_card_header" aria-describedby="front_color_card_headerHelp">
                                        <small id="front_color_card_headerHelp" class="form-text text-muted">Please select a
                                            color for the front card Header.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary add_site">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
