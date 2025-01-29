<?php

namespace App\Exports;
 
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
 
class ExcelExportsView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $view;
    Private $data = [];
    
    public function __construct(String  $view , $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }


    public function view(): View
    {        
        return view($this->view , $this->data);
    }
}
