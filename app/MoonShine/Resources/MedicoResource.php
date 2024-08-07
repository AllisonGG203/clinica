<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medico;
use Illuminate\Support\Facades\Request as FacadesRequest;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Medico>
 */
class MedicoResource extends ModelResource
{
    protected string $model = Medico::class;

    protected string $title = 'Médicos';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    public function redirectAfterSave(): string
    {
        $referer = FacadesRequest::header('referer');
        return $referer ?: '/';
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Nombre', 'nombre')->required(),
                Text::make('Correo', 'correo')->required(),
                Text::make('Teléfono', 'telefono')->required(),
                Text::make('Profesión', 'profesion')->required(),
            ]),
        ];
    }

    /**
     * @param Medico $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:medico,correo,' . $item->id],
            'telefono' => ['required', 'string', 'max:20'],
            'profesion' => ['required', 'string', 'max:255'],
        ];
    }
}
