<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"
]
        :beforeWidgets="$this->getBeforeWidgets()"
        :afterWidgets="$this->getAfterWidgets()"

    />
</x-filament::page>
