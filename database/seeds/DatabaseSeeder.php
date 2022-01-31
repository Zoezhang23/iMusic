<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zoe',
            'email' => 'zoe@123.com',
            'password' => bcrypt('123456'),
            'avatar_url' => 'default.png',
            'isAdmin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Kuan',
            'email' => 'kuan@123.com',
            'password' => bcrypt('123456'),
            'avatar_url' => 'default.png',
            'isAdmin' => false
        ]);
        DB::table('comments')->insert([
            'comment_name' => 'first comment',
            'comment_content' => 'first comment content'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Adele',
            'description' => 'Adele Laurie Blue Adkins MBE is an English singer-songwriter. After graduating from the BRIT School for Performing Arts and Technology in 2006, Adele was given a recording contract by XL Recordings after a friend posted her demo on Myspace the same year.',
            'singer_pic_url' => 'Adele.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Big Bang',
            'description' => 'Big Bang (Korean: 빅뱅) is a South Korean boy band formed by YG Entertainment. Consisting of members G-Dragon, T.O.P, Taeyang, Daesung, and Seungri, the group officially debuted on August 19, 2006.',
            'singer_pic_url' => 'Bang.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'the Beatles',
            'description' => 'The Beatles were an English rock band, formed in Liverpool in 1960. With members John Lennon, Paul McCartney, George Harrison and Ringo Starr, they became widely regarded as the foremost and most influential act of the rock era',
            'singer_pic_url' => 'Beatles.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Jay',
            'description' => 'Jay Chou (traditional Chinese: 周杰倫; simplified Chinese: 周杰伦; pinyin: Zhōu Jiélún; born 18 January 1979) is a Taiwanese musician, singer, songwriter, record producer, film producer, actor and director.',
            'singer_pic_url' => 'Jay.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Bruno Mars',
            'description' => "Peter Gene Hernandez (born October 8, 1985), known professionally as Bruno Mars (/ˈmɑːrz/), is an American singer-songwriter, multi-instrumentalist, record producer, and choreographer.",
            'singer_pic_url' => 'Mars.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Rihana',
            'description' => 'Robyn Rihanna Fenty (/riˈænə/;[1] born February 20, 1988) is a Barbadian singer, songwriter, and actress. Born in Saint Michael and raised in Bridgetown, she first entered the music industry by recording demo tapes under the direction of record producer Evan Rogers in 2003. ',
            'singer_pic_url' => 'Rihana.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Taylor Swift',
            'description' => 'Taylor Alison Swift (born December 13, 1989) is an American singer-songwriter. One of the most popular contemporary female recording artists, she is known for narrative songs about her personal life, which has received much media attention.',
            'singer_pic_url' => 'Taylor.png'
        ]);
        DB::table('singers')->insert([
            'singer_name' => 'Weekend',
            'description' => 'The weeknd :This article holds apatronymicname. This person is addressed by his name,Abel, and not asMakkonen.Abel Makkonen Tesfaye(born 16 February 1990), known professionally asThe Weeknd(pronounced "the weekend"), is a Canadian singer, songwriter and record producer.',
            'singer_pic_url' => 'Weeked.png'
        ]);
    }
}
