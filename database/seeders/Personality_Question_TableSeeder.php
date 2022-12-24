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
                'question' => 'Tick following answers if its match with how student behave in class in terms of his/her extraversion',
                'type' => 'mcq',
                'ans_choices' =>
                json_encode(
                    array(
                        'extroversion' =>

                        array(
                            'Talkative',
                            'Outgoing',
                            'Sociable',
                            'Loved to be center of attention',
                            'Conversation stater',
                            'Center of attention'
                        ),

                        'introversion' =>
                        array(
                            'Shy',
                            'Quiet',
                            'Reserved',
                            'Inhibited',
                            'Passive',
                            'Bashful'
                        )
                    )
                ),
            ],
            [

                'category' => 'Agreeableness',
                'question' => 'Tick following answers if its match with how student behave in class in terms of his/her agreeableness',
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
                            'Lenient',
                            'Helpful'
                        ),

                        'competitiveness' =>
                        array(
                            'Uncooperative',
                            'Irritable',
                            'Cold',
                            'Harsh',
                            'Rude',
                            'Aloof'
                        )
                    )
                ),
            ],
            [

                'category' => 'Neuroticism',
                'question' => 'Tick following answers if its match with how student behave in class in terms of his/her neuroticism',
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
                            'Freaquent mood swings',
                            'Insecure'
                        ),

                        'stable' =>
                        array(
                            'Unenvious',
                            'Calm',
                            'Relaxed',
                            'Handle stress well',
                            'Emotionally-stable',
                            'Comfortable'
                        )
                    )
                ),
            ],
            [

                'category' => 'Conscientiousness',
                'question' => 'Tick following answers if its match with how student behave in class in terms of his/her conscientiousness',
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
                            'Punctual',
                            'Disciplined'
                        ),

                        'spontaneity' =>
                        array(
                            'Inefficient',
                            'Careless',
                            'Impulsive',
                            'Easily distracted',
                            'Impractical',
                            'Late attendance/submission'
                        )
                    )
                ),
            ],
            [

                'category' => 'Openness',
                'question' => 'Tick following answers if its match with how student behave in class in terms of his/her openness',
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
                            'Preference for variety',
                            'Open to new ideas'
                        ),

                        'consistency' =>
                        array(
                            'Inefficient',
                            'Uncreative',
                            'Practical',
                            'Down-to-earth',
                            'Preference for routine',
                            'Conventional'
                        )
                    )
                ),
            ],
            //open ended 
            [

                'category' => 'Extraversion',
                'question' => 'Describe how student behave in class in terms of his/her extraversion',
                'type' => 'o',
                'ans_choices' => json_encode('Extraversion includes traits such as talkative, energetic, assertive, and outgoing. <br/> 
                Social interaction is the key here. <br/> 
                Extraverts often take on positions of leadership; first to offer their opinion and suggestions.')
            ],
            [

                'category' => 'Agreeableness',
                'question' => 'Describe how student behave in class in terms of his/her agreeableness',
                'type' => 'o',
                'ans_choices' => json_encode('Agreeableness reflects the student tendency to develop and maintain prosocial relationships. <br/>
                Students high in this trait are more trustworthy, straightforward, altruistic, compliant, modest, and tender-minded.')
            ],
            [

                'category' => 'Neuroticism',
                'question' => 'Describe how student behave in class in terms of his/her emotional stability',
                'type' => 'o',
                'ans_choices' => json_encode('Student with neuroticism may be self-conscious and shy. <br/>
                They may tend to internalize phobias and other neurotic traits, such as anxiety, panic, aggression, negativity, and depression. <br/>
                Neuroticism is an ongoing emotional state defined by these negative reactions and feelings.')
            ],
            [

                'category' => 'Conscientiousness',
                'question' => 'Describe how student behave in class in terms of his/her conscientiousness',
                'type' => 'o',
                'ans_choices' => json_encode('Conscientiousness is the personality trait of being careful, or diligent. <br/>
                Conscientiousness implies a desire to do a task well, and to take obligations to others seriously. <br/>
                Conscientious people tend to be efficient and organized as opposed to easy-going and disorderly.')
            ],
            [

                'category' => 'Openness',
                'question' => 'Describe how student behave in class in terms of his/her openness',
                'type' => 'o',
                'ans_choices' => json_encode('Openness is how open-minded, imaginative, creative and insightful a person is or can be. <br/>
                 More open minded people tend to prefer variety, seek new experiences and are curious and perceptive to their environment. <br/>
                 Less open minded people tend to avoid change, dislike disruption and focus on a few specific interests.')
            ]

        ];
        DB::table('personality_questions')->insert($questions);
    }
}
