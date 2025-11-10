<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Actions\Action;

class CreateSlider extends CreateRecord
{
    use Translatable;

    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('locale-switcher')
                ->view('filament.components.locale-switcher'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Slider başarıyla oluşturuldu';
    }
}
