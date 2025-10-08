<?php

namespace App\Filament\Pages;

use App\Models\OfficialAlumni as Official;

use BackedEnum;

use Filament\Actions\EditAction;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as StorageFacade;
class OfficialAlumni extends Page implements HasTable
{
    use InteractsWithTable;

     protected static ?string $model = Official::class;
    protected string $view = 'filament.pages.official-alumni';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Official::query())
            ->columns([
                TextColumn::make('graduation_batch')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('binusian_id')
                    ->searchable()
                    ->sortable()
                    ->copyable(), // Optional: allow copying
                TextColumn::make('student_id_1')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student_name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('legitimation_date')
                    ->date('M j, Y')
                    ->sortable(),
            ])
            ->filters([
                // Optional: Add filters for common searches
                Tables\Filters\SelectFilter::make('graduation_batch')
                    ->options(
                        Official::query()
                            ->select('graduation_batch')
                            ->distinct()
                            ->pluck('graduation_batch', 'graduation_batch')
                            ->toArray()
                    ),
                // Add more filters if needed
            ])
            ->actions([
                EditAction::make(),
           
            ]);
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('createAlumni')
                ->label('Add New Alumni')
                ->icon('heroicon-o-plus')
                ->form([
                    FileUpload::make('attachment')
                        ->disk('public')
                        ->directory('official-alumni-imports')
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->required(),
                ])
                ->action(function (array $data) {
                    $storedPath = $data['attachment'] ?? null;

                    if (! $storedPath || ! StorageFacade::disk('public')->exists($storedPath)) {
                        Notification::make()
                            ->title('Import failed')
                            ->body('File upload tidak ditemukan, silakan coba lagi.')
                            ->danger()
                            ->send();

                        return;
                    }

                    $absolutePath = StorageFacade::disk('public')->path($storedPath);

                    $worksheet = IOFactory::load($absolutePath)->getActiveSheet();

                    $headers = [];

                    if (
                        !(function () use ($worksheet, &$headers) {
                            $dhs = array_map('strtolower', [
                                'graduation batch',
                                'binusian id',
                                'student id 1',
                                'student name',
                                'legitimation date'
                            ]);
                            return (function () use ($dhs, $worksheet, &$headers) {
                                $headers = array_intersect(
                                    array_map(
                                        'strtolower',
                                        array_map('trim', $worksheet->rangeToArray('A2:' . $worksheet->getHighestColumn() . '2')[0])
                                    ),
                                    $dhs
                                );
                                return count($headers);
                            })() === count($dhs);
                        })()
                    ) {
                        $headers = [];
                        Notification::make()
                            ->title('Import Failed')
                            ->body('Header tabel tidak sesuai dengan yang diperlukan.')
                            ->danger()
                            ->send();
                        return;
                    }

                    try {
                        DB::transaction(function () use ($worksheet, $headers) {
                            foreach ($worksheet->getRowIterator(3) as $row) {
                                $rowIndex = $row->getRowIndex();

                                $officialAlumni = [];

                                foreach ($headers as $columnIndex => $excelHeader) {
                                    $modelAttribute = str_replace(' ', '_', $excelHeader);

                                    $officialAlumni[$modelAttribute] = $worksheet->getCell(Coordinate::stringFromColumnIndex($columnIndex + 1) . $rowIndex)->getValue();
                                }

                                Official::updateOrCreate(
                                    [
                                        'graduation_batch' => $officialAlumni['graduation_batch'],
                                        'binusian_id' => $officialAlumni['binusian_id'],
                                        'student_id_1' => $officialAlumni['student_id_1'],
                                        'student_name' => $officialAlumni['student_name'],
                                        'legitimation_date' => $officialAlumni['legitimation_date'],
                                    ],
                                    $officialAlumni
                                );
                            }
                        });

                        Notification::make()
                            ->title('Import berhasil')
                            ->body('Data official alumni berhasil diperbarui.')
                            ->success()
                            ->send();

                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Import failed')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }

                }),
        ];
    }
}
