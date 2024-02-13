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
        return auth()->user()
            ->projects()
            ->with(['tasks' => fn($query) =>
                $query->when(
                    $this->search,
                    fn($query) => $query->where('name', 'like', '%'.$this->search.'%')
                )
            ])
            ->get()
            ->filter(fn($project) => $project->tasks->isNotEmpty());
    }
}
