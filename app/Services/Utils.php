<?php

namespace App\Services;

class Utils
{
    const defaultPerPage = 20;
    const defaultOrderBy = 'id';
    const defaultOrder = 'desc';

    public static function pagination($model, $requestInfo)
    {
        $orderBy = $requestInfo['orderBy'] ?? self::defaultOrderBy;
        $order = $requestInfo['order'] ?? self::defaultOrder;
        $perPage = $requestInfo['perPage'] ?? self::defaultPerPage;
        return $model->paginate($perPage);
    }

    public static function search($model, $requestInfo, $excludeFields = null)
    {
        $fillable = $model->getFillable();
        if ($excludeFields != null) {
            foreach ($fillable as $key => $value) {
                if (in_array($fillable[$key], $excludeFields)) {
                    unset($fillable[$key]);
                }
            }
        }
        $query = $model->query();
        if (array_key_exists('search', $requestInfo)) {

            if (self::validateDate($requestInfo['search'], 'd/m/Y')) {
                $requestInfo['search'] = self::formatDate($requestInfo['search']);
            }
            if (array_key_exists('searchFields', $requestInfo)) {
                $query->whereLike($requestInfo['searchFields'], "%{$requestInfo['search']}%");
            } else {
                $query->whereLike($fillable, "%{$requestInfo['search']}%");
            }
        }
        return $query;
    }

    public static function formatDate($date)
    {
        $date = explode('/', $date);
        $year = $date[2];
        $date[2] = $date[0];
        $date[0] = $year;
        return $date = implode('-', $date);
    }

    public static function validateDate($date, $format = 'd/m/Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
