CREATE TABLE puntointeres
(
  id  serial,
  nombpunto VARCHAR(200),
  tipopunto VARCHAR(100),
  nombdep   VARCHAR(100),
  nombpro   VARCHAR(100),
  nombdis   VARCHAR(40),
  geometria geometry,
  ubigeo    CHAR(6),
  CONSTRAINT pk_puntointeres PRIMARY KEY (id),
  CONSTRAINT enforce_srid_the_geom CHECK (st_srid(geometria) = 4326)
);

CREATE TABLE departamento
(
  coddep     CHAR(2) NOT NULL,
  nombdep    VARCHAR(100),
  geometria  geometry,
  CONSTRAINT pk_departamento          PRIMARY KEY (coddep),
  CONSTRAINT enforce_dims_the_geom    CHECK (st_ndims(geometria) = 2),
  CONSTRAINT enforce_geotype_the_geom CHECK (geometrytype(geometria) = 'MULTIPOLYGON'::text OR geometria IS NULL),
  CONSTRAINT enforce_srid_the_geom    CHECK (st_srid(geometria) = 4326)
);

CREATE TABLE provincia
(
  codpro     CHAR(4) NOT NULL,
  coddep     CHAR(2),
  nombpro    VARCHAR(100),
  geometria  geometry,
  CONSTRAINT pk_provincia              PRIMARY KEY (codpro),
  CONSTRAINT fk_provincia_departamento FOREIGN KEY (coddep) REFERENCES departamento (coddep),
  CONSTRAINT enforce_dims_the_geom     CHECK (st_ndims(geometria) = 2),
  CONSTRAINT enforce_geotype_the_geom  CHECK (geometrytype(geometria) = 'MULTIPOLYGON'::text OR geometria IS NULL),
  CONSTRAINT enforce_srid_the_geom     CHECK (st_srid(geometria) = 4326)
);

CREATE TABLE distrito
(
  ubigeo     CHAR(6) NOT NULL,
  codpro     CHAR(4),
  nombdis    VARCHAR(40),
  geometria  geometry,
  CONSTRAINT pk_distrito              PRIMARY KEY (ubigeo),
  CONSTRAINT fk_distrito_provincia    FOREIGN KEY (codpro) REFERENCES provincia (codpro),
  CONSTRAINT enforce_dims_the_geom    CHECK (st_ndims(geometria) = 2),
  CONSTRAINT enforce_geotype_the_geom CHECK (geometrytype(geometria) = 'MULTIPOLYGON'::text OR geometria IS NULL),
  CONSTRAINT enforce_srid_the_geom    CHECK (st_srid(geometria) = 4326)
);