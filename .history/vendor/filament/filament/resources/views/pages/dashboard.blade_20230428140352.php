<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"
        {{-- i want to display the number of recors --}}
    />

</x-filament::page>
