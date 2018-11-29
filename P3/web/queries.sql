#1. Qual é o processo de socorro que envolveu maior número de meios distintos; 

#1. nova

select numProcessoSocorro
from acciona
group by numProcessoSocorro
having count(distinct numMeio)=(
	select max(count)
	from(
		select numProcessoSocorro, count(distinct numMeio) as count
		from acciona
		group by numProcessoSocorro
		) as foo
);


#2. Qual a entidade fornecedora de meios que participou em mais processos de socorro no
#	Verão de 2018;


#2 novo
select nomeEntidade
from acciona natural join EventoEmergencia
where(instanteChamada >= '2018-06-21 00:00:00' and instanteChamada <='2018-09-20 23:59:59')
group by nomeEntidade
having count(nomeEntidade)=(
	select max(count)
	from(
		select nomeEntidade, count(nomeEntidade) as count
		from acciona natural join EventoEmergencia
		where(instanteChamada >= '2018-06-21 00:00:00' and
	  	  instanteChamada <='2018-09-20 23:59:59')
		group by nomeEntidade
		) as foo
);

#3. Quais são os processos de socorro, referente a eventos de emergência em 2018 de
#	Oliveira do Hospital, onde existe pelo menos um acionamento de meios que não foi alvo
#	de auditoria;


select  distinct numProcessoSocorro
from acciona natural join EventoEmergencia
where instanteChamada >= '2018-01-01 00:00:00' and
	  instanteChamada <= '2018-12-31 23:59:59' and
	  moradaLocal = 'Oliveira do Hospital' and
	  (numMeio not in (select numMeio from audita) or nomeEntidade not in(select nomeEntidade from audita)) ;


#4. Quantos segmentos de vídeo com duração superior a 60 segundos, foram gravados em
#	câmeras de vigilância de Monchique durante o mês de Agosto de 2018;


select count( numSegmento) 
from(
select distinct numSegmento
from vigia natural join segmentoVideo natural join video
where(dataHoraInicio >= '2018-08-01 00:00:00' and
	  dataHoraFim <='2018-08-31 23:59:59' and
	  duracao >='00:01:00' and moradaLocal='Monchique')
	group by numSegmento
) as foo;

#5. Liste os Meios de combate que não foram usados como Meios de Apoio em nenhum
#	processo de socorro;


select numMeio,nomeentidade
from MeioCombate
where(numMeio not in (select numMeio from alocado) and nomeentidade not in (select nomeentidade from alocado));

#6. Liste as entidades que forneceram meios de combate a todos os Processos de socorro
#	que acionaram meios;

select distinct nomeEntidade
from MeioCombate natural join acciona
where not exists (
	select acciona 
	from ProcessoSocorro p
	where not exists(
	select  numProcessoSocorro
	from ProcessoSocorro b
	where b.numProcessoSocorro = p.numProcessoSocorro 
));
