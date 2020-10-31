<?php

namespace Turahe\Master\Models;

use Illuminate\Support\Facades\Cache;

/**
 * Turahe\Master\Timezone
 *
 * @property int $id
 * @property null|string $value
 * @property null|string $abbr
 * @property null|int $offset
 * @property null|int $isdst
 * @property null|string $text
 * @property null|string $utc
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereIsdst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereOffset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereValue($value)
 * @mixin \Eloquent
 */
class Timezone extends Model
{
    protected $table = 'tm_timezones';
    /**
     * Bootstrap the model and its traits.
     *
     * Caching model when updating and
     * delete cache when delete models
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::updating(function ($instance) {
            Cache::put('timezones.'.$instance->slug, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('timezones.'.$instance->slug);
        });
    }
}
