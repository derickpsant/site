SELECT * FROM alimentobd.total_votos;
SELECT * FROM alimentobd.votacao;
SELECT 
    SUM(CASE WHEN opcao = 'sim' AND periodo = 'manha' THEN 1 ELSE 0 END) AS manha_sim,
    SUM(CASE WHEN opcao = 'sim' AND periodo = 'tarde' THEN 1 ELSE 0 END) AS tarde_sim,
    SUM(CASE WHEN opcao = 'sim' AND periodo = 'noite' THEN 1 ELSE 0 END) AS noite_sim,
    SUM(CASE WHEN opcao = 'nao' AND periodo = 'manha' THEN 1 ELSE 0 END) AS manha_nao,
    SUM(CASE WHEN opcao = 'nao' AND periodo = 'tarde' THEN 1 ELSE 0 END) AS tarde_nao,
    SUM(CASE WHEN opcao = 'nao' AND periodo = 'noite' THEN 1 ELSE 0 END) AS noite_nao
FROM votacao;