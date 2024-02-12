<form wire:submit.prevent="save" class="m-5">
    <div class="mb-4">
        <label for="project" class="block text-sm font-medium text-gray-700">Project</label>
        <input list="projects" id="projectInput" wire:model="projectName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" placeholder="Select or type new"/>
        <div>
            @error('projectName') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>
        <datalist id="projects">
            @foreach ($projects as $project)
                <option value="{{ $project->name }}">{{ $project->name }}</option>
            @endforeach
        </datalist>
    </div>
    <div class="mb-4">
        <label for="task-name" class="block text-sm font-medium text-gray-700">Task Name</label>
        <input type="text" id="task-name" wire:model="taskName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter task name">
        <div>
            @error('taskName') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>
    </div>
    <div class="flex items-center justify-end">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save Task
        </button>
    </div>
</form>
