<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Enums\ContributionType;
use App\Enums\Status;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Donasi')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('user_id')
                                ->label('Donatur')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('contribution_type')
                                ->label('Tipe Kontribusi')
                                ->options(ContributionType::class)
                                ->required(),
                        ])->columnSpanFull(),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('amount')
                                ->label('Jumlah Donasi (Rp)')
                                ->numeric()
                                ->minValue(0)
                                ->prefix('Rp')
                                ->required(),
                            Select::make('status')
                                ->label('Status')
                                ->options(Status::class)
                                ->default(Status::Pending->value)
                                ->required(),
                        ])->columnSpanFull(),
                    Grid::make(2)
                        ->schema([
                            FileUpload::make('proof_path')
                                ->label('Bukti Transfer')
                                ->disk('public')
                                ->directory('donations/proof')
                                ->openable()
                                ->downloadable()
                                ->nullable(),
                        ])->columnSpanFull(),
                    Textarea::make('notes')
                        ->label('Catatan Internal')
                        ->rows(4)
                        ->columnSpanFull(),
                ])->columnSpanFull(),
        ]);
    }
}
