<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mapa de Níveis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($levels as $level)
                    @php
                        $isCompleted = in_array($level->id, $completedLevelIds);
                    @endphp

                    <div class="relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 {{ $isCompleted ? 'border-green-500' : 'border-transparent' }} hover:shadow-xl transition-shadow duration-300">
                        
                        <!-- Badge de Status -->
                        <div class="absolute top-0 right-0 mt-4 mr-4">
                            @if($isCompleted)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Concluído
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Pendente
                                </span>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">
                                #{{ $level->order }} - {{ $level->title }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 h-16 overflow-hidden">
                                {{ Str::limit($level->description, 80) }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                @if($isCompleted)
                                    <button disabled class="w-full bg-gray-300 dark:bg-gray-700 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed">
                                        Tarefa Realizada
                                    </button>
                                @else
                                    <a href="{{ route('levels.show', $level) }}" class="w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                        Iniciar Nível
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 dark:text-gray-400 py-10">
                        Nenhum nível cadastrado ainda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>