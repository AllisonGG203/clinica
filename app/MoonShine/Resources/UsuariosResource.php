<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\MoonshineUser;
use App\Models\MoonshineUserRole;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Password;
use MoonShine\Fields\Select;
use Illuminate\Support\Facades\DB;

/**
 * @extends ModelResource<MoonshineUser>
 */
class UsuariosResource extends ModelResource
{
    protected string $model = MoonshineUser::class;

    protected string $title = 'Usuarios';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    public function redirectAfterSave(): string
    {
        $referer = request()->header('referer');
        return $referer ?: '/';
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        // Obtener roles desde la base de datos
        $roles = DB::table('moonshine_user_roles')->pluck('name', 'id')->toArray();

        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Nombre', 'name')->required(),
                Text::make('Correo Electrónico', 'email')->required(),
                Password::make('Contraseña', 'password')->required(),
                Select::make('Rol', 'moonshine_user_role_id')
                    ->options($roles)
                    ->required(),
            ]),
        ];
    }

    /**
     * @param Model $item
     *
     * @return array<string, string[]|string>
     */
    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:moonshine_users,email,' . $item->id],
            'password' => ['required', 'string', 'min:8'],
            'moonshine_user_role_id' => ['required', 'exists:moonshine_user_roles,id'],
        ];
    }
}
