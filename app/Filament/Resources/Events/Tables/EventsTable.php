<?php

namespace App\Filament\Resources\Events\Tables;

use App\Enums\EventType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Livewire;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('type')
                    ->formatStateUsing(fn(?EventType $state) => $state ? ucfirst(strtolower($state->value)) : '-')
                    ->placeholder('-'),
                TextColumn::make('date')
                    ->placeholder('-')
                    ->date()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->placeholder('-')
                    ->time()
                    ->label('Start Time'),
                TextColumn::make('end_time')
                    ->placeholder('-')
                    ->time()       
                    ->label('End Time'),
                TextColumn::make('tags')
                    ->placeholder('-'),
            ])
            ->filters([
                //
                SelectFilter::make('type')
              
             
                ->options([
        'SCHEDULED' => 'Scheduled',
        'ANNUAL' => 'Annual',
    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
