<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets
        :widgets="$this->getWidgets()"
        :columns="$this->getColumns()"

    />
        {{-- i want to display the number of records in requisition table, stockss table and assignment table is three cards --}}

    <x-filament::card class="flex flex-col items-center justify-center">
        <x-filament::card.header>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ __('Requisitions') }}
            </h2>
        </x-filament::card.header>

        <x-filament::card.body>
            <div class="flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full">
                <span class="text-3xl font-bold text-gray-900">{{ $requisitions }}</span>
            </div>
        </x-filament::card.body>
    </x-filament::card>
    <x-filament::card class="flex flex-col items-center justify-center">
        <x-filament::card.header>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ __('Stocks') }}
            </h2>
        </x-filament::card.header>

        <x-filament::card.body>
            <div class="flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full">
                <span class="text-3xl font-bold text-gray-900">{{ $stocks }}</span>
            </div>
        </x-filament::card.body>
    </x-filament::card>

    <x-filament::card class="flex flex-col items-center justify-center">
        <x-filament::card.header>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ __('Assignments') }}
            </h2>
        </x-filament::card.header>

        <x-filament::card.body>
            <div class="flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full">
                <span class="text-3xl font-bold text-gray-900">{{ $assignments }}</span>
            </div>
        </x-filament::card.body>
    </x-filament::card>


</x-filament::page>
