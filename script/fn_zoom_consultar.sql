CREATE OR REPLACE FUNCTION fn_zoom_consultar(pcod VARCHAR)
  RETURNS SETOF record AS
$BODY$
/* ***************************************************************************************
Ejecución         : 

SELECT x, y, zoom FROM fn_zoom_consultar('150101') as (x FLOAT, y FLOAT, zoom INTEGER);

******************************************************************************************** */
BEGIN
    IF(length(pcod)=2) THEN
        RETURN Query
        SELECT st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT, 7 zoom from departamento where coddep=pcod;
    ELSIF (length(pcod)=4) THEN
        RETURN Query
        SELECT st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT, 9 zoom from provincia where codpro=pcod;
    ELSE 
        RETURN Query
        SELECT st_x(st_centroid(geometria))::FLOAT, st_y(st_centroid(geometria))::FLOAT, 12 zoom from distrito where ubigeo=pcod;
    END IF;
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;