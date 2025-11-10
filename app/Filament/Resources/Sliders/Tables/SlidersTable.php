<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Görsel')
                    ->disk('public')
                    ->size(80),
                
                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->getTranslation('title', 'tr') ?? $record->getTranslation('title', 'en') ?? '-'),
                
                TextColumn::make('description')
                    ->label('Açıklama')
                    ->limit(50)
                    ->getStateUsing(fn ($record) => $record->getTranslation('description', 'tr') ?? $record->getTranslation('description', 'en') ?? '-')
                    ->toggleable(),
                
                TextColumn::make('button_text')
                    ->label('Buton Yazısı')
                    ->getStateUsing(fn ($record) => $record->getTranslation('button_text', 'tr') ?? $record->getTranslation('button_text', 'en') ?? '-')
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                
                TextColumn::make('link')
                    ->label('Bağlantı')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                
                TextColumn::make('order')
                    ->label('Sıra')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                
                IconColumn::make('is_active')
                    ->label('Durum')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
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
            ->defaultSort('order', 'asc')
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
