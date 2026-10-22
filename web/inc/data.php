<?php
/*
 * Site content for the public website.
 * Edit text, people and contact details here; the page templates read from this file.
 */

$school = [
    'name'       => 'Shri Balaji English Primary & Secondary School',
    'short_name' => 'Shri Balaji School',
    'place'      => 'Wadegaon',
    'trust'      => 'Shri Balaji Yuvak Krida Mandal, Wadegaon',
    'motto'      => 'Achieving the impossible through dedication and determination',
    'founded'    => 1998,
    'about'      => 'Shri Balaji English Primary & Secondary School, Wadegaon is directed by Shri Balaji Yuvak Krida Mandal Wadegaon, established in 1998. Our school offers an inquiry based, child centered and academically rigorous curriculum that addresses the perfect English medium education with the intellectual, social and emotional needs of each child in rural areas, to make them well cultured.',
    'prospectus' => 'assets/images/BalajiEnglishSchool.pdf',
    'portal'     => '/signin/index',
];

$contact = [
    'phones'   => [
        ['label' => 'Office', 'display' => '+91 96040 44131', 'tel' => '+919604044131'],
        ['label' => 'Office', 'display' => '+91 96573 59335', 'tel' => '+919657359335'],
    ],
    'whatsapp' => '919604044131',
    'email'    => 'info@shribalajiengschool.in',
    'address'  => ['Wadegaon', 'Tq. Balapur, Dist. Akola', 'Maharashtra'],
    'map_query' => 'Shri Balaji English School, Wadegaon, Balapur, Akola',
];

$heroSlides = [
    [
        'image' => 'assets/images/opt/hero-2.jpg',
        'title' => 'Explore your potential & talents at Shri Balaji School',
        'text'  => 'Shri Balaji School is committed to providing world-class education that will enable our students to succeed in their chosen fields. We offer a wide range of programs that cater to the unique needs and interests of our students.',
        'tag'   => 'Morning assembly',
    ],
    [
        'image' => 'assets/images/opt/hero-1.jpg',
        'title' => 'Explore your creativity & talent with Shri Balaji School',
        'text'  => 'We offer a range of courses in the arts and sciences that are designed to help you reach your potential. Come explore what Shri Balaji School has to offer!',
        'tag'   => 'Annual function',
    ],
    [
        'image' => 'assets/images/opt/hero-3.jpg',
        'title' => 'Start your beautiful & bright future from here',
        'text'  => 'Shri Balaji School is the perfect place to start your academic journey. With our top-tier faculties, ample resources and support, your success is guaranteed!',
        'tag'   => 'Educational tour',
    ],
];

$institutes = [
    ['icon' => 'ri-book-open-line',  'title' => 'English Primary & Secondary School', 'name' => 'Shri Balaji English Primary & Secondary School, Wadegaon', 'year' => 2004],
    ['icon' => 'ri-quill-pen-line',  'title' => 'Marathi Primary & Secondary School', 'name' => 'Late. Ramraoji Gawande Vidyalaya, Umra', 'year' => 1995],
    ['icon' => 'ri-book-3-line',     'title' => 'Library',                            'name' => 'Shri. Balaji Public Library, Wadegaon (Grade-B)', 'year' => 1991],
];

$facilities = [
    ['icon' => 'ri-government-line',   'text' => 'Nursery to 10th Class, full English medium'],
    ['icon' => 'ri-building-2-line',   'text' => 'Spacious building with 30 rooms'],
    ['icon' => 'ri-computer-line',     'text' => 'Free computer lab'],
    ['icon' => 'ri-tv-2-line',         'text' => 'Digital room facility'],
    ['icon' => 'ri-plant-line',        'text' => 'Adequate play materials'],
    ['icon' => 'ri-football-line',     'text' => 'Spacious playground'],
    ['icon' => 'ri-shield-check-line', 'text' => 'Admission as per RTE Act (25%)'],
    ['icon' => 'ri-user-star-line',    'text' => 'Trained, well educated & experienced teachers'],
];

$stats = [
    ['value' => 19, 'suffix' => '+',  'label' => 'Years of experience'],
    ['value' => 2,  'suffix' => 'k+', 'label' => 'Students'],
    ['value' => 50, 'suffix' => '+',  'label' => 'Teachers'],
];

$achievements = [
    'state' => [
        ['name' => 'Pranav Ramesh Ingle', 'year' => '2022-2023', 'sport' => 'Carrom'],
    ],
    'division' => [
        ['name' => 'Sakshi Gopal Sarap',             'year' => '2019-2020', 'sport' => 'Shot Put'],
        ['name' => 'Aishwarya Muralidhar Lokhande',  'year' => '2019-2020', 'sport' => 'Rope Mallakhamb'],
        ['name' => 'Om Pradip Kale',                 'year' => '2019-2020', 'sport' => 'Archery Indian'],
        ['name' => 'Parth Sanjay Akhare',            'year' => '2022-2023', 'sport' => 'Archery Indian'],
        ['name' => 'Om Pradip Kale',                 'year' => '2022-2023', 'sport' => 'Archery Indian'],
        ['name' => 'Ujwal Gajanan Ambhore',          'year' => '2022-2023', 'sport' => 'Mallakhamb'],
        ['name' => 'Vedant Prakash Shegokar',        'year' => '2022-2023', 'sport' => 'Mallakhamb'],
        ['name' => 'Achal Gajanan Ambhore',          'year' => '2022-2023', 'sport' => 'Mallakhamb'],
        ['name' => 'Anjali Gajanan Huse',            'year' => '2022-2023', 'sport' => 'Rope Mallakhamb'],
    ],
];

$management = [
    ['name' => 'Vilas Sukhdeo Warokar',       'role' => 'President',      'photo' => 'assets/management/opt/vilas-warokar.jpg'],
    ['name' => 'Vilas Tulshiram Huse',        'role' => 'Vice President', 'photo' => 'assets/management/opt/vilas-huse.jpg'],
    ['name' => 'Bhaskar Deorao Kale',         'role' => 'Vice President', 'photo' => 'assets/management/opt/bhaskar-kale.jpg'],
    ['name' => 'Arun Jagdeo Potdukhe',        'role' => 'Secretary',      'photo' => 'assets/management/opt/arun-potdukhe.jpg'],
    ['name' => 'Vijay Shridhar Katkhede',     'role' => 'Member',         'photo' => 'assets/management/opt/vijay-katkhede.jpg'],
    ['name' => 'Baburao Bhagwan Ajgar',       'role' => 'Member',         'photo' => 'assets/management/opt/baburao-ajgar.jpg'],
    ['name' => 'Baliram Gotiram Ghatol',      'role' => 'Member',         'photo' => 'assets/management/opt/baliram-ghatol.jpg'],
    ['name' => 'Prakash Natthuji Kandarkar',  'role' => 'Member',         'photo' => 'assets/management/opt/prakash-kandarkar.jpg'],
    ['name' => 'Devanand Govindrao Katkhede', 'role' => 'Member',         'photo' => 'assets/management/opt/devanand-katkhede.jpg'],
    ['name' => 'Digambar Sukhdev Kale',       'role' => 'Member',         'photo' => 'assets/management/opt/digambar-kale.jpg'],
];

$leaders = [
    ['name' => 'Mr. Dipak Manikrao Masane',  'role' => 'Principal',  'qual' => 'M.A., B.Ed',               'phone' => '9763757391', 'photo' => 'assets/management/opt/dipak-masane.jpg'],
    ['name' => 'Mrs. Varsha Pande',          'role' => 'Principal',  'qual' => 'B.A., M.A., M.Com, B.Ed', 'phone' => '8446556137', 'photo' => 'assets/management/opt/varsha-pande.jpg'],
    ['name' => 'Kapil Mahendraprasad Pande', 'role' => 'Supervisor', 'qual' => 'B.Com, D.Ed',             'phone' => '7709933293', 'photo' => 'assets/management/opt/kapil-pande.jpg'],
];

$officeStaff = [
    ['name' => 'Mr. Mangesh Sahdevrao Masane', 'phone' => '9604044131'],
    ['name' => 'Mr. Sagar Arun Potdukhe',      'phone' => '9657359335'],
    ['name' => 'Mr. Ram Mahadeo Kale',         'phone' => '9604398296'],
    ['name' => 'Mrs. Shraddha Sachin Ghatol',  'phone' => '9284709296'],
];

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function initials($name)
{
    $parts = preg_split('/\s+/', trim(preg_replace('/^(Mr|Mrs|Ms|Dr)\.?\s+/i', '', $name)));
    return strtoupper(substr($parts[0], 0, 1) . (count($parts) > 1 ? substr(end($parts), 0, 1) : ''));
}
