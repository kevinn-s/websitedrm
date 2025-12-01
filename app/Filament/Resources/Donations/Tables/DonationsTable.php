<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Enums\ContributionType;
use App\Enums\Status;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Donatur')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contribution_type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        ContributionType::Monthly->value => 'Bulanan',
                        ContributionType::Yearly->value => 'Tahunan',
                        default => $state,
                    }),
                TextColumn::make('amount')
                    ->label('Nominal')
                    ->sortable()
                    ->formatStateUsing(fn ($state): string => 'Rp ' . number_format((float) $state, 0, ',', '.')),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?Status $state): ?string => $state?->getColor())
                    ->formatStateUsing(fn (?Status $state): ?string => $state?->getLabel())
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                IconColumn::make('proof_path')
                    ->label('Bukti')
                    ->boolean()
                    ->tooltip(fn ($state) => $state ? 'Bukti tersedia' : 'Belum ada bukti')
                    ->state(fn ($record): bool => ! empty($record->proof_path)),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Status::class),
                SelectFilter::make('contribution_type')
                    ->label('Jenis Kontribusi')
                    ->options(ContributionType::class),
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
