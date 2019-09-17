<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class Vehiculo extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246591',
                'matricula' => 'URU-197-A',
                'marca' => 'Nissan',
                'modelo' => 'March - 2018',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 16,
                'estatus' => 'disponible',
                'anio' => 2018,
                'precio' => 1095.00, 
                'costo' => 150000.00, 
                'pasajeros' => 5,
                'maletero' =>  '2 Maletas Grandes',
                'color' =>  'Blanco',
                'cilindros' => 4,
                'kilometraje' => 4000,
                'tipo' => 'compacto',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246592',
                'matricula' => 'URU-197-B',
                'marca' => 'Chevrolet',
                'modelo' => 'Aveo-2016',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 20,
                'estatus' => 'disponible',
                'anio' => 2016,
                'precio' => 1200.00, 
                'costo' => 170000.00, 
                'pasajeros' => 5,
                'maletero' =>  '4 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 4,
                'kilometraje' => 8000,
                'tipo' => 'compacto',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246593',
                'matricula' => 'URU-197-C',
                'marca' => 'Renault',
                'modelo' => 'Duster-2018',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 12,
                'estatus' => 'disponible',
                'anio' => 2018,
                'precio' => 1500.00, 
                'costo' => 200000.00, 
                'pasajeros' => 7,
                'maletero' =>  '5 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 6,
                'kilometraje' => 10000,
                'tipo' => 'camioneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246594',
                'matricula' => 'URU-197-D',
                'marca' => 'Toyota',
                'modelo' => 'Hilux-2014',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 10,
                'estatus' => 'disponible',
                'anio' => 2014,
                'precio' => 2000.00, 
                'costo' => 250000.00, 
                'pasajeros' => 7,
                'maletero' =>  'Gran pacidad de transporte',
                'color' =>  'Plata',
                'cilindros' => 6,
                'kilometraje' => 15000,
                'tipo' => 'camioneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246595',
                'matricula' => 'URU-197-E',
                'marca' => 'Dodge',
                'modelo' => 'Durango-2013',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 10,
                'estatus' => 'disponible',
                'anio' => 2013,
                'precio' => 1800.00, 
                'costo' => 230000.00, 
                'pasajeros' => 7,
                'maletero' =>  '5 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 6,
                'kilometraje' => 5000,
                'tipo' => 'camioneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246596',
                'matricula' => 'URU-197-F',
                'marca' => 'Chevrolet',
                'modelo' => 'suburban-2008',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 8,
                'estatus' => 'disponible',
                'anio' => 2008,
                'precio' => 1900.00, 
                'costo' => 300000.00, 
                'pasajeros' => 7,
                'maletero' =>  '5 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 6,
                'kilometraje' => 20350,
                'tipo' => 'van',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246597',
                'matricula' => 'URU-197-G',
                'marca' => 'Subaru',
                'modelo' => 'XV-2018',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 18,
                'estatus' => 'disponible',
                'anio' => 2018,
                'precio' => 1200.00, 
                'costo' => 150000.00, 
                'pasajeros' => 5,
                'maletero' =>  '2 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 4,
                'kilometraje' => 3000,
                'tipo' => 'compacto',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246598',
                'matricula' => 'URU-197-H',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));

            //carros duplicados
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246599',
                'matricula' => 'URU-197-I',
                'marca' => 'Subaru',
                'modelo' => 'XV-2018',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 18,
                'estatus' => 'disponible',
                'anio' => 2018,
                'precio' => 1200.00, 
                'costo' => 150000.00, 
                'pasajeros' => 5,
                'maletero' =>  '2 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 4,
                'kilometraje' => 3000,
                'tipo' => 'compacto',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246600',
                'matricula' => 'URU-197-J',
                'marca' => 'Subaru',
                'modelo' => 'XV-2018',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 18,
                'estatus' => 'disponible',
                'anio' => 2018,
                'precio' => 1200.00, 
                'costo' => 150000.00, 
                'pasajeros' => 5,
                'maletero' =>  '2 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 4,
                'kilometraje' => 3000,
                'tipo' => 'compacto',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246601',
                'matricula' => 'URU-197-K',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246602',
                'matricula' => 'URU-197-L',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246603',
                'matricula' => 'URU-197-M',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246604',
                'matricula' => 'URU-197-N',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246605',
                'matricula' => 'URU-197-O',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246606',
                'matricula' => 'URU-197-P',
                'marca' => 'Honda',
                'modelo' => 'Dio-2019',
                'transmicion' => 'no aplica',//no aplica
                'puertas' => 0,              //no aplica
                'rendimiento' => 25,
                'estatus' => 'disponible',
                'anio' => 2019,
                'precio' => 900.00, 
                'costo' => 15000.00, 
                'pasajeros' => 0,           //no aplica
                'maletero' =>  'no aplica', //no aplica
                'color' =>  'Azul',
                'cilindros' => 250,         //considerar
                'kilometraje' => 15000,
                'tipo' => 'motoneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
            \DB::table('vehiculos')->insert(array(
                'vin' => '1GNCS13Z6M0246607',
                'matricula' => 'URU-197-Q',
                'marca' => 'Dodge',
                'modelo' => 'Durango-2013',
                'transmicion' => 'standar',
                'puertas' => 4,
                'rendimiento' => 10,
                'estatus' => 'disponible',
                'anio' => 2013,
                'precio' => 1800.00, 
                'costo' => 230000.00, 
                'pasajeros' => 7,
                'maletero' =>  '5 Maletas Grandes',
                'color' =>  'Plata',
                'cilindros' => 6,
                'kilometraje' => 5000,
                'tipo' => 'camioneta',
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_derecha' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_izquierda' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_frente' => 'img/flota/Chevrolet-Aveo-2018.jpg',
                'foto_trasera' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
    }
}
