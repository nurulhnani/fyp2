<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Personality_Question_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [

            //scale
            [
                'category' => 'Extraversion',
                'question' => 'Is talkative',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Competitiveness',
                'question' => 'Tends to find fault with others',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Conscientiousness',
                'question' => 'Does a through job',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Neuroticism',
                'question' => 'Is depressed, blue',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Openness',
                'question' => 'Is original, comes up with new ideas',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Introversion',
                'question' => 'Is reserved',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Agreeableness',
                'question' => 'Is helpful and unselfish with others',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Spontaneity',
                'question' => 'Can be somewhat careless',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Stable',
                'question' => 'Is relaxed, handles stress well',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Is curious about many different things',
                'type' => 's',
                'ans_choices' => null

            ],
            //10s
            [
                'category' => 'Extraversion',
                'question' => 'Is full of energy',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Competitiveness',
                'question' => 'Starts quarrels with others',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Conscientiousness',
                'question' => 'Is a reliable worker',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Neuroticism',
                'question' => 'Can be tense',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Is ingenious, a deep thinker',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Extraversion',
                'question' => 'Generates a lot of enthusiasm',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Agreeableness',
                'question' => 'Has a forgiving nature',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Spontaneity',
                'question' => 'Tend to be disorganized',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Neuroticism',
                'question' => 'Worries a lot',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Has an active imagination',
                'type' => 's',
                'ans_choices' => null

            ],
            //10s

            [
                'category' => 'Introversion',
                'question' => 'Tends to be quiet',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Agreeableness',
                'question' => 'Is generally trusting',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Spontaneity',
                'question' => 'Tends to be lazy',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Stable',
                'question' => 'Is emotionally stable, not easily upset',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Is inventive',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Extraversion',
                'question' => 'Has an assertive personality',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Competitiveness',
                'question' => 'Can be cold and aloof',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Conscientiousness',
                'question' => 'Perseveres until the task is finished',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Neuroticism',
                'question' => 'Can be moody',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Value artistic, aesthetic experiences',
                'type' => 's',
                'ans_choices' => null

            ],
            //10s

            [
                'category' => 'Introversion',
                'question' => 'Is sometimes shy, inhibited',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Agreeableness',
                'question' => 'Is considerate and kind to almost everyone',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Conscientiousness',
                'question' => 'Does things efficiently',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Stable',
                'question' => 'Remains calm in tense situations',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Consistency',
                'question' => 'Prefers work that is routine',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Extraversion',
                'question' => 'Is outgoing, sociable',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Competitiveness',
                'question' => 'Is sometimes rude to others',
                'type' => 's',
                'ans_choices' => null

            ],

            [
                'category' => 'Conscientiousness',
                'question' => 'Makes plans and follows through with them',
                'type' => 's',
                'ans_choices' => null

            ],
            [
                'category' => 'Neuroticism',
                'question' => 'Get nervous easily',
                'type' => 's',
                'ans_choices' => null

            ],
            [

                'category' => 'Openness',
                'question' => 'Likes to reflect, play with ideas',
                'type' => 's',
                'ans_choices' => null

            ],
            //mcq
            [

                'category' => 'Extraversion',
                'question' => 'Student\'s extraversion',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'extroversion' =>

                        array(
                            'Talkative',
                            'Outgoing',
                            'Enjoy socialing',
                            'Loved to be center of attention',
                            'Conversation stater'
                        ),

                        'introversion' =>
                        array(
                            'Shy',
                            'Quiet',
                            'Reserved',
                            'Inhibited',
                            'Passive'
                        )
                    )
                ),
            ],
            [

                'category' => 'Agreeableness',
                'question' => 'Student\'s agreeableness',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'agreeableness' =>

                        array(
                            'Trusting',
                            'Tolerant',
                            'Generous',
                            'Care for others',
                            'Lenient'
                        ),

                        'competitiveness' =>
                        array(
                            'Uncooperative',
                            'Irritable',
                            'Cold',
                            'Harsh',
                            'Rude'
                        )
                    )
                ),
            ],
            [

                'category' => 'Neuroticism',
                'question' => 'Student\'s neuroticism',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'neuroticism' =>

                        array(
                            'Tense',
                            'Nervous',
                            'Anxious',
                            'Self-conscious',
                            'Freaquent mood swings'
                        ),

                        'stable' =>
                        array(
                            'Unenvious',
                            'Calm',
                            'Relaxed',
                            'Handle stress well',
                            'Emotionally-stable'
                        )
                    )
                ),
            ],
            [

                'category' => 'Conscientiousness',
                'question' => 'Student\'s conscientiousness',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'conscientiousness' =>

                        array(
                            'Organized',
                            'Neat',
                            'Systematic',
                            'Dependable',
                            'Punctual'
                        ),

                        'spontaneity' =>
                        array(
                            'Inefficient',
                            'Careless',
                            'Impulsive',
                            'Lazy',
                            'Impractical'
                        )
                    )
                ),
            ],
            [

                'category' => 'Openness',
                'question' => 'Student\'s openness',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'openness' =>

                        array(
                            'Innovative',
                            'Creative',
                            'Imaginative',
                            'Always curious',
                            'Preference for variety'
                        ),

                        'consistency' =>
                        array(
                            'Inefficient',
                            'Uncreative',
                            'Practical',
                            'Down-to-earth',
                            'Preference for routine'
                        )
                    )
                ),
            ],
            //open ended 
            [

                'category' => 'Extraversion',
                'question' => 'Student\'s extaraversion',
                'type' => 'o',
                'ans_choices' => null
            ],
            [

                'category' => 'Agreeableness',
                'question' => 'Student\'s agreeableness',
                'type' => 'o',
                'ans_choices' => null
            ],
            [

                'category' => 'Neuroticism',
                'question' => 'Student\'s emotional stability',
                'type' => 'o',
                'ans_choices' => null
            ],
            [

                'category' => 'Conscientiousness',
                'question' => 'Student\'s conscientiousness',
                'type' => 'o',
                'ans_choices' => null
            ],
            [

                'category' => 'Openness',
                'question' => 'Student\'s openness',
                'type' => 'o',
                'ans_choices' => null
            ]

        ];
        DB::table('personality_questions')->insert($questions);
    }
}
