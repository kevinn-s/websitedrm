<?php

namespace App\Filament\Resources\Alumnis\Tables;

use App\Enums\Status;
use App\Models\OfficialAlumni;
use Filament\Notifications\Notification;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
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
                IconColumn::make('alumni_registered')
                    ->label('Alumni Terdaftar')
                    ->boolean()
                    ->tooltip(fn ($state) => $state ? 'NIM ditemukan pada data resmi' : 'NIM belum terdaftar resmi')
                    ->state(fn ($record): bool => $record?->student_id
                        ? OfficialAlumni::where('student_id_1', $record->student_id)->exists()
                        : false),
                TextColumn::make('user.status')
                    ->label('Status')
                    ->badge()
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
                EditAction::make()->label("Action"),
                \Filament\Actions\Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->user && ($record->user->status instanceof Status
                        ? ! $record->user->status->isVerified()
                        : $record->user->status !== Status::Verified->value))
                    ->action(function ($record) {
                        if (! $record->user) {
                            Notification::make()
                                ->title('Gagal verifikasi')
                                ->body('Pengguna belum terhubung dengan data alumni.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $record->user->update(['status' => Status::Verified]);

                        $alumni = $record->user->alumni;

                        if ($alumni) {
                            $officialAlumniRecord = OfficialAlumni::where('student_id_1', $alumni->student_id)->first();

                            if ($officialAlumniRecord) {
                                $batchDigits = preg_replace('/\D/', '', (string) $officialAlumniRecord->graduation_batch);

                                $educationPayload = array_filter([
                                    'graduation_batch' => $batchDigits !== '' ? (int) $batchDigits : null,
                                    'legitimation_date' => $officialAlumniRecord->legitimation_date?->toDateString(),
                                ], fn ($value) => filled($value));

                                if (! empty($educationPayload)) {
                                    $alumni->education()->updateOrCreate([], $educationPayload);
                                }
                            }
                        }

                        Notification::make()
                            ->title('Berhasil diverifikasi')
                            ->body('Status pengguna telah diperbarui menjadi VERIFIED.')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
