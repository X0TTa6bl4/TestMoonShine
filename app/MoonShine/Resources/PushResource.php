<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Push;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Metrics\DonutChartMetric;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Push>
 */
class PushResource extends ModelResource
{
    protected string $model = Push::class;

    protected string $title = 'Posts';

    private Collection $status;

    private function getStatus(): Collection
    {
        if (!isset($this->status)) {
            $this->status = Status::all();
        }
        return $this->status;
    }

    private function statuses(): array
    {
        $statuses = [];
        foreach ($this->getStatus() as $item) {
            $statuses[$item->id] = $item->name;
        }
        return $statuses;
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('User', 'user', 'name', new UserResource()),
                Text::make('text')
                    ->updateOnPreview()
                    ->required(),
                Select::make('Status', 'status_id')
                    ->updateOnPreview()
                    ->options($this->statuses())
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function metrics(): array
    {
        $countStatuses = [];
        foreach ($this->getStatus() as $status) {
            $count = $status->push()->count();
            $countStatuses[$status->name] = $count;
        }
        return [
            DonutChartMetric::make('Statuses')->values($countStatuses)
        ];
    }
}
