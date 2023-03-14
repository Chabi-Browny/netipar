<?php

namespace App\Http\Controllers\Prototype;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

/**
 * Description of AbstractController
 * @author Csaba Baranbas Barcsa
 */
class AbstractController extends BaseController
{
    protected $viewName = '';
    protected $viewData = [];
    protected $request;
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        
        $this->init();
    }
    
    public function init(){}
    
    public function index()
    {
        return $this->render();
    }

    public function setViewName(string $viewName)
    {
        $this->viewName = $viewName;
    }
    
    public function setViewData(string $dataKey, $data)
    {
        if (array_key_exists($dataKey, $this->viewData))
        {
            throw new Exception('Data key is reserved');
        }
        
        $this->viewData[$dataKey] = $data;
    }
    
    public function render()
    {
        if (empty($this->viewName))
        {
            throw new Exception('Missing view name');
        }
        
        $viewData = array_merge(
            ['baseUrl' => $this->request->url('/')],
            $this->viewData
        );
        
        return view($this->viewName, $viewData);
    }
}
