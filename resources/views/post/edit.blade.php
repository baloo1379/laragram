@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-11 col-sm-8 container">
            <form class="card" method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <fieldset class="card-body">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label" for="title">Title</label>
                        <div>
                            <input id="title" name="title" type="text" placeholder="placeholder"
                                   class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                   value="{{ old('title') ?? $profile->title }}" autocomplete="off">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    @foreach($errors->get('title') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label" for="website">Website</label>
                        <div class="">
                            <input id="website" name="website" type="text" placeholder="http://example.com"
                                   class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                   value="{{ old('website') ?? $profile->website }}" autocomplete="off">
                            @if ($errors->has('website'))
                                <div class="invalid-feedback">
                                    @foreach($errors->get('website') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label" for="biogram">Biogram</label>
                        <div class="">
                            <input id="biogram" name="biogram" type="text" placeholder=""
                                   class="form-control {{ $errors->has('biogram') ? 'is-invalid' : '' }}"
                                   value="{{ old('biogram') ?? $profile->biogram }}" autocomplete="off">
                            @if ($errors->has('biogram'))
                                <div class="invalid-feedback">
                                    @foreach($errors->get('biogram') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose new profile photo</label>
                        </div>
                        @if ($errors->has('image'))
                            <div class="invalid-feedback d-inline">
                                @foreach($errors->get('image') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <button type="submit" id="send" name="send" class="btn btn-primary">Update profile</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
@endsection
