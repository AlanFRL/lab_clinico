<?php

namespace Database\Seeders;

use App\Models\Bioquimico;
use App\Models\Historial;
use App\Models\TipoSeguro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Registro;
use App\Models\Especialidad;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user1 = User::create([
            'name' => 'Jhoel Debray',
            'email' => 'JhoelDebray@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Paciente');
        $user2 = User::create([
            'name' => 'Manuel medrano',
            'email' => 'ManuelMedrano@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Paciente');
        $user3 = User::create([
            'name' => 'Carla Zapata',
            'email' => 'CarlaZapata@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Paciente');
        $user4 = User::create([
            'name' => 'Tania Valdez',
            'email' => 'TaniaValdez@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Paciente');
        $user5 = User::create([
            'name' => 'Dr. Juan Perez',
            'email' => 'JuanPerez@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Bioquimico');




        $historial1 = Historial::create([
            'nroHistoria' => 'H-1',
            'fechaRegistro' => '2021-01-01',
            'antecedentesPatologicos' => 'ninguno',
        ]);
        
        $historial2 = Historial::create([
            'nroHistoria' => 'H-2',
            'fechaRegistro' => '2021-02-02',
            'antecedentesPatologicos' => 'ninguno',
        ]);

        $historial3 = Historial::create([
            'nroHistoria' => 'H-3',
            'fechaRegistro' => '2021-03-03',
            'antecedentesPatologicos' => 'ninguno',
        ]);

        $historial4 = Historial::create([
            'nroHistoria' => 'H-4',
            'fechaRegistro' => '2021-04-04',
            'antecedentesPatologicos' => 'ninguno',
        ]);

        $tiposeguro1 = TipoSeguro::create([
            'descripcion' => 'Caja Petrolera',
            'descuento' => 50,
        ]);
        $tiposeguro2 = TipoSeguro::create([
            'descripcion' => 'CNS',
            'descuento' => 100,
        ]);
        $tiposeguro3 = TipoSeguro::create([
            'descripcion' => 'SEGURO PRIVADO',
            'descuento' => 100,
        ]);






        Paciente::create([
            'ci' => '123456',
            'nombre' => 'Carlos Perez',
            'fechaNacimiento' => '1990-01-01',
            'sexo' => 'MASCULINO',
            'telefono' => '70016993',
            'idTipoSeguro' => $tiposeguro1->id,
            'idHistorial' => $historial1->id,
            'idUser' => $user1->id,
        ]);

        Paciente::create([
            'ci' => '654321',
            'nombre' => 'Manuel medrano',
            'fechaNacimiento' => '1990-01-02',
            'sexo' => 'MASCULINO',
            'telefono' => '60960799',
            'idTipoSeguro' => $tiposeguro1->id,
            'idHistorial' => $historial2->id,
            'idUser' => $user2->id,
        ]);


        Paciente::create([
            'ci' => '123426',
            'nombre' => 'Carla Zapata',
            'fechaNacimiento' => '1990-01-01',
            'sexo' => 'FEMENINO',
            'telefono' => '70016993',
            'idTipoSeguro' => $tiposeguro3->id,
            'idHistorial' => $historial3->id,
            'idUser' => $user3->id,
        ]);

        Paciente::create([
            'ci' => '654321',
            'nombre' => 'Tania Valdez',
            'fechaNacimiento' => '1990-01-02',
            'sexo' => 'FEMENINO',
            'telefono' => '60960799',
            'idTipoSeguro' => $tiposeguro2->id,
            'idHistorial' => $historial4->id,
            'idUser' => $user4->id,
        ]);

        $especialidad = Especialidad::create([
            'nombre' => 'Bioquimica', // 'nombre' => 'Bioquimica
            'descripcion' => 'Bioquimica',
        ]);


        $bioquimico = Bioquimico::create([
            'ci' => '123456',
            'direccion' => 'av. 6 de agosto',
            'nombre' => 'Juan Perez',
            'fechaNacimiento' => '1990-01-01',
            'sexo' => 'MASCULINO',
            'telefono' => '70016993',
            'idEspecialidad' => $especialidad->id,
        ]);


        Registro::create([
            
            'tipo_analisis' => 'QUIMICA SANGUINEA',
            'fecha' => '2021-01-01',
            'doctor' => 'Dr. Juan Perez',
            'precion_arterial' => '120/80 mmHg',
            'peso' => '75',
            'altura' => '170',
            'notas' => 'El analisis resulto normal sin ninguna anomalia',
            'idBioquimico' => $bioquimico->id,
            'idHistorial' => $historial1->id
        ]);

        Registro::create([
            
            'tipo_analisis' => 'HEMOGRAMA COMPLETO',
            'fecha' => '2021-02-02',
            'doctor' => 'Dr. Juan Perez',
            'precion_arterial' => '110/80 mmHg',
            'peso' => '75',
            'altura' => '170',
            'notas' => 'ninguna',
            'idBioquimico' => $bioquimico->id,
            'idHistorial' => $historial1->id
        ]);

        Registro::create([
            
            'tipo_analisis' => 'QUIMICA SANGUINEA',
            'fecha' => '2021-03-03',
            'doctor' => 'Dr. Juan Perez',
            'precion_arterial' => '120/80 mmHg',
            'peso' => '75',
            'altura' => '170',
            'notas' => 'ninguna',
            'idBioquimico' => $bioquimico->id,
            'idHistorial' => $historial1->id
        ]);

        Registro::create([
            
            'tipo_analisis' => 'HEMOGRAMA COMPLETO',
            'fecha' => '2021-04-04',
            'doctor' => 'Dr. Juan Perez',
            'precion_arterial' => '100/70 mmHg',
            'peso' => '70',
            'altura' => '174',
            'notas' => 'el paciente tiene una anomalia en la cantidad de plaquetas',
            'idBioquimico' => $bioquimico->id,
            'idHistorial' => $historial1->id
        ]);



    }
}
