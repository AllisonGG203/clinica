<?php

declare(strict_types=1);

namespace App\Providers;


use App\MoonShine\Resources\PacientesResource;
use App\MoonShine\Resources\MedicoResource;
use App\MoonShine\Resources\InventarioResource;
use App\MoonShine\Resources\ServicioResource;
use App\MoonShine\Resources\UsuariosResource;
use App\MoonShine\Resources\RolesResource;
use App\MoonShine\Resources\CitasResource;
use DragonCode\Contracts\Cashier\Http\Request;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Pacientes', new PacientesResource()),
            MenuItem::make('Consultas', static fn() => route('consultas.index')),
            MenuItem::make('Citas', new CitasResource()),
            MenuItem::make('Agenda', static fn() => route('agenda.index')),
            MenuItem::make('Medicos', new MedicoResource()),
            MenuItem::make('Servicios', new ServicioResource()),
            MenuItem::make('Inventarios', new InventarioResource()),
            MenuItem::make('Usuarios', new UsuariosResource()),
            MenuItem::make('Roles', new RolesResource()),
        ];
    }


}
