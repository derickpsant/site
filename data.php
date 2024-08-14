<?php
include 'db.php';

$query = "
    SELECT 
        SUM(CASE WHEN opcao = 'sim' AND periodo = 'manha' THEN 1 ELSE 0 END) AS manha_sim,
        SUM(CASE WHEN opcao = 'sim' AND periodo = 'tarde' THEN 1 ELSE 0 END) AS tarde_sim,
        SUM(CASE WHEN opcao = 'sim' AND periodo = 'noite' THEN 1 ELSE 0 END) AS noite_sim,
        SUM(CASE WHEN opcao = 'nao' AND periodo = 'manha' THEN 1 ELSE 0 END) AS manha_nao,
        SUM(CASE WHEN opcao = 'nao' AND periodo = 'tarde' THEN 1 ELSE 0 END) AS tarde_nao,
        SUM(CASE WHEN opcao = 'nao' AND periodo = 'noite' THEN 1 ELSE 0 END) AS noite_nao
    FROM votacao
";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
