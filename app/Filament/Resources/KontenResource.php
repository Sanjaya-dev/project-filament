<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Konten;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\KontenResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KontenResource\RelationManagers;

class KontenResource extends Resource
{
    protected static ?string $model = Konten::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationLabel(): string
    {
        return 'Content';
    }


    public static function getBreadcrumb(): string
    {
        return 'Content'; // Mengubah teks breadcrumb
    }

    public static function getPluralModelLabel(): string
    {
        return 'Content List';
    }
    
    // protected static string $slug = 'content';
    protected static ?string $slug = 'content';

    protected function getTableQuery()
    {
        return Konten::query(); // Sesuaikan dengan model Anda
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('nama')
                ->label('Suspect')
                ->createItemButtonLabel('Add New Name')
                ->schema([
                    TextInput::make('value')->label('Name')
                    ->required()
                    ->maxLength(255),
                ])->columns(1)->columnSpan('full'),
                
                Repeater::make('peneliti')
                ->label('Investigators')
                ->createItemButtonLabel('Add New Investigator')
                ->schema([
                    TextInput::make('value')->label('Investigator')
                    ->required()
                    ->maxLength(255),
                ])->columns(1)->columnSpan('full'),

                Select::make('jenis_kejahatan_id')
                ->label('Type Of Crime')
                ->relationship('jenisKejahatan', 'nama_jenis')->required(),

                Forms\Components\DatePicker::make('tanggal_SPDP')->label('Date SPDP'),
                Forms\Components\DatePicker::make('tanggal_P17')->label('Date P-17'),
                Forms\Components\DatePicker::make('tanggal_tahap_I')->label('Date Tahap I'),
                Forms\Components\DatePicker::make('tanggal_P18')->label('Date P-18'),
                Forms\Components\DatePicker::make('tanggal_P19')->label('Date P-19'),
                Forms\Components\DatePicker::make('tanggal_P20')->label('Date P-20'),
                Forms\Components\DatePicker::make('tanggal_P21')->label('Date P-21'),
                Forms\Components\DatePicker::make('tanggal_P21A')->label('Date P-21A'),

                Select::make('status')
                ->label('Status')
                ->options([
                    'pra-penuntutan' => 'Pra-Penuntutan',
                    'penuntutan' => 'Penuntutan',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                // TextColumn::make('nama')
                // ->sortable()
                // ->searchable(),
                // TextColumn::make('nama')->label('Nama'),
                TextColumn::make('formattedNama')->label('Name'),
                TextColumn::make('formattedPeneliti')->label('Investigator'),
                // TextColumn::make('peneliti')->label('Peneliti')->formatStateUsing(function ($state) {
                //     // Cek jika $state tidak null dan berbentuk string JSON
                //     if ($state && is_string($state)) {
                //         $decoded = json_decode($state, true);
                //         if (is_array($decoded)) {
                //             // Mengambil nilai 'value' dari setiap elemen
                //             return collect($decoded)->pluck('value')->implode(', ');
                //         }
                //     }
                //     return $state;
                // }),
                TextColumn::make('jenisKejahatan.nama_jenis')->label('Type Of Crime'),
                TextColumn::make('tanggal_SPDP')->label('Date SPDP')
                    ->getStateUsing(function ($record) {
                    // Periksa apakah 'tanggal_SPDP' ada
                    return $record->tanggal_SPDP 
                        ? Carbon::parse($record->tanggal_SPDP)->format('d-m-Y') 
                        : '-';
                    }),
                TextColumn::make('tanggal_P17')->label('Date P-17')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P17' ada
                        return $record->tanggal_P17 
                            ? Carbon::parse($record->tanggal_P17)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_tahap_I')->label('Date Tahap I')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_tahap_I' ada
                        return $record->tanggal_tahap_I 
                            ? Carbon::parse($record->tanggal_tahap_I)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_P18')->label('Date P-18')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P18' ada 
                        return $record->tanggal_P18 
                            ? Carbon::parse($record->tanggal_P18)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_P19')->label('Date P-19')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P19' ada
                        return $record->tanggal_P19 
                            ? Carbon::parse($record->tanggal_P19)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_P20')->label('Date P-20')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P20' ada 
                        return $record->tanggal_P20 
                            ? Carbon::parse($record->tanggal_P20)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_P21')->label('Date P-21')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P21' ada
                        return $record->tanggal_P21 
                            ? Carbon::parse($record->tanggal_P21)->format('d-m-Y') 
                            : '-';
                    }),
                TextColumn::make('tanggal_P21A')->label('Date P-21A')
                    ->getStateUsing(function ($record) {
                        // Periksa apakah 'tanggal_P21A' ada
                        return $record->tanggal_P21A    
                            ? Carbon::parse($record->tanggal_P21A)->format('d-m-Y') 
                            : '-';
                    }),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Date Created')
                //     ->date('d-m-Y'), // Format created_at
                TextColumn::make('status')->label('Status'),
            ])
            
            ->filters([
                // Filter::make('pra-penuntutan')
                // ->query(fn (Builder $query): Builder => $query->where('status', 'pra-penuntutan')),
                // Filter::make('penuntutan')
                // ->query(fn (Builder $query): Builder => $query->where('status', 'penuntutan')),
                Filter::make('Search by Name')
                ->form([
                    Forms\Components\TextInput::make('search')
                        ->label('Search Name')
                        ->placeholder('Enter name...'),
                ])
                ->query(function ($query, $data) {
                    if (!empty($data['search'])) {
                        $searchTerm = '%' . $data['search'] . '%';

                        // Menggunakan JSON_UNQUOTE dan JSON_EXTRACT untuk LIKE di kolom JSON
                        $query->whereRaw(
                            "JSON_UNQUOTE(JSON_EXTRACT(nama, '$[*].value')) LIKE ?",
                            [$searchTerm]
                        );
                    }
                })
                ->label('Custom Search'),
                // Filter::make('Search Formatted Name')
                //     ->query(function (Builder $query, $searchTerm) {
                //         $query->searchByFormattedNama($searchTerm);
                //     })
                //     ->label('Search by Formatted Name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }

    // protected function getTableFilters(): array
    // {
    //     return [
    //         Filter::make('Search by Name')
    //             ->form([
    //                 Forms\Components\TextInput::make('search')
    //                     ->label('Search Name')
    //                     ->placeholder('Enter name...'),
    //             ])
    //             ->query(function ($query, $data) {
    //                 if ($data['search']) {
    //                     $query->whereRaw('JSON_CONTAINS(nama, ?)', [json_encode(['value' => $data['search']])]);
    //                 }
    //             })
    //             ->label('Custom Search'),
    //     ];
    // }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKontens::route('/'),
            'create' => Pages\CreateKonten::route('/create'),
            'edit' => Pages\EditKonten::route('/{record}/edit'),
        ];
    }
}
