<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JenisKejahatan;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JenisKejahatanResource\Pages;
use App\Filament\Resources\JenisKejahatanResource\RelationManagers;

class JenisKejahatanResource extends Resource
{
    protected static ?string $model = JenisKejahatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     public static function getNavigationLabel(): string
    {
        return 'Type Of Crime';
    }

     public static function getBreadcrumb(): string
    {
        return 'Type Of Crime'; // Mengubah teks breadcrumb
    }

    public static function getPluralModelLabel(): string
    {
        return 'list of crimes';
    }
    
    // protected static string $slug = 'content';
    protected static ?string $slug = 'type-of-crime';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_jenis')
                ->label('Crime type names')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_jenis')
                ->label('Crime name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisKejahatans::route('/'),
            'create' => Pages\CreateJenisKejahatan::route('/create'),
            'edit' => Pages\EditJenisKejahatan::route('/{record}/edit'),
        ];
    }
}
