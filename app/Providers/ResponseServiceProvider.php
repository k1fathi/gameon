<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('message', function ($code, $parameters = [], $status = 200, array $headers = [], $options = 0) use ($factory) {
            return response()->json([
                'swal'    => 1,
                'code'    => $code,
                'title'   => trans('messages.common.success'),
                'message' => trans('messages.' . $code, $parameters),
            ], $status, $headers, $options);
        });

        $factory->macro('success', function ($data, $code = 'common.success', $parameters = [], $status = 200, array $headers = [], $options = 0) use ($factory) {
            return response()->json([
                'code'    => $code,
                'message' => trans('messages.' . $code, $parameters),
                'data'    => $data,
            ], $status, $headers, $options);
        });

        $factory->macro('error', function ($code, $parameters = [], $extras = [], $status = 404, array $headers = [], $options = 0) use ($factory) {
            return response()->json([
                    'code'    => $code,
                    'title'   => trans('errors.common.error'),
                    'message' => trans('errors.' . $code, $parameters),
                ] + $extras, $status, $headers, $options);
        });

        $factory->macro('paginate', function ($data, $limit = 10, $code = 'common.success', $status = 200, array $headers = [], $options = 0, $extras = []) use ($factory) {
            if ($data == null) {
                return response()->json([
                    'code'    => $code,
                    'message' => trans('messages.' . $code),
                    'data'       => [],
                    'pagination' => [
                        'total'        => 0,
                        'per_page'     => $limit,
                        'current_page' => 1,
                        'last_page'    => 0,
                        'first_item'   => 1,
                        'last_item'    => 0,
                    ]
                ], $status, $headers, $options);
            }
            // If query paginate
            if ($data instanceof \Illuminate\Database\Query\Builder ||
                $data instanceof \Illuminate\Database\Eloquent\Builder ||
                $data instanceof \Illuminate\Database\Eloquent\Relations\Relation
            ) {
                $data = $data->paginate($limit);
            }

            return response()->json(
                array_merge([
                    'code'    => $code,
                    'message' => trans('messages.' . $code),
                    'data'       => $data->items(),
                    'pagination' => [
                        'total'        => $data->total(),
                        'per_page'     => $data->perPage(),
                        'current_page' => $data->currentPage(),
                        'last_page'    => $data->lastPage(),
                        'first_item'   => $data->firstItem(),
                        'last_item'    => $data->lastItem(),
                    ]
                ], count($extras) ? ['extra' => $extras]:[]), $status, $headers, $options);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
