<?php
// Inicializa os estados de entrada (0 para falso, 1 para verdadeiro)
$entradaA = isset($_POST['entradaA']) ? (int)$_POST['entradaA'] : 0;
$entradaB = isset($_POST['entradaB']) ? (int)$_POST['entradaB'] : 0;

// Função para alternar o valor (0 vira 1, 1 vira 0) para os botões
$proximoA = $entradaA === 1 ? 0 : 1;
$proximoB = $entradaB === 1 ? 0 : 1;

// Processamento lógico das portas
$resultadoAND = $entradaA && $entradaB;
$resultadoOR  = $entradaA || $entradaB;
$resultadoXOR = $entradaA ^ $entradaB;
$resultadoNOT_A = !$entradaA; // NOT costuma usar apenas uma entrada
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Portas Lógicas</title>
    <style>
        :root {
            --bg-color: #1e1e2e;
            --card-bg: #252538;
            --text-color: #cdd6f4;
            --on-color: #a6e3a1;
            --off-color: #f38ba8;
            --primary: #89b4fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 30px;
        }

        .container {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        /* Seção de Entradas */
        .painel-entradas {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .btn-entrada {
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.1s, filter 0.2s;
            color: #11111b;
        }

        .btn-entrada:hover {
            filter: brightness(1.2);
        }

        .btn-entrada:active {
            transform: scale(0.95);
        }

        /* Seção de Saídas (Portas) */
        .grid-portas {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .porta-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            border-left: 5px solid #ccc;
        }

        /* Classes utilitárias para estados Ligado/Desligado */
        .estado-1 {
            background-color: var(--on-color) !important;
            box-shadow: 0 0 10px var(--on-color);
        }

        .estado-0 {
            background-color: var(--off-color) !important;
            box-shadow: 0 0 10px var(--off-color);
        }

        .led {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .porta-card.ativo {
            border-left-color: var(--on-color);
        }

        .porta-card.inativo {
            border-left-color: var(--off-color);
        }
    </style>
</head>
<body>

    <h1>Simulador de Portas Lógicas</h1>

    <div class="container">
        
        <div class="painel-entradas">
            <form method="POST" action="">
                <input type="hidden" name="entradaB" value="<?php echo $entradaB; ?>">
                <button type="submit" name="entradaA" value="<?php echo $proximoA; ?>" class="btn-entrada estado-<?php echo $entradaA; ?>">
                    Entrada A: <?php echo $entradaA; ?>
                </button>
            </form>

            <form method="POST" action="">
                <input type="hidden" name="entradaA" value="<?php echo $entradaA; ?>">
                <button type="submit" name="entradaB" value="<?php echo $proximoB; ?>" class="btn-entrada estado-<?php echo $entradaB; ?>">
                    Entrada B: <?php echo $entradaB; ?>
                </button>
            </form>
        </div>

        <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">

        <div class="grid-portas">
            
            <div class="porta-card <?php echo $resultadoAND ? 'ativo' : 'inativo'; ?>">
                <h3>AND (A & B)</h3>
                <span>Resultado: <?php echo $resultadoAND ? '1' : '0'; ?></span>
                <span class="led estado-<?php echo $resultadoAND ? '1' : '0'; ?>"></span>
            </div>

            <div class="porta-card <?php echo $resultadoOR ? 'ativo' : 'inativo'; ?>">
                <h3>OR (A | B)</h3>
                <span>Resultado: <?php echo $resultadoOR ? '1' : '0'; ?></span>
                <span class="led estado-<?php echo $resultadoOR ? '1' : '0'; ?>"></span>
            </div>

            <div class="porta-card <?php echo $resultadoXOR ? 'ativo' : 'inativo'; ?>">
                <h3>XOR (A ⊕ B)</h3>
                <span>Resultado: <?php echo $resultadoXOR ? '1' : '0'; ?></span>
                <span class="led estado-<?php echo $resultadoXOR ? '1' : '0'; ?>"></span>
            </div>

            <div class="porta-card <?php echo $resultadoNOT_A ? 'ativo' : 'inativo'; ?>">
                <h3>NOT (Inverte A)</h3>
                <span>Resultado: <?php echo $resultadoNOT_A ? '1' : '0'; ?></span>
                <span class="led estado-<?php echo $resultadoNOT_A ? '1' : '0'; ?>"></span>
            </div>

        </div>

    </div>

</body>
</html>