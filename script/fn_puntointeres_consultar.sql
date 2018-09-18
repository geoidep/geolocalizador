CREATE OR REPLACE FUNCTION fn_puntointeres_consultar(pcodigo VARCHAR)
  RETURNS SETOF record AS
$BODY$
/* ***************************************************************************************
Ejecución         : 

SELECT nombpunto, x, y FROM fn_puntointeres_consultar('150103') as (nombpunto VARCHAR, x FLOAT, y FLOAT);

******************************************************************************************** */
BEGIN
    IF(length(pcodigo)=2) THEN
        RETURN Query
        SELECT (nombpunto||' '||tipopunto)::varchar nombpunto, st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT
        FROM puntointeres where substring(ubigeo,1,2) = pcodigo;
    ELSIF (length(pcodigo)=4) THEN
        RETURN Query
        SELECT (nombpunto||' '||tipopunto)::varchar nombpunto, st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT
        FROM puntointeres where substring(ubigeo,1,4) = pcodigo;
    ELSE 
        RETURN Query
        SELECT (nombpunto||' '||tipopunto)::varchar nombpunto, st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT
        FROM puntointeres where ubigeo = pcodigo;
    END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;