<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Url;

class TasksList extends Component
{
    #[Url]
    public $search = '';

    #[On('refresh-tasks-list')]
    public function refreshTasksList()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.tasks-list', [
            'projects'  => $this->getProjects()
        ]);
    }

    public function updateTaskOrder(array $tasks) {
        foreach($tasks as $task) {
            Task::whereId($task['value'])->update(['priority' => $task['order']]);
        }
    }

    public function deleteTask(int $taskId) {
        Task::whereId($taskId)->delete();
        $this->render();
    }

    public function getProjects()
    {
        return auth()->user()->projects()
            ->join('tasks', 'tasks.project_id', 'projects.id')
            ->search($this->search)
            ->select('projects.*')
            ->distinct('projects.id')
            ->with('tasks')
            ->get();
    }
}
