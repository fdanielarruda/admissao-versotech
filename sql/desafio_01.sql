/*
    Consulta de Vendedores:
    Escreva uma query para listar todos os vendedores ativos, mostrando as colunas id, nome, salario.
    Ordene o resultado pelo nome em ordem ascendente.
*/

select
    v.id_vendedor as id,
    v.nome,
    v.salario
from vendedores v 
where v.inativo is false
order by v.nome asc;