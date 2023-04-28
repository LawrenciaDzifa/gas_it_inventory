<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"
        {{-- i want to display the number of records in r --}}
    />

</x-filament::page>
