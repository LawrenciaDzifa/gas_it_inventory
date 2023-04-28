<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"
        {{-- i want to display the number of records in requisition table, stockss table and assi --}}
    />

</x-filament::page>
