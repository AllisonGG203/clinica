<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Fields\Textarea;

/**
 * @extends ModelResource<Cita>
 */
class CitasResource extends ModelResource
{
    protected string $model = Cita::class;

    protected string $title = 'Citas';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Paciente', 'paciente_id')->required(),
                Date::make('Fecha', 'fecha')->required(),
                Text::make('Hora', 'hora')
                    ->required()
                    ->type('time'), // Especifica el tipo de input como "time"
                Text::make('Motivo', 'motivo')->required(),
                Textarea::make('Notas', 'notas'),
            ]),
        ];
    }

    /**
     * @param Cita $item
     *
     * @return array
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'paciente_id' => ['required', 'exists:pacientes,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'], // Valida el formato de la hora
            'motivo' => ['required', 'string', 'max:255'],
        ];
    }
}
