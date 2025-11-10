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
                Section::make('İçerik')
                    ->description('Slider içerik bilgileri')
                    ->schema([
                        TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('description')
                            ->label('Açıklama')
                            ->rows(3),
                        
                        TextInput::make('button_text')
                            ->label('Buton Yazısı')
                            ->maxLength(100)
                            ->placeholder('Daha Fazla Bilgi'),
                    ])
                    ->columns(2),
                
                Section::make('Görsel ve Ayarlar')
                    ->description('Slider görseli ve diğer ayarlar')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Görsel')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('sliders')
                            ->visibility('public')
                            ->required()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        
                        TextInput::make('link')
                            ->label('Bağlantı (URL)')
                            ->url()
                            ->placeholder('https://example.com'),
                        
                        TextInput::make('button_link')
                            ->label('Buton Bağlantısı (URL)')
                            ->url()
                            ->placeholder('https://example.com/page'),
                        
                        TextInput::make('order')
                            ->label('Sıralama')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Küçük değer önce gösterilir'),
                        
                        TextInput::make('autoplay_delay')
                            ->label('Otomatik Değişim Süresi (ms)')
                            ->numeric()
                            ->default(5000)
                            ->required()
                            ->suffix('ms')
                            ->helperText('1000 = 1 saniye'),
                        
                        Toggle::make('show_navigation')
                            ->label('İleri/Geri Butonları')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Sağ/Sol ok butonlarını göster'),
                        
                        Toggle::make('show_pagination')
                            ->label('Sayfa Noktaları')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Alt kısımda nokta göstergelerini göster'),
                        
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}
