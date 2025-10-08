<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Enums\EventType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('events')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('category'),
                                Select::make('type')
                                    ->options(EventType::class)
                                    ->default('SCHEDULED')
                                    ->required(),
                                DatePicker::make('date'),
                                TextInput::make('time'),
                                TextInput::make('annual_date'),
                                TextInput::make('speaker_name'),
                                Textarea::make('description')
                                    ->columnSpanFull()
                            ])
                    ])->columnSpanFull(),
                Section::make('Event Access Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('accesses.type')
                                    ->label('Access Type')
                                    ->options([
                                        'physical' => 'Physical Location',
                                        'virtual' => 'Virtual Meeting',
                                        'hybrid' => 'Hybrid (Both)',
                                    ])
                                    ->required(),

                                TextInput::make('accesses.name')
                                    ->label('Location/Meeting Name')
                                    ->maxLength(255),

                                TextInput::make('accesses.address')
                                    ->label('Physical Address')
                                    ->maxLength(500),

                                TextInput::make('accesses.map_url')
                                    ->label('Map URL')
                                    ->url(),

                                TextInput::make('accesses.meeting_url')
                                    ->label('Meeting URL')
                                    ->url(),

                                TextInput::make('accesses.meeting_passcode')
                                    ->label('Meeting Passcode')
                                    ->maxLength(100),
                            ])
                            ->relationship('accesses')
                    ])->columnSpanFull()
            ]);
    }
}
