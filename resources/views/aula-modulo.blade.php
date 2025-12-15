<x-app-layout>
    @php
        $user = Auth::user();
        $lessonIds = $modulo->lessons->pluck('id')->toArray();
        $completedCount = count(array_intersect($lessonIds, $concluidas));
        $totalLessons = max(1, $modulo->lessons->count());
        $progressPercent = round(($completedCount / $totalLessons) * 100);
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $modulo->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 text-sm text-gray-600">
                <a href="{{ route('aulas') }}" class="hover:underline">Aulas</a>
                <span class="mx-2">></span>
                <span>{{ $modulo->titulo }}</span>
            </div>

            @if (session('status'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-semibold mb-4">Syllabus</h3>
                    <ul>
                        @foreach ($syllabus as $item)
                            <li>
                                <a href="{{ route('aulas.show', ['id' => $item->id]) }}"
                                   class="block mb-2 p-2 rounded {{ $item->id === $modulo->id ? 'bg-gray-200 font-bold text-black' : 'hover:bg-gray-100 text-gray-700' }}">
                                    {{ $item->titulo }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Conteúdo do módulo</h2>
                    <p class="text-gray-700 mb-6">{{ $modulo->descricao }}</p>

                    <div class="space-y-6">
                        @forelse ($modulo->lessons as $lesson)
                            <div class="border rounded-lg p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Aula {{ $lesson->ordem }}</p>
                                        <h3 class="text-lg font-semibold">{{ $lesson->titulo }}</h3>
                                    </div>
                                    <form method="POST" action="{{ route('gamification.lessons.complete', $lesson->id) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 text-sm font-semibold rounded {{ in_array($lesson->id, $concluidas) ? 'bg-gray-200 text-gray-700 cursor-not-allowed' : 'bg-green-600 text-white hover:bg-green-700' }}" {{ in_array($lesson->id, $concluidas) ? 'disabled' : '' }}>
                                            {{ in_array($lesson->id, $concluidas) ? 'Concluída' : '+XP Concluir aula' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="mt-3 text-sm text-gray-700 leading-relaxed">
                                    {!! nl2br(e(Str::limit($lesson->conteudo, 400))) !!}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600">Nenhuma aula cadastrada para este módulo ainda.</p>
                        @endforelse
                    </div>
                </div>

                <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-semibold mb-4">Progresso & XP</h3>
                    <p class="text-sm text-gray-600 mb-2">Nível {{ $user->level }} · {{ number_format($user->xp) }} XP</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    <p class="text-sm text-gray-700">{{ $completedCount }} / {{ $totalLessons }} aulas concluídas</p>

                    <div class="mt-6">
                        <h4 class="font-semibold mb-2">Registrar atividade prática</h4>
                        <form method="POST" action="{{ route('gamification.activities.complete') }}" class="space-y-2">
                            @csrf
                            <input type="hidden" name="activity_key" value="modulo-{{ $modulo->id }}-atividade">
                            <input type="hidden" name="description" value="Atividade prática do módulo {{ $modulo->titulo }}">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded">+XP Registrar atividade</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>