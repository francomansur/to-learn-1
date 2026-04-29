<?php
require_once 'valida.php';
$nome = isset($_SESSION['USUARIO']) ? $_SESSION['USUARIO'] : '';
?>

<style>
    * { font-family: sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f5f5f5; }
    .navbar { display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background: #fff; border-bottom: 1px solid #ddd; }
    .navbar a { color: #2563eb; text-decoration: none; margin-left: 12px; font-size: 0.9rem; }
    .navbar a:hover { text-decoration: underline; }
    .page-body { padding: 24px; }
    .btn { display: inline-block; padding: 7px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 0.9rem; text-decoration: none; }
    .btn:hover { background: #1d4ed8; }
    .btn-danger { background: #dc2626; }
    .btn-danger:hover { background: #b91c1c; }
    .input { display: block; margin-bottom: 8px; padding: 8px; width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 4px; }
    table { border-collapse: collapse; width: 100%; background: #fff; }
    th, td { border: 1px solid #ddd; padding: 10px 14px; text-align: left; }
    th { background: #f0f0f0; font-weight: 600; }
    tr:hover td { background: #f9f9f9; }
</style>
<div class="navbar">
    <div>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</div>
    <div><a href="logout.php">Sair</a></div>
</div>

