<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SoftLearn - Transforme sua carreira com aprendizado prático</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="antialiased bg-white w-full">
        <header class="bg-white shadow-sm">
            <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <div>
                    <a href="/" class="text-2xl font-bold text-gray-800">
                        SOFTLEARN
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="#modulos" class="text-gray-600 hover:text-gray-900">Módulos</a>
                    <a href="#sobre-nos" class="text-gray-600 hover:text-gray-900">Sobre Nós</a>
                    <a href="#precos" class="text-gray-600 hover:text-gray-900">Preços</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700">
                        Criar conta
                    </a>
                </div>
            </nav>
        </header>
        <main>
            <div class="bg-white relative">
                <div class="absolute inset-0 overflow-hidden z-0 opacity-60 w-full"> 
                    <video
                        autoplay loop muted playsinline 
                        class="absolute top-1/2 left-1/2 min-w-full min-h-full object-cover -translate-x-1/2 -translate-y-1/2" 
                        preload="auto"
                    >
                        <source src="/videos/video-class.mp4" type="video/mp4">
                        Seu navegador não suporta a tag de vídeo.
                    </video>
                </div>
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 z-50">
                    <div class="max-w-3xl mx-auto text-center ">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight opacity-90">
                            Aprenda, pratique e transforme sua carreira
                        </h1>
                        
                        <p class="mt-6 text-lg text-grey-700 opacity-90">
                            Junte-se a milhares de alunos na plataforma que une teoria, prática com flashcards, diagramas e gamificação.
                        </p>

                        <div class="mt-10">
                            <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-3 rounded-md text-lg font-medium hover:bg-green-700 opacity-90">
                                Comece a aprender
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
            

            <div id="modulos" class="py-16 md:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                            Explore nossos principais módulos
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Comece sua jornada com os conteúdos mais acessados da plataforma.
                        </p>
                    </div>

                   <div x-data="{ page: 1, totalPages: 2 }" class="relative">
                        <div class="relative min-h-[530px]">  
                            <div x-show="page === 1" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0">
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="/img/img_scrum.png" class="" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 1: Fundamentos do Scrum</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Aprenda os conceitos básicos, papéis e cerimônias do Scrum.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">2 / 5 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 40%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="/img/umlCLass.png" class="" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 2: Diagramas UML</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Domine Casos de Uso, Diagramas de Classe e Sequência.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">0 / 8 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="/img/Agile.png" class="block m-0" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 3: Métodos Ágeis</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Uma visão geral sobre Kanban, XP e outros métodos.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">4 / 4 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-show="page === 2" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0" style="display: none;">
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="/img/DevOps.png" class="" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 4: DevOps Básico</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Aprenda sobre CI/CD, Docker e automação de deploy.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">0 / 6 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="img/SQL.png" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 5: Banco de Dados</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Entenda SQL, NoSQL e como modelar dados relacionais.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">1 / 10 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 10%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden"><img src="img/front-green.svg" alt=""></div>
                                        <div class="p-6 flex-grow flex flex-col">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Módulo 6: Front-end Avançado</h3>
                                            <p class="text-gray-600 text-sm mb-4 flex-grow">Conceitos de performance, SSR e frameworks reativos.</p>
                                            <div class="mb-4">
                                                <span class="text-sm font-medium text-gray-700">3 / 7 aulas</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1"><div class="bg-green-600 h-2 rounded-full" style="width: 42%"></div></div>
                                            </div>
                                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">Iniciar Módulo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button @click="page = (page === 1) ? totalPages : page - 1"
                                class="absolute top-1/2 -left-4 md:-left-8 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="page = (page === totalPages) ? 1 : page + 1"
                                class="absolute top-1/2 -right-4 md:-right-8 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div id="recursos" class="bg-white pb-16 md:pb-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                            Uma plataforma completa para o seu aprendizado
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Nossas ferramentas são desenhadas para acelerar sua jornada da teoria à prática.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        
                        <div class="p-6">
                            <div class="w-16 h-16 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M5 7h14"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Flashcards</h3>
                            <p class="text-gray-600">
                                Memorize conceitos-chave de forma eficiente com nosso sistema de revisão espaçada.
                            </p>
                        </div>

                        <div class="p-6">
                            <div class="w-16 h-16 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Diagramas</h3>
                            <p class="text-gray-600">
                                Crie e visualize diagramas UML, fluxogramas e mais, direto na plataforma.
                            </p>
                        </div>

                        <div class="p-6">
                            <div class="w-16 h-16 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Gamificação</h3>
                            <p class="text-gray-600">
                                Ganhe pontos, suba de nível e mantenha-se motivado com nosso sistema de progresso.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                            O que nossos alunos dizem
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Veja como o SoftLearn ajudou a transformar a carreira de outros desenvolvedores.
                        </p>
                    </div>

                    <div x-data="{ page: 1, totalPages: 2 }" class="relative">
                        <div class="relative min-h-[320px]"> 
                            
                            <div x-show="page === 1" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"A combinação de flashcards e diagramas foi um divisor de águas..."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">A</span></div>
                                            <div>
                                                <div class="font-bold text-green-600">Ana Silva</div>
                                                <div class="text-sm text-gray-500">Desenvolvedora Back-end</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"Eu vinha do front-end e não tinha experiência com PHP ou Laravel..."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">B</span></div>
                                            <div>
                                                <div class="font-bold text-green-600">Bruno Costa</div>
                                                <div class="text-sm text-gray-500">Desenvolvedor Front-end</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"A gamificação não é só um truque. Ver minha barra de progresso..."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">C</span></div>
                                            <div>
                                                <div class="font-bold text-green-600">Carla Moreira</div>
                                                <div class="text-sm text-gray-500">Estudante de Eng. de Software</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div x-show="page === 2" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0" style="display: none;">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"O Assistente IA é incrível. Tira dúvidas de código na hora, sem precisar sair da plataforma."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">D</span></div>
                                            <div>
                                                <div class="font-bold text-green-600">Daniel Martins</div>
                                                <div class="text-sm text-gray-500">Engenheiro de DevOps</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"Nunca tinha entendido UML direito na faculdade. O módulo de diagramas é direto ao ponto."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">E</span></div>
                                            <div>
                                                <div class="font-bold text-green-800">Eduarda Farias</div>
                                                <div class="text-sm text-gray-500">Analista de Sistemas</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-sm p-8 h-full flex flex-col">
                                        <p class="text-gray-600 italic mb-6 flex-grow">"Consegui meu primeiro estágio depois de completar os módulos de Scrum e Métodos Ágeis."</p>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center mr-4"><span class="text-gray-500 text-xl">F</span></div>
                                            <div>
                                                <div class="font-bold text-green-600">Felipe Guedes</div>
                                                <div class="text-sm text-gray-500">Estudante</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button @click="page = (page === 1) ? totalPages : page - 1"
                                class="absolute top-1/2 -left-4 md:-left-8 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="page = (page === totalPages) ? 1 : page + 1"
                                class="absolute top-1/2 -right-4 md:-right-8 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div id="sobre-nos" class="bg-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                                Construído para quem aprende na prática
                            </h2>
                            <p class="text-lg text-gray-600 mb-4">
                                O SoftLearn nasceu de um projeto de Engenharia de Software com um objetivo claro: criar uma plataforma onde os alunos não apenas assistem, mas ativamente praticam o que aprendem.
                            </p>
                            <p class="text-gray-600 mb-4">
                                Nós acreditamos que a verdadeira maestria vem da aplicação. É por isso que integramos ferramentas como <b>Flashcards</b> para memorização, <b>Diagramas UML</b> para visualização de arquitetura e um sistema de <b>Gamificação</b> para manter você motivado.
                            </p>
                            <p class="text-gray-600">
                                Seja você um estudante começando ou um desenvolvedor front-end se aventurando no back-end (como você!), nossa plataforma é o seu campo de treino.
                            </p>
                        </div>

                        <div class="flex items-center justify-center bg-gray-100 rounded-lg h-80">
                            <span class="text-gray-500"><img src="/img/Coruja Estudiosa com Óculos e Livro 2.svg" alt=""></span>
                        </div>

                    </div>
                </div>
            </div>
            
            <div id="precos" class="py-16 md:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                            Escolha o plano ideal para você
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Comece de graça e evolua quando estiver pronto.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 flex flex-col">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Gratuito</h3>
                            <p class="text-gray-600 mb-6 flex-grow">Acesso essencial para começar sua jornada de aprendizado.</p>
                            <div class="text-4xl font-bold text-gray-900 mb-6">
                                R$0 <span class="text-lg font-normal text-gray-500">/mês</span>
                            </div>
                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Acesso a todos os módulos</li>
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Criação de Flashcards</li>
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Diagramas UML</li>
                            </ul>
                            <a href="{{ route('register') }}" class="w-full text-center bg-gray-800 text-white px-6 py-3 rounded-md font-medium hover:bg-gray-900">
                                Comece agora
                            </a>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg border border-green-600 p-8 flex flex-col relative">
                            <span class="absolute top-0 right-8 -mt-3 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full">MAIS POPULAR</span>
                            
                            <h3 class="text-2xl font-bold text-green-700 mb-4">Plano Pro</h3>
                            <p class="text-gray-600 mb-6 flex-grow">Desbloqueie todo o potencial da plataforma.</p>
                            <div class="text-4xl font-bold text-gray-900 mb-6">
                                R$29 <span class="text-lg font-normal text-gray-500">/mês</span>
                            </div>
                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Tudo do plano Gratuito</li>
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Assistente IA ilimitado</li>
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Certificados de conclusão</li>
                                <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Suporte prioritário</li>
                            </ul>
                            <a href="{{ route('register') }}" class="w-full text-center bg-green-600 text-white px-6 py-3 rounded-md font-medium hover:bg-green-700">
                                Comece o Pro
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        <footer class="bg-white border-t border-gray-200 mt-16 md:mt-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div>
                        <a href="/" class="text-2xl font-bold text-gray-800">
                            SOFTLEARN
                        </a>
                        <p class="mt-4 text-gray-500 text-sm">
                            Aprenda, pratique e transforme sua carreira.
                        </p>
                        <p class="mt-6 text-gray-400 text-xs">
                            © 2025 SoftLearn. Todos os direitos reservados.
                        </p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900">Plataforma</h4>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#modulos" class="text-gray-600 hover:text-gray-900 text-sm">Módulos</a></li>
                            <li><a href="#recursos" class="text-gray-600 hover:text-gray-900 text-sm">Flashcards</a></li>
                            <li><a href="#recursos" class="text-gray-600 hover:text-gray-900 text-sm">Diagramas</a></li>
                            <li><a href="#recursos" class="text-gray-600 hover:text-gray-900 text-sm">Gamificação</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900">Empresa</h4>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#sobre-nos" class="text-gray-600 hover:text-gray-900 text-sm">Sobre Nós</a></li>
                            <li><a href="#precos" class="text-gray-600 hover:text-gray-900 text-sm">Preços</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm">Entrar</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 text-sm">Criar conta</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>
    </body>
</html>