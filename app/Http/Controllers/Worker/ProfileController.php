<?php
namespace App\Http\Controllers\Worker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{
    public function __invoke(){
        $worker = Auth::user();
        return view('worker.profile', ['worker'=> $worker]);
    }
}