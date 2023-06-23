@extends('layouts.frontend')

@section('title', __('menu.frontend.projects.index'))

@section('content')
    @if ($projects->isEmpty())
        <div class="alert alert-secondary shadow-sm text-center text-danger mb-4 p-4" role="alert">
            {{ __('content.frontend.projects.emptyData') }}
        </div>
    @else
        <div class="row column-count">
            @foreach ($projects as $project)
                <div class="col-12">
                    <div class="card mb-4 shadow-sm d-flex flex-row flex-wrap">
                        @if ($project->imagePathWithTimestamp)
                            <a href="{{ route('frontend.projects.show', ['project' => $project->slug]) }}" target="_blank" class="card-link">
                                <img src="{{ asset($project->imagePathWithTimestamp) }}" class="card-img-top border-bottom" />
                            </a>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('frontend.projects.show', ['project' => $project->slug]) }}" target="_blank" class="card-link">{{ $project->name }}</a>
                            </h5>
                            <div class="card-text">{!! $project->short_description !!}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('scripts')
<script>
    $('.column-count').columnCount({
        lg: 3,
        md: 2
    });
</script>
@endsection
