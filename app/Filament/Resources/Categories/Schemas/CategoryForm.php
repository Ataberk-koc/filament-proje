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
                Section::make('Türkçe')
                    ->description('Türkçe içerik bilgileri')
                    ->schema([
                        TextInput::make('name.tr')
                            ->label('Kategori Adı (TR)')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('slug.tr')
                            ->label('URL Slug (TR)')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('description.tr')
                            ->label('Açıklama (TR)')
                            ->maxLength(500),
                    ])
                    ->columns(3),
                
                Section::make('English')
                    ->description('English content information')
                    ->schema([
                        TextInput::make('name.en')
                            ->label('Category Name (EN)')
                            ->maxLength(255),
                        
                        TextInput::make('slug.en')
                            ->label('URL Slug (EN)')
                            ->maxLength(255),
                        
                        TextInput::make('description.en')
                            ->label('Description (EN)')
                            ->maxLength(500),
                    ])
                    ->columns(3)
                    ->collapsed(),
            ]);
    }
}

