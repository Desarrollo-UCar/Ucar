<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class cliente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                $faker = Faker::create();
                for ($i=0; $i <500; $i++) {
                DB::table('clientes')-> insert([
                    'credencial'=> $faker->numberBetween(1000000000000,1000000000000000),
                    'nombre' => $faker->randomElement(['JUAN','JOSÉ LUIS','JOSÉ','MARÍA GUADALUPE','FRANCISCO','GUADALUPE', 'MARÍA','JUANA','ANTONIO','JESÚS','MIGUEL ÁNGEL','PEDRO','ALEJANDRO','MANUEL','MARGARITA','MARÍA DEL CARMEN','JUAN CARLOS','ROBERTO','FERNANDO','DANIEL','CARLOS','JORGE','RICARDO','MIGUEL','EDUARDO','JAVIER','RAFAEL','MARTÍN','RAÚL','DAVID','JOSEFINA','JOSÉ ANTONIO','ARTURO','MARCO ANTONIO','JOSÉ MANUEL','FRANCISCO JAVIER','ENRIQUE','VERÓNICA','GERARDO','MARÍA ELENA','LETICIA','ROSA','MARIO','FRANCISCA','ALFREDO','TERESA','ALICIA','MARÍA FERNANDA','SERGIO','ALBERTO','LUIS','ARMANDO','ALEJANDRA','MARTHA','SANTIAGO','YOLANDA','PATRICIA','MARÍA DE LOS ÁNGELES','JUAN MANUEL','ROSA MARÍA','ELIZABETH','GLORIA','ÁNGEL','GABRIELA','SALVADOR','VÍCTOR MANUEL','SILVIA','MARÍA DE GUADALUPE','MARÍA DE JESÚS','GABRIEL','ANDRÉS','ÓSCAR','GUILLERMO','ANA MARÍA','RAMÓN','MARÍA ISABEL','PABLO','RUBEN','ANTONIA','MARÍA LUISA','LUIS ÁNGEL','MARÍA DEL ROSARIO','FELIPE','JORGE JESÚS','JAIME','JOSÉ GUADALUPE','JULIO CESAR','JOSÉ DE JESÚS','DIEGO','ARACELI','ANDREA','ISABEL','MARÍA TERESA','IRMA','CARMEN','LUCÍA','ADRIANA','AGUSTÍN','MARÍA DE LA LUZ','GUSTAVO']),
                    
                    'primer_apellido' => $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'segundo_apellido'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'fecha_nacimiento'=>$faker->randomElement(['1990-08-23','1987-01-24','1984-05-23','1986-12-22','1979-11-13','1983-02-15','1982-03-29']),
        
                    'nacionalidad' => 'MEXICANA',
        
                    'correo'=> 'ucardesarollo@gmail.com',
        
                    'telefono' => $faker->numberBetween(1000000000,10000000000),
                     
                    'calle'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'numero' =>$faker->numberBetween(1,1000),
        
                    'colonia'=>$faker->randomElement(['GABRIEL HERNANDEZ','GUSTAVO A. MADERO','GABRIEL RAMOS MILLAN','TLALPAN','GABRIEL RAMOS MILLAN SECCION BRAMADERO	IZTACALCO','GABRIEL RAMOS MILLAN SECCION TLACOTAL IZTACALCO','GABRIEL REYNA NAVA	NICOLAS ROMERO','GALAXIA	CUAUTITLAN IZCALLI','GALAXIA AZCAPOTZALCO AZCAPOTZALCO','GALAXIA MONARCA','GALAXIA SANTA LUCIA	ALVARO OBREGON','GALEANA','GARCIMARRERO','GENERAL ANTONIO ROSALES','GENERAL MANUEL AVILA CAMACHO','GENERAL PEDRO MARIA ANAYA','GEOVILLAS DE JESUS MARIA','GEOVILLAS DE SAN ISIDRO','GEOVILLAS IXTAPALUCA','GERTRUDIS SANCHEZ 1A. SECC.	GUSTAVO A. MADERO','GERTRUDIS SANCHEZ 2A. SECC.	GUSTAVO A. MADERO']),
        
                    'ciudad' => $faker->randomElement(['ACAPULCO','AGUASCALIENTES','APODACA','BUENAVISTA','CAMPECHE','CANCÚN','CELAYA','CHALCO','CHETUMAL','CHICOLOAPAN','CHIHUAHUA','CHILPANCINGO','CHIMALHUACÁN','CIUDAD ACUÑA','CIUDAD DE MÉXICO DF (CDMX)','CIUDAD DEL CARMEN','CIUDAD LÓPEZ MATEOS','CIUDAD MADERO','CIUDAD OBREGÓN','CIUDAD VALLES','CIUDAD VICTORIA','COATZACOALCOS','COLIMA','CÓRDOBA','CUAUHTÉMOC','CUAUTITLÁN','CUAUTITLÁN IZCALLI','CUAUTLA','CUERNAVACA','CULIACÁN','DELICIAS','DURANGO','ECATEPEC','ENSENADA','FRESNILLO','GENERAL ESCOBEDO','GÓMEZ PALACIO','GUADALAJARA','GUADALUPE','GUADALUPE','GUAYMAS','HERMOSILLO','HIDALGO DEL PARRAL','IGUALA','IRAPUATO','IXTAPALUCA','JIUTEPEC','JUÁREZ','JUÁREZ','LA PAZ','LEÓN','LOS MOCHIS','MANZANILLO','MATAMOROS','MAZATLÁN','MÉRIDA','MEXICALI','MINATITLÁN','MIRAMAR','MONCLOVA','MONTERREY','MORELIA','NAUCALPAN','NAUCALPAN DE JUÁREZ','NAVOJOA','NEZAHUALCÓYOTL','NOGALES','NUEVO LAREDO','OAXACA DE JUÁREZ','OJO DE AGUA','ORIZABA','PACHUCA','PIEDRAS NEGRAS','PLAYA DEL CARMEN','POZA RICA DE HIDALGO','PUEBLA','PUERTO VALLARTA','QUERÉTARO','REYNOSA','SALAMANCA','SALTILLO','SAN CRISTÓBAL DE LAS CASAS','SAN FRANCISCO COACALCO','SAN JUAN BAUTISTA TUXTEPEC','SAN JUAN DEL RÍO','SAN LUIS POTOSÍ','SAN LUIS RÍO COLORADO','SAN NICOLÁS DE LOS GARZA','SAN PABLO DE LAS SALINAS','SAN PEDRO GARZA GARCÍA','SANTA CATARINA','SOLEDAD DE GRACIANO SÁNCHEZ','TAMPICO','TAPACHULA','TEHUACÁN','TEPEXPAN','TEPIC','TEXCOCO DE MORA','TIJUANA','TLALNEPANTLA','TLAQUEPAQUE','TOLUCA','TONALÁ','TORREÓN','TULANCINGO DE BRAVO','TUXTLA','URUAPAN','VERACRUZ','VERACRUZ','VILLA DE ÁLVAREZ','VILLA NICOLÁS ROMERO','VILLAHERMOSA','XALAPA','XICO','ZACATECAS','ZAMORA','ZAPOPAN']),
        
                    'estado'=> $faker->randomElement(['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','CIUDAD DE MÉXICO','COAHUILA','COLIMA','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACÁN','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATÁN','ZACATECAS']),
                    
                    'pais'=>'MEXICO',
        
                    ]);
                }
                    for ($i=0; $i <10; $i++) {
                        DB::table('clientes')-> insert([
                            'pasaporte'=> $faker->numberBetween(100000,1000000),
                            'nombre' => $faker->randomElement(['JUAN','JOSÉ LUIS','JOSÉ','MARÍA GUADALUPE','FRANCISCO','GUADALUPE', 'MARÍA','JUANA','ANTONIO','JESÚS','MIGUEL ÁNGEL','PEDRO','ALEJANDRO','MANUEL','MARGARITA','MARÍA DEL CARMEN','JUAN CARLOS','ROBERTO','FERNANDO','DANIEL','CARLOS','JORGE','RICARDO','MIGUEL','EDUARDO','JAVIER','RAFAEL','MARTÍN','RAÚL','DAVID','JOSEFINA','JOSÉ ANTONIO','ARTURO','MARCO ANTONIO','JOSÉ MANUEL','FRANCISCO JAVIER','ENRIQUE','VERÓNICA','GERARDO','MARÍA ELENA','LETICIA','ROSA','MARIO','FRANCISCA','ALFREDO','TERESA','ALICIA','MARÍA FERNANDA','SERGIO','ALBERTO','LUIS','ARMANDO','ALEJANDRA','MARTHA','SANTIAGO','YOLANDA','PATRICIA','MARÍA DE LOS ÁNGELES','JUAN MANUEL','ROSA MARÍA','ELIZABETH','GLORIA','ÁNGEL','GABRIELA','SALVADOR','VÍCTOR MANUEL','SILVIA','MARÍA DE GUADALUPE','MARÍA DE JESÚS','GABRIEL','ANDRÉS','ÓSCAR','GUILLERMO','ANA MARÍA','RAMÓN','MARÍA ISABEL','PABLO','RUBEN','ANTONIA','MARÍA LUISA','LUIS ÁNGEL','MARÍA DEL ROSARIO','FELIPE','JORGE JESÚS','JAIME','JOSÉ GUADALUPE','JULIO CESAR','JOSÉ DE JESÚS','DIEGO','ARACELI','ANDREA','ISABEL','MARÍA TERESA','IRMA','CARMEN','LUCÍA','ADRIANA','AGUSTÍN','MARÍA DE LA LUZ','GUSTAVO']),
                            
                            'primer_apellido' => $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'segundo_apellido'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'fecha_nacimiento'=>$faker->randomElement(['1990-08-23','1987-01-24','1984-05-23','1986-12-22','1979-11-13','1983-02-15','1982-03-29']),
                
                            'nacionalidad' => 'ALEMAN',
                
                            'correo'=> 'ucardesarollo@gmail.com',
                
                            'telefono' => $faker->numberBetween(1000000000,10000000000),
                             
                            'calle'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'numero' =>$faker->numberBetween(1,1000),
                
                            'colonia'=>$faker->randomElement(['GABRIEL HERNANDEZ','GUSTAVO A. MADERO','GABRIEL RAMOS MILLAN','TLALPAN','GABRIEL RAMOS MILLAN SECCION BRAMADERO	IZTACALCO','GABRIEL RAMOS MILLAN SECCION TLACOTAL IZTACALCO','GABRIEL REYNA NAVA	NICOLAS ROMERO','GALAXIA	CUAUTITLAN IZCALLI','GALAXIA AZCAPOTZALCO AZCAPOTZALCO','GALAXIA MONARCA','GALAXIA SANTA LUCIA	ALVARO OBREGON','GALEANA','GARCIMARRERO','GENERAL ANTONIO ROSALES','GENERAL MANUEL AVILA CAMACHO','GENERAL PEDRO MARIA ANAYA','GEOVILLAS DE JESUS MARIA','GEOVILLAS DE SAN ISIDRO','GEOVILLAS IXTAPALUCA','GERTRUDIS SANCHEZ 1A. SECC.	GUSTAVO A. MADERO','GERTRUDIS SANCHEZ 2A. SECC.	GUSTAVO A. MADERO']),
                
                            'ciudad' => $faker->randomElement(['ACAPULCO','AGUASCALIENTES','APODACA','BUENAVISTA','CAMPECHE','CANCÚN','CELAYA','CHALCO','CHETUMAL','CHICOLOAPAN','CHIHUAHUA','CHILPANCINGO','CHIMALHUACÁN','CIUDAD ACUÑA','CIUDAD DE MÉXICO DF (CDMX)','CIUDAD DEL CARMEN','CIUDAD LÓPEZ MATEOS','CIUDAD MADERO','CIUDAD OBREGÓN','CIUDAD VALLES','CIUDAD VICTORIA','COATZACOALCOS','COLIMA','CÓRDOBA','CUAUHTÉMOC','CUAUTITLÁN','CUAUTITLÁN IZCALLI','CUAUTLA','CUERNAVACA','CULIACÁN','DELICIAS','DURANGO','ECATEPEC','ENSENADA','FRESNILLO','GENERAL ESCOBEDO','GÓMEZ PALACIO','GUADALAJARA','GUADALUPE','GUADALUPE','GUAYMAS','HERMOSILLO','HIDALGO DEL PARRAL','IGUALA','IRAPUATO','IXTAPALUCA','JIUTEPEC','JUÁREZ','JUÁREZ','LA PAZ','LEÓN','LOS MOCHIS','MANZANILLO','MATAMOROS','MAZATLÁN','MÉRIDA','MEXICALI','MINATITLÁN','MIRAMAR','MONCLOVA','MONTERREY','MORELIA','NAUCALPAN','NAUCALPAN DE JUÁREZ','NAVOJOA','NEZAHUALCÓYOTL','NOGALES','NUEVO LAREDO','OAXACA DE JUÁREZ','OJO DE AGUA','ORIZABA','PACHUCA','PIEDRAS NEGRAS','PLAYA DEL CARMEN','POZA RICA DE HIDALGO','PUEBLA','PUERTO VALLARTA','QUERÉTARO','REYNOSA','SALAMANCA','SALTILLO','SAN CRISTÓBAL DE LAS CASAS','SAN FRANCISCO COACALCO','SAN JUAN BAUTISTA TUXTEPEC','SAN JUAN DEL RÍO','SAN LUIS POTOSÍ','SAN LUIS RÍO COLORADO','SAN NICOLÁS DE LOS GARZA','SAN PABLO DE LAS SALINAS','SAN PEDRO GARZA GARCÍA','SANTA CATARINA','SOLEDAD DE GRACIANO SÁNCHEZ','TAMPICO','TAPACHULA','TEHUACÁN','TEPEXPAN','TEPIC','TEXCOCO DE MORA','TIJUANA','TLALNEPANTLA','TLAQUEPAQUE','TOLUCA','TONALÁ','TORREÓN','TULANCINGO DE BRAVO','TUXTLA','URUAPAN','VERACRUZ','VERACRUZ','VILLA DE ÁLVAREZ','VILLA NICOLÁS ROMERO','VILLAHERMOSA','XALAPA','XICO','ZACATECAS','ZAMORA','ZAPOPAN']),
                
                            'estado'=> $faker->randomElement(['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','CIUDAD DE MÉXICO','COAHUILA','COLIMA','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACÁN','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATÁN','ZACATECAS']),
                            
                            'pais'=>'ALEMANIA',
                
                            ]);
                }
        
                for ($i=0; $i <10; $i++) {
                    DB::table('clientes')-> insert([
                        'pasaporte'=> $faker->numberBetween(100000,1000000),
                        'nombre' => $faker->randomElement(['JUAN','JOSÉ LUIS','JOSÉ','MARÍA GUADALUPE','FRANCISCO','GUADALUPE', 'MARÍA','JUANA','ANTONIO','JESÚS','MIGUEL ÁNGEL','PEDRO','ALEJANDRO','MANUEL','MARGARITA','MARÍA DEL CARMEN','JUAN CARLOS','ROBERTO','FERNANDO','DANIEL','CARLOS','JORGE','RICARDO','MIGUEL','EDUARDO','JAVIER','RAFAEL','MARTÍN','RAÚL','DAVID','JOSEFINA','JOSÉ ANTONIO','ARTURO','MARCO ANTONIO','JOSÉ MANUEL','FRANCISCO JAVIER','ENRIQUE','VERÓNICA','GERARDO','MARÍA ELENA','LETICIA','ROSA','MARIO','FRANCISCA','ALFREDO','TERESA','ALICIA','MARÍA FERNANDA','SERGIO','ALBERTO','LUIS','ARMANDO','ALEJANDRA','MARTHA','SANTIAGO','YOLANDA','PATRICIA','MARÍA DE LOS ÁNGELES','JUAN MANUEL','ROSA MARÍA','ELIZABETH','GLORIA','ÁNGEL','GABRIELA','SALVADOR','VÍCTOR MANUEL','SILVIA','MARÍA DE GUADALUPE','MARÍA DE JESÚS','GABRIEL','ANDRÉS','ÓSCAR','GUILLERMO','ANA MARÍA','RAMÓN','MARÍA ISABEL','PABLO','RUBEN','ANTONIA','MARÍA LUISA','LUIS ÁNGEL','MARÍA DEL ROSARIO','FELIPE','JORGE JESÚS','JAIME','JOSÉ GUADALUPE','JULIO CESAR','JOSÉ DE JESÚS','DIEGO','ARACELI','ANDREA','ISABEL','MARÍA TERESA','IRMA','CARMEN','LUCÍA','ADRIANA','AGUSTÍN','MARÍA DE LA LUZ','GUSTAVO']),
                        
                        'primer_apellido' => $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
            
                        'segundo_apellido'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
            
                        'fecha_nacimiento'=>$faker->randomElement(['1990-08-23','1987-01-24','1984-05-23','1986-12-22','1979-11-13','1983-02-15','1982-03-29']),
            
                        'nacionalidad' => 'CANADIENSE',
            
                        'correo'=> 'ucardesarollo@gmail.com',
            
                        'telefono' => $faker->numberBetween(1000000000,10000000000),
                         
                        'calle'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
            
                        'numero' =>$faker->numberBetween(1,1000),
            
                        'colonia'=>$faker->randomElement(['GABRIEL HERNANDEZ','GUSTAVO A. MADERO','GABRIEL RAMOS MILLAN','TLALPAN','GABRIEL RAMOS MILLAN SECCION BRAMADERO	IZTACALCO','GABRIEL RAMOS MILLAN SECCION TLACOTAL IZTACALCO','GABRIEL REYNA NAVA	NICOLAS ROMERO','GALAXIA	CUAUTITLAN IZCALLI','GALAXIA AZCAPOTZALCO AZCAPOTZALCO','GALAXIA MONARCA','GALAXIA SANTA LUCIA	ALVARO OBREGON','GALEANA','GARCIMARRERO','GENERAL ANTONIO ROSALES','GENERAL MANUEL AVILA CAMACHO','GENERAL PEDRO MARIA ANAYA','GEOVILLAS DE JESUS MARIA','GEOVILLAS DE SAN ISIDRO','GEOVILLAS IXTAPALUCA','GERTRUDIS SANCHEZ 1A. SECC.	GUSTAVO A. MADERO','GERTRUDIS SANCHEZ 2A. SECC.	GUSTAVO A. MADERO']),
            
                        'ciudad' => $faker->randomElement(['ACAPULCO','AGUASCALIENTES','APODACA','BUENAVISTA','CAMPECHE','CANCÚN','CELAYA','CHALCO','CHETUMAL','CHICOLOAPAN','CHIHUAHUA','CHILPANCINGO','CHIMALHUACÁN','CIUDAD ACUÑA','CIUDAD DE MÉXICO DF (CDMX)','CIUDAD DEL CARMEN','CIUDAD LÓPEZ MATEOS','CIUDAD MADERO','CIUDAD OBREGÓN','CIUDAD VALLES','CIUDAD VICTORIA','COATZACOALCOS','COLIMA','CÓRDOBA','CUAUHTÉMOC','CUAUTITLÁN','CUAUTITLÁN IZCALLI','CUAUTLA','CUERNAVACA','CULIACÁN','DELICIAS','DURANGO','ECATEPEC','ENSENADA','FRESNILLO','GENERAL ESCOBEDO','GÓMEZ PALACIO','GUADALAJARA','GUADALUPE','GUADALUPE','GUAYMAS','HERMOSILLO','HIDALGO DEL PARRAL','IGUALA','IRAPUATO','IXTAPALUCA','JIUTEPEC','JUÁREZ','JUÁREZ','LA PAZ','LEÓN','LOS MOCHIS','MANZANILLO','MATAMOROS','MAZATLÁN','MÉRIDA','MEXICALI','MINATITLÁN','MIRAMAR','MONCLOVA','MONTERREY','MORELIA','NAUCALPAN','NAUCALPAN DE JUÁREZ','NAVOJOA','NEZAHUALCÓYOTL','NOGALES','NUEVO LAREDO','OAXACA DE JUÁREZ','OJO DE AGUA','ORIZABA','PACHUCA','PIEDRAS NEGRAS','PLAYA DEL CARMEN','POZA RICA DE HIDALGO','PUEBLA','PUERTO VALLARTA','QUERÉTARO','REYNOSA','SALAMANCA','SALTILLO','SAN CRISTÓBAL DE LAS CASAS','SAN FRANCISCO COACALCO','SAN JUAN BAUTISTA TUXTEPEC','SAN JUAN DEL RÍO','SAN LUIS POTOSÍ','SAN LUIS RÍO COLORADO','SAN NICOLÁS DE LOS GARZA','SAN PABLO DE LAS SALINAS','SAN PEDRO GARZA GARCÍA','SANTA CATARINA','SOLEDAD DE GRACIANO SÁNCHEZ','TAMPICO','TAPACHULA','TEHUACÁN','TEPEXPAN','TEPIC','TEXCOCO DE MORA','TIJUANA','TLALNEPANTLA','TLAQUEPAQUE','TOLUCA','TONALÁ','TORREÓN','TULANCINGO DE BRAVO','TUXTLA','URUAPAN','VERACRUZ','VERACRUZ','VILLA DE ÁLVAREZ','VILLA NICOLÁS ROMERO','VILLAHERMOSA','XALAPA','XICO','ZACATECAS','ZAMORA','ZAPOPAN']),
            
                        'estado'=> $faker->randomElement(['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','CIUDAD DE MÉXICO','COAHUILA','COLIMA','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACÁN','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATÁN','ZACATECAS']),
                        
                        'pais'=>'CANADA',
            
                        ]);
            }
        
            for ($i=0; $i <10; $i++) {
                DB::table('clientes')-> insert([
                    'pasaporte'=> $faker->numberBetween(100000,1000000),
                    'nombre' => $faker->randomElement(['JUAN','JOSÉ LUIS','JOSÉ','MARÍA GUADALUPE','FRANCISCO','GUADALUPE', 'MARÍA','JUANA','ANTONIO','JESÚS','MIGUEL ÁNGEL','PEDRO','ALEJANDRO','MANUEL','MARGARITA','MARÍA DEL CARMEN','JUAN CARLOS','ROBERTO','FERNANDO','DANIEL','CARLOS','JORGE','RICARDO','MIGUEL','EDUARDO','JAVIER','RAFAEL','MARTÍN','RAÚL','DAVID','JOSEFINA','JOSÉ ANTONIO','ARTURO','MARCO ANTONIO','JOSÉ MANUEL','FRANCISCO JAVIER','ENRIQUE','VERÓNICA','GERARDO','MARÍA ELENA','LETICIA','ROSA','MARIO','FRANCISCA','ALFREDO','TERESA','ALICIA','MARÍA FERNANDA','SERGIO','ALBERTO','LUIS','ARMANDO','ALEJANDRA','MARTHA','SANTIAGO','YOLANDA','PATRICIA','MARÍA DE LOS ÁNGELES','JUAN MANUEL','ROSA MARÍA','ELIZABETH','GLORIA','ÁNGEL','GABRIELA','SALVADOR','VÍCTOR MANUEL','SILVIA','MARÍA DE GUADALUPE','MARÍA DE JESÚS','GABRIEL','ANDRÉS','ÓSCAR','GUILLERMO','ANA MARÍA','RAMÓN','MARÍA ISABEL','PABLO','RUBEN','ANTONIA','MARÍA LUISA','LUIS ÁNGEL','MARÍA DEL ROSARIO','FELIPE','JORGE JESÚS','JAIME','JOSÉ GUADALUPE','JULIO CESAR','JOSÉ DE JESÚS','DIEGO','ARACELI','ANDREA','ISABEL','MARÍA TERESA','IRMA','CARMEN','LUCÍA','ADRIANA','AGUSTÍN','MARÍA DE LA LUZ','GUSTAVO']),
                    
                    'primer_apellido' => $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'segundo_apellido'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'fecha_nacimiento'=>$faker->randomElement(['1990-08-23','1987-01-24','1984-05-23','1986-12-22','1979-11-13','1983-02-15','1982-03-29']),
        
                    'nacionalidad' => 'FRANCES',
        
                    'correo'=> 'ucardesarollo@gmail.com',
        
                    'telefono' => $faker->numberBetween(1000000000,10000000000),
                     
                    'calle'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
        
                    'numero' =>$faker->numberBetween(1,1000),
        
                    'colonia'=>$faker->randomElement(['GABRIEL HERNANDEZ','GUSTAVO A. MADERO','GABRIEL RAMOS MILLAN','TLALPAN','GABRIEL RAMOS MILLAN SECCION BRAMADERO	IZTACALCO','GABRIEL RAMOS MILLAN SECCION TLACOTAL IZTACALCO','GABRIEL REYNA NAVA	NICOLAS ROMERO','GALAXIA	CUAUTITLAN IZCALLI','GALAXIA AZCAPOTZALCO AZCAPOTZALCO','GALAXIA MONARCA','GALAXIA SANTA LUCIA	ALVARO OBREGON','GALEANA','GARCIMARRERO','GENERAL ANTONIO ROSALES','GENERAL MANUEL AVILA CAMACHO','GENERAL PEDRO MARIA ANAYA','GEOVILLAS DE JESUS MARIA','GEOVILLAS DE SAN ISIDRO','GEOVILLAS IXTAPALUCA','GERTRUDIS SANCHEZ 1A. SECC.	GUSTAVO A. MADERO','GERTRUDIS SANCHEZ 2A. SECC.	GUSTAVO A. MADERO']),
        
                    'ciudad' => $faker->randomElement(['ACAPULCO','AGUASCALIENTES','APODACA','BUENAVISTA','CAMPECHE','CANCÚN','CELAYA','CHALCO','CHETUMAL','CHICOLOAPAN','CHIHUAHUA','CHILPANCINGO','CHIMALHUACÁN','CIUDAD ACUÑA','CIUDAD DE MÉXICO DF (CDMX)','CIUDAD DEL CARMEN','CIUDAD LÓPEZ MATEOS','CIUDAD MADERO','CIUDAD OBREGÓN','CIUDAD VALLES','CIUDAD VICTORIA','COATZACOALCOS','COLIMA','CÓRDOBA','CUAUHTÉMOC','CUAUTITLÁN','CUAUTITLÁN IZCALLI','CUAUTLA','CUERNAVACA','CULIACÁN','DELICIAS','DURANGO','ECATEPEC','ENSENADA','FRESNILLO','GENERAL ESCOBEDO','GÓMEZ PALACIO','GUADALAJARA','GUADALUPE','GUADALUPE','GUAYMAS','HERMOSILLO','HIDALGO DEL PARRAL','IGUALA','IRAPUATO','IXTAPALUCA','JIUTEPEC','JUÁREZ','JUÁREZ','LA PAZ','LEÓN','LOS MOCHIS','MANZANILLO','MATAMOROS','MAZATLÁN','MÉRIDA','MEXICALI','MINATITLÁN','MIRAMAR','MONCLOVA','MONTERREY','MORELIA','NAUCALPAN','NAUCALPAN DE JUÁREZ','NAVOJOA','NEZAHUALCÓYOTL','NOGALES','NUEVO LAREDO','OAXACA DE JUÁREZ','OJO DE AGUA','ORIZABA','PACHUCA','PIEDRAS NEGRAS','PLAYA DEL CARMEN','POZA RICA DE HIDALGO','PUEBLA','PUERTO VALLARTA','QUERÉTARO','REYNOSA','SALAMANCA','SALTILLO','SAN CRISTÓBAL DE LAS CASAS','SAN FRANCISCO COACALCO','SAN JUAN BAUTISTA TUXTEPEC','SAN JUAN DEL RÍO','SAN LUIS POTOSÍ','SAN LUIS RÍO COLORADO','SAN NICOLÁS DE LOS GARZA','SAN PABLO DE LAS SALINAS','SAN PEDRO GARZA GARCÍA','SANTA CATARINA','SOLEDAD DE GRACIANO SÁNCHEZ','TAMPICO','TAPACHULA','TEHUACÁN','TEPEXPAN','TEPIC','TEXCOCO DE MORA','TIJUANA','TLALNEPANTLA','TLAQUEPAQUE','TOLUCA','TONALÁ','TORREÓN','TULANCINGO DE BRAVO','TUXTLA','URUAPAN','VERACRUZ','VERACRUZ','VILLA DE ÁLVAREZ','VILLA NICOLÁS ROMERO','VILLAHERMOSA','XALAPA','XICO','ZACATECAS','ZAMORA','ZAPOPAN']),
        
                    'estado'=> $faker->randomElement(['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','CIUDAD DE MÉXICO','COAHUILA','COLIMA','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACÁN','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATÁN','ZACATECAS']),
                    
                    'pais'=>'FRANCIA',
        
                    ]);
                    }   
        
                    for ($i=0; $i <10; $i++) {
                        DB::table('clientes')-> insert([
                            'pasaporte'=> $faker->numberBetween(100000,1000000),
                            'nombre' => $faker->randomElement(['JUAN','JOSÉ LUIS','JOSÉ','MARÍA GUADALUPE','FRANCISCO','GUADALUPE', 'MARÍA','JUANA','ANTONIO','JESÚS','MIGUEL ÁNGEL','PEDRO','ALEJANDRO','MANUEL','MARGARITA','MARÍA DEL CARMEN','JUAN CARLOS','ROBERTO','FERNANDO','DANIEL','CARLOS','JORGE','RICARDO','MIGUEL','EDUARDO','JAVIER','RAFAEL','MARTÍN','RAÚL','DAVID','JOSEFINA','JOSÉ ANTONIO','ARTURO','MARCO ANTONIO','JOSÉ MANUEL','FRANCISCO JAVIER','ENRIQUE','VERÓNICA','GERARDO','MARÍA ELENA','LETICIA','ROSA','MARIO','FRANCISCA','ALFREDO','TERESA','ALICIA','MARÍA FERNANDA','SERGIO','ALBERTO','LUIS','ARMANDO','ALEJANDRA','MARTHA','SANTIAGO','YOLANDA','PATRICIA','MARÍA DE LOS ÁNGELES','JUAN MANUEL','ROSA MARÍA','ELIZABETH','GLORIA','ÁNGEL','GABRIELA','SALVADOR','VÍCTOR MANUEL','SILVIA','MARÍA DE GUADALUPE','MARÍA DE JESÚS','GABRIEL','ANDRÉS','ÓSCAR','GUILLERMO','ANA MARÍA','RAMÓN','MARÍA ISABEL','PABLO','RUBEN','ANTONIA','MARÍA LUISA','LUIS ÁNGEL','MARÍA DEL ROSARIO','FELIPE','JORGE JESÚS','JAIME','JOSÉ GUADALUPE','JULIO CESAR','JOSÉ DE JESÚS','DIEGO','ARACELI','ANDREA','ISABEL','MARÍA TERESA','IRMA','CARMEN','LUCÍA','ADRIANA','AGUSTÍN','MARÍA DE LA LUZ','GUSTAVO']),
                            
                            'primer_apellido' => $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'segundo_apellido'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'fecha_nacimiento'=>$faker->randomElement(['1990-08-23','1987-01-24','1984-05-23','1986-12-22','1979-11-13','1983-02-15','1982-03-29']),
                
                            'nacionalidad' => 'HOLANDES',
                
                            'correo'=> 'ucardesarollo@gmail.com',
                
                            'telefono' => $faker->numberBetween(1000000000,10000000000),
                             
                            'calle'=> $faker->randomElement(['GONZÁLEZ','RODRÍGUEZ','GÓMEZ','FERNÁNDEZ','LÓPEZ','DÍAZ','MARTÍNEZ','PÉREZ','GARCÍA','SÁNCHEZ','ROMERO','SOSA','ÁLVAREZ','TORRES','RUIZ','RAMÍREZ','FLORES','ACOSTA','BENÍTEZ','MEDINA','SUÁREZ','HERRERA','AGUIRRE','PEREYRA','GUTIÉRREZ','GIMÉNEZ','MOLINA','SILVA','CASTRO','ROJAS','ORTÍZ','NÚÑEZ','LUNA','JUÁREZ','CABRERA','RÍOS','FERREYRA','GODOY','MORALES','DOMÍNGUEZ','MORENO','PERALTA']),
                
                            'numero' =>$faker->numberBetween(1,1000),
                
                            'colonia'=>$faker->randomElement(['GABRIEL HERNANDEZ','GUSTAVO A. MADERO','GABRIEL RAMOS MILLAN','TLALPAN','GABRIEL RAMOS MILLAN SECCION BRAMADERO	IZTACALCO','GABRIEL RAMOS MILLAN SECCION TLACOTAL IZTACALCO','GABRIEL REYNA NAVA	NICOLAS ROMERO','GALAXIA	CUAUTITLAN IZCALLI','GALAXIA AZCAPOTZALCO AZCAPOTZALCO','GALAXIA MONARCA','GALAXIA SANTA LUCIA	ALVARO OBREGON','GALEANA','GARCIMARRERO','GENERAL ANTONIO ROSALES','GENERAL MANUEL AVILA CAMACHO','GENERAL PEDRO MARIA ANAYA','GEOVILLAS DE JESUS MARIA','GEOVILLAS DE SAN ISIDRO','GEOVILLAS IXTAPALUCA','GERTRUDIS SANCHEZ 1A. SECC.	GUSTAVO A. MADERO','GERTRUDIS SANCHEZ 2A. SECC.	GUSTAVO A. MADERO']),
                
                            'ciudad' => $faker->randomElement(['ACAPULCO','AGUASCALIENTES','APODACA','BUENAVISTA','CAMPECHE','CANCÚN','CELAYA','CHALCO','CHETUMAL','CHICOLOAPAN','CHIHUAHUA','CHILPANCINGO','CHIMALHUACÁN','CIUDAD ACUÑA','CIUDAD DE MÉXICO DF (CDMX)','CIUDAD DEL CARMEN','CIUDAD LÓPEZ MATEOS','CIUDAD MADERO','CIUDAD OBREGÓN','CIUDAD VALLES','CIUDAD VICTORIA','COATZACOALCOS','COLIMA','CÓRDOBA','CUAUHTÉMOC','CUAUTITLÁN','CUAUTITLÁN IZCALLI','CUAUTLA','CUERNAVACA','CULIACÁN','DELICIAS','DURANGO','ECATEPEC','ENSENADA','FRESNILLO','GENERAL ESCOBEDO','GÓMEZ PALACIO','GUADALAJARA','GUADALUPE','GUADALUPE','GUAYMAS','HERMOSILLO','HIDALGO DEL PARRAL','IGUALA','IRAPUATO','IXTAPALUCA','JIUTEPEC','JUÁREZ','JUÁREZ','LA PAZ','LEÓN','LOS MOCHIS','MANZANILLO','MATAMOROS','MAZATLÁN','MÉRIDA','MEXICALI','MINATITLÁN','MIRAMAR','MONCLOVA','MONTERREY','MORELIA','NAUCALPAN','NAUCALPAN DE JUÁREZ','NAVOJOA','NEZAHUALCÓYOTL','NOGALES','NUEVO LAREDO','OAXACA DE JUÁREZ','OJO DE AGUA','ORIZABA','PACHUCA','PIEDRAS NEGRAS','PLAYA DEL CARMEN','POZA RICA DE HIDALGO','PUEBLA','PUERTO VALLARTA','QUERÉTARO','REYNOSA','SALAMANCA','SALTILLO','SAN CRISTÓBAL DE LAS CASAS','SAN FRANCISCO COACALCO','SAN JUAN BAUTISTA TUXTEPEC','SAN JUAN DEL RÍO','SAN LUIS POTOSÍ','SAN LUIS RÍO COLORADO','SAN NICOLÁS DE LOS GARZA','SAN PABLO DE LAS SALINAS','SAN PEDRO GARZA GARCÍA','SANTA CATARINA','SOLEDAD DE GRACIANO SÁNCHEZ','TAMPICO','TAPACHULA','TEHUACÁN','TEPEXPAN','TEPIC','TEXCOCO DE MORA','TIJUANA','TLALNEPANTLA','TLAQUEPAQUE','TOLUCA','TONALÁ','TORREÓN','TULANCINGO DE BRAVO','TUXTLA','URUAPAN','VERACRUZ','VERACRUZ','VILLA DE ÁLVAREZ','VILLA NICOLÁS ROMERO','VILLAHERMOSA','XALAPA','XICO','ZACATECAS','ZAMORA','ZAPOPAN']),
                
                            'estado'=> $faker->randomElement(['AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','CHIAPAS','CHIHUAHUA','CIUDAD DE MÉXICO','COAHUILA','COLIMA','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACÁN','MORELOS','NAYARIT','NUEVO LEÓN','OAXACA','PUEBLA','QUERÉTARO','QUINTANA ROO','SAN LUIS POTOSÍ','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATÁN','ZACATECAS']),
                            
                            'pais'=>'HOLANDA',
                
                            ]);
     } 
    }
}
