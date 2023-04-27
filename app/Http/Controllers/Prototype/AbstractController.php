<?php

namespace App\Http\Controllers\Prototype;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\UrlGenerator;

/**
 * Description of AbstractController
 * @author Csaba Baranbas Barcsa
 */
class AbstractController extends BaseController
{
    protected $viewName = '';
    protected $viewData = [];
    /**
     * @var Request
     */
    protected $request;
    protected $urlGen;
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct(Request $request, UrlGenerator $urlGen)
    {
        $this->request = $request;
        
        $this->urlGen = $urlGen;
        
        $this->init();
    }
    
    public function init(){}
    
    /**/
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
    
    /**
     * @desc - This method renders the current page, if has correct view filename
     * @return \Illuminate\View\View
     * @throws Exception
     */
    public function render()
    {
        if (empty($this->viewName))
        {
            throw new Exception('Missing view name');
        }

        $viewData = array_merge(
            ['baseUrl' => $this->urlGen->to('/')],
            $this->viewData
        );
        
        return view($this->viewName, $viewData);
    }
}
