<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public Task $task;
    public Collection $projects;

    #[Validate('required|string|min:3|max:100')] 
    public $projectName = '';

    #[Validate('required|string|min:3|max:100')]
    public $taskName = '';

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->projectName = $task->project->name;
        $this->taskName = $task->name;
        $this->projects = auth()->user()
            ->projects()
            ->has('tasks')
            ->get();
    }

    public function render()
    {
        return view('livewire.edit-task');
    }

    public function save()
    {
        $this->validate(); 
 
        $project = Project::findOrCreateForUser($this->projectName, auth()->user());
        Task::whereId($this->task->id)->update([
            'name' => $this->taskName,
            'project_id' => $project->id,
        ]);

        $this->dispatch('refresh-tasks-list');
        $this->closeModal();
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
}
