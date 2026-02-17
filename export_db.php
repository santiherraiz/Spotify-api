<?php

// Configuración de la base de datos (extraída de .env)
$host = 'add-dbms';
$db   = 'spotify';
$user = 'root';
$pass = 'dbrootpass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Si falla add-dbms, intentamos localhost por si acaso
     try {
         $dsn = "mysql:host=localhost;dbname=$db;charset=$charset";
         $pdo = new PDO($dsn, $user, $pass, $options);
     } catch (\PDOException $e) {
         die("Error de conexión: " . $e->getMessage());
     }
}

// Obtener todas las tablas
$tablesQuery = $pdo->query("SHOW TABLES");
$tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizador de Base de Datos - Spotify API</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --accent-color: #1ed760;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --header-bg: rgba(15, 23, 42, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: \'Outfit\', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            line-height: 1.6;
            padding-bottom: 50px;
        }

        header {
            position: sticky;
            top: 0;
            background: var(--header-bg);
            backdrop-filter: blur(10px);
            padding: 20px 5%;
            border-bottom: 1px solid var(--border-color);
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            background: linear-gradient(90deg, #1ed760, #1db954);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .nav-links a {
            padding: 8px 16px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .table-section {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            margin-bottom: 50px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table-header {
            padding: 20px;
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 1.25rem;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: rgba(0,0,0,0.2);
            padding: 15px 20px;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255,255,255,0.01);
        }

        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            background: var(--accent-color);
            color: var(--bg-color);
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--text-secondary);
            font-style: italic;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>
</head>
<body>
    <header>
        <h1>Spotify API Database</h1>
        <div class="stats">
            Generado el: ' . date('d/m/Y H:i:s') . '
        </div>
    </header>

    <div class="container">
        <div class="nav-links">';
foreach ($tables as $table) {
    $html .= '<a href="#table-' . $table . '">' . $table . '</a>';
}
$html .= '</div>';

foreach ($tables as $table) {
    $html .= '<section id="table-' . $table . '" class="table-section">
        <div class="table-header">
            <h2>Tabla: ' . $table . '</h2>
        </div>
        <div class="table-wrapper">';

    $dataQuery = $pdo->query("SELECT * FROM `$table` LIMIT 100");
    $data = $dataQuery->fetchAll();

    if (count($data) > 0) {
        $html .= '<table>
            <thead>
                <tr>';
        foreach (array_keys($data[0]) as $column) {
            $html .= '<th>' . $column . '</th>';
        }
        $html .= '</tr>
            </thead>
            <tbody>';
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $value) {
                // Formatear nulos y booleanos
                if ($value === null) {
                    $html .= '<td><em style="color:#64748b">NULL</em></td>';
                } elseif ($value === true || $value === 1 && ($table == "configuracion" && ($row["autoplay"] == $value || $row["ajuste"] == $value || $row["normalizacion"] == $value))) {
                    // Intento de detectar booleanos en configuracion
                    $html .= '<td><span class="badge">TRUE</span></td>';
                } elseif ($value === false || $value === 0 && ($table == "configuracion" && ($row["autoplay"] == $value || $row["ajuste"] == $value || $row["normalizacion"] == $value))) {
                    $html .= '<td><span class="badge" style="background:#ef4444">FALSE</span></td>';
                } else {
                    $html .= '<td>' . htmlspecialchars($value) . '</td>';
                }
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>
        </table>';
    } else {
        $html .= '<div class="empty-state">No hay registros en esta tabla.</div>';
    }

    $html .= '</div>
    </section>';
}

$html .= '
    </div>
</body>
</html>';

file_put_contents('db_view.html', $html);
echo "Archivo db_view.html generado correctamente.\n";
