<?php

namespace App\Filament\Resources\JenisKejahatanResource\Pages;

use App\Filament\Resources\JenisKejahatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisKejahatans extends ListRecords
{
    protected static string $resource = JenisKejahatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
