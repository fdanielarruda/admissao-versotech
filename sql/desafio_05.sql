/*
    Escreva uma query que retorne o produto mais vendido (em quantidade),
    incluindo o valor total vendido deste produto, quantidade de pedidos em que ele apareceu e para quantos clientes diferentes ele foi vendido. 
    A consulta deve retornar as colunas id_produto, quantidade_vendida, total_vendido, clientes, pedidos.
    Caso haja empate em quantidade de vendas, utilizar o total vendido como critério de desempate.
*/

select
	pr.id_produto,
	sum(ip.quantidade) as quantidade_vendida,
	sum(ip.quantidade * ip.preco_praticado) as total_vendido,
	count(distinct ip.id_pedido) as pedidos,
	count(distinct pe.id_cliente) as clientes
from produtos pr
inner join itens_pedido ip on ip.id_produto = pr.id_produto
inner join pedido pe on pe.id_pedido = ip.id_pedido
group by pr.id_produto
order by quantidade_vendida desc, total_vendido desc
limit 1;