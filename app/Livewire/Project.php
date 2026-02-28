<?php

namespace App\Livewire;

use App\Models\Project as ModelsProject;
use Livewire\Component;

class Project extends Component
{
    public function render()
    {
        $projects = ModelsProject::latest()->take(6)->get();
        return view('livewire.project', compact('projects'));
    }
}
