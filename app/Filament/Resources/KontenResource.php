<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Konten;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KontenResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KontenResource\RelationManagers;

class KontenResource extends Resource
{
    protected static ?string $model = Konten::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Konten');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('nama')
                ->label('Nama')
                ->schema([
                    TextInput::make('value')->label('Nama')
                    ->required()
                    ->maxLength(255),
                ])->columns(1)->columnSpan('full'),
                
                Repeater::make('peneliti')
                ->label('Peneliti')
                ->schema([
                    TextInput::make('value')->label('Nama Peneliti')
                    ->required()
                    ->maxLength(255),
                ])->columns(1)->columnSpan('full'),

                Select::make('jenis_kejahatan_id')
                ->label('Jenis Kejahatan')
                ->relationship('jenisKejahatan', 'nama_jenis')->required(),

                Forms\Components\DatePicker::make('tanggal_SPDP')->label('Tanggal SPDP'),
                Forms\Components\DatePicker::make('tanggal_P17')->label('Tanggal P-17'),
                Forms\Components\DatePicker::make('tanggal_tahap_I')->label('Tanggal Tahap I'),
                Forms\Components\DatePicker::make('tanggal_P18')->label('Tanggal P-18'),
                Forms\Components\DatePicker::make('tanggal_P19')->label('Tanggal P-19'),
                Forms\Components\DatePicker::make('tanggal_P20')->label('Tanggal P-20'),
                Forms\Components\DatePicker::make('tanggal_P21')->label('Tanggal P-21'),
                Forms\Components\DatePicker::make('tanggal_P21A')->label('Tanggal P-21A'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('nama')->label('Nama'),
                TextColumn::make('formattedNama')->label('Nama'),
                TextColumn::make('formattedPeneliti')->label('Peneliti'),
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
                TextColumn::make('jenisKejahatan.nama_jenis')->label('Jenis Kejahatan'),
                TextColumn::make('tanggal_SPDP')->label('Tanggal SPDP')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P17')->label('Tanggal P-17')
                    ->formatStateUsing(function ($state) {
                         // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_tahap_I')->label('Tanggal Tahap I')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P18')->label('Tanggal P-18')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P19')->label('Tanggal P-19')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P20')->label('Tanggal P-20')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P21')->label('Tanggal P-21')
                    ->formatStateUsing(function ($state) {
                        // Memastikan state tidak kosong
                        if (empty($state)) {
                            return 'Tidak ada tanggal';
                        }

                        // Konversi tanggal ke format "tanggal-bulan-tahun"
                        return Carbon::parse($state)->format('d-m-Y');
                    }),
                TextColumn::make('tanggal_P21A')->label('Tanggal P-21A')
                    ->formatStateUsing(function ($state) {
                        // Cek jika state kosong atau null
                        if (empty($state)) {
                            return 'Tanggal belum ditetapkan';
                        }

                        // Format tanggal ke 'tanggal-bulan-tahun'
                        return \Carbon\Carbon::parse($state)->format('d-m-Y');
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->date('d-m-Y'), // Format created_at
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
            'index' => Pages\ListKontens::route('/'),
            'create' => Pages\CreateKonten::route('/create'),
            'edit' => Pages\EditKonten::route('/{record}/edit'),
        ];
    }
}
