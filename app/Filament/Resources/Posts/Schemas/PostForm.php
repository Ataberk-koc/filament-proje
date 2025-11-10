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
                Section::make('Türkçe')
                    ->description('Türkçe içerik bilgileri')
                    ->schema([
                        TextInput::make('title.tr')
                            ->label('Başlık (TR)')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('slug.tr')
                            ->label('URL Slug (TR)')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('body.tr')
                            ->label('İçerik (TR)')
                            ->required()
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('English')
                    ->description('English content information')
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        
                        TextInput::make('slug.en')
                            ->label('URL Slug (EN)')
                            ->maxLength(255),
                        
                        Textarea::make('body.en')
                            ->label('Content (EN)')
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsed(),
                
                Section::make('Ayarlar')
                    ->description('Post ayarları ve ilişkiler')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Resim')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('posts')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(Category::all()->pluck('name', 'id')->map(function ($name, $id) {
                                $category = Category::find($id);
                                return $category->getTranslation('name', 'tr') ?? $category->getTranslation('name', 'en');
                            }))
                            ->required()
                            ->searchable()
                            ->preload(),
                        
                        Select::make('user_id')
                            ->label('Yazar')
                            ->options(User::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->default(fn () => auth()->id())
                            ->preload(),
                        
                        Select::make('status')
                            ->label('Durum')
                            ->options([
                                'draft' => 'Taslak',
                                'published' => 'Yayında',
                            ])
                            ->required()
                            ->default('draft'),
                    ])
                    ->columns(3),
            ]);
    }
}
