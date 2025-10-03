/*
    Resumo por cliente:
    Escreva uma query para listar todos os clientes e o valor total de pedidos já transmitidos.
    A consulta deve retornar as colunas id, razao_social, total, ordenadas pelo total em ordem descendente.
*/

select
    c.id_cliente as id,
    c.razao_social,
    sum(coalesce(p.valor_total, 0)) as total
from clientes c
left join pedido p on p.id_cliente = c.id_cliente
group by c.id_cliente, c.razao_social 
order by total desc;