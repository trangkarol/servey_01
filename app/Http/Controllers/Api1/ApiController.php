<?php

namespace App\Http\Controllers\Api1;

use App\Http\Controllers\AbstractController;
use App\Exceptions\Api1\NotFoundException;
use App\Exceptions\Api1\UnknowException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use LRedis;

class ApiController extends AbstractController
{
    protected $guard = 'api';
    private $redis;

    protected function trueJson()
    {
        $this->compacts['http_status'] = [
            'code' => 200,
            'status' => true,
        ];

        return response()->json($this->compacts);
    }

    protected function doAction(callable $callback)
    {
        DB::beginTransaction();
        try {
            if (is_callable($callback)) {
                call_user_func($callback);
            }

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            throw new NotFoundException($e->getMessage(), $e->getCode());
        } catch (NotFoundException $e) {
            DB::rollBack();

            throw new NotFoundException($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnknowException($e->getMessage());
        }

        return $this->trueJson();
    }

    protected function getData(callable $callback)
    {
        try {
            if (is_callable($callback)) {
                call_user_func($callback);
            }
        } catch (Exception $e) {
            throw new UnknowException($e->getMessage());
        }

        return $this->trueJson();
    }

    public function sendNotification($receiver, $data, $modelName, $object)
    {
        $notification['notifiable_id'] = $receiver;
        $notification['type'] = $modelName;
        $notification['created_at'] = Carbon::now()->toDateTimeString();
        $notification['data'] = [
            'from' => $this->user,
            $object => $data,
        ];

        $this->redis = LRedis::connection();
        $this->redis->publish('getNotification', json_encode($notification));
    }
}
