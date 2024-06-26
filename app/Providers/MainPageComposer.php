<?php
namespace App\Providers;


use Illuminate\View\View;

class MainPageComposer{

 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void{
        $view->with('cartCount', count(session()->get('cart', [])));
    }
}