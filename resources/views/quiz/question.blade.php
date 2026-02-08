<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Título Principal --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    {{ $quiz->titulo }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Enunciado {{ $index + 1 }} de {{ $quiz->questoes->count() }}
                </p>
            </div>

            {{-- Container do Quiz --}}
            <div id="quiz-container"
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 transition-colors duration-300">

                {{-- Barra de Progresso --}}
                @php
                    $total = $quiz->questoes->count();
                    $percentual = ($index + 1) / $total * 100;
                @endphp

                <div class="mb-6">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-300"
                             style="width: {{ (int)$percentual }}%"></div>
                    </div>
                </div>

                {{-- Pergunta --}}
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    {{ $questao->enunciado }}
                </h2>

                {{-- Dica --}}
                @if ($questao->dica)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        💡 Dica: {{ $questao->dica }}
                    </p>
                @endif

                {{-- Alternativas --}}
                <div id="alternativas" class="space-y-3 mb-8">
                    @foreach ($questao->opcoes as $opcao)
                        <button
                            class="option w-full p-4 text-left border-2 border-gray-200 dark:border-gray-600 rounded-lg
                                   bg-gray-50 dark:bg-gray-700 hover:border-green-500 dark:hover:border-green-500
                                   hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200
                                   text-gray-900 dark:text-gray-100 font-medium"
                            data-correta="{{ $opcao->correta ? '1' : '0' }}"
                            onclick="responder(this)">
                            {{ $opcao->texto_opcao }}
                        </button>
                    @endforeach
                </div>

                {{-- Navegação --}}
                <div class="flex gap-3 justify-between">
                    <div class="flex gap-3">
                        @if ($index > 0)
                            <a href="/quiz/{{ $quiz->slug }}/{{ $index - 1 }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700
                                      text-gray-900 dark:text-gray-100 font-medium rounded-lg
                                      hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                ⬅ Voltar
                            </a>
                        @endif

                        @if ($index + 1 < $quiz->questoes->count())
                            <a id="btn-proximo"
                               href="/quiz/{{ $quiz->slug }}/{{ $index + 1 }}"
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white
                                      font-medium rounded-lg hover:bg-green-700 transition-colors"
                               style="display:none;">
                                Próximo ➡
                            </a>
                        @else
                            <a id="btn-finalizar"
                               href="/aula/teste"
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white
                                      font-medium rounded-lg hover:bg-green-700 transition-colors"
                               style="display:none;">
                                Finalizar ✓
                            </a>
                        @endif
                    </div>

                    <a href="/aula/teste"
                       class="inline-flex items-center px-4 py-2 bg-gray-400 dark:bg-gray-600
                              text-white font-medium rounded-lg hover:bg-gray-500 transition-colors">
                        Módulos
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        function responder(botao) {
            const correta = botao.dataset.correta === '1';
            const container = document.getElementById('quiz-container');
            const botoes = document.querySelectorAll('.option');
            const btnProximo = document.getElementById('btn-proximo');
            const btnFinalizar = document.getElementById('btn-finalizar');

            botoes.forEach(b => b.disabled = true);

            if (correta) {
                botao.classList.add('bg-green-600', 'text-white', 'border-green-600');
                container.classList.add('ring-2', 'ring-green-500');
            } else {
                botao.classList.add('bg-red-600', 'text-white', 'border-red-600');
                container.classList.add('ring-2', 'ring-red-500');

                botoes.forEach(b => {
                    if (b.dataset.correta === '1') {
                        b.classList.add('bg-green-600', 'text-white', 'border-green-600');
                    }
                });
            }

            if (btnProximo) btnProximo.style.display = 'inline-flex';
            if (btnFinalizar) btnFinalizar.style.display = 'inline-flex';
        }
    </script>
</x-app-layout>
