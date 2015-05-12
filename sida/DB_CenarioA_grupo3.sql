/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     02/05/2015 19:17:14                          */
/*==============================================================*/


drop table if exists Docente;

drop table if exists Estudante;

drop table if exists Modulo;

drop table if exists NivelDificuldade;

drop table if exists Pessoa;

drop table if exists Questao;
/*
drop index ASSOCIATION_QUESTAO_FK on Resposta;

drop index ASSOCIATION_ESTUDANTE_FK on Resposta;
*/
drop table if exists Resposta;

drop table if exists SubModulo;

/*==============================================================*/
/* Table: Docente                                               */
/*==============================================================*/
create table Docente
(
   emailPessoa          varchar(500) not null,
   id                   int not null,
   primary key (emailPessoa, id)
);

/*==============================================================*/
/* Table: Estudante                                             */
/*==============================================================*/
create table Estudante
(
   emailPessoa          varchar(500) not null,
   id                   int not null,
   curso                varchar(500) not null,
   primary key (emailPessoa, id)
);

/*==============================================================*/
/* Table: Modulo                                                */
/*==============================================================*/
create table Modulo
(
   designacaoModulo     varchar(100) not null,
   emailPessoa          varchar(500),
   id                   int,
   ultimaModificacao    datetime not null,
   primary key (designacaoModulo)
);

/*==============================================================*/
/* Table: NivelDificuldade                                      */
/*==============================================================*/
create table NivelDificuldade
(
   designacaoNivel      varchar(20) not null,
   idNivel              int not null,
   ultimaModificacao    datetime not null,
   unique key (designacaoNivel),
   primary key (idNivel)
);

/*==============================================================*/
/* Table: Pessoa                                                */
/*==============================================================*/
create table Pessoa
(
   isEstudante          bool not null,
   nome                 varchar(200) not null,
   senha                varchar(100) not null,
   emailPessoa          varchar(500) not null,
   ultimaModificacao    datetime,
   primary key (emailPessoa)
);

/*==============================================================*/
/* Table: Questao                                               */
/*==============================================================*/
create table Questao
(
   texto                varchar(500) not null,
   resposta             int not null,
   explicacao           varchar(500) not null,
   linkFicheiro         varchar(200),
   idQuestao            int not null,
   idNivel              int not null,
   designacaoModulo     varchar(100) not null,
   designacaoSubModulo  varchar(100) not null,
   emailPessoa          varchar(500) not null,
   id                   int not null,
   ultimaModificacao    datetime not null,
   primary key (idQuestao)
);

/*==============================================================*/
/* Table: Resposta                                              */
/*==============================================================*/
create table Resposta
(
   idQuestao            int not null,
   emailPessoa          varchar(500) not null,
   id                   int not null,
   respostaEscolhida    int not null,
   dataResposta         datetime not null,
   ultimaModificacao    datetime not null,
   primary key (idQuestao, emailPessoa, id)
);

/*==============================================================*/
/* Index: ASSOCIATION3_FK                                       */
/*==============================================================*/
create index ASSOCIATION_QUESTAO_FK on Resposta
(
   idQuestao
);

/*==============================================================*/
/* Index: ASSOCIATION3_FK2                                      */
/*==============================================================*/
create index ASSOCIATION_ESTUDANTE_FK on Resposta
(
   emailPessoa,
   id
);

/*==============================================================*/
/* Table: SubModulo                                             */
/*==============================================================*/
create table SubModulo
(
   designacaoModulo     varchar(100) not null,
   designacaoSubModulo  varchar(100) not null,
   emailPessoa          varchar(500),
   id                   int,
   ultimaModificacao    datetime not null,
   primary key (designacaoModulo, designacaoSubModulo)
);

alter table Docente add constraint FK_Generalization_2 foreign key (emailPessoa)
      references Pessoa (emailPessoa) on delete cascade on update cascade;

alter table Estudante add constraint FK_Generalization_1 foreign key (emailPessoa)
      references Pessoa (emailPessoa) on delete cascade on update cascade;

alter table Modulo add constraint FK_association5 foreign key (emailPessoa, id)
      references Docente (emailPessoa, id) on delete restrict on update cascade;

alter table Questao add constraint FK_association2 foreign key (idNivel)
      references NivelDificuldade (idNivel) on delete restrict on update cascade;

alter table Questao add constraint FK_association7 foreign key (designacaoModulo, designacaoSubModulo)
      references SubModulo (designacaoModulo, designacaoSubModulo) on delete restrict on update restrict;

alter table Questao add constraint FK_association8 foreign key (emailPessoa, id)
      references Docente (emailPessoa, id) on delete restrict on update restrict;

alter table Resposta add constraint FK_association3 foreign key (emailPessoa, id)
      references Estudante (emailPessoa, id) on delete cascade on update cascade;

alter table Resposta add constraint FK_association3_1 foreign key (idQuestao)
      references Questao (idQuestao) on delete cascade on update cascade;

alter table SubModulo add constraint FK_association4 foreign key (designacaoModulo)
      references Modulo (designacaoModulo) on delete cascade on update cascade;

alter table SubModulo add constraint FK_association6 foreign key (emailPessoa, id)
      references Docente (emailPessoa, id) on delete restrict on update restrict;

