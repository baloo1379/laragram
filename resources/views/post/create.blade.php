@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-11 col-sm-8 container">
            <form class="card" method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <fieldset class="card-body">
                    <!-- File Button -->
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose photo</label>
                        </div>
                        @if ($errors->has('image'))
                            <div class="invalid-feedback d-inline">
                                @foreach($errors->get('image') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label" for="title">Description</label>
                        <div>
                            <input id="description" name="description" type="text" placeholder="placeholder"
                                   class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                   value="{{ old('description') }}" autocomplete="off">
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    @foreach($errors->get('description') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <button type="submit" id="send" name="send" class="btn btn-primary">Create post</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
@endsection
