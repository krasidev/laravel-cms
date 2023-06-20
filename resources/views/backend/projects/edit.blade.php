@extends('layouts.backend')

@section('title', __('menu.backend.projects.text') . ' - ' . __('menu.backend.projects.edit'))

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('menu.backend.projects.edit') }}</div>

    <div class="card-body">
        <form action="{{ route('backend.projects.update', ['project' => $project->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('content.backend.projects.labels.name') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="name" value="{{ old('name', $project->name) }}" id="name" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="slug">{{ __('content.backend.projects.labels.slug') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" id="slug" class="form-control @error('slug') is-invalid @enderror">

                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="url">{{ __('content.backend.projects.labels.url') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="url" value="{{ old('url', $project->url) }}" id="url" class="form-control @error('url') is-invalid @enderror">

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="image">{{ __('content.backend.projects.labels.image') }}:</label>

                        <label class="form-control h-auto text-center p-4 form-control @error('image') is-invalid @enderror">
                            <input type="file" name="image" id="image" class="d-none">

                            <img src="{{ $project->imagePathWithTimestamp }}" class="mw-100" alt="{{ __('content.choose-file') }}">
                        </label>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="short_description">{{ __('content.backend.projects.labels.short_description') }}: <span class="text-danger">*</span></label>

                        <textarea name="short_description" id="short_description" class="projects-tinymce form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $project->short_description) }}</textarea>

                        @error('short_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="description">{{ __('content.backend.projects.labels.description') }}: <span class="text-danger">*</span></label>

                        <textarea name="description" id="description" class="projects-tinymce form-control @error('short_description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="dropdown-divider mt-0 mb-3">

            <button type="submit" class="btn btn-primary">{{ __('content.backend.projects.buttons.update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    tinymce.init({
        selector: '.projects-tinymce'
    });
</script>
@endsection
