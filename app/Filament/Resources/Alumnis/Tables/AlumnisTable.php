<?php

namespace App\Filament\Resources\Alumnis\Tables;

use App\Enums\Status;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlumnisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label("Id")
                    ->numeric()
                    ->sortable(),
                TextColumn::make('student_id')
                    ->label("NIM")
                    ->searchable(),
                TextColumn::make('name')
                ->label("Nama")
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('user.status')
                    ->label('Status')
    ->badge() // optional: makes it a colored badge
    ->color(fn (?Status $state): ?string => $state?->getColor())
    ->formatStateUsing(fn (?Status $state): ?string => $state?->getLabel())
    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                //
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
