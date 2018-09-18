CREATE OR REPLACE FUNCTION fn_provincia_listar(pcoddep VARCHAR)
  RETURNS SETOF record AS
$BODY$
/* ***************************************************************************************
Ejecución         : 

SELECT codpro, nombpro FROM fn_provincia_listar('01') as (codpro CHAR(4), nombpro VARCHAR(100));

******************************************************************************************** */
BEGIN
	

	RETURN Query
	SELECT codpro, nombpro FROM provincia WHERE coddep = pcoddep ORDER BY 1;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;