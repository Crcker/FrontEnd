PROGRAM Hello(INPUT, OUTPUT);
USES
  DOS;
VAR
  Name, Temp: STRING; 
BEGIN {PrintHello}
  WRITELN('Content-Type: text/plain');
  WRITELN; 
  Name := GetEnv('QUERY_STRING');
  Temp := copy(Name, 1, 5);
  IF Temp <> 'name='
  THEN
    WRITELN('Hello Anonymous!')
  ELSE
    BEGIN
      DELETE(Name, 1, 5);    
      WRITELN('Hello dear, ', Name, '!')
    END;
END. {PrintHello}

