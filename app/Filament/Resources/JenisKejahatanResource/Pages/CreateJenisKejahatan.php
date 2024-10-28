<?php

namespace App\Filament\Resources\JenisKejahatanResource\Pages;

use App\Filament\Resources\JenisKejahatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisKejahatan extends CreateRecord
{
    protected static string $resource = JenisKejahatanResource::class;

    protected static ?string $title = 'Create Type Crime';
}
