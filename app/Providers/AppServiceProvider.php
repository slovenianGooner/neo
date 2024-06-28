<?php

namespace App\Providers;

use App\Blocks\OurTeamBlock;
use Filament\Support\Facades\FilamentView;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::global-search.after',
            hook: fn(): string => Blade::render('<livewire:language-switch key=\'fls-in-panels\' />')
        );

        TiptapEditor::configureUsing(function (TiptapEditor $component) {
            $component->blocks([
                OurTeamBlock::class
            ])->collapseBlocksPanel();
        });

        require_once app_path('Helpers.php');
    }
}
