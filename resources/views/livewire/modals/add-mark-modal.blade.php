<x-filament::modal id="add-mark" width="md">
    <x-slot name="heading">
        Add Mark
    </x-slot>

    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Save
        </x-filament::button>
    </form>
</x-filament::modal>