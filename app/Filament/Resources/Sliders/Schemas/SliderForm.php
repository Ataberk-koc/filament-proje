<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('messages.slider_content'))
                    ->description(__('messages.slider_content_description'))
                    ->schema([
                        TextInput::make('title')
                            ->label(__('messages.slider_title'))
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('button_text')
                            ->label(__('messages.slider_button_text'))
                            ->maxLength(100)
                            ->placeholder(__('messages.slider_button_text_placeholder')),
                        
                        Textarea::make('description')
                            ->label(__('messages.slider_description'))
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make(__('messages.slider_settings'))
                    ->description(__('messages.slider_settings_description'))
                    ->schema([
                        FileUpload::make('image')
                            ->label(__('messages.slider_image'))
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('sliders')
                            ->visibility('public')
                            ->imagePreviewHeight('250')
                            ->required()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        
                        TextInput::make('link')
                            ->label(__('messages.slider_link'))
                            ->url()
                            ->placeholder(__('messages.slider_link_placeholder')),
                        
                        TextInput::make('button_link')
                            ->label(__('messages.slider_button_link'))
                            ->url()
                            ->placeholder(__('messages.slider_button_link_placeholder')),
                        
                        TextInput::make('order')
                            ->label(__('messages.slider_order'))
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText(__('messages.slider_order_helper')),
                        
                        TextInput::make('autoplay_delay')
                            ->label(__('messages.slider_autoplay_delay'))
                            ->numeric()
                            ->default(5000)
                            ->required()
                            ->suffix('ms')
                            ->helperText(__('messages.slider_autoplay_helper')),
                        
                        Toggle::make('show_navigation')
                            ->label(__('messages.slider_show_navigation'))
                            ->default(true)
                            ->inline(false)
                            ->helperText(__('messages.slider_show_navigation_helper')),
                        
                        Toggle::make('show_pagination')
                            ->label(__('messages.slider_show_pagination'))
                            ->default(true)
                            ->inline(false)
                            ->helperText(__('messages.slider_show_pagination_helper')),
                        
                        Toggle::make('is_active')
                            ->label(__('messages.slider_is_active'))
                            ->default(true)
                            ->inline(false)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}
