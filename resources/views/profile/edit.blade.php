@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 container">
                <form class="card" method="post" action="{{ route('profile.update', $profile) }}"
                      enctype="multipart/form-data" id="editProfileForm">
                    @csrf
                    @method('PATCH')
                    <fieldset class="card-body">
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

                        <div class="form-group">
                            <label class="control-label" for="textarea">Biogram</label>
                            <div>
                                <textarea class="form-control {{ $errors->has('biogram') ? 'is-invalid' : '' }}"
                                          id="biogram"
                                          name="biogram">{{ old('biogram') ?? $profile->biogram }}</textarea>
                                @if ($errors->has('biogram'))
                                    <div class="invalid-feedback d-inline">
                                        @foreach($errors->get('biogram') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-start align-items-center">
                            <div class="mr-3">
                                <img src="{{ $profile->getImage() }}" id="avatar" alt="Profile image" class="w-100 rounded-circle border" style="max-width: 100px;">
                            </div>

                            @if($profile->image !== null)
                                <input type="hidden" name="removeImage" id="removeImage">
                                <div>
                                    <button type="button" class="btn" onclick="document.getElementById('removeImage').value = 1;document.getElementById('editProfileForm').submit();">Delete photo</button>
                                </div>
                            @endif

                            <div class="w-100">
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
                        </div>

                        <div class="form-group">
                            <button type="submit" id="send" name="send" class="btn btn-primary">Update profile</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
