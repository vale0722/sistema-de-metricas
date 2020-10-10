<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Metric extends Model
{
    protected $fillable = ['metric', 'primary_id', 'secondary_id', 'date', 'keyword', 'status_type', 'status'];


    /**
     * @param array|string|null $primaryId
     * @return bool
     */
    public static function isFilteredByPrimaryId($primaryId): bool
    {
        return $primaryId != 'all' && $primaryId != null;
    }

    /**
     * @param Builder $query
     * @param array|string|null $primaryId
     * @return bool
     */
    public static function scopeFilterByPrimaryId(Builder $query, $primaryId): Builder
    {
        if (self::isFilteredByPrimaryId($primaryId)) {
            $seller = Seller::where('id', $primaryId['value'])->select('id')->first();

            return $query->where('primary_id', $seller->id);
        }

        return $query;
    }

    /**
     * @param array $filter
     * @param $primaryId
     * @return Collection
     */
    public static function getMetrics(array $filter): Collection
    {
        $primary = $filter['primary'] ?? null;

        return self::filterByPrimaryId($primary)
            ->whereBetween('date', [
                $filter['from'] ?? now()->subMonth()->format('Y-m-d'),
                $filter['to'] ?? now()->format('Y-m-d'),
            ])
            ->selectRaw('SUM(total) as `total`,
                `date` as `date`,
                `status`')
            ->groupBy('status', 'date')
            ->get(['date', 'status', 'total']);
    }

    /**
     * @param Collection $metrics
     * @return Collection
     */
    public static function readThreeLevelsMetric(Collection $metrics): Collection
    {
        $data = [];

        foreach ($metrics as $metric) {
            $data[$metric->status][$metric->date] = ($data[$metric->status][$metric->date] ?? 0) + $metric->total;
        }

        return collect($data);
    }
}
