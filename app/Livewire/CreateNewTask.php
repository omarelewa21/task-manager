<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate; 

class CreateNewTask extends ModalComponent
{
    public Collection $projects;

    #[Validate('required|string|min:3|max:100')] 
    public $projectName = '';

    #[Validate('required|string|min:3|max:100')]
    public $taskName = '';

    public function mount()
    {
        $this->projects = auth()->user()->projects;
    }

    public function save()
    {
        $this->validate(); 
 
        $project = Project::findOrCreateForUser($this->projectName, auth()->user());
        $project->tasks()->create([
            'name' => $this->taskName,
            'priority' => $project->tasks->count() + 1,
        ]);
 
        return $this->redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.create-new-task');
    }
}
