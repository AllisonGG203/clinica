<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use Illuminate\Support\Facades\Request as FacadesRequest;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Servicio>
 */
class ServicioResource extends ModelResource
{
    protected string $model = Servicio::class;

    protected string $title = 'Servicios';

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
                Text::make('Tipo de Servicio', 'tipo_servicio')->required(),
                Number::make('Precio', 'precio')->required(),
            ]),
        ];
    }

    /**
     * @param Servicio $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'tipo_servicio' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
        ];
    }
}
