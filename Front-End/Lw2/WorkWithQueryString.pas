PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;
FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  first_name, last_name, age: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN; 
  Name := GetEnv('QUERY_STRING'); 
  
  
END;                           
BEGIN {WorkWithQueryString}
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END. {WorkWithQueryString}
                                                                                                                
