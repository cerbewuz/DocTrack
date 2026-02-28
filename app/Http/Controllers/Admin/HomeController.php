<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Subclassification;
use App\Models\Prioritization;
use App\Models\Action;
use App\Models\Classification;
use App\Models\User;

class HomeController extends Controller
{
    // condition to check if user is admin
    public function index(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        
        // Get document counts for dashboard cards
        $incomingCount = Document::where('status', 'incoming')->count();
        $pendingCount = Document::where('status', 'pending')->count();
        $outgoingCount = Document::where('status', 'outgoing')->count();
        $receivedCount = Document::where('status', 'received')->count();
        
        return view('admin.home', compact('admin_name', 'incomingCount', 'pendingCount', 'outgoingCount', 'receivedCount'));
    }

    // for profile page
    public function profile(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        return view('admin.profile', compact('admin_name'));
    }

    // for settings page
    public function settings(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        return view('admin.settings', compact('admin_name'));
    }

    // for incoming page
    public function incoming(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        $documents = Document::where("status", 'incoming')->get();
        return view("admin.incoming", compact('admin_name', 'documents'));
    }
    public function compose()
    {
    
        $users = User::all(); 
        $prioritizations = Prioritization::all(); 
        $classifications = Classification::all(); 
        $subclassifications = Subclassification::all(); 
        $actions = Action::all(); 
    
        $admin_name = Auth::user()->username; 
    
        return view('admin.compose', compact('users', 'prioritizations', 'classifications', 'subclassifications', 'actions', 'admin_name'));
    }
    
    // for received page 
    public function received(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        $documents = Document::where("status", 'received')->get();
        return view("admin.received", compact('admin_name', 'documents'));
    }

    // for outgoing page
    public function outgoing(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        $documents = Document::where("status", 'outgoing')->get();
        return view("admin.outgoing", compact('admin_name', 'documents'));
    }

    // for pending page
    public function pending(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        $documents = Document::where("status", 'pending')->get();
        return view("admin.pending", compact('admin_name', 'documents'));
    }

    // for archive page
    public function archive(){
        $admin_name = Auth::check() && Auth::user()->usertype == 1 ? Auth::user()->username : null;
        $documents = Document::where("status", 'archive')->get();
        return view("admin.archive", compact('admin_name', 'documents'));
    }
}
