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
                    ->label(__('messages.image'))
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->toggleable(),
                
                TextColumn::make('title')
                    ->label(__('messages.title'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('slug')
                    ->label(__('messages.slug'))
                    ->searchable()
                     ->sortable()
                    ->badge()
                    ->color('info'),
                    
                
                TextColumn::make('category.name')
                    ->label(__('messages.category'))
                    ->sortable()
                    ->searchable(),
                   
                
                TextColumn::make('category_id')
                    ->label(__('messages.category_id'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('user.name')
                    ->label(__('messages.author'))
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('status')
                    ->label(__('messages.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => __('messages.published'),
                        'draft' => __('messages.draft'),
                        default => $state,
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
