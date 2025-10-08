<?php

namespace App\Filament\Resources\Alumnis\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlumniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('student_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone_number')
                    ->tel(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('profile_photo_path'),
                TextInput::make('competency'),
                TextInput::make('x'),
                TextInput::make('instagram'),
                TextInput::make('facebook'),
                TextInput::make('linkedin'),
            ]);
    }
}
