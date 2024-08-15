<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Fields\Time;
use MoonShine\Fields\Textarea;

/**
 * @extends ModelResource<Model>
 */
class ConsultarResource extends ModelResource
{
    protected string $model = Model::class;  // Cambia esto a tu modelo correcto

    protected string $title = 'Consulta';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Paciente', 'paciente_id')
                    ->required(),
                Date::make('Fecha', 'fecha')->required(),
                Text::make('Hora', 'hora')
                    ->required()
                    ->type('time'),
                Text::make('Motivo', 'motivo')->required(),
                Textarea::make('Notas', 'notas'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'paciente_id' => ['required', 'exists:pacientes,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'motivo' => ['required', 'string', 'max:255'],
            'notas' => ['nullable', 'string'],
        ];
    }

    public function viewResumen(Model $cita)
    {
        return view('consultas.resumen', compact('cita'));
    }
}
