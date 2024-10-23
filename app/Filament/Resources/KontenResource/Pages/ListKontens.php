<?php

namespace App\Filament\Resources\KontenResource\Pages;

use App\Filament\Resources\KontenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKontens extends ListRecords
{
    protected static string $resource = KontenResource::class;

    protected function getCreateButtonLabel(): string
    {
        return 'Add New Content'; // Ganti dengan teks yang Anda inginkan
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
