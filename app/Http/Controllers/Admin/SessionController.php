<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    // List all sessions (Read)
    public function index()
    {
        // Order by year so the newest sessions show first
        $sessions = Session::orderBy('year', 'desc')->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    // Show the creation form (Create)
    public function create()
    {
        return view('admin.sessions.create');
    }

    // Store the new session (Create)
    public function store(Request $request)
    {
        // Validation ensures required fields are present and semester is valid
        $request->validate([
            'year' => 'required|string|max:10|unique:sessions,year', 
            'semester' => 'required|string|in:1st,2nd', 
        ]);

        Session::create($request->all());

        return redirect()->route('admin.sessions.index')->with('success', 'Session created successfully.');
    }
    
    // Action to set a specific session as active 
    public function setCurrent(Session $session)
    {
        // Reset all others before setting the new one
        Session::where('is_current', true)->update(['is_current' => false]);
        
        // Set the selected session as current
        $session->update(['is_current' => true]);

        return redirect()->route('admin.sessions.index')->with('success', 'Current Academic Session updated.');
    }
}
