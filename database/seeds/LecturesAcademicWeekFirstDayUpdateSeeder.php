<?php


use Illuminate\Database\Seeder;
use AcademicDirectory\Domains\Lectures\Lecture;
use Illuminate\Support\Facades\DB;

class LecturesAcademicWeekFirstDayUpdateSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecture::find(2)->update([
            'local' => 'Prédio 32 FACIN - AGES Sala 107'
        ]);
//Android

        deleteUsersLecturesByLectureId(3);
        Lecture::find(3)->update([
            'local' => 'Prédio 32, Laboratório 312',
            'init_hour' => setHourAndMinute(19, 00),
            'end_hour' => setHourAndMinute(22, 30),
            'event_schedule_id' => 2,
            'description' => 'Curso básico de Android. Ministrante - Daniel Dacorso',
        ]);

//Angular
        deleteUsersLecturesByLectureId(4);
        Lecture::find(4)->update([
            'init_hour' => setHourAndMinute(17, 30),
            'end_hour' => setHourAndMinute(22, 30),
            'event_schedule_id' => 2,
            'description' => 'Ministrante - Antônio Vilmar Silveira Castro',
            'local' => 'Local a ser definido na data do Curso'
        ]);

//Palestra Ecore

        Lecture::find(11)->update([
            'subject' => '#First Round on Us',
            'description' => 'Suporte à clientes internacionais.',
            'lecture_category_id' => 1
        ]);

//AntônioReis
        deleteUsersLecturesByLectureId(13);
        Lecture::find(13)->update([
            'init_hour' => setHourAndMinute(20, 30),
            'end_hour' => setHourAndMinute(21, 30),
            'description' => 'No início temos os conhecimentos básicos: A programação estruturada com os seus desvios condicionais, laços de repetição, conectores lógicos, vetores e matrizes, Pesquisa e
Ordenação, Funções, Arquivos, etc..',
        ]);

//iot- Contexto
        deleteUsersLecturesByLectureId(14);
        Lecture::find(14)->update([
            'event_schedule_id' => 2,
            'init_hour' => setHourAndMinute(12, 30),
            'end_hour' => setHourAndMinute(13, 30),
            'description' => 'Palestra dada pelo PhD em Ciênca da Computação Everton De Matos',
            'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102',
        ]);

        //iot- Segurança
        deleteUsersLecturesByLectureId(26);
        Lecture::find(26)->update([
            'event_schedule_id' => 1,
            'init_hour' => setHourAndMinute(21, 30),
            'end_hour' => setHourAndMinute(22, 30),
            'description' => 'Palestra dada pelo PhD em Ciênca da Computação, Ramão Tiago Tiburskis',
            'local' => 'Prédio 97 Global Tecnopuc - Auditório sala 109',
        ]);

        /*

        SOBRE O SEGUNDO DIA

         */
        deleteUsersLecturesByLectureId(32);
        Lecture::find(32)->update([
            'local' => 'Prédio 32, Laboratório 312',
            'init_hour' => setHourAndMinute(19, 00),
            'end_hour' => setHourAndMinute(22, 30),
            'event_schedule_id' => 1,
            'description' => 'Ministrante - Daniel Dacorso',
        ]);

//React.js
        deleteUsersLecturesByLectureId(31);
        Lecture::find(31)->update([
            'subject' => 'Curso de React.js',
            'local' => 'Prédio 32, Laboratório 309',
            'init_hour' => setHourAndMinute(19, 00),
            'end_hour' => setHourAndMinute(22, 30),
            'event_schedule_id' => 2,
            'description' => 'Curso básico de React.js realizado pela empresa E-core. Ministrante - Jean Bauer',
        ]);
//insert Nodejs

        DB::table('lectures')->insert([
            [
                'subject' => 'Curso de NodeJs',
                'description' => 'Curso básico de Nodejs ministrado por Andrey Moser',
                'init_hour' => setHourAndMinute(19, 00),
                'end_hour' => setHourAndMinute(22, 30),
                'max_people' => 30,
                'event_schedule_id' => 1, 'lecture_category_id' => 2,
                'local' => 'Prédio 32, Laboratório 309'
            ]
        ]);

// Inception Enxuta
        deleteUsersLecturesByLectureId(19);
        Lecture::find(19)->update([
            'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102',
            'init_hour' => setHourAndMinute(9, 30),
            'end_hour' => setHourAndMinute(10, 30),
            'event_schedule_id' => 2,
            'description' => 'Mayra Rodrigues, Analista de negócios na Thoughtworks, facilitadora de Inception, práticas ágeis e workshops. É apaixonada por facilitação',
        ]);
//me formei e agora?
        deleteUsersLecturesByLectureId(18);
        Lecture::find(18)->update([
            'init_hour' => setHourAndMinute(10, 30),
            'end_hour' => setHourAndMinute(11, 30),
            'description' => 'Presença de alunos formados pela facin como estão hoje no mercado e dicas que podem dar aos alunos que estão começando hj na faculdade.'
        ]);
//Software livre
//A cadeia produtiva nacional do Software Livre

        deleteUsersLecturesByLectureId(16);
        Lecture::find(16)->update([
            'subject' => 'A cadeia produtiva nacional do Software Livre',
            'init_hour' => setHourAndMinute(11, 30),
            'end_hour' => setHourAndMinute(12, 30),
            'description' => 'Desenvolvimento de código é uma arte que requer conhecimento, mas que pode alcançar padrões impensáveis com colaboração e compartilhamento. E é essa capacidade técnica que pode tornar o desenvolvedor brasileiro, a indústria de software nacional e o Brasil, uma referência mundial, ao custo de algumas boas políticas, um pouco de coragem e doses decisivas de inovação e ousadia.
'
        ]);
//iot - contexto ja arrumado 12::30/1:30

//programacao dinamica ja arrumado 17:30/18:30

//Eloi - IOT 19:30/20:30

        deleteUsersLecturesByLectureId(21);
        Lecture::find(21)->update([
            'subject' => 'INTERNET das coisas',
            'local' => 'Prédio 32 FACIN - Auditório Terreo Sala 102	',
            'init_hour' => setHourAndMinute(18, 30),
            'end_hour' => setHourAndMinute(19, 30),
            'event_schedule_id' => 2,
            'description' => 'Eloi Dara uma idéia basica de Internet das coisas .',

        ]);
//Cloud Services 19:30/20:30

        deleteUsersLecturesByLectureId(22);
        Lecture::find(22)->update([
            'subject' => 'Cloud Computing Club – O que é diferente na nuvem? - SAP',
            'local' => 'Prédio 32 FACIN - Auditório Terreo Sala 102	',
            'init_hour' => setHourAndMinute(19, 30),
            'end_hour' => setHourAndMinute(20, 30),
            'event_schedule_id' => 2,
            'description' => 'Não informado pelo palestrante',
        ]);
// Mobilidade academica 20:30 as 21:30

        deleteUsersLecturesByLectureId(23);
        Lecture::find(23)->update([
            'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102',
            'init_hour' => setHourAndMinute(20, 30),
            'end_hour' => setHourAndMinute(21, 30),
            'event_schedule_id' => 2,
            'description' => 'Estudar fora do pais, desafios, superação, novidades?'
        ]);


//Rafael ASL  -21:30 /22:30

        DB::table('lectures')->insert([
            [
                'subject' => 'Conhecimento livre: Um novo paradigma para a ciência, tecnologia e educação',
                'description' => ' Atualmente é membro da colaboração ALICE do CERN, dedicada à pesquisa das propriedades do plasma de quarks e glúons através da colisão de íons pesados relativísticos. Também coordena o Centro de Tecnologia Acadêmica da UFRGS, que atua na pesquisa e desenvolvimento de hiperobjetos compostos de hardware e software livres e abertos e a aplicação destes hiperobjetos em Recursos Educacionais Abertos, tecnologias livres, ciência aberta e ciência cidadã. Faz parte do comitê organizador do Primeiro encontro Brasileiro de Hardware Aberto e Livre (1º e-HAL)',
                'init_hour' => setHourAndMinute(21, 30),
                'end_hour' => setHourAndMinute(22, 30),
                'max_people' => 30,
                'event_schedule_id' => 2, 'lecture_category_id' => 1,
                'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102'
            ]
        ]);

        deleteUsersLecturesByLectureId(17);
        Lecture::find(17)->delete();

        deleteUsersLecturesByLectureId(23);
        Lecture::find(23)->delete();


        /*
         * UPDATE TERCEIRO DIA
         */

        //curso descomplicando sharelatex
        Lecture::find(33)->update([
            'local' => 'Prédio 32, Laboratório 410',
            'description' => 'Ministrante - Anderson Domingues mostrará como funciona e as principais funções para usar o ShareLatex : https://www.sharelatex.com/',
        ]);

        //imagine - CUP

        deleteUsersLecturesByLectureId(24);
        Lecture::find(24)->update([
            'subject' => 'Imagine CUP',
            'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102',
            'init_hour' => setHourAndMinute(10, 30),
            'end_hour' => setHourAndMinute(11, 30),
            'event_schedule_id' => 3,
            'description' => 'Dê vida a suas ideias com ousadia. O Microsoft Imagine conecta alunos a ferramentas, recursos e experiências que são necessários para aprimorar suas habilidades no mundo profissional atual. Seja na criação de um jogo, no design de um aplicativo ou no lançamento de um projeto, o Microsoft Imagine ajuda os alunos a desenvolver e dar vida a suas ideias com ousadia.',
        ]);


        DB::table('lectures')->insert([
            [
                'subject' => 'Carreira internacional - SAP',
                'description' => 'Matheus Soares possui graduação em Engenharia de Computação pela PUCRS, tendo feito intercâmbio na University of Tennessee. Foi bolsista de iniciação científica no Grupo de Sistemas Embarcados (GSE) da PUCRS. Iniciou a carreira na SAP em 2013 como Rotation Intern e atualmente é desenvolvedor na localização de Itália e Portugal.',
                'init_hour' => setHourAndMinute(19, 30),
                'end_hour' => setHourAndMinute(20, 30),
                'max_people' => 100,
                'event_schedule_id' => 1, 'lecture_category_id' => 1,
                'local' => 'Prédio 32 FACIN - Auditório térreo, Sala 102'
            ]
        ]);
    }

}