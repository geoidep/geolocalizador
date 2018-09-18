CREATE OR REPLACE FUNCTION fn_departamento_listar()
  RETURNS SETOF record AS
$BODY$
/* ***************************************************************************************
Ejecución         : 

SELECT coddep, nombdep FROM fn_departamento_listar() as (coddep CHAR(2), nombdep VARCHAR(100));

******************************************************************************************** */
BEGIN

    RETURN Query
    select coddep, nombdep from departamento ORDER BY 1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;