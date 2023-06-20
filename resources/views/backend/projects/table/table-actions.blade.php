<div class="btn-group btn-group-sm" role="group">
    @if ($project->trashed())
        <a href="{{ route('backend.projects.restore', ['project' => $project->id]) }}" class="btn dt-bt-restore" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.projects.buttons.restore') }}">
            <i class="fas fa-trash-restore text-success"></i>
        </a>
        <a href="{{ route('backend.projects.force-delete', ['project' => $project->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.projects.buttons.destroy') }}">
            <i class="fas fa-trash text-danger"></i>
        </a>
    @else
        <a href="{{ route('backend.projects.edit', ['project' => $project->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.projects.buttons.update') }}">
            <i class="fas fa-edit text-primary"></i>
        </a>
        <a href="{{ route('backend.projects.destroy', ['project' => $project->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.projects.buttons.destroy') }}">
            <i class="fas fa-trash text-warning"></i>
        </a>
    @endif
</div>
