<form id="delete-restore-{{$id}}" method="POST" action="{{ $action ?? '#' }}">
    @csrf
    @if(!(isset($isDeleted) && $isDeleted))
    @method('delete')
    @endif
</form>

@if(isset($isDeleted) && $isDeleted)
<x-danger-button form="delete-restore-{{$id}}">
    {{ $restoreLabel ?? __('Restore')}}
</x-danger-button>
@else
<x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'yesno_delete{{$id}}')">
    {{ $deleteLabel ?? __('Delete')}}
</x-danger-button>
@endif

<x-modal name="yesno_delete{{$id}}" class="justify-center" focusable maxWidth="md">
    <div class="p-5 text-center">
        <h4 class="mb-5 text-center">{{ __('Are you sure you want to delete this record?') }}</h4>

        <x-primary-button class="mx-3" x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-primary-button>
        <x-primary-button class="mx-3" x-on:click="$dispatch('close')" form="delete-restore-{{$id}}">{{ __('Yes') }}</x-primary-button>
    </div>
</x-modal>