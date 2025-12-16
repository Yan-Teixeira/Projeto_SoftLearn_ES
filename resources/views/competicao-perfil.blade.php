<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-gray-900 py-8 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Botão Voltar -->
            <div class="mb-6">
                <a href="{{ route('competicao') }}" 
                   class="inline-flex items-center space-x-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Voltar ao Ranking</span>
                </a>
            </div>

            <!-- Card do Perfil -->
            <div class="bg-gradient-to-br {{ $user['position'] == 1 ? 'from-yellow-400 via-orange-400 to-pink-400' : ($user['position'] == 2 ? 'from-gray-300 via-gray-400 to-gray-500' : ($user['position'] == 3 ? 'from-orange-300 via-orange-400 to-orange-500' : 'from-purple-400 via-blue-400 to-indigo-400')) }} rounded-xl shadow-2xl p-8 relative overflow-hidden mb-6">
                <!-- Efeito de brilho animado -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full animate-shimmer"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                        <!-- Avatar Grande -->
                        <div class="relative">
                            @if($user['position'] <= 3)
                                <div class="absolute inset-0 {{ $user['position'] == 1 ? 'bg-yellow-300' : ($user['position'] == 2 ? 'bg-gray-300' : 'bg-orange-300') }} rounded-full animate-ping opacity-75"></div>
                            @endif
                            <img src="{{ $user['avatar'] }}" 
                                 alt="{{ $user['name'] }}" 
                                 class="w-32 h-32 rounded-full border-4 border-white shadow-xl relative z-10">
                        </div>
                        
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex flex-col md:flex-row md:items-center md:space-x-3 mb-4">
                                <h1 class="text-4xl font-bold text-white mb-2 md:mb-0">{{ $user['name'] }}</h1>
                                @if($user['position'] == 1)
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-bold text-orange-600 inline-block">
                                        🏆 Mestre em Modelagem
                                    </span>
                                @elseif($user['position'] == 2)
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-bold text-gray-600 inline-block">
                                        🥈 Especialista
                                    </span>
                                @elseif($user['position'] == 3)
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-bold text-orange-600 inline-block">
                                        🥉 Expert
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 text-white">
                                <div>
                                    <span class="text-sm opacity-90 block">Posição no Ranking</span>
                                    <p class="text-3xl font-bold">
                                        @if($user['position'] == 1)
                                            🥇
                                        @elseif($user['position'] == 2)
                                            🥈
                                        @elseif($user['position'] == 3)
                                            🥉
                                        @else
                                            #{{ $user['position'] }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm opacity-90 block">Nível</span>
                                    <p class="text-3xl font-bold">{{ $user['level'] }}</p>
                                </div>
                                <div>
                                    <span class="text-sm opacity-90 block">XP Total</span>
                                    <p class="text-3xl font-bold">{{ number_format($user['xp']) }}</p>
                                </div>
                                <div>
                                    <span class="text-sm opacity-90 block">Emblemas</span>
                                    <p class="text-3xl font-bold">{{ $user['badges'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Pontos Altos -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Pontos Altos
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/30 rounded-lg transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Streak Atual</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $user['streak'] ?? 0 }} dias</p>
                                </div>
                            </div>
                            <span class="text-2xl">🔥</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Maior XP em Sessão</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $user['maxXpSession'] ?? 0 }} XP</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Diagramas Completados</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $user['diagramsCompleted'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Precisão Média</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $user['accuracy'] ?? 0 }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Velocidade de Aprendizado -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Velocidade de Aprendizado
                    </h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg transition-colors">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">Tempo Médio por Exercício</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user['avgTime'] ?? 'N/A' }}</p>
                        </div>
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg transition-colors">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">Taxa de Evolução</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user['evolutionRate'] ?? 'N/A' }}</p>
                        </div>
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg transition-colors">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">XP Médio por Dia</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">~{{ $user['avgXpPerDay'] ?? 0 }} XP</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Análise por Tipo de Diagrama -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-6 transition-colors duration-300">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Domínio por Tipo de Diagrama</h3>
                <div class="space-y-4">
                    @php
                        $diagrams = [
                            ['name' => 'UML - Casos de Uso', 'percentage' => 95, 'color' => 'green'],
                            ['name' => 'UML - Classes', 'percentage' => 88, 'color' => 'green'],
                            ['name' => 'DER - Entidade-Relacionamento', 'percentage' => 91, 'color' => 'green'],
                            ['name' => 'UML - Sequência', 'percentage' => 82, 'color' => 'blue'],
                            ['name' => 'UML - Atividades', 'percentage' => 72, 'color' => 'yellow'],
                            ['name' => 'DFD - Fluxo de Dados', 'percentage' => 68, 'color' => 'yellow'],
                        ];
                    @endphp
                    @foreach($diagrams as $diagram)
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $diagram['name'] }}</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $diagram['percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 {{ 
                                    $diagram['color'] == 'green' ? 'bg-gradient-to-r from-green-400 to-green-600' : 
                                    ($diagram['color'] == 'blue' ? 'bg-gradient-to-r from-blue-400 to-blue-600' : 
                                    'bg-gradient-to-r from-yellow-400 to-yellow-600') 
                                }}" style="width: {{ $diagram['percentage'] }}%"></div>
                            </div>
                            <div class="flex items-center mt-1 space-x-2">
                                @if($diagram['percentage'] >= 85)
                                    <span class="text-xs text-green-600 dark:text-green-400 font-semibold">✓ Domínio Excelente</span>
                                @elseif($diagram['percentage'] >= 75)
                                    <span class="text-xs text-blue-600 dark:text-blue-400 font-semibold">✓ Bom Desempenho</span>
                                @else
                                    <span class="text-xs text-yellow-600 dark:text-yellow-400 font-semibold">⚠ Área de Melhoria</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .animate-shimmer {
            animation: shimmer 3s infinite;
        }
    </style>
</x-app-layout>