<!DOCTYPE html>
<html>
<head>
    <title>{{ $quiz['titulo'] }}</title>
    <link rel="stylesheet" href="/css/quiz.css">
    <style>
        .option.correct {
            background: #2ecc71 !important;
            color: white !important;
        }
        
        .option.wrong {
            background: #e74c3c !important;
            color: white !important;
        }
        
        #quiz-container.acerto {
            background-color: #2ecc71 !important;
        }
        
        #quiz-container.erro {
            background-color: #e74c3c !important;
        }
    </style>
</head>
<body>

<div id="quiz-container">

    <h2>{{ $quiz['titulo'] }}</h2>
    <h3>Pergunta {{ $index + 1 }}</h3>

    <p>{{ $question['pergunta'] }}</p>

    <div id="alternativas">
        @foreach ($question['alternativas'] as $key => $alt)
            <button
                class="option"
                data-key="{{ $key }}"
                data-correta="{{ $question['correta'] }}"
                onclick="responder(this)">
                {{ $key }}) {{ $alt }}
            </button>
        @endforeach
    </div>

    <div class="navigation">
        @if ($index > 0)
            <a href="/quiz/{{ $module }}/{{ $index - 1 }}" class="btn">⬅ Voltar</a>
        @endif

        @if ($index + 1 < count($quiz['perguntas']))
            <a id="btn-proximo" href="/quiz/{{ $module }}/{{ $index + 1 }}" class="btn" style="display:none;">
                Próximo ➡
            </a>
        @endif

        <a href="/quiz" class="btn secondary">Módulos</a>
    </div>

</div>

<script>
function responder(botao) {
    const marcada = botao.dataset.key;
    const correta = botao.dataset.correta;
    const container = document.getElementById('quiz-container');
    const botoes = document.querySelectorAll('.option');
    const btnProximo = document.getElementById('btn-proximo');

    // trava todos os botões
    botoes.forEach(b => b.disabled = true);

    if (marcada === correta) {
        // botão correto fica verde
        botao.classList.add('correct');
        // tela fica verde
        container.classList.add('acerto');
    } else {
        // botão errado fica vermelho
        botao.classList.add('wrong');
        // botão correto fica verde
        botoes.forEach(b => {
            if (b.dataset.key === correta) {
                b.classList.add('correct');
            }
        });
        // tela fica vermelha
        container.classList.add('erro');
    }

    // avança para próxima pergunta após 2s
    setTimeout(() => {
        if (btnProximo) {
            btnProximo.click();
        } else {
            // Se não há próxima pergunta, volta para módulos
            window.location.href = '/quiz';
        }
    }, 2000);
}
</script>


</body>
</html>
