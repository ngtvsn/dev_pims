<?php

namespace App\Http\Livewire\Pages\Css\Responses;
use App\Models\CssResponse;
use Livewire\Component;

class ViewCssResponse extends Component
{
    public $param;
    
    public function mount($param)
    {
        $this->param = $param;
    }
    
    public function render()
    {
        return view('livewire.pages.css.responses.view-css-response', 
        [
            'response_info' => CssResponse::where('id', $this->param)->first(),
        ]);
    }
}
