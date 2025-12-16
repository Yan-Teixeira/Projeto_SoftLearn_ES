<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-gray-900 py-8 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">🏆 Ranking de Competição</h1>
                <p class="text-gray-600 dark:text-gray-400">Compita com outros alunos e domine os diagramas de Engenharia de Software</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Ranking Lateral (30-35%) -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-6 transition-colors duration-300">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Top 10 Ranking
                        </h2>

                        <div class="space-y-4">
                            @foreach($ranking as $user)
                                <a href="{{ route('competicao.perfil', $user['id']) }}" 
                                   class="block flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-md transition-all duration-200 cursor-pointer 
                                   {{ $user['position'] <= 3 ? 'bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border-2 ' . ($user['position'] == 1 ? 'border-yellow-400 dark:border-yellow-600' : ($user['position'] == 2 ? 'border-gray-300 dark:border-gray-600' : 'border-orange-300 dark:border-orange-600')) : 'dark:border dark:border-transparent' }}">
                                    <!-- Posição -->
                                    <div class="flex-shrink-0 w-8 text-center">
                                        @if($user['position'] == 1)
                                            <span class="text-2xl">🥇</span>
                                        @elseif($user['position'] == 2)
                                            <span class="text-2xl">🥈</span>
                                        @elseif($user['position'] == 3)
                                            <span class="text-2xl">🥉</span>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400 font-bold">{{ $user['position'] }}</span>
                                        @endif
                                    </div>

                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" 
                                             class="w-12 h-12 rounded-full border-2 {{ $user['position'] == 1 ? 'border-yellow-400 ring-2 ring-yellow-200 dark:ring-yellow-900' : ($user['position'] == 2 ? 'border-gray-300 ring-2 ring-gray-200 dark:ring-gray-700' : ($user['position'] == 3 ? 'border-orange-300 ring-2 ring-orange-200 dark:ring-orange-900' : 'border-gray-200 dark:border-gray-600')) }}">
                                    </div>

                                    <!-- Informações -->
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $user['name'] }}</p>
                                        <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Nv. {{ $user['level'] }}</span>
                                            <span>•</span>
                                            <span>{{ number_format($user['xp']) }} XP</span>
                                        </div>
                                        <div class="flex items-center mt-1">
                                            @for($i = 0; $i < min(5, $user['badges']); $i++)
                                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            @if($user['badges'] > 5)
                                                <span class="text-xs text-gray-500 dark:text-gray-500 ml-1">+{{ $user['badges'] - 5 }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            <!-- Mostrar posição do usuário logado se não estiver no top 10 -->
                            @if(!$userInTop10)
                                <div class="mt-6 pt-6 border-t-2 border-gray-300 dark:border-gray-700">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide">Sua Posição</p>
                                    <a href="{{ route('competicao.perfil', 'me') }}" class="block flex items-center space-x-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-300 dark:border-blue-700 hover:bg-blue-100 dark:hover:bg-blue-900/40 hover:shadow-md transition-all duration-200 cursor-pointer">
                                        <!-- Posição -->
                                        <div class="flex-shrink-0 w-8 text-center">
                                            <span class="text-gray-700 dark:text-gray-300 font-bold">{{ $userPosition }}</span>
                                        </div>

                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($currentUser->email))) }}?d=mp" 
                                                 alt="{{ $currentUser->name }}" 
                                                 class="w-12 h-12 rounded-full border-2 border-blue-400 ring-2 ring-blue-200 dark:ring-blue-900">
                                        </div>

                                        <!-- Informações -->
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $currentUser->name }}</p>
                                            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                                                <span class="font-medium">Nv. {{ $userLevel }}</span>
                                                <span>•</span>
                                                <span>{{ number_format($userXP) }} XP</span>
                                            </div>
                                            <div class="flex items-center mt-1">
                                                @for($i = 0; $i < min(5, $userBadges); $i++)
                                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                                @if($userBadges > 5)
                                                    <span class="text-xs text-gray-500 ml-1">+{{ $userBadges - 5 }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">Continue praticando para subir no ranking! 🚀</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Área Principal - Top 1 (65-70%) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Card do Top 1 -->
                    @php
                        $topUser = $ranking[0]; // Primeiro do ranking
                    @endphp
                    <div class="bg-gradient-to-br from-yellow-400 via-orange-400 to-pink-400 rounded-xl shadow-2xl p-8 relative overflow-hidden">
                        <!-- Efeito de brilho animado -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full animate-shimmer"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center space-x-6 mb-6">
                                <!-- Avatar Grande -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-yellow-300 rounded-full animate-ping opacity-75"></div>
                                    <img src="{{ $topUser['avatar'] }}" 
                                         alt="{{ $topUser['name'] }}" 
                                         class="w-24 h-24 rounded-full border-4 border-white shadow-xl relative z-10">
                                </div>
                                
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h2 class="text-3xl font-bold text-white">{{ $topUser['name'] }}</h2>
                                        <span class="px-3 py-1 bg-white/90 rounded-full text-sm font-bold text-orange-600">
                                            🏆 Mestre em Modelagem
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-4 text-white">
                                        <div>
                                            <span class="text-sm opacity-90">Nível</span>
                                            <p class="text-2xl font-bold">{{ $topUser['level'] }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm opacity-90">XP Total</span>
                                            <p class="text-2xl font-bold">{{ number_format($topUser['xp']) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm opacity-90">Emblemas</span>
                                            <p class="text-2xl font-bold">{{ $topUser['badges'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Emblemas -->
                            <div class="mb-6">
                                <h3 class="text-white font-semibold mb-3">Emblemas Conquistados</h3>
                                <div class="flex flex-wrap gap-3">
                                    @php
                                        $badges = ['Especialista em Classes', 'Mestre DER', 'Velocista UML', 'Arquiteto Diamante', 'Gênio de Casos de Uso', 'Diagramador Pro'];
                                    @endphp
                                    @foreach($badges as $badge)
                                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="text-white font-medium text-sm">{{ $badge }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico de Progresso XP -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Evolução de XP (Últimas 8 Semanas)</h3>
                        <div class="h-64 flex items-end justify-between space-x-2">
                            @php
                                $weeklyXP = [1250, 1380, 1520, 1450, 1680, 1720, 1850, 1950];
                                $maxXP = max($weeklyXP);
                            @endphp
                            @foreach($weeklyXP as $index => $xp)
                                <div class="flex-1 flex flex-col items-center">
                                    <div class="w-full bg-gradient-to-t from-purple-500 to-blue-400 dark:from-purple-600 dark:to-blue-600 rounded-t-lg hover:from-purple-600 hover:to-blue-500 dark:hover:from-purple-500 dark:hover:to-blue-500 transition-all duration-300 cursor-pointer group" 
                                         style="height: {{ ($xp / $maxXP) * 100 }}%"
                                         title="Semana {{ $index + 1 }}: {{ $xp }} XP">
                                        <div class="hidden group-hover:block bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-xs font-semibold px-2 py-1 rounded shadow-lg mb-1 -mt-8">
                                            {{ $xp }} XP
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">S{{ $index + 1 }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-purple-500 rounded"></div>
                                <span>Nível alcançado</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-green-500 rounded"></div>
                                <span>Conquista especial</span>
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas de Performance -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pontos Altos -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
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
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">28 dias</p>
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
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">850 XP</p>
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
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">347</p>
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
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">87%</p>
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
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">4min 32s</p>
                                </div>
                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg transition-colors">
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">Taxa de Evolução</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">2.3 níveis/semana</p>
                                </div>
                                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg transition-colors">
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">XP Médio por Dia</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">~220 XP</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Análise por Tipo de Diagrama -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
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

                    <!-- Conquistas Recentes -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Conquistas Recentes</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @php
                                $recentAchievements = [
                                    ['name' => 'Especialista em Classes', 'date' => '15/01/2025', 'icon' => '📊'],
                                    ['name' => 'Mestre DER', 'date' => '12/01/2025', 'icon' => '🗄️'],
                                    ['name' => 'Velocista UML', 'date' => '08/01/2025', 'icon' => '⚡'],
                                ];
                            @endphp
                            @foreach($recentAchievements as $achievement)
                                <div class="bg-gradient-to-br from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 rounded-lg p-4 border-2 border-purple-200 dark:border-purple-800 hover:border-purple-400 dark:hover:border-purple-600 transition-all duration-200">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <span class="text-3xl">{{ $achievement['icon'] }}</span>
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white">{{ $achievement['name'] }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Conquistado em {{ $achievement['date'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 0; $i < 3; $i++)
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

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