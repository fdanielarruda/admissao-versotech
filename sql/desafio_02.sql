/*
    Funcionários com Salário Acima da Média:
    Escreva uma query para listar os funcionários que possuem um salário acima da média salarial de todos os funcionários.
    A consulta deve mostrar as colunas id, nome, e salário, ordenadas pelo salário em ordem descendente.
*/

select
    v.id_vendedor as id,
    v.nome,
    v.salario
from vendedores v 
where v.salario > (
	select avg(x.salario) from vendedores x
)
order by v.salario desc;