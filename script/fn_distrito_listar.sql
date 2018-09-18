CREATE OR REPLACE FUNCTION fn_distrito_listar(pcodpro VARCHAR)
  RETURNS SETOF record AS
$BODY$
/* ***************************************************************************************
Ejecución         : 

SELECT ubigeo, nombdis FROM fn_distrito_listar('1501') as (ubigeo CHAR(6), nombdis VARCHAR(40));

******************************************************************************************** */
BEGIN
	

	RETURN Query
	SELECT ubigeo, nombdis FROM distrito WHERE codpro = pcodpro ORDER BY 2;
    
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;