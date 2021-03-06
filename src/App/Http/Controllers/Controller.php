<?php namespace Redooor\Redminportal\App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    protected $model;
    protected $perpage;
    protected $sortBy;
    protected $orderBy;
    protected $pageView;
    protected $pageRoute;
    protected $data; // For storing shared data across views
    
    use DispatchesCommands, ValidatesRequests;
}
