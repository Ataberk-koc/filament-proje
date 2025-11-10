<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;

class CustomLocaleSwitcher
{
    public static function make(): Action
    {
        return Action::make('locale_switcher')
            ->label(fn () => strtoupper(app()->getLocale()))
            ->button()
            ->size('sm')
            ->color('gray')
            ->icon('heroicon-o-language')
            ->url(fn () => null)
            ->openUrlInNewTab(false)
            ->action(function (): void {
            })
            ->extraAttributes([
                'x-data' => '{ currentLocale: "' . app()->getLocale() . '" }',
                'x-on:click' => 'let newLocale = currentLocale === "tr" ? "en" : "tr"; 
                    fetch("/admin/locale/switch", { 
                        method: "POST", 
                        headers: { 
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(\'meta[name="csrf-token"]\')?.getAttribute("content") || ""
                        }, 
                        body: JSON.stringify({ locale: newLocale }) 
                    }).then(() => { 
                        window.location.href = window.location.pathname; 
                    });'
            ]);
    }
}

