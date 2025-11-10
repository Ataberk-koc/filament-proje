<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kategori Bilgileri')
                    ->description('Kategori bilgileri')
                    ->schema([
                        TextInput::make('name')
                            ->label('Kategori Adı')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('description')
                            ->label('Açıklama')
                            ->maxLength(500),
                    ])
                    ->columns(3),
            ]);
    }
}

