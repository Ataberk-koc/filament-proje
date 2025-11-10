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
                    ->label(__('messages.category_name'))
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->size('lg')
                    ->weight('medium')
                    ->grow()
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $name = $record->getTranslation('name', $locale, false);
                        if (!$name) {
                            $name = $record->getTranslation('name', 'tr', false) ?: $record->getTranslation('name', 'en', false) ?: '-';
                        }
                        return $name;
                    }),
                
                
                TextColumn::make('slug')
                    ->label(__('messages.slug'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->grow()
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $slug = $record->getTranslation('slug', $locale, false);
                        if (!$slug) {
                            $slug = $record->getTranslation('slug', 'tr', false) ?: $record->getTranslation('slug', 'en', false) ?: '-';
                        }
                        return $slug;
                    }),
                                
                TextColumn::make('description')
                    ->label(__('messages.description'))
                    ->limit(100)
                    ->wrap()
                    ->grow()
                    ->toggleable()
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $description = $record->getTranslation('description', $locale, false);
                        if (!$description) {
                            $description = $record->getTranslation('description', 'tr', false) ?: $record->getTranslation('description', 'en', false) ?: '-';
                        }
                        return $description;
                    }),             
                TextColumn::make('created_at')
                    ->label(__('messages.created_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label(__('messages.updated_at'))
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
