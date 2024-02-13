<div class="container mx-auto px-4 mt-4" x-data="{reordering: false}">

    <div class="flex flex-row justify-between">
        <div class="flex flex-row content-center">
            <input type="text" wire:model.live="search" class="form-control border rounded w-64" placeholder="Search in tasks">
            <span class="relative right-8 top-2">
                <x-icons.search />
            </span>
        </div>
        <button wire:click="$dispatch('openModal', { component: 'create-new-task' })" class="bg-blue-500 text-white p-2 rounded">Add Task</button>
    </div>
    
    @forelse ($projects as $project)
        <div class="mx-2 mt-6">
            <h3 class="text-lg font-semibold mb-2">{{ $project->name }}</h3>
            <div wire:sortable="updateTaskOrder" class="ml-2">
                @foreach ($project->tasks as $task)
                    <div wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}" class="flex flex-row justify-between items-center">
                        <div class="flex flex-row content-center">
                            <div wire:sortable.handle
                                :class="reordering ? 'cursor-grabbing flex items-center' : 'cursor-grab flex items-center'"
                                @mousedown="reordering=true"
                                @mouseup="reordering=false"
                            >
                                <x-icons.drag />
                            </div>
                            <span class="ml-1">{{ $task->name }}</span>
                        </div>
                        
                        <div class="flex flex-row content-center">
                            <span wire:click="$dispatch('openModal', { component: 'edit-task', arguments: {task: {{$task->id}}} })" class="cursor-pointer ml-2">
                                <x-icons.edit />
                            </span>
                            <span wire:click="deleteTask({{ $task->id }})" class="cursor-pointer ml-2">
                                <x-icons.trash />
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <h3 class="text-lg font-semibold m-2">No Tasks Found</h3>
    @endforelse
</div>
