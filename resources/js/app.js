// IMPORTANTE: Este arquivo assume que o jsPlumb foi carregado globalmente via CDN no blade.
import './bootstrap';
import './settings.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('reviewSession', () => ({
        showAnswer: false,

        // Inicialização
        init() {
            // Foca no container para capturar eventos de teclado se necessário
            this.$el.focus();
        },

        // Ação para revelar a resposta do cartão
        reveal() {
            this.showAnswer = true;
        },

        // Submete o formulário baseado no valor do status
        submitReview(statusValue) {
            // Procura um botão dentro do componente que tenha o valor correspondente
            // Ex: <button name="status" value="easy">
            const button = this.$el.querySelector(`button[name="status"][value="${statusValue}"]`);

            if (button) {
                button.click(); // Simula o clique para enviar o formulário
            } else {
                console.warn(`Botão para o status '${statusValue}' não encontrado.`);
            }
        },

        // Gerenciamento de atalhos de teclado
        handleKeydown(event) {
            // Ignora se o usuário estiver digitando em um input/textarea
            if (['INPUT', 'TEXTAREA'].includes(event.target.tagName)) return;

            // 1. Revelar Resposta (Espaço)
            if (!this.showAnswer && (event.code === 'Space' || event.key === ' ')) {
                event.preventDefault(); // Previne o scroll da página
                this.reveal();
                return;
            }

            // 2. Submeter Revisão (Teclas 1, 2, 3, 4) - APENAS se a resposta estiver visível
            if (this.showAnswer) {
                switch (event.key) {
                    case '1':
                        this.submitReview('again');
                        break;
                    case '2':
                        this.submitReview('hard');
                        break;
                    case '3':
                        this.submitReview('good');
                        break;
                    case '4':
                        this.submitReview('easy');
                        break;
                }
            }
        }
    }));
});



Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const htmlElement = document.documentElement;
    const toggleButton = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    // Função auxiliar para atualizar a UI do botão (Sol/Lua)
    const updateIcons = (isDark) => {
        if (sunIcon && moonIcon) {
            if (isDark) {
                // Se está no modo Escuro, mostre a Lua (moon) e esconda o Sol (sun)
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');

            } else {
                // Se está no modo Claro, mostre o Sol (sun) e esconda a Lua (moon)
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');

            }
        }
    };

    // 1. Sincronização Inicial:
    // Garante que o ícone inicial esteja correto, baseado na classe 'dark' 
    // que já foi aplicada pelo script inline no <head>
    updateIcons(htmlElement.classList.contains('dark'));

    // 2. Lógica de Alternância (No Clique)
    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            let newTheme;
            let settings = {};
            const stored = localStorage.getItem('softlearn.settings');
            // Tenta carregar as configurações existentes
            if (stored) {
                try {
                    settings = JSON.parse(stored);
                } catch (e) {
                    console.error("Erro ao parsear settings:", e);
                }
            }
            // Alternar a classe 'dark' no <html>
            if (htmlElement.classList.contains('dark')) {
                // Se estava Dark, vai para Light
                htmlElement.classList.remove('dark');
                newTheme = 'light';
            } else {
                // Se estava Light (ou sistema), vai para Dark
                htmlElement.classList.add('dark');
                newTheme = 'dark';
            }
            // 3. Atualizar ícones e Salvar a Preferência
            updateIcons(newTheme === 'dark');

            // Salva o novo tema na estrutura de settings que você já usa
            settings.theme = newTheme;
            localStorage.setItem('softlearn.settings', JSON.stringify(settings));
        });
    }
});





















// Variáveis Globais de Estado
// IMPORTANTE: Este arquivo assume que o jsPlumb foi carregado globalmente via CDN no blade.

// Variáveis Globais de Estado
window.jsp = null; 
window.idCounter = 1;
window.currentLinkType = 'Association';
window.currentSelectedConn = null;
window.currentSelectedNodeId = null;
window.contextMenuPos = { x: 0, y: 0 }; 
window.contextMenuTargetId = null; 

// Configuração dos Tipos de Link
const linkTypes = {
    'Association': { 
        paintStyle: { stroke: "#334155", strokeWidth: 2, dashstyle: "0" },
        overlays: [],
        hoverPaintStyle: { stroke: "#2563eb", strokeWidth: 3 }
    },
    'Include': {
        paintStyle: { stroke: "#334155", strokeWidth: 2, dashstyle: "4 2" },
        overlays: [
            ["Arrow", { location: 1, width: 10, length: 10 }],
            ["Label", { label: "«include»", location: 0.5, cssClass: "jtk-overlay" }]
        ],
        hoverPaintStyle: { stroke: "#2563eb", strokeWidth: 3 }
    },
    'Extend': {
        paintStyle: { stroke: "#334155", strokeWidth: 2, dashstyle: "4 2" },
        overlays: [
            ["Arrow", { location: 1, width: 10, length: 10 }],
            ["Label", { label: "«extend»", location: 0.5, cssClass: "jtk-overlay" }]
        ],
        hoverPaintStyle: { stroke: "#2563eb", strokeWidth: 3 }
    },
    'Generalization': {
        paintStyle: { stroke: "#334155", strokeWidth: 2, dashstyle: "0" },
        overlays: [
            ["Arrow", { location: 1, width: 12, length: 12, foldback: 1, paintStyle: { fill: "#334155", stroke: "#334155", strokeWidth: 1.5 } }]
        ],
        hoverPaintStyle: { stroke: "#2563eb", strokeWidth: 3 }
    }
};

// Função auxiliar de geometria
function isElementInside(inner, outer) {
    if (!inner || !outer) return false;
    const i = inner.getBoundingClientRect();
    const o = outer.getBoundingClientRect();
    const cx = i.left + i.width / 2;
    const cy = i.top + i.height / 2;
    return (cx >= o.left && cx <= o.right && cy >= o.top && cy <= o.bottom);
}

// Validador de Regras
function validateRules(nodes, connections, rules) {
    console.log("Validando regras:", rules); // DEBUG

    if (!rules || Object.keys(rules).length === 0) {
        return { success: true, msg: "Nível livre (sem regras definidas)." };
    }

    // 1. Validar Nós
    if (rules.required_nodes) {
        for (let req of rules.required_nodes) {
            const found = nodes.find(n => n.text.toLowerCase().includes(req.name.toLowerCase()));
            if (!found) {
                return { success: false, msg: `Falta o elemento: '${req.name}'` + (req.type ? ` (${req.type})` : "") + "." };
            }
        }
    }

    // 2. Validar Grupos
    if (rules.required_groups) {
        for (let req of rules.required_groups) {
            const innerNode = nodes.find(n => n.text.toLowerCase().includes(req.inner.toLowerCase()));
            const outerNode = nodes.find(n => n.text.toLowerCase().includes(req.outer.toLowerCase()));
            
            // Se o nó não existe, o passo 1 já deve ter pego, mas garantimos aqui
            if (!innerNode) return { success: false, msg: `Elemento '${req.inner}' não encontrado.` };
            if (!outerNode) return { success: false, msg: `Elemento '${req.outer}' não encontrado.` };

            const innerEl = document.getElementById(innerNode.id);
            const outerEl = document.getElementById(outerNode.id);
            
            if (!isElementInside(innerEl, outerEl)) {
                return { success: false, msg: `O elemento '${innerNode.text}' deve estar visualmente DENTRO de '${outerNode.text}'.` };
            }
        }
    }

    // 3. Validar Conexões
    if (rules.required_connections) {
        for (let req of rules.required_connections) {
            const foundConn = connections.some(c => {
                const matchSource = c.sourceText.toLowerCase().includes(req.from.toLowerCase());
                const matchTarget = c.targetText.toLowerCase().includes(req.to.toLowerCase());
                const matchType = req.type ? (c.type === req.type) : true;
                return matchSource && matchTarget && matchType;
            });

            if (!foundConn) {
                let typeName = req.type === 'Include' ? '«include»' : (req.type === 'Extend' ? '«extend»' : req.type);
                return { 
                    success: false, 
                    msg: `Falta uma conexão${typeName ? " do tipo " + typeName : ""} de '${req.from}' para '${req.to}'.` 
                };
            }
        }
    }

    return { success: true, msg: "Desafio concluído com sucesso!" };
}

// Função Principal de Verificação (Conectada ao Laravel)
window.checkLevel = function() {
    console.log("Iniciando verificação..."); // DEBUG

    // Pega os dados DIRETAMENTE do window aqui dentro para garantir que estão carregados
    const currentLevel = window.currentLevelData || {};
    const rules = currentLevel.validation_rules || {};

    console.log("Dados do nível:", currentLevel); // DEBUG

    // Coletar dados dos Nós
    const nodeEls = document.querySelectorAll('.diagram-node');
    const nodes = Array.from(nodeEls).map(el => {
        const textEl = el.querySelector('.label-text, .system-title');
        return {
            id: el.id,
            type: getNodeType(el),
            text: textEl ? textEl.innerText.trim() : ""
        };
    });

    // Coletar dados das Conexões
    const conns = window.jsp.getAllConnections().map(c => {
        const sourceEl = document.getElementById(c.sourceId);
        const targetEl = document.getElementById(c.targetId);
        
        const sNode = sourceEl.classList.contains('diagram-node') ? sourceEl : sourceEl.closest('.diagram-node');
        const tNode = targetEl.classList.contains('diagram-node') ? targetEl : targetEl.closest('.diagram-node');

        const sText = sNode?.querySelector('.label-text, .system-title')?.innerText.trim() || "";
        const tText = tNode?.querySelector('.label-text, .system-title')?.innerText.trim() || "";

        return {
            type: c.getData().type || 'Association',
            sourceText: sText,
            targetText: tText
        };
    });

    console.log("Nós encontrados:", nodes); // DEBUG
    console.log("Conexões encontradas:", conns); // DEBUG

    // Validar
    const result = validateRules(nodes, conns, rules);

    if (result.success) {
        Swal.fire({
            title: 'Excelente!',
            text: result.msg,
            icon: 'success',
            confirmButtonColor: '#16a34a',
            confirmButtonText: 'Salvar e Concluir'
        }).then((res) => {
            if (res.isConfirmed) {
                submitLevelCompletion();
            }
        });
    } else {
        Swal.fire({
            title: 'Ainda não...',
            text: result.msg,
            icon: 'warning',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'Continuar Tentando'
        });
    }
}

// Envia requisição POST para o Laravel
function submitLevelCompletion() {
    const url = window.completeLevelUrl;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!url) {
        console.error("URL de conclusão não definida!");
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ score: 100 })
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
        } else {
            window.location.href = window.levelsIndexUrl || '/levels'; 
        }
    })
    .catch(error => {
        console.error('Erro ao salvar:', error);
        Swal.fire('Erro', 'Não foi possível salvar o progresso. Verifique o console.', 'error');
    });
}

// --- INICIALIZAÇÃO E CONFIGURAÇÃO ---

window.addEventListener('DOMContentLoaded', function() {
    initDiagram();
});

function initDiagram() {
    const canvas = document.getElementById('diagram-canvas');
    if (!canvas) return; 
    
    // Limpeza
    if (window.jsp) { try { window.jsp.reset(); } catch (e) {} }
    canvas.innerHTML = '';
    
    // Reset estado
    window.idCounter = 1;
    window.currentSelectedConn = null;
    window.currentSelectedNodeId = null;

    jsPlumb.ready(function() {
        window.jsp = jsPlumb.getInstance({
            Container: "diagram-canvas",
            Connector: ["Straight"],
            Endpoint: ["Dot", { radius: 1, cssClass: "opacity-0" }], 
            Anchor: "Continuous"
        });

        setupJsPlumbEvents();
        setupDomEvents();
    });
}

function setupJsPlumbEvents() {
    window.jsp.bind("connection", function(info) {
        if (!info.connection.getData().type) {
            applyLinkType(info.connection, window.currentLinkType);
        }
    });

    window.jsp.bind("click", function(conn, originalEvent) {
        deselectNode();
        if(window.currentSelectedConn && window.currentSelectedConn !== conn) {
             const type = window.currentSelectedConn.getData().type || 'Association';
             window.currentSelectedConn.setPaintStyle(linkTypes[type].paintStyle);
        }
        window.currentSelectedConn = conn;
        const currentType = conn.getData().type || 'Association';
        const currentDash = linkTypes[currentType].paintStyle.dashstyle;
        conn.setPaintStyle({ stroke: "#ef4444", strokeWidth: 3, dashstyle: currentDash });
        window.currentLinkType = currentType;
        updateToolbarUI(currentType);
        originalEvent.stopPropagation();
        hideContextMenu();
    });
}

function setupDomEvents() {
    const canvas = document.getElementById('diagram-canvas');
    canvas.addEventListener('click', function(e) {
        if (e.target.id === 'diagram-canvas') {
            deselectNode();
            deselectLink();
            hideContextMenu();
            if (document.activeElement && (document.activeElement.isContentEditable || document.activeElement.tagName === 'SPAN')) {
                document.activeElement.blur();
                window.getSelection().removeAllRanges();
            }
        }
    });

    canvas.addEventListener('contextmenu', function(e) {
        if (e.target.id === 'diagram-canvas') {
            e.preventDefault();
            const rect = e.target.getBoundingClientRect();
            window.contextMenuPos.x = e.clientX - rect.left;
            window.contextMenuPos.y = e.clientY - rect.top;
            showCanvasContextMenu(e.pageX, e.pageY);
        } else {
            hideContextMenu();
        }
    });
    
    document.addEventListener('click', hideContextMenu);
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Delete' || e.key === 'Backspace') {
            const activeEl = document.activeElement;
            if (activeEl.isContentEditable || activeEl.tagName === 'INPUT' || activeEl.tagName === 'TEXTAREA') return;
            if (window.currentSelectedNodeId) {
                removeNode(window.currentSelectedNodeId);
            } else if (window.currentSelectedConn) {
                window.jsp.deleteConnection(window.currentSelectedConn);
                window.currentSelectedConn = null;
            }
        }
    });
}

// --- INTERAÇÕES DE UI ---

window.setLinkType = function(type) {
    window.currentLinkType = type;
    updateToolbarUI(type);
    if (window.currentSelectedConn) {
        applyLinkType(window.currentSelectedConn, type);
        const newDash = linkTypes[type].paintStyle.dashstyle;
        window.currentSelectedConn.setPaintStyle({ stroke: "#ef4444", strokeWidth: 3, dashstyle: newDash });
    }
}

function updateToolbarUI(type) {
    document.querySelectorAll('#top-toolbar .tool-group .tool-btn').forEach(btn => btn.classList.remove('active'));
    const btn = document.getElementById(`btn-link-${type}`);
    if(btn) btn.classList.add('active');
}

window.dragStart = function(ev, type) { ev.dataTransfer.setData("type", type); }
window.allowDrop = function(ev) { ev.preventDefault(); }
window.drop = function(ev) {
    ev.preventDefault();
    const type = ev.dataTransfer.getData("type");
    const canvasRect = document.getElementById('diagram-canvas').getBoundingClientRect();
    const x = ev.clientX - canvasRect.left;
    const y = ev.clientY - canvasRect.top;
    const newId = createNode(type, x, y);
    setTimeout(() => { document.getElementById(newId); }, 50);
}

window.addActorAtMouse = function() { createNode('actor', window.contextMenuPos.x, window.contextMenuPos.y); hideContextMenu(); }
window.addUseCaseAtMouse = function() { createNode('usecase', window.contextMenuPos.x, window.contextMenuPos.y); hideContextMenu(); }
window.addSystemAtMouse = function() { createNode('system', window.contextMenuPos.x, window.contextMenuPos.y); hideContextMenu(); }

window.handleContextRename = function() {
    if (window.contextMenuTargetId) {
        const el = document.getElementById(window.contextMenuTargetId);
        const textEl = el.querySelector('.label-text, .system-title');
        if(textEl) {
            textEl.focus();
            const range = document.createRange();
            range.selectNodeContents(textEl);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
    hideContextMenu();
}

window.handleContextRemoveFromGroup = function() {
    if (window.contextMenuTargetId) {
        try { window.jsp.removeFromGroup(window.contextMenuTargetId); } catch(e) {}
    }
    hideContextMenu();
}

window.handleContextDelete = function() {
    if (window.contextMenuTargetId) { removeNode(window.contextMenuTargetId); }
    hideContextMenu();
}

window.saveImage = function() {
    const canvas = document.getElementById('diagram-canvas');
    const ports = document.querySelectorAll('.port');
    ports.forEach(p => p.style.display = 'none');
    html2canvas(canvas).then(canvasImg => {
        const link = document.createElement('a');
        link.download = 'diagrama-casos-de-uso.png';
        link.href = canvasImg.toDataURL();
        link.click();
        ports.forEach(p => p.style.display = '');
    });
}

// Funções Internas de Manipulação
function createNode(type, x, y, text = null) {
    const uniqueId = Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
    const id = `el-${uniqueId}`; 
    const canvas = document.getElementById('diagram-canvas');
    const el = document.createElement('div');
    el.id = id;
    el.style.left = `${x}px`;
    el.style.top = `${y}px`;
    el.className = `diagram-node node-${type}`;
    
    el.addEventListener('click', function(e) { e.stopPropagation(); selectNode(id); hideContextMenu(); });
    el.addEventListener('contextmenu', function(e) { e.preventDefault(); e.stopPropagation(); showNodeContextMenu(e, id); });
    el.addEventListener('dblclick', function(e) {
        e.stopPropagation(); hideContextMenu(); 
        const textEl = el.querySelector('.label-text, .system-title, span[contenteditable]');
        if(textEl) {
            textEl.focus();
            const range = document.createRange();
            range.selectNodeContents(textEl);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    });

    let portsHtml = `<div class="port port-t"></div><div class="port port-r"></div><div class="port port-b"></div><div class="port port-l"></div>`;
    
    let content = '';
    if (type === 'actor') {
        content = `${portsHtml}<svg viewBox="0 0 50 100"><circle cx="25" cy="15" r="10" /><line x1="25" y1="25" x2="25" y2="65" /><line x1="0" y1="35" x2="50" y2="35" /><line x1="25" y1="65" x2="0" y2="100" /><line x1="25" y1="65" x2="50" y2="100" /></svg><span class="label-text" contenteditable="true" spellcheck="false">${text || "Ator"}</span>`;
    } else if (type === 'usecase') {
        content = `${portsHtml}<span class="label-text" contenteditable="true" spellcheck="false">${text || "Caso de Uso"}</span>`;
    } else if (type === 'system') {
        content = `<div class="system-title" contenteditable="true" spellcheck="false">${text || "Sistema"}</div>`;
    }

    el.innerHTML = content;
    canvas.appendChild(el);

    if (type === 'system') makeResizable(el);

    const editableText = el.querySelector('[contenteditable="true"]');
    if(editableText) {
        editableText.addEventListener('blur', function() { window.getSelection().removeAllRanges(); });
        editableText.addEventListener('mousedown', function(e) { e.stopPropagation(); });
    }

    const dragFilter = "[contenteditable='true'], .port"; 
    setTimeout(() => {
        if (type === 'system') {
            try {
                window.jsp.addGroup({
                    el: el, id: id, constrain: false, orphan: true, droppable: true, dropOverride: true, draggable: true, dragOptions: { filter: dragFilter }
                });
            } catch (err) { window.jsp.draggable(el, { grid: [10, 10], filter: dragFilter }); }
        } else {
            window.jsp.draggable(el, { grid: [10, 10], filter: dragFilter });
            const ports = el.querySelectorAll('.port');
            ports.forEach(port => { window.jsp.makeSource(port, { parent: el, anchor: "Center", maxConnections: -1, filter: "" }); });
            window.jsp.makeTarget(el, { anchor: "Continuous", allowLoopback: false });
            
            const groupEl = getGroupAt(x, y, id);
            if(groupEl) { try { window.jsp.addToGroup(groupEl.id, el); } catch(e){} }
        }
    }, 0);
    return id;
}

function makeResizable(el) {
    const BORDER_SIZE = 15; 
    el.addEventListener('mousemove', function(e) {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left; const y = e.clientY - rect.top;
        const onLeft = x < BORDER_SIZE; const onRight = x > rect.width - BORDER_SIZE;
        const onTop = y < BORDER_SIZE; const onBottom = y > rect.height - BORDER_SIZE;

        if (onLeft && onTop) el.style.cursor = 'nwse-resize';
        else if (onRight && onBottom) el.style.cursor = 'nwse-resize';
        else if (onRight && onTop) el.style.cursor = 'nesw-resize';
        else if (onLeft && onBottom) el.style.cursor = 'nesw-resize';
        else if (onRight || onLeft) el.style.cursor = 'ew-resize';
        else if (onBottom || onTop) el.style.cursor = 'ns-resize';
        else el.style.cursor = 'default';
    });

    el.addEventListener('mousedown', function(e) {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left; const y = e.clientY - rect.top;
        const onLeft = x < BORDER_SIZE; const onRight = x > rect.width - BORDER_SIZE;
        const onTop = y < BORDER_SIZE; const onBottom = y > rect.height - BORDER_SIZE;
        if (!onLeft && !onRight && !onTop && !onBottom) return;

        e.preventDefault(); e.stopPropagation(); 
        const startX = e.clientX; const startY = e.clientY;
        const startWidth = rect.width; const startHeight = rect.height;
        const startLeft = el.offsetLeft; const startTop = el.offsetTop;

        function doDrag(e) {
            const dx = e.clientX - startX; const dy = e.clientY - startY;
            if (onRight) { const newW = startWidth + dx; if (newW > 150) el.style.width = newW + 'px'; }
            if (onBottom) { const newH = startHeight + dy; if (newH > 150) el.style.height = newH + 'px'; }
            if (onLeft) { const newW = startWidth - dx; if (newW > 150) { el.style.width = newW + 'px'; el.style.left = (startLeft + dx) + 'px'; } }
            if (onTop) { const newH = startHeight - dy; if (newH > 150) { el.style.height = newH + 'px'; el.style.top = (startTop + dy) + 'px'; } }
            window.jsp.revalidate(el);
        }
        function stopDrag() {
            document.documentElement.removeEventListener('mousemove', doDrag, false);
            document.documentElement.removeEventListener('mouseup', stopDrag, false);
        }
        document.documentElement.addEventListener('mousemove', doDrag, false);
        document.documentElement.addEventListener('mouseup', stopDrag, false);
    });
}

function showNodeContextMenu(e, id) {
    window.contextMenuTargetId = id; selectNode(id); 
    const menu = document.getElementById('custom-context-menu');
    const btnRemoveGroup = document.getElementById('ctx-remove-group');
    const el = document.getElementById(id);
    if (el.classList.contains('node-system')) btnRemoveGroup.style.display = 'none'; else btnRemoveGroup.style.display = 'flex';
    menu.style.display = 'block'; menu.style.left = e.pageX + 'px'; menu.style.top = e.pageY + 'px';
}

function showCanvasContextMenu(pageX, pageY) {
    const menu = document.getElementById('canvas-context-menu');
    menu.style.display = 'block'; menu.style.left = pageX + 'px'; menu.style.top = pageY + 'px';
}

function hideContextMenu() {
    document.getElementById('canvas-context-menu').style.display = 'none';
    document.getElementById('custom-context-menu').style.display = 'none';
}

function getNodeType(el) {
    if (el.querySelector('.fa-user') || el.querySelector('svg circle')) return 'actor';
    if (el.classList.contains('node-system')) return 'system';
    return 'usecase';
}

function getGroupAt(x, y, ignoreId) {
    const systems = document.querySelectorAll('.node-system');
    for(let sys of systems) {
        if(sys.id === ignoreId) continue;
        const rect = sys.getBoundingClientRect();
        const canvasRect = document.getElementById('diagram-canvas').getBoundingClientRect();
        const sysX = rect.left - canvasRect.left; const sysY = rect.top - canvasRect.top;
        if (x >= sysX && x <= sysX + rect.width && y >= sysY && y <= sysY + rect.height) return sys;
    }
    return null;
}

function removeNode(id) {
    const el = document.getElementById(id); if(!el) return;
    if(el.classList.contains('node-system')) { window.jsp.removeGroup(id, true); if(document.getElementById(id)) window.jsp.remove(id); } else { window.jsp.remove(id); }
    window.currentSelectedNodeId = null; hideContextMenu();
}

function applyLinkType(conn, type) {
    if (!conn) return; const config = linkTypes[type];
    conn.setPaintStyle(config.paintStyle); conn.setHoverPaintStyle(config.hoverPaintStyle);
    conn.removeAllOverlays();
    if (config.overlays) { config.overlays.forEach(ov => { conn.addOverlay(JSON.parse(JSON.stringify(ov))); }); }
    conn.setData({ type: type }); conn.repaint();
}

function selectNode(id) {
    deselectLink(); deselectNode(); window.currentSelectedNodeId = id;
    const el = document.getElementById(id); if(el) el.classList.add('selected');
}

function deselectNode() {
    if (window.currentSelectedNodeId) {
        const el = document.getElementById(window.currentSelectedNodeId);
        if(el) el.classList.remove('selected');
        window.currentSelectedNodeId = null;
    }
}

function deselectLink() {
    if(window.currentSelectedConn) {
         const type = window.currentSelectedConn.getData().type || 'Association';
         window.currentSelectedConn.setPaintStyle(linkTypes[type].paintStyle);
         window.currentSelectedConn = null;
    }
}