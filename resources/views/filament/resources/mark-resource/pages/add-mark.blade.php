<x-filament::page>

    <form wire:submit.prevent="create">

        {{ $this->form }} <!-- This will render the form components defined in getFormSchema -->

        <div class="mt-4">
            <!-- The action will be handled by Filament, and you don't need to manually call it -->
            {{ $this->getActions()[0] }}  <!-- Render the first action button, which is create -->
        </div>

    </form>

</x-filament::page>
