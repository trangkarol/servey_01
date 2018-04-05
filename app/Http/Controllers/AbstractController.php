<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class AbstractController extends Controller
{
    protected $repositoryName;

    protected $user;

    protected $compacts = [];

    protected $view;

    protected $repository;

    public function __construct($repository = null)
    {
        $this->middleware(function ($request, $next) use ($repository) {
            $this->user = Auth::guard($this->getGuard())->user();

            if ($repository) {
                $this->repositorySetup($repository);
            }

            return $next($request);
        });
    }

    public function repositorySetup($repository = null)
    {
        $this->repository = $repository->setGuard($this->getGuard());
        $this->repositoryName = strtolower(class_basename($this->repository->model()));
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

    protected function responseSuccess($fields = [])
    {
        if (empty($this->compacts)) {
            $this->compacts['status'] = true;
        }

        $data = array_merge($fields, $this->compacts);

        return response()->json($data);
    }

    protected function responseFail()
    {
        return response()->json([
            'status' => false,
        ]);
    }
}
