<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $projects = Project::latest()->take(4)->get();
        return view('livewire.about', compact('projects'));
    }
}
