<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Category;
use App\Models\User;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('İçerik Bilgileri')
                    ->description('Post içerik bilgileri')
                    ->schema([
                        TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('excerpt')
                            ->label('Özet')
                            ->rows(3)
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->helperText('Kısa bir özet yazın (listelemelerde gösterilir)'),
                        
                        Textarea::make('body')
                            ->label('İçerik')
                            ->required()
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Ayarlar')
                    ->description('Post ayarları')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Resim')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->columnSpanFull(),
                        
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(function () {
                                return Category::all()->mapWithKeys(function ($category) {
                                    $name = $category->getTranslation('name', app()->getLocale()) 
                                        ?? $category->getTranslation('name', 'tr') 
                                        ?? $category->getTranslation('name', 'en')
                                        ?? 'Kategori #' . $category->id;
                                    return [$category->id => $name];
                                });
                            })
                            ->required()
                            ->searchable()
                            ->preload(),
                        
                        Select::make('user_id')
                            ->label('Yazar')
                            ->options(User::all()->pluck('name', 'id'))
                            ->required()
                            ->default(fn () => auth()->id()),
                        
                        Select::make('status')
                            ->label('Durum')
                            ->options(['draft' => 'Taslak', 'published' => 'Yayında'])
                            ->required()
                            ->default('draft'),
                    ])
                    ->columns(3),
            ]);
    }
}

