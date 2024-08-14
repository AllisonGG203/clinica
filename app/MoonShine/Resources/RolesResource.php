<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\MoonshineUserRole;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\HasMany;

/**
 * @extends ModelResource<MoonshineUserRole>
 */
class RolesResource extends ModelResource
{
    protected string $model = MoonshineUserRole::class;

    protected string $title = 'Roles';

    public function fields(): array
    {
        // Aquí definimos los campos que se mostrarán en el listado y edición del rol
        return [
            Block::make([
                ID::make()->sortable(),
            Text::make('Name', 'name')->required(),

                // Aquí listamos los permisos asociados a cada rol, utilizando checkboxes para cada menú
                Checkbox::make('Pacientes', 'permiso_pacientes'),
                Checkbox::make('Consultas', 'permiso_consultas'),
                Checkbox::make('Agenda', 'permiso_agenda'),
                Checkbox::make('Medicos', 'permiso_medicos'),
                Checkbox::make('Servicios', 'permiso_servicios'),
                Checkbox::make('Inventarios', 'permiso_inventarios'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            // Aquí agregas las validaciones necesarias para los permisos
        ];
    }

    public function beforeSave(Model $item): void
    {
        // Aquí puedes agregar lógica para manejar los permisos, como serializar los datos en la base de datos.
    }
}
