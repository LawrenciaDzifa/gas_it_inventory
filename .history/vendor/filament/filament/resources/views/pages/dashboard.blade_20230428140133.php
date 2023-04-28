<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"
        :rows="$this->getRows()"
    />
</x-filament::page>
