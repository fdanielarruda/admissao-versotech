/*
    Situação por pedido:
    Escreva uma query que retorne a situação atual de cada pedido da base.
    A consulta deve retornar as colunas id, valor, data e situacao.
    A situacao deve obedecer a seguinte regra:
        Se possui data de cancelamento preenchido: CANCELADO
        Se possui data de faturamento preenchido: FATURADO
        Caso não possua data de cancelamento e nem faturamento: PENDENTE
*/

select
	p.id_pedido as id,
	p.valor_total as valor,
	p.data_emissao as data,
	case
		when p.data_cancelamento is not null then 'CANCELADO'
		when p.data_faturamento is not null then 'FATURADO'
		else 'PENDENTE'
	end as situacao
from pedido p