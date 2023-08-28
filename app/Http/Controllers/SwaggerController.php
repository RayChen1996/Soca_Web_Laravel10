<?php
 

 namespace App\Http\Controllers;
 

class SwaggerController extends Controller
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function index()
    {
        return view('swagger');
 
    }
}