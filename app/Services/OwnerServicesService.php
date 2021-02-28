<?php

namespace App\Services;

use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Authenticatable;

class OwnerServicesService
{
    /**
     * Выдает сервисы, принадлежащие заданному пользователю
     * @param User $user
     * @return Collection
     */
    public static function getOwnerServices(Authenticatable $user): Collection
    {
        return Service::with(['types',
            'schedules' => function ($q) {
                $q->whereDate('work_day', '>=', date('Y.m.d'))
                    ->join('types', 'schedules.service_type_id', '=', 'types.id')
                    ->select('schedules.*', 'types.name');
            }])
            ->select('services.*')
            ->where('user_id', $user->id)
            ->get();
    }
}
