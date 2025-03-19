<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot() 
    {
        Filament::serving(function () {
            Filament::registerRenderHook('sidebar.start', function () {
                return "<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let items = document.querySelectorAll('a[href$=\"/admin\"]'); 
                        items.forEach(item => item.parentElement.remove()); 
                    });
                </script>";
            });
    
            Filament::registerNavigationItems([
                NavigationItem::make('My Pages') 
                    ->url(function () {
                        if (Auth::user()->hasRole('admin')) {
                            return route('filament.pages.dashboard');
                        } elseif (Auth::user()->hasRole('teacher')) {
                            return route('filament.resources.teacher-resource.pages.teacher-dashboard'); 
                        } elseif (Auth::user()->hasRole('student') && Auth::user()->student) {
                            return route('filament.resources.students.dashboard'); 
                        } else {
                            return route('filament.resources.students.dashboard'); 
                        }
                    })
                    ->icon('heroicon-o-home')
                    ->sort(0),
            ]);
        });
    }
    
}
