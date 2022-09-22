<?php


namespace App\Http\Filters\EventoPromotor;


use App\Http\Filters\Filter;

class EventoPromotorFilter extends Filter
{

    protected $filters = ['byField', 'filter', 'field', 'operator', 'value'];

    protected function byField($value, $operator, $field)
    {
        $value = operator_format_like_string($value, $operator);

        return $this->builder->where($field, operator($operator), $value);
    }

}
