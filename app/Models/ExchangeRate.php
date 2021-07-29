<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Класс-модель для сущности "Курс обмена"
 * Class ExchangeRate
 * @package App\Models
 * @property string currency - название валюты
 * @property float buy - цена продажи
 * @property float sell - цена покупки
 * @property Carbon begins_at - момент начала действия курса
 * @property int|null office_id - офис
 */
class ExchangeRate extends Model
{
    public const FILLABLE = ['currency', 'buy', 'sell', 'begins_at', 'office_id'];

    protected $table = 'exchange_rates';
    protected $fillable = self::FILLABLE;

    protected $casts = [
        'begins_at' => 'datetime:d.m.Y H:i:s',
    ];
}
