<x-filament-panels::page>

    <form wire:submit.prevent="save">
        {{ $this->form }}

        <div style="margin-top: 10px;">
            <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />
        </div>
    </form>

</x-filament-panels::page>
