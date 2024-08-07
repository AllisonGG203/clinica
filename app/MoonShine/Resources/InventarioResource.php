<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventario;
use Illuminate\Support\Facades\Request as FacadesRequest;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Inventario>
 */
class InventarioResource extends ModelResource
{
    protected string $model = Inventario::class;

    protected string $title = 'Inventario';

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
                Text::make('Nombre del Medicamento', 'nombre_medicamento')->required(),
                Number::make('Precio', 'precio')->required(),
                Number::make('Stock', 'stock')->required(),
                Text::make('Cantidad', 'cantidad')->required(),
            ]),
        ];
    }

    /**
     * @param Inventario $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'nombre_medicamento' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'cantidad' => ['required', 'string', 'max:255'],
        ];
    }
}
