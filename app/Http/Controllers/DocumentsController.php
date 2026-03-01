<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Document;
use App\Models\User;
use App\Models\Prioritization;
use App\Models\Classification;
use App\Models\Subclassification;
use App\Models\Action;
use Carbon\Carbon;

class DocumentsController extends Controller
{
    public function create()
    {
        return redirect("admin.compose");
    }

    public function store(Request $request)
    {
        $isDraft = $request->input('is_draft') === '1';

        if ($isDraft) {
            // Rules for Draft: Only basic info required
            $rules = [
                'sender_user_id' => 'required|exists:users,id',
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
                'receiver_user_id' => 'nullable|exists:users,id',
                'prioritization' => 'nullable',
                'classification' => 'nullable',
                'subclassification' => 'nullable',
                'action' => 'nullable',
                'deadline' => 'nullable|date',
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv|max:10240',
            ];
        } else {
            // Rules for Submission: Everything is required
            $rules = [
                'sender_user_id' => 'required|exists:users,id',
                'receiver_user_id' => 'required|exists:users,id',
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
                'prioritization' => 'required',
                'classification' => 'required',
                'subclassification' => 'nullable',
                'action' => 'required',
                'deadline' => 'required|date',
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,csv|max:10240',
            ];
        }

        $request->validate($rules);

        $document = new Document; 
        $document->document_id = $this->generateDocumentId();
        
        if ($isDraft) {
            $document->status = 'draft';
            $document->status2 = 'none';
        } else {
            $document->status = $request->status ?? 'outgoing';
            $document->status2 = $request->status2 ?? 'incoming';
        }

        $document->sender_user_id = $request->sender_user_id;
        $document->receiver_user_id = $request->receiver_user_id ?? null;
        $document->subject = $request->subject;
        $document->description = $request->description;
        $document->prioritization = $request->prioritization ?? 'None';
        $document->classification = $request->classification ?? 'None';
        $document->subclassification = $request->subclassification ?? 'None';
        $document->action = $request->action ?? 'None';
        $document->deadline = $request->deadline ?? now();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('document'), $filename);
            $document->file = $filename;
        } else {
            $document->file = ''; 
        }

        $document->save();

        $message = $isDraft ? 'Document saved as draft.' : 'Document submitted successfully.';
        return redirect()->back()->with('success', $message);
    }

    public function generateDocumentId()
    {
        $today = Carbon::today();
        $dateStr = $today->format('mdy'); // MMDDYY
        
        // Count documents created today to get the next number
        $countToday = Document::whereDate('created_at', $today)->count();
        $nextNumber = str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);
        
        return "#{$nextNumber}-{$dateStr}";
    }

    public function drafts()
    {
        $user = Auth::user();
        $documents = Document::where('sender_user_id', $user->id)
                             ->where('status', 'draft')
                             ->orderBy('created_at', 'desc')
                             ->get();
        
        $view = $user->usertype == 1 ? 'admin.drafts' : 'Employee.drafts';
        $name_var = $user->usertype == 1 ? 'admin_name' : 'employee_name';
        
        return view($view, [
            $name_var => $user->firstname . ' ' . $user->lastname,
            'documents' => $documents
        ]);
    }
    public function index()
    {
        $document = Document::all();
        return view('document.index', compact('document'))->with('success', 'Document created successfully.');
    }

    public function show(Document $document)
    {
        $user = Auth::user();
        $view = $user->usertype == 1 ? 'admin.view-document' : 'Employee.view-document';
        $name_var = $user->usertype == 1 ? 'admin_name' : 'employee_name';

        return view($view, [
            $name_var => $user->firstname . ' ' . $user->lastname,
            'document' => $document
        ]);
    }

    public function incoming()
    {
        $user = Auth::user();
        $documents = Document::where('receiver_user_id', $user->id)->where('status', '!=', 'outgoing')->get();
        return view('document.incoming', compact('documents'));
    }

    public function outgoing()
    {
        $user = Auth::user();
        $documents = Document::where('sender_user_id', $user->id)->where('status', 'outgoing')->get();
        return view('document.outgoing', compact('documents'));
    }
   

    public function moveToPending(Document $document)
    {
        $document->status = 'pending';
        $document->save();
        return redirect()->back()->with('success', 'Document moved to pending.');
    }

    public function moveToArchive(Document $document)
    {
        $document->status = 'archive';
        $document->save();
        return redirect()->back()->with('success', 'Document moved to archive.');
    }

    public function download(Document $document)
    {
        $filePath = public_path('document/' . $document->file);
        
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'File not found.');
    }
}


