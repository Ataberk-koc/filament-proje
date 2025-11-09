<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Forms;
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTranslatable\TextInput as TranslatableTextInput; 
use Filament\Forms\Components\SpatieTranslatable\RichEditor as TranslatableRichEditor; 
use Filament\Tables\Columns\SpatieTranslatable\TextColumn as TranslatableTextColumn;
use Filament\Tables;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $recordTitleAttribute = null;
    
    public static function getRecordTitle($record): string
    {
        return $record->getTranslation('title', app()->getLocale()) ?? 
               $record->getTranslation('title', 'tr') ?? 
               'Post #' . $record->id;
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
