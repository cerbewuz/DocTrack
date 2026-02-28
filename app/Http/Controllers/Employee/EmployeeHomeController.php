<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Subclassification;
use App\Models\Prioritization;
use App\Models\Action;
use App\Models\Classification;
use App\Models\User;

class EmployeeHomeController extends Controller
{
    // condition to check if the user is an employee
    public function index()
    {
        $user = Auth::user();
        $employee_name = $user && $user->usertype == 0 ? $user->username : null;
        
        // Get document counts for dashboard cards (user-specific)
        $incomingCount = Document::where('receiver_user_id', $user->id)
                                  ->where('status', 'incoming')
                                  ->count();
        $pendingCount = Document::where('sender_user_id', $user->id)
                                 ->where('status', 'pending')
                                 ->count();
        $outgoingCount = Document::where('sender_user_id', $user->id)
                                  ->where('status', 'outgoing')
                                  ->count();
        $receivedCount = Document::where('receiver_user_id', $user->id)
                                  ->where('status', 'received')
                                  ->count();
        
        return view('employee.home', compact('employee_name', 'incomingCount', 'pendingCount', 'outgoingCount', 'receivedCount'));
    }

    // for compose page
    public function compose()
    {
    
        $users = User::all(); 
        $prioritizations = Prioritization::all(); 
        $classifications = Classification::all(); 
        $subclassifications = Subclassification::all(); 
        $actions = Action::all(); 
    
        $employee_name = Auth::user()->username; 
    
        return view('employee.compose', compact('users', 'prioritizations', 'classifications', 'subclassifications', 'actions', 'employee_name'));
    }

    public function profile()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        return view('employee.profile', compact('employee_name'));
    }

    public function settings()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        return view('employee.settings', compact('employee_name'));
    }
    

    public function incoming()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        $documents = Document::where("status", 'incoming')->get();

        return view("employee.incoming", compact('employee_name', 'documents'));
    }

    public function received()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        $documents = Document::where("status", 'received')->get();

        return view("employee.received", compact('employee_name', 'documents'));
    }

    public function outgoing()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        $documents = Document::where("status", 'outgoing')->get();

        return view("employee.outgoing", compact('employee_name', 'documents'));
    }

    public function pending()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        $documents = Document::where('status', 'pending')->get();

        return view("employee.pending", compact('employee_name', 'documents'));
    }

    public function archive()
    {
        $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
        $documents = Document::where('status', 'archive')->get();

        return view("employee.archive", compact('employee_name', 'documents'));
    }

    // public function show($id)
    // {
    //     $employee_name = Auth::check() && Auth::user()->usertype == 0 ? Auth::user()->username : null;
    //     $document = Document::findOrFail($id);

    //     return view('view-document', compact('employee_name', 'document'));
    // }
}
