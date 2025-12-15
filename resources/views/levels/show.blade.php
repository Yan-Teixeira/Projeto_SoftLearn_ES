<x-app-layout>
    {{-- Importando bibliotecas via CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Scripts necessários --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Container Principal (Ocupa a tela menos o header da AppLayout) --}}
    <div class="flex flex-col h-[calc(100vh-65px)] bg-gray-100 font-sans overflow-hidden">

        {{-- Cabeçalho da Missão --}}
        <div class="bg-white border-b border-gray-200 shadow-sm z-20 shrink-0">
            {{-- Topo --}}
            <div class="bg-slate-800 text-white p-3 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('levels.index') }}" class="text-gray-400 hover:text-white transition" title="Voltar">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <h1 class="text-lg font-bold flex items-center gap-2">
                        <i class="fa-solid fa-gamepad text-yellow-400"></i>
                        {{ $level->title }}
                    </h1>
                </div>
                <div>
                    {{-- O clique aqui dispara a validação no JS --}}
                    <button onclick="checkLevel()" class="bg-green-600 hover:bg-green-500 text-white px-4 py-1.5 rounded text-sm font-bold transition shadow-sm flex items-center gap-2 border border-green-700">
                        <i class="fa-solid fa-check-circle"></i> Verificar Resposta
                    </button>
                </div>
            </div>

            {{-- Descrição do Nível --}}
            <div id="mission-panel" class="px-4 py-3 bg-blue-50 border-b border-blue-100">
                <p class="text-sm text-slate-800 leading-tight">
                    <span class="font-bold bg-blue-200 text-blue-800 px-2 py-0.5 rounded text-xs mr-2">MISSÃO</span>
                    {!! $level->description !!}
                </p>
            </div>
        </div>

        {{-- Barra de Ferramentas --}}
        <div id="top-toolbar" class="bg-white border-b border-gray-200 px-4 py-2 flex items-center justify-between shrink-0 select-none">
            <div class="tool-group flex items-center gap-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mr-2 hidden sm:inline">Conexão:</span>
                <button onclick="setLinkType('Association')" id="btn-link-Association" class="tool-btn active group relative" title="Associação">
                    <span class="w-6 border-b-2 border-gray-600 block"></span> 
                    <span class="text-xs ml-1 hidden lg:inline">Assoc.</span>
                </button>
                <button onclick="setLinkType('Include')" id="btn-link-Include" class="tool-btn group relative" title="Include">
                    <span class="w-6 border-b-2 border-dashed border-gray-600 block"></span>
                    <span class="text-xs ml-1 hidden lg:inline">Include</span>
                </button>
                <button onclick="setLinkType('Extend')" id="btn-link-Extend" class="tool-btn group relative" title="Extend">
                    <span class="w-6 border-b-2 border-dashed border-gray-600 block"></span>
                    <span class="text-xs ml-1 hidden lg:inline">Extend</span>
                </button>
                <button onclick="setLinkType('Generalization')" id="btn-link-Generalization" class="tool-btn group relative" title="Generalização">
                    <i class="fa-solid fa-caret-up text-gray-600"></i>
                    <span class="text-xs ml-1 hidden lg:inline">Generaliz.</span>
                </button>
            </div>
            
            <div class="text-xs text-gray-400 flex items-center gap-4">
                <span class="hidden md:flex items-center gap-1"><i class="fa-solid fa-mouse-pointer"></i> 2 Cliques: Renomear</span>
                <span class="hidden md:flex items-center gap-1"><i class="fa-regular fa-keyboard"></i> Delete: Apagar</span>
            </div>
        </div>

        {{-- Área Principal --}}
        <div class="flex flex-1 overflow-hidden relative">
            
            {{-- PALETA --}}
            <div class="w-64 bg-white border-r border-gray-300 flex flex-col shadow-lg z-10 overflow-y-auto shrink-0 select-none">
                <div class="p-3 bg-gray-50 border-b border-gray-200 font-bold text-gray-500 text-xs tracking-wide uppercase">
                    Elementos
                </div>
                
                <div class="p-3 space-y-3">
                    <div class="draggable-item bg-white p-2 border rounded shadow-sm flex items-center gap-3 cursor-grab hover:border-blue-400 hover:bg-blue-50 transition-all" 
                         draggable="true" ondragstart="dragStart(event, 'actor')">
                        <div class="w-8 flex justify-center text-slate-700 text-2xl"><i class="fa-solid fa-user"></i></div>
                        <span class="text-sm font-medium text-slate-700">Ator</span>
                    </div>

                    <div class="draggable-item bg-white p-2 border rounded shadow-sm flex items-center gap-3 cursor-grab hover:border-blue-400 hover:bg-blue-50 transition-all" 
                         draggable="true" ondragstart="dragStart(event, 'usecase')">
                        <div class="w-10 h-6 border-2 border-blue-800 rounded-[50%] bg-blue-50"></div>
                        <span class="text-sm font-medium text-slate-700">Caso de Uso</span>
                    </div>

                    <div class="draggable-item bg-white p-2 border rounded shadow-sm flex items-center gap-3 cursor-grab hover:border-blue-400 hover:bg-blue-50 transition-all" 
                         draggable="true" ondragstart="dragStart(event, 'system')">
                        <div class="w-8 h-8 border-2 border-gray-600 flex items-start justify-start p-[1px]">
                             <div class="w-3 h-2 bg-gray-600"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Fronteira</span>
                    </div>
                </div>
            </div>

            {{-- CANVAS --}}
            <div class="flex-1 relative bg-slate-100 overflow-auto" id="scroll-container">
                <div id="diagram-canvas" class="w-[2000px] h-[2000px] relative top-0 left-0 outline-none z-0 bg-white shadow-sm" 
                     ondrop="drop(event)" ondragover="allowDrop(event)">
                </div>
            </div>
            
            {{-- MENUS DE CONTEXTO --}}
            <div id="canvas-context-menu" class="hidden absolute bg-white border border-gray-200 shadow-xl rounded-lg z-[2000] min-w-[180px] py-1 overflow-hidden">
                <button onclick="addActorAtMouse()" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-user w-4 text-center text-slate-400"></i> Adicionar Ator</button>
                <button onclick="addUseCaseAtMouse()" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3 transition-colors"><div class="w-4 h-2 border border-current rounded-[50%] text-slate-400"></div> Adicionar Caso de Uso</button>
                <button onclick="addSystemAtMouse()" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-regular fa-square w-4 text-center text-slate-400"></i> Adicionar Sistema</button>
            </div>

            <div id="custom-context-menu" class="hidden absolute bg-white border border-gray-200 shadow-xl rounded-lg z-[1000] min-w-[160px] py-1 overflow-hidden">
                <button onclick="handleContextRename()" id="ctx-rename" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-pen w-4 text-center text-slate-400"></i> Renomear</button>
                <button onclick="handleContextRemoveFromGroup()" id="ctx-remove-group" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3 transition-colors"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-slate-400"></i> Sair do Grupo</button>
                <div class="h-px bg-gray-100 my-1"></div>
                <button onclick="handleContextDelete()" id="ctx-delete" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-3 transition-colors"><i class="fa-solid fa-trash w-4 text-center"></i> Excluir</button>
            </div>
        </div>
    </div>

    {{-- ESTILOS CSS --}}
    <style>
        #diagram-canvas { background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px; user-select: none; -webkit-user-select: none; }
        .tool-btn { padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 500; color: #475569; background: white; border: 1px solid #e2e8f0; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
        .tool-btn:hover { background: #f8fafc; border-color: #94a3b8; }
        .tool-btn.active { background: #eff6ff; border-color: #3b82f6; color: #2563eb; box-shadow: 0 0 0 1px rgba(59, 130, 246, 0.5); }
        .diagram-node { position: absolute; z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: box-shadow 0.2s; user-select: none; cursor: move; }
        .diagram-node.selected { outline: 2px dashed #2563eb; outline-offset: 4px; z-index: 50; }
        .diagram-node:hover { z-index: 50; }
        .port { position: absolute; width: 10px; height: 10px; background-color: #94a3b8; border: 2px solid #ffffff; border-radius: 50%; cursor: crosshair; z-index: 60; opacity: 0; pointer-events: none; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .port:hover { background-color: #3b82f6; transform: scale(1.3); }
        .port-t { top: -5px; left: 50%; transform: translateX(-50%); }
        .port-r { top: 50%; right: -5px; transform: translateY(-50%); }
        .port-b { bottom: -5px; left: 50%; transform: translateX(-50%); }
        .port-l { top: 50%; left: -5px; transform: translateY(-50%); }
        .diagram-node:hover .port { opacity: 1; pointer-events: auto; }
        .node-actor svg { width: 100%; height: 60px; stroke: #334155; fill: #f8fafc; stroke-width: 2; pointer-events: none; }
        .node-actor .label-text { margin-top: 5px; font-size: 12px; font-weight: bold; text-align: center; background: rgba(255,255,255,0.9); padding: 2px 6px; border-radius: 4px; cursor: text; min-width: 40px; border: 1px solid transparent; }
        .node-actor .label-text:hover { border-color: #cbd5e1; }
        .node-actor { width: 60px; height: 90px; }
        .node-usecase { width: 140px; height: 70px; background: #eff6ff; border: 2px solid #1e3a8a; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .node-usecase .label-text { text-align: center; font-size: 13px; line-height: 1.2; color: #1e3a8a; cursor: text; min-width: 20px; pointer-events: auto; }
        .node-system { width: 300px; height: 400px; border: 2px solid #475569; background: rgba(255, 255, 255, 0.6); display: block; overflow: visible; z-index: 5; padding-top: 30px; cursor: default; }
        .node-system .system-title { position: absolute; top: 0; left: 0; width: 100%; background: #e2e8f0; padding: 6px; font-weight: bold; text-align: center; font-size: 14px; cursor: text; border-bottom: 1px solid #cbd5e1; color: #334155; }
        [contenteditable="true"] { outline: none; border-bottom: 1px dashed transparent; user-select: text; -webkit-user-select: text; cursor: text; }
        [contenteditable="true"]:focus { border-bottom: 1px dashed #3b82f6; background: white; color: #000; }
        .jtk-connector { z-index: 9; }
        .jtk-overlay { background-color: white; padding: 2px 6px; font-size: 11px; border: 1px solid #cbd5e1; border-radius: 4px; z-index: 1000 !important; cursor: pointer; color: #475569; position: absolute; font-family: monospace; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    </style>

    {{-- Script de Inicialização --}}
    <script>
        // Passa os dados do nível atual do PHP para o JS
        window.currentLevelData = @json($level);
        
        // Define as rotas para o JS usar
        window.completeLevelUrl = "{{ route('levels.complete', $level) }}";
        window.levelsIndexUrl = "{{ route('levels.index') }}";
    </script>

    {{-- Carrega o Script do Jogo (crie este arquivo na pasta public/js) --}}
    <script src="{{ asset('js/uml-game.js') }}"></script>
</x-app-layout>