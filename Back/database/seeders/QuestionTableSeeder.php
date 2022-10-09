<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert datas in the array into question table
        Question::insert([
            [ 
                'question'=>'Votre adresse mail',
                'question_type'=>'B',
                'answer_choice'=>null,
                'survey_id'=>1
            ],
            [ 
                'question'=>'Votre âge',
                'question_type'=>'B',
                'answer_choice'=>null,
                'survey_id'=>1
            ],
            [ 
                'question'=>'Votre sexe',
                'question_type'=>'A',
                'answer_choice'=>'Homme, Femme, Préfère ne pas répondre',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Nombre de personne dans votre foyer (adulte & enfants)',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Votre profession',
                'question_type'=>'B',
                'answer_choice'=>null,
                'survey_id'=>1
            ],
            [ 
                'question'=>'Quel marque de casque VR utilisez-vous ?',
                'question_type'=>'A',
                'answer_choice'=>'Oculus Quest, Oculus Rift/s, HTC Vive, Windows Mixed Reality, Valve index',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Sur quel magasin d’application achetez vous des contenus VR ?',
                'question_type'=>'A',
                'answer_choice'=>'SteamVR, Occulus store, Viveport, Windows store',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Quel casque envisagez-vous d’acheter dans un futur proche  ?',
                'question_type'=>'A',
                'answer_choice'=>'Occulus Quest, Occulus Go, HTC Vive Pro, PSVR, Autre, Aucun',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Au sein de votre foyer, combien de personnes utilisent votre casque VR pour regarder Bigscreen ?',
                'question_type'=>'C','answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Vous utilisez principalement Bigscreen pour',
                'question_type'=>'A',
                'answer_choice'=>'regarder la TV en direct, regarder des films, travailler, jouer en solo, jouer en équipe',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Combien donnez-vous de point pour la qualité de l’image sur Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Combien donnez-vous de point pour le confort d’utilisation de l’interface Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Combien donnez-vous de point pour la connexion réseau de Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Combien donnez-vous de point pour la qualité des graphismes 3D dans Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Combien donnez-vous de point pour la qualité audio dans Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Aimeriez vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?',
                'question_type'=>'A',
                'answer_choice'=>'Oui, Non',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Aimeriez vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?',
                'question_type'=>'A',
                'answer_choice'=>'Oui, Non',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Aimeriez vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Aimeriez-vous jouer à des jeux exclusifs sur votre Bigscreen ?',
                'question_type'=>'C',
                'answer_choice'=>' 1, 2, 3, 4, 5',
                'survey_id'=>1
            ],
            [ 
                'question'=>'Quelle nouvelle fonctionnalité devrait exister sur Bigscreen ?',
                'question_type'=>'B',
                'answer_choice'=>null,
                'survey_id'=>1
            ]
        ]);
    }
    
}
