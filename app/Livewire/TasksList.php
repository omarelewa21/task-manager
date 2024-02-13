<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksList extends Component
{
    public Collection $projects;

    #[On('refresh-tasks-list')]
    public function refreshTasksList()
    {
        $this->mount();
        $this->render();
    }

    public function mount()
    {
        $this->projects = auth()->user()
            ->projects()
            ->has('tasks')
            ->get();
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

    public function deleteTask(int $taskId) {
        Task::whereId($taskId)->delete();
        $this->mount();
        $this->render();
    }
}
