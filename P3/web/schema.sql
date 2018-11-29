DROP TABLE IF EXISTS Camara CASCADE;
DROP TABLE IF EXISTS Video CASCADE;
DROP TABLE IF EXISTS SegmentoVideo CASCADE;
DROP TABLE IF EXISTS Local CASCADE;
DROP TABLE IF EXISTS Vigia CASCADE;
DROP TABLE IF EXISTS ProcessoSocorro CASCADE;
DROP TABLE IF EXISTS EventoEmergencia CASCADE;
DROP TABLE IF EXISTS EntidadeMeio CASCADE;
DROP TABLE IF EXISTS Meio CASCADE;
DROP TABLE IF EXISTS MeioCombate CASCADE;
DROP TABLE IF EXISTS MeioApoio CASCADE;
DROP TABLE IF EXISTS MeioSocorro CASCADE;
DROP TABLE IF EXISTS Transporta CASCADE;
DROP TABLE IF EXISTS Alocado CASCADE;
DROP TABLE IF EXISTS Acciona CASCADE;
DROP TABLE IF EXISTS Coordenador CASCADE;
DROP TABLE IF EXISTS Audita CASCADE;
DROP TABLE IF EXISTS Solicita CASCADE;


CREATE TABLE Camara(
	numCamara int NOT NULL,
	CONSTRAINT pk_Camara PRIMARY KEY (numCamara)
);

CREATE TABLE Video(
	dataHoraInicio timestamp NOT NULL,
	dataHoraFim timestamp NOT NULL,
	numCamara int NOT NULL,
	CONSTRAINT pk_Video PRIMARY KEY(dataHoraInicio,numCamara),
	CONSTRAINT fk_Video_Camara FOREIGN KEY (numCamara) REFERENCES Camara(numCamara) on update cascade on delete cascade
);

CREATE TABLE SegmentoVideo(
	numSegmento int NOT NULL,
	duracao time NOT NULL,
	dataHoraInicio timestamp NOT NULL,
	numCamara int NOT NULL,
	CONSTRAINT pk_SegmentoVideo PRIMARY KEY(numSegmento,dataHoraInicio,numCamara),
	CONSTRAINT fk_SegmentoVideo_Video FOREIGN KEY (dataHoraInicio,numCamara) REFERENCES Video(dataHoraInicio,numCamara) on update cascade on delete cascade
);

CREATE TABLE Local(
	moradaLocal VARCHAR(150) NOT NULL,
	CONSTRAINT pk_Local PRIMARY KEY (moradaLocal)
);

CREATE TABLE Vigia(
	moradaLocal VARCHAR(150) NOT NULL,
	numCamara int NOT NULL ,
	CONSTRAINT pk_Vigia PRIMARY KEY(moradaLocal,numCamara),
	CONSTRAINT fk_Vigia_Local FOREIGN KEY (moradaLocal) REFERENCES Local(moradaLocal) on update cascade on delete cascade,
	CONSTRAINT fk_Vigia_Camara FOREIGN KEY (numCamara) REFERENCES Camara(numCamara) on update cascade on delete cascade
);

CREATE TABLE ProcessoSocorro(
	numProcessoSocorro int NOT NULL,
	CONSTRAINT pk_ProcessoSocorro PRIMARY KEY(numProcessoSocorro)
);

CREATE TABLE EventoEmergencia(
	numTelefone VARCHAR(9) NOT NULL,
	instanteChamada timestamp NOT NULL,
	nomePessoa VARCHAR(150) NOT NULL,
	moradaLocal VARCHAR(150) NOT NULL,
	numProcessoSocorro int NOT NULL,
	UNIQUE(numTelefone,nomePessoa),
	CONSTRAINT pk_EventoEmergencia PRIMARY KEY(numTelefone,instanteChamada),
	CONSTRAINT fk_EventoEmergencia_Local FOREIGN KEY (moradaLocal) REFERENCES Local(moradaLocal) on update cascade on delete cascade,
	CONSTRAINT fk_EventoEmergencia_ProcessoSocorro FOREIGN KEY (numProcessoSocorro) REFERENCES ProcessoSocorro(numProcessoSocorro) on update cascade on delete cascade
);

CREATE TABLE EntidadeMeio(
	nomeEntidade VARCHAR(150) NOT NULL,
	CONSTRAINT pk_EntidadeMeio PRIMARY KEY (nomeEntidade)
);

CREATE TABLE Meio(
	numMeio int NOT NULL,
	nomeMeio VARCHAR(150) NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	CONSTRAINT pk_Meio PRIMARY KEY(numMeio,nomeEntidade),
	CONSTRAINT fk_Meio_EntidadeMeio FOREIGN KEY(nomeEntidade) REFERENCES EntidadeMeio(nomeEntidade) on update cascade on delete cascade
);

CREATE TABLE MeioCombate(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	CONSTRAINT pk_MeioCombate PRIMARY KEY(numMeio,nomeEntidade),
	CONSTRAINT fk_MeioCombate_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade
);

CREATE TABLE MeioApoio(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	CONSTRAINT pk_MeioApoio PRIMARY KEY(numMeio,nomeEntidade),
	CONSTRAINT fk_MeioApoio_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade
);

CREATE TABLE MeioSocorro(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	CONSTRAINT pk_MeioSocorro PRIMARY KEY(numMeio,nomeEntidade),
	CONSTRAINT fk_MeioSocorro_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade
);

CREATE TABLE Transporta(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	numVitimas int NOT NULL,
	numProcessoSocorro int NOT NULL,
	CONSTRAINT pk_Transporta PRIMARY KEY (numMeio,nomeEntidade,numProcessoSocorro),
	CONSTRAINT fk_Transporta_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade,
	CONSTRAINT fk_Transporta_ProcessoSocorro FOREIGN KEY (numProcessoSocorro)
	REFERENCES ProcessoSocorro(numProcessoSocorro)
);

CREATE TABLE Alocado(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	numHoras int NOT NULL,
	numProcessoSocorro int NOT NULL, 
	CONSTRAINT pk_Alocado PRIMARY KEY (numMeio,nomeEntidade,numProcessoSocorro),
	CONSTRAINT fk_Alocado_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade,
	CONSTRAINT fk_Alocado_ProcessoSocorro FOREIGN KEY (numProcessoSocorro) REFERENCES ProcessoSocorro(numProcessoSocorro)
);

CREATE TABLE Acciona(
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	numProcessoSocorro int NOT NULL,
	CONSTRAINT pk_Acciona PRIMARY KEY (numMeio,nomeEntidade,numProcessoSocorro),
	CONSTRAINT fk_Acciona_Meio FOREIGN KEY(numMeio,nomeEntidade) REFERENCES Meio(numMeio,nomeEntidade) on update cascade on delete cascade,
	CONSTRAINT fk_Acciona_ProcessoSocorro FOREIGN KEY (numProcessoSocorro) REFERENCES ProcessoSocorro(numProcessoSocorro)
);

CREATE TABLE Coordenador(
	idCoordenador int NOT NULL,
	CONSTRAINT pk_Coordenador PRIMARY KEY(idCoordenador)
);

CREATE TABLE Audita(
	idCoordenador int NOT NULL,
	numMeio int NOT NULL,
	nomeEntidade VARCHAR(150) NOT NULL,
	numProcessoSocorro int NOT NULL,
	datahoraInicio timestamp NOT NULL,
	datahorafim timestamp NOT NULL,
	dataAuditoria timestamp NOT NULL,
	texto VARCHAR(150) NOT NULL,
	CONSTRAINT pk_Audita PRIMARY KEY(idCoordenador,numMeio,nomeEntidade,numProcessoSocorro),
	CONSTRAINT fk_Audita_Acciona FOREIGN KEY(numMeio,nomeEntidade,numProcessoSocorro)
	REFERENCES Acciona(numMeio,nomeEntidade,numProcessoSocorro) on update cascade on delete cascade,
	CONSTRAINT fk_Audita_Coordenador FOREIGN KEY(idCoordenador) REFERENCES Coordenador(idCoordenador) on update cascade on delete cascade
);

CREATE TABLE Solicita(
	idCoordenador int NOT NULL,
	dataHoraInicioVideo timestamp NOT NULL,
	numCamara int NOT NULL,
	dataHoraInicio timestamp Not NULL,
	dataHorafim timestamp Not NULL,
	CONSTRAINT pk_Solicita PRIMARY KEY(idCoordenador,dataHoraInicioVideo,numCamara),
	CONSTRAINT fk_Solocita_Coordenador FOREIGN KEY(idCoordenador) REFERENCES Coordenador(idCoordenador) on update cascade on delete cascade,
	CONSTRAINT fk_Solocita_Video FOREIGN KEY(dataHoraInicioVideo,numCamara) REFERENCES Video(dataHoraInicio,numCamara) on update cascade on delete cascade
);
