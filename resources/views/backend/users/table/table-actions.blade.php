<div class="btn-group btn-group-sm" role="group">
    @can('manage_system')
        @if ($user->trashed())
            <a href="{{ route('backend.users.restore', ['user' => $user->id]) }}" class="btn dt-bt-restore" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.users.buttons.restore') }}">
                <i class="fas fa-trash-restore text-success"></i>
            </a>
            <a href="{{ route('backend.users.force-delete', ['user' => $user->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.users.buttons.destroy') }}">
                <i class="fas fa-trash text-danger"></i>
            </a>
        @else
            <a href="{{ route('backend.users.edit', ['user' => $user->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.users.buttons.update') }}">
                <i class="fas fa-edit text-primary"></i>
            </a>    
            @if (auth()->user()->id != $user->id)
                <a href="{{ route('backend.users.destroy', ['user' => $user->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.backend.users.buttons.destroy') }}">
                    <i class="fas fa-trash text-warning"></i>
                </a>
            @endif
        @endif
    @endcan
</div>
