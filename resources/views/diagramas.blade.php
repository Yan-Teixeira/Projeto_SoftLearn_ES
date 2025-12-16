<x-app-layout>
    {{-- Importando bibliotecas via CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Scripts necessários --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Container Principal --}}
    <div class="flex flex-col h-[calc(100vh-65px)] bg-gray-50 dark:bg-gray-900 font-sans overflow-hidden transition-colors duration-300">

        {{-- ========================================== --}}
        {{-- CABEÇALHO SUPERIOR (Título e Ações)        --}}
        {{-- ========================================== --}}
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm z-30 shrink-0">
            <div class="flex justify-between items-center px-6 py-4 bg-slate-800 dark:bg-black text-white">
                <div class="flex items-center gap-5">
                    <a href="{{ route('levels.index') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 transition-colors text-white border border-white/10" title="Voltar para o Mapa">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-0.5">Desafio de Modelagem</div>
                        <h1 class="text-2xl font-black flex items-center gap-3 tracking-tight">
                            <span class="bg-yellow-500 text-slate-900 text-xs font-bold px-2 py-1 rounded shadow-sm">NÍVEL {{ $level->order ?? '?' }}</span>
                            {{ $level->title }}
                        </h1>
                    </div>
                </div>
                
                <button onclick="checkLevel()" class="group relative inline-flex items-center gap-3 px-8 py-3 bg-green-600 hover:bg-green-500 text-white font-bold rounded-xl shadow-lg shadow-green-900/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 border-b-4 border-green-800 active:border-b-0">
                    <i class="fa-solid fa-check-circle text-xl group-hover:animate-pulse"></i>
                    <span class="text-base">Verificar Solução</span>
                </button>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- PAINEL DE MISSÃO (Expandido e Destacado)   --}}
        {{-- ========================================== --}}
        <div id="mission-panel" class="relative z-20 shrink-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors">
            <!-- Padrão de fundo sutil para dar textura -->
            <div class="absolute inset-0 opacity-5 dark:opacity-10 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative px-8 py-8 max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    
                    {{-- Ícone Grande da Missão --}}
                    <div class="hidden md:flex shrink-0 w-20 h-20 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border-2 border-blue-100 dark:border-blue-800 items-center justify-center shadow-sm">
                        <i class="fa-solid fa-rocket text-4xl text-blue-600 dark:text-blue-400 drop-shadow-sm"></i>
                    </div>
                    
                    {{-- Conteúdo da Missão --}}
                    <div class="flex-1 space-y-4 w-full">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-sm">
                                <i class="fa-solid fa-crosshairs"></i>
                            </span>
                            <h3 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                Objetivo da Missão
                            </h3>
                        </div>
                        
                        {{-- Caixa de Texto Principal --}}
                        <div class="p-6 bg-slate-50 dark:bg-gray-700/50 rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm min-h-[120px] flex items-center">
                            <div class="text-xl md:text-2xl text-slate-800 dark:text-gray-100 leading-relaxed font-medium markdown-content w-full">
                                {!! $level->description !!}
                            </div>
                        </div>

                        {{-- Dicas/Tags (Opcional, visual apenas) --}}
                        <div class="flex flex-wrap gap-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wide">
                            <span class="flex items-center gap-1"><i class="fa-solid fa-circle-info"></i> Leia com atenção</span>
                            <span class="hidden sm:flex items-center gap-1 before:content-['•'] before:mx-2">Use os elementos da biblioteca</span>
                            <span class="hidden sm:flex items-center gap-1 before:content-['•'] before:mx-2">Conecte corretamente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- BARRA DE FERRAMENTAS (Toolbar)             --}}
        {{-- ========================================== --}}
        <div id="top-toolbar" class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3 flex items-center justify-between shrink-0 select-none transition-colors shadow-sm relative z-10">
            <div class="tool-group flex items-center gap-4 overflow-x-auto pb-1 md:pb-0">
                <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-bezier-curve"></i> Conexões:
                </span>
                
                <button onclick="setLinkType('Association')" id="btn-link-Association" class="tool-btn active group" title="Associação">
                    <span class="h-[3px] w-8 bg-slate-600 dark:bg-slate-400 group-hover:bg-blue-600 mb-1 rounded-full"></span>
                    <span class="text-[10px] font-bold uppercase">Assoc.</span>
                </button>
                <button onclick="setLinkType('Include')" id="btn-link-Include" class="tool-btn group" title="Include">
                    <div class="flex items-center w-8 mb-1">
                        <span class="h-[2px] w-full border-t-2 border-dashed border-slate-600 dark:border-slate-400"></span>
                        <i class="fa-solid fa-angle-right text-[10px] -ml-1 text-slate-600 dark:text-slate-400"></i>
                    </div>
                    <span class="text-[10px] font-bold uppercase">Include</span>
                </button>
                <button onclick="setLinkType('Extend')" id="btn-link-Extend" class="tool-btn group" title="Extend">
                    <div class="flex items-center w-8 mb-1">
                        <span class="h-[2px] w-full border-t-2 border-dashed border-slate-600 dark:border-slate-400"></span>
                        <i class="fa-solid fa-angle-right text-[10px] -ml-1 text-slate-600 dark:text-slate-400"></i>
                    </div>
                    <span class="text-[10px] font-bold uppercase">Extend</span>
                </button>
                <button onclick="setLinkType('Generalization')" id="btn-link-Generalization" class="tool-btn group" title="Generalização">
                    <div class="flex items-center w-8 mb-1">
                        <span class="h-[3px] w-full bg-slate-600 dark:bg-slate-400 rounded-l-full"></span>
                        <i class="fa-solid fa-play text-[10px] -ml-1.5 text-slate-600 dark:text-slate-400 rotate-0"></i>
                    </div>
                    <span class="text-[10px] font-bold uppercase">Generaliz.</span>
                </button>
            </div>
            
            <div class="hidden xl:flex items-center gap-6 text-xs font-medium text-slate-500 dark:text-slate-400 bg-gray-50 dark:bg-gray-700/50 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700">
                <span class="flex items-center gap-2"><i class="fa-solid fa-mouse-pointer text-blue-500"></i> Clique: Selecionar</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-pen text-green-500"></i> 2x Clique: Editar</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-trash text-red-500"></i> Delete: Apagar</span>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- ÁREA DE TRABALHO (Sidebar + Canvas)        --}}
        {{-- ========================================== --}}
        <div class="flex flex-1 overflow-hidden relative">
            
            {{-- PALETA LATERAL --}}
            <div class="w-72 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-10 overflow-y-auto shrink-0 select-none transition-colors">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-toolbox text-blue-500"></i> Ferramentas
                    </h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Arraste os elementos para o quadro</p>
                </div>
                
                <div class="p-5 space-y-4">
                    {{-- Item: Ator --}}
                    <div class="draggable-item group bg-white dark:bg-gray-700 p-4 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-gray-600 cursor-grab transition-all flex items-center gap-4" 
                         draggable="true" ondragstart="dragStart(event, 'actor')">
                        <div class="w-10 h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg text-slate-700 dark:text-slate-200 text-2xl group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide">Ator</span>
                    </div>

                    {{-- Item: Caso de Uso --}}
                    <div class="draggable-item group bg-white dark:bg-gray-700 p-4 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-gray-600 cursor-grab transition-all flex items-center gap-4" 
                         draggable="true" ondragstart="dragStart(event, 'usecase')">
                        <div class="w-10 h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg">
                            <div class="w-8 h-5 border-2 border-slate-600 dark:border-slate-300 rounded-[50%] group-hover:border-blue-600 dark:group-hover:border-blue-400 transition-colors bg-white dark:bg-gray-700"></div>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide">Caso de Uso</span>
                    </div>

                    {{-- Item: Sistema --}}
                    <div class="draggable-item group bg-white dark:bg-gray-700 p-4 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-gray-600 cursor-grab transition-all flex items-center gap-4" 
                         draggable="true" ondragstart="dragStart(event, 'system')">
                        <div class="w-10 h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg">
                            <i class="fa-regular fa-square text-2xl text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors"></i>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide">Sistema</span>
                    </div>
                </div>
            </div>

            {{-- CANVAS --}}
            <div class="flex-1 relative bg-gray-100 dark:bg-gray-950 overflow-auto" id="scroll-container">
                <div id="diagram-canvas" class="w-[2000px] h-[2000px] relative top-0 left-0 outline-none z-0 shadow-inner" 
                     ondrop="drop(event)" ondragover="allowDrop(event)">
                </div>
            </div>
            
            {{-- MENUS DE CONTEXTO (Invisíveis até serem chamados) --}}
            @include('components.diagram-context-menus') {{-- Opcional se quiser extrair, mas mantendo aqui abaixo por simplicidade --}}
            
            <div id="canvas-context-menu" class="hidden absolute bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-2xl rounded-lg z-[2000] min-w-[200px] py-1 overflow-hidden font-sans">
                <div class="px-3 py-2 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Adicionar Elemento</div>
                <button onclick="addActorAtMouse()" class="w-full text-left px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-user w-5 text-center text-slate-400"></i> Ator</button>
                <button onclick="addUseCaseAtMouse()" class="w-full text-left px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 flex items-center gap-3 transition-colors"><div class="w-5 h-3 border border-current rounded-[50%] text-slate-400"></div> Caso de Uso</button>
                <button onclick="addSystemAtMouse()" class="w-full text-left px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-regular fa-square w-5 text-center text-slate-400"></i> Sistema</button>
            </div>

            <div id="custom-context-menu" class="hidden absolute bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-2xl rounded-lg z-[1000] min-w-[180px] py-1 overflow-hidden font-sans">
                <button onclick="handleContextRename()" id="ctx-rename" class="w-full text-left px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-pen w-4 text-center text-slate-400"></i> Renomear</button>
                <button onclick="handleContextRemoveFromGroup()" id="ctx-remove-group" class="w-full text-left px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-slate-400"></i> Sair do Grupo</button>
                <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                <button onclick="handleContextDelete()" id="ctx-delete" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-3 transition-colors"><i class="fa-solid fa-trash w-4 text-center"></i> Excluir</button>
            </div>
        </div>
    </div>

    {{-- ESTILOS CSS --}}
    <style>
        /* CANVAS GRID */
        #diagram-canvas { 
            background-size: 20px 20px; 
            user-select: none; 
            background-color: #f3f4f6; /* gray-100 */
            background-image: radial-gradient(#d1d5db 1px, transparent 1px); 
        }
        .dark #diagram-canvas {
            background-color: #0f172a; /* slate-900 */
            background-image: radial-gradient(#334155 1px, transparent 1px);
        }

        /* TOOLBAR BUTTONS */
        .tool-btn { 
            padding: 8px 12px; 
            border-radius: 8px; 
            background: transparent; 
            border: 1px solid transparent; 
            cursor: pointer; 
            transition: all 0.2s; 
            display: flex; 
            flex-direction: column;
            align-items: center; 
            color: #64748b; /* slate-500 */
        }
        .dark .tool-btn { color: #94a3b8; }
        
        .tool-btn:hover { background: rgba(0,0,0,0.05); color: #0f172a; }
        .dark .tool-btn:hover { background: rgba(255,255,255,0.05); color: #f8fafc; }

        .tool-btn.active { 
            background: #eff6ff; 
            border-color: #bfdbfe; 
            color: #2563eb; 
            box-shadow: 0 1px 2px rgba(37,99,235,0.1); 
        }
        .dark .tool-btn.active {
            background: #1e293b;
            border-color: #3b82f6;
            color: #60a5fa;
        }

        /* MARKDOWN HIGHLIGHTS */
        .markdown-content strong { 
            color: #2563eb; 
            font-weight: 800; 
            background: rgba(37, 99, 235, 0.1); 
            padding: 0 4px; 
            border-radius: 4px; 
        }
        .dark .markdown-content strong {
            color: #60a5fa;
            background: rgba(96, 165, 250, 0.15);
        }

        /* NODES */
        .diagram-node { position: absolute; z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: box-shadow 0.2s; user-select: none; cursor: move; }
        .diagram-node.selected { outline: 2px dashed #2563eb; outline-offset: 4px; z-index: 50; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        .diagram-node:hover { z-index: 50; }
        
        /* PORTS */
        .port { position: absolute; width: 12px; height: 12px; background-color: #94a3b8; border: 2px solid #ffffff; border-radius: 50%; cursor: crosshair; z-index: 60; opacity: 0; transition: all 0.2s; }
        .diagram-node:hover .port { opacity: 1; }
        .port-t { top: -6px; left: 50%; transform: translateX(-50%); }
        .port-r { top: 50%; right: -6px; transform: translateY(-50%); }
        .port-b { bottom: -6px; left: 50%; transform: translateX(-50%); }
        .port-l { top: 50%; left: -6px; transform: translateY(-50%); }

        /* NODE STYLES */
        .node-actor svg { width: 100%; height: 65px; stroke: #334155; fill: #f1f5f9; stroke-width: 2; pointer-events: none; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.1)); }
        .dark .node-actor svg { stroke: #cbd5e1; fill: #1e293b; }
        .node-actor .label-text { margin-top: 4px; font-size: 13px; font-weight: bold; text-align: center; background: rgba(255,255,255,0.95); padding: 2px 8px; border-radius: 6px; cursor: text; min-width: 60px; border: 1px solid transparent; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .dark .node-actor .label-text { background: rgba(30, 41, 59, 0.9); color: #e2e8f0; }
        .node-actor { width: 70px; height: 100px; }

        .node-usecase { width: 160px; height: 80px; background: linear-gradient(to bottom right, #eff6ff, #dbeafe); border: 2px solid #1e40af; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .dark .node-usecase { background: #1e293b; border-color: #60a5fa; box-shadow: none; }
        .node-usecase .label-text { text-align: center; font-size: 14px; font-weight: 600; line-height: 1.2; color: #1e3a8a; cursor: text; min-width: 30px; pointer-events: auto; }
        .dark .node-usecase .label-text { color: #bfdbfe; }

        .node-system { width: 350px; height: 450px; border: 3px solid #475569; background: rgba(255, 255, 255, 0.9); display: block; overflow: visible; z-index: 5; padding-top: 40px; cursor: default; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-radius: 4px; }
        .dark .node-system { border-color: #94a3b8; background: rgba(15, 23, 42, 0.6); }
        .node-system .system-title { position: absolute; top: 0; left: 0; width: 100%; background: #e2e8f0; padding: 8px; font-weight: 800; text-align: center; font-size: 15px; cursor: text; border-bottom: 2px solid #cbd5e1; color: #334155; text-transform: uppercase; letter-spacing: 0.05em; }
        .dark .node-system .system-title { background: #334155; border-bottom-color: #475569; color: #e2e8f0; }

        /* EDIÇÃO DE TEXTO */
        [contenteditable="true"] { outline: none; border-bottom: 1px dashed transparent; user-select: text; -webkit-user-select: text; cursor: text; transition: border 0.2s; }
        [contenteditable="true"]:focus { border-bottom: 1px dashed #3b82f6; background: rgba(255,255,255,1); color: #000; }
        .dark [contenteditable="true"]:focus { background: rgba(30, 41, 59, 0.8); color: white; }

        /* JSPLUMB / LINHAS */
        .jtk-connector { z-index: 9; }
        .jtk-overlay { background-color: white; padding: 3px 8px; font-size: 11px; font-weight: bold; border: 1px solid #cbd5e1; border-radius: 12px; z-index: 1000 !important; cursor: pointer; color: #475569; position: absolute; font-family: monospace; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .dark .jtk-overlay { background-color: #1e293b; border-color: #475569; color: #cbd5e1; }
    </style>

    {{-- Script de Inicialização --}}
    <script>
        window.currentLevelData = @json($level);
        window.completeLevelUrl = "{{ route('levels.complete', $level) }}";
        window.levelsIndexUrl = "{{ route('levels.index') }}";
    </script>

    {{-- Carrega o Script do Jogo --}}
    <script src="{{ asset('js/uml-game.js') }}"></script>
</x-app-layout>