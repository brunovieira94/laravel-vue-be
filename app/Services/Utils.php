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
        $query = $model->query();
        if (array_key_exists('search', $requestInfo)) {
            $query->where('title', $requestInfo['search']);
        }
        return $query;
    }
}
