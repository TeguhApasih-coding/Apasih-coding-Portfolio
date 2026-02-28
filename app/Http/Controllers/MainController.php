<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('welcome');
    }

    // Admin Page
    public function indexOfAdmin() {
        $projects = Project::latest()->paginate(6);
        $unreadMessages = ContactMessage::where('is_read', false)
        ->where('is_spam', false)
        ->count();
        
        $recentMessages = ContactMessage::latest()
        ->limit(5)
        ->get();
        return view('admin.index', compact('projects', 'unreadMessages', 'recentMessages'));
    }
}
