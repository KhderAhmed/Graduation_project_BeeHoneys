<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\{Contact,Product,Client,Catgory};

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $number_of_clients=Client::count();
        $number_of_Contact=Contact::count();
        $number_of_Product=Product::count();
        $number_of_Catgory=Catgory::count();
        return [
            Stat::make(__("messages.The_Number_of_Clients"),$number_of_clients),
            Stat::make(__("messages.The_Number_of_Contact"),$number_of_Contact),
            Stat::make(__("messages.The_Number_of_Product"),$number_of_Product),
            Stat::make(__("messages.The_Number_of_Category"),$number_of_Catgory),

        ];
    }
}
