<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\PacientesResource;
use App\MoonShine\Resources\MedicoResource;
use App\MoonShine\Resources\InventarioResource;
use App\MoonShine\Resources\ServicioResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;
use Illuminate\Support\Facades\Auth;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<MenuElement>
     */
    protected function menu(): array
    {
        $user = Auth::user();
        $menu = [];

        if ($user) {
            $menu[] = MenuItem::make('Pacientes', new PacientesResource())->canSee(fn() => $user->role == 'admin' || $user->role == 'medico' || $user->role == 'secretaria');
            $menu[] = MenuItem::make('Consultas', static fn() => route('consultas.index'))->canSee(fn() => $user->role == 'admin' || $user->role == 'medico' || $user->role == 'secretaria');
            $menu[] = MenuItem::make('Agenda', static fn() => route('agenda'))->canSee(fn() => $user->role == 'admin' || $user->role == 'medico' || $user->role == 'secretaria');

            if ($user->role == 'admin') {
                $menu[] = MenuItem::make('Medicos', new MedicoResource());
                $menu[] = MenuItem::make('Servicios', new ServicioResource());
                $menu[] = MenuItem::make('Inventarios', new InventarioResource());
            }
        }

        return $menu;
    }
}
