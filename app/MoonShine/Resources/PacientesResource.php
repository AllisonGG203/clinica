<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pacientes;
use Illuminate\Support\Facades\Request as FacadesRequest;
use MoonShine\Resources\ModelResource;
use MoonShine\Resources\Request;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use Moonshine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Paciente>
 */
class PacientesResource extends ModelResource
{
    protected string $model = Pacientes::class;

    protected string $title = 'Pacientes';

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
                Text::make('Edad', 'edad')->required(),
                Text::make('Sexo', 'sexo')->required(),
                Text::make('Teléfono', 'telefono')->required(),
            ]),
        ];
    }

    /**
     * @param Paciente $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'edad' => ['required', 'string', 'max:50'],
            'sexo' => ['required', 'string', 'max:1'],
            'telefono' => ['required', 'string', 'max:15'],
        ];
    }
}
