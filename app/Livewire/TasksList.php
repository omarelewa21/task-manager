<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Component;

class TasksList extends Component
{
    public Collection $projects;

    public function mount()
    {
        $this->projects = auth()->user()->projects;
    }

    public function render()
    {
        return view('livewire.tasks-list');
    }

    public function updateTaskOrder(array $tasks) {
        foreach($tasks as $task) {
            Task::whereId($task['value'])->update(['priority' => $task['order']]);
        }
    }
}
