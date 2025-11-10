<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Kategori Adı')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->size('lg')
                    ->weight('medium')
                    ->grow()
                    ->getStateUsing(fn ($record) => $record->getTranslation('name', 'tr') ?? $record->getTranslation('name', 'en') ?? '-'),
                
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->grow()
                    ->getStateUsing(fn ($record) => $record->getTranslation('slug', 'tr') ?? $record->getTranslation('slug', 'en') ?? '-'),
                
                TextColumn::make('description')
                    ->label('Açıklama')
                    ->limit(100)
                    ->wrap()
                    ->grow()
                    ->toggleable()
                    ->getStateUsing(fn ($record) => $record->getTranslation('description', 'tr') ?? $record->getTranslation('description', 'en') ?? '-'),
                
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
