<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Status>
 */
class StatusResource extends ModelResource
{
    protected string $model = Status::class;

    protected string $title = 'Statuses';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('name'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
