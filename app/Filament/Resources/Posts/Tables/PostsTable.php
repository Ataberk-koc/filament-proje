<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Resim')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->toggleable(),
                
                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->getTranslation('title', 'tr') ?? $record->getTranslation('title', 'en') ?? '-'),
                
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->getStateUsing(fn ($record) => $record->getTranslation('slug', 'tr') ?? $record->getTranslation('slug', 'en') ?? '-'),
                
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn ($record) => $record->category ? ($record->category->getTranslation('name', 'tr') ?? $record->category->getTranslation('name', 'en')) : '-'),
                
                TextColumn::make('category_id')
                    ->label('Kategori ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('user.name')
                    ->label('Yazar')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Yayında',
                        'draft' => 'Taslak',
                        default => $state,
                    }),
                
                TextColumn::make('created_at')
                    ->label('Oluşturma Tarihi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Güncelleme Tarihi')
                    ->dateTime('d/m/Y H:i')
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
                Action::make('go_back')
                    ->label(__('messages.go_back'))
                    ->color('gray')
                    ->size('sm')
                    ->url(fn (): string => url()->previous())
                    ->button(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
