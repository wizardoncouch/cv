<?php

require('fpdf/fpdf.php');

Class Profile
{

    public function __construct()
    {
        $this->pdf = new FPDF('P', 'mm', 'Letter');
        $this->x = 25;
        $this->y = 25;
        $this->marginx = 45;
        $this->length = 175;
        $this->height = 230;
    }

    public function init()

    {
        $this->pdf->AddPage();
        $this->personal();
        $this->skills();
        $this->experience();
        $this->education();
        $this->pdf->Output('Resume.pdf', 'i');
    }

    private function personal()
    {
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Alex L. Culango');

        $this->y += 6;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Senior Applications Developer');

        #$this->pdf->SetFillColor(225,225,225);
        #$this->pdf->Rect(0, $this->y+3, 216, 44,'F');

        $this->pdf->Image('rsz_profile.jpg', $this->x, $this->y + 1, 43, 43);


        $this->y += 10;
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Personal Data');
        $this->pdf->Text($this->x + $this->marginx + 65, $this->y, 'Contact Details');

        $this->pdf->SetFont('Arial', '', 10);

        $this->y += 6;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Date of Birth:');
        $this->pdf->Text($this->x + $this->marginx + 25, $this->y, 'December 18, 1988');
        $this->pdf->Text($this->x + $this->marginx + 65, $this->y, 'Address:');
        $this->pdf->Text($this->x + $this->marginx + 85, $this->y, 'Capitol Site, Cebu City 6000');

        $this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Place of Birth:');
        $this->pdf->Text($this->x + $this->marginx + 25, $this->y, 'Altavista, Poro, Cebu');
        $this->pdf->Text($this->x + $this->marginx + 65, $this->y, 'Mobile:');
        $this->pdf->Text($this->x + $this->marginx + 85, $this->y, '(+63) 916 627 6768');

        $this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Gender:');
        $this->pdf->Text($this->x + $this->marginx + 25, $this->y, 'Male');
        $this->pdf->Text($this->x + $this->marginx + 65, $this->y, 'Email:');
        $this->pdf->Text($this->x + $this->marginx + 85, $this->y, 'alex.culango@gmail.com');

        $this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Civil Status:');
        $this->pdf->Text($this->x + $this->marginx + 25, $this->y, 'Single');
        $this->pdf->Text($this->x + $this->marginx + 65, $this->y, 'Skype:');
        $this->pdf->Text($this->x + $this->marginx + 85, $this->y, 'wizardoncouch');

        $this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Citizenship:');
        $this->pdf->Text($this->x + $this->marginx + 25, $this->y, 'Filipino');

        /*$this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Height:');
        $this->pdf->Text($this->x + 70, $this->y, '5\' 10"');

        $this->y += 5;
        $this->pdf->Text($this->x + $this->marginx, $this->y, 'Weight:');
        $this->pdf->Text($this->x + 70, $this->y, '148 lbs');*/

        $this->y += 15;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x, $this->y, 'Summary');
        $this->y += 6;
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->setXY($this->x, $this->y);
        $this->pdf->Multicell(170, 5,
            'I am a developer that specialize core logic, database designs, data and application integration, API and other back-end processes of an application or website.');
        $this->y = $this->pdf->GetY();
        $this->y += 3;
        $this->pdf->setXY($this->x, $this->y);
        $this->pdf->Multicell(170, 5, 'I have been developing web applications since 2008.');
        $this->y = $this->pdf->GetY();
        $this->y += 3;
        $this->pdf->setXY($this->x, $this->y);
        $this->pdf->Multicell(170, 5, 'I also do front end and mobile application development.');
        $this->y = $this->pdf->GetY();
        $this->y += 3;
        $this->pdf->setXY($this->x, $this->y);
        $this->pdf->Multicell(170, 5, 'Capable also of leading development projects.');
        $this->y = $this->pdf->GetY();
    }

    private function skills()
    {
        $force = ($this->y > 230) ? true : false;
        $this->newpage($force);
        $this->y += 10;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x, $this->y, 'Skills');

        $list = $this->skillsList();

        if (count($list) > 0) {
            foreach ($list as $array) {
                $this->newpage();
                $this->y += 7.5;
                $this->pdf->SetFont('Arial', 'B', 10);
                $this->pdf->Text($this->x, $this->y, $array['category']);

                $this->pdf->SetFont('Arial', '', 10);
                if (isset($array['inline']) && $array['inline'] == true) {
                    $this->newpage();
                    $this->y += 2;
                    $this->pdf->setXY($this->x, $this->y);
                    $this->pdf->Multicell(170, 5, implode(', ', $array['list']), 0, 'L');
                    $this->y = $this->pdf->GetY();
                } else {
                    foreach ($array['list'] as $row) {
                        $this->newpage();
                        $this->y += 5;
                        $this->pdf->Text($this->x, $this->y, '- ' . $row);
                    }
                }
            }

        }

    }

    private function experience()
    {
        $force = ($this->y > 200) ? true : false;
        $this->newpage($force);
        $this->y += 15;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x, $this->y, 'Experience');
        $list = $this->expList();

        if (count($list) > 0) {
            $list = array_reverse($list);
            foreach ($list as $array) {
                $this->newpage();
                $this->y += 8;
                $this->pdf->SetFont('Arial', '', 10);
                $this->pdf->SetTextColor(100, 100, 100);
                if (isset($array['from']) || isset($array['to'])) // this is for the date part
                {
                    if(is_array($array['from']) && is_array($array['to'])){
                        $yy = $this->y;
                        for($zz = 0; $zz < count($array['from']); $zz++){
                            $txt = '';
                            if (isset($array['from'][$zz])) {
                                $txt .= date("F Y", strtotime($array['from'][$zz]));
                            }
                            if (isset($array['to'][$zz])) {
                                $txt .= ' - ';
                                if ($array['to'][$zz] == date("Y-m-d")) {
                                    $txt .= 'Present';
                                } else {
                                    $txt .= date("F Y", strtotime($array['to'][$zz]));
                                }
                            }
                            $this->pdf->Text($this->x, $yy, $txt);
                            $yy += 6;
                        }
                        
                    }else{
                        $txt = '';
                        if (isset($array['from'])) {
                            $txt .= date("F Y", strtotime($array['from']));
                        }
                        if (isset($array['to'])) {
                            $txt .= ' - ';
                            if ($array['to'] == date("Y-m-d")) {
                                $txt .= 'Present';
                            } else {
                                $txt .= date("F Y", strtotime($array['to']));
                            }
                        }
                        $this->pdf->Text($this->x, $this->y, $txt);
                    }
                    
                    // if (isset($array['from']) && isset($array['to'])) {
                        // $diffdate = '(' . $this->diffdate($array['from'], $array['to']) . ')';
                        // $swidth = $this->pdf->GetStringWidth($diffdate);
                        // $mx = ($this->marginx - $swidth) / 2;
                        // $this->pdf->SetFont('Arial', '', 8);
                        // $this->pdf->Text($this->x + $mx, $this->y + 6, $diffdate);
                    // }
                    $this->pdf->SetTextColor(0, 0, 0);

                }// end of the date

                $this->pdf->SetFont('Arial', 'B', 11);
                $this->pdf->Text($this->x + $this->marginx, $this->y, $array['title']);

                if (isset($array['company'])) {
                    $this->newpage();
                    $this->y += 6;
                    $this->pdf->SetFont('Arial', 'B', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['company']);
                }
                if (isset($array['street'])) {
                    $this->newpage();
                    $this->y += 5;
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['street']);
                }

                if (isset($array['address'])) {
                    $this->newpage();
                    $this->y += 5;
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['address']);
                }

                if (isset($array['job'])) {
                    $this->newpage();
                    $this->y += 3;
                    $this->pdf->SetFont('Arial', '', 10);
                    foreach ($array['job'] as $job) {
                        $this->newpage();
                        $this->y += 1;
                        $this->pdf->SetXY($this->x + $this->marginx, $this->y);
                        $this->pdf->MultiCell(130, 5, '- ' . $job, 0, 'L');
                        $this->y = $this->pdf->GetY();
                    }
                }

                if (isset($array['projects'])) {
                    $this->newpage();
                    $this->y += 3;
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->SetTextColor(80, 80, 80);
                    foreach ($array['projects'] as $project) {
                        $force = ($this->y > 230) ? true : false;
                        $this->newpage($force);
                        $this->y += 5;
                        $this->pdf->SetFont('Arial', 'B', '10');
                        $this->pdf->Text($this->x + $this->marginx, $this->y, $project['title']);
                        $this->pdf->SetFont('Arial', '', 10);
                        $this->newpage();
                        $this->y += 1;
                        $this->pdf->SetXY($this->x + $this->marginx, $this->y);
                        $this->pdf->Multicell(130, 5, '- ' . $project['description'], 0, 'L');
                        $this->y = $this->pdf->GetY();
                        $this->newpage();
                        $this->y += 1;
                        $this->pdf->SetXY($this->x + $this->marginx, $this->y);
                        $this->pdf->Multicell(130, 5, '- ' . $project['language'], 0, 'L');
                        $this->y = $this->pdf->GetY();

                    }
                    $this->pdf->SetTextColor(0, 0, 0);
                }


            }
        }

    }

    private function education()
    {
        $this->y += 10;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x, $this->y, 'Educational Background');

        $list = $this->educationList();

        if (count($list) > 0) {
            foreach ($list as $array) {
                $this->newpage();
                $this->y += 8;
                $this->pdf->SetFont('Arial', '', 10);
                if (isset($array['from']) || isset($array['to'])) // this is for the date part
                {
                    $txt = '';
                    if (isset($array['from'])) {
                        $txt .= date("F Y", strtotime($array['from']));
                    }
                    if (isset($array['to'])) {
                        $txt .= ' - ' . date("F Y", strtotime($array['to']));
                    }
                    $this->pdf->SetTextColor(100, 100, 100);
                    $this->pdf->Text($this->x, $this->y, $txt);
                    $this->pdf->SetTextColor(0, 0, 0);

                }// end of the date

                $this->pdf->SetFont('Arial', 'B', 11);
                $this->pdf->Text($this->x + $this->marginx, $this->y, $array['title']);

                if (isset($array['course'])) {
                    $this->newpage();
                    $this->y += 6;
                    $this->pdf->SetFont('Arial', 'B', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['course']);
                }
                if (isset($array['school'])) {
                    $this->newpage();
                    $this->y += 5;
                    $this->pdf->SetFont('Arial', 'B', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['school']);
                }
                if (isset($array['address'])) {
                    $this->newpage();
                    $this->y += 5;
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, $array['address']);
                }
                if (isset($array['telephone'])) {
                    $this->newpage();
                    $this->y += 5;
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->Text($this->x + $this->marginx, $this->y, 'Tel. no.: ' . $array['telephone']);
                }

            }

        }
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Text($this->x, $this->y + 15, 'References are available on request.');


    }

    private function diffdate($from, $to)
    {
        $start = new DateTime($from);
        $to = new DateTime($to);
        $diff = $start->diff($to);
        $txt = '';
        if ($diff->y > 0) {
            $txt .= $diff->y;
            if ($diff->y > 1) {
                $txt .= ' years';
            } else {
                $txt .= ' year';
            }
        }
        if ($diff->m > 0) {
            if ($diff->y > 0) {
                $txt .= ' and ';
            }
            $txt .= $diff->m;
            if ($diff->m > 1) {
                $txt .= ' months';
            } else {
                $txt .= ' month';
            }
        }

        return $txt;
    }

    private function newpage($force = false)
    {
        if ($force) {
            $this->pdf->AddPage();
            $this->y = 25;
        } else {
            if ($this->y >= 260) {
                $this->pdf->AddPage();
                $this->y = 25;
            }
        }

    }

    private function skillsList()
    {
        $list = [];
        $list[] = [
            'category' => 'Web Development',
            'list'     => [
                'PHP (Laravel, CodeIgniter)',
                'Python (Django, Flask, Cherrypy)',
                'Javascript (NodeJS, VueJs, React, AngularJs, Jquery, XHR/AJAX)',
                'Wordpress/Joomla',
                'Gulp / Webpack',
                'HTML / HTML5 / XHTML / Smarty / Blade - Templating',
                'CSS / CSS3 / SASS / SCSS',
                'Bootstrap'
            ],
            'inline'   => true
        ];
        $list[] = [
            'category' => 'Database',
            'list'     => ['MySQL', 'PostgreSQL', 'MongoDB'],
            'inline'   => true
        ];
        $list[] = [
            'category' => 'Desktop Application/ Mobile Application Development',
            'list'     => ['Python', 'Java', 'Android', 'IOS'],
            'inline'   => true
        ];
        $list[] = [
            'category' => 'Operating Systems',
            'list'     => ['Windows', 'Unix / Linux(Debian/Ubuntu/CentOS/Fedora)'],
            'inline'   => true
        ];
        $list[] = [
            'category' => 'Testing Frameworks',
            'list'     => ['Codeception - PHP', 'PhpUnit - PHP', 'PyVows - Python', 'Cucumber - Ruby']
        ];
        $list[] = [
            'category' => 'Agile Practices',
            'list'     => [
                'Behavior-driven development',
                'Test-driven development',
                'Scrum board',
                'Scrum meetings',
                'Continuous Integration'            ]
        ];
        $list[] = [
            'category' => 'Others',
            'list'     => [
                'Linux Web Server Administration',
                'Basic Networking',
                'Capable of creating web based applications',
                'Process Improvement',
                'Global Customer Service and Support',
                'Communication (both writing and speaking)',
                'JIRA / Asana'
            ]
        ];

        return $list;
    }

    private function educationList()
    {
        $list = [];
        $list[] = [
            'title'     => 'College',
            'course'    => 'Information Technology',
            'from'      => '2005-06-01',
            'to'        => '2008-05-24',
            'school'    => 'Center for Industrial Technology and Enterprise / CITE Technical Institute',
            'address'   => 'Purok II, San Jose, Cebu City 6000 Philippines',
            'telephone' => '(32) 346-1611'
        ];

        return $list;
    }

    private function expList()
    {
        $list = [];

        /*$list[] = [
            'title'    => 'Personal Projects',
            'projects' => [
                [
                    'title'       => 'No name yet :-)',
                    'description' => 'An ongoing personal project that will serve as a guide or search engine for places here in the Philippines (with style)',
                    'language'    => 'Laravel, MongoDB, Bootstrap, JQuery, Vue, HTML5, CSS / CSS3'
                ]
            ]
        ];*/

        $list[] = [
            'title'   => 'OJT - IT Helpdesk / Technical Support',
            'from'    => '2007-03-01',
            'to'      => '2008-06-02',
            'company' => 'TMX Philippinex Inc. (TIMEX)',
            'address' => 'PEZA, Lapu-lapu City Cebu 6015 Philippines',
            'job'     => ['As an IT Support, I handled global user\'s request and inquiries regarding on their issues on computers. I managed phone calls and first level incidents.']
        ];
        $list[] = [
            'title'    => 'Junior - Senior Applications Developer',
            'from'     => '2008-06-04',
            'to'       => '2013-01-31',
            'company'  => 'Cebu Software Inc.',
            'address'  => 'Banilad, Cebu City 6000 Philippines',
            'job'      => [
                'Web Applications Development',
                'Android Mobile Development',
                'Rewrite existing Software',
                'Web Server Administration'
            ],
            'projects' => [
                [
                    'title'       => 'Yeti',
                    'description' => 'Application that manage domain services and hosting',
                    'language'    => 'PHP, MySQL, JavaScript, AJAX, JQuery, HTML, CSS'
                ],
                [
                    'title'       => 'AVWG - Arzneimittelversorgungs-Wirtschaftlichkeitsgesetz',
                    'description' => 'It provides or feeds data about drugs to many companies in the pharmaceutical industry.',
                    'language'    => 'PHP, MySQL, JavaScript, AJAX, JQuery, HTML, CSS'
                ],
                [
                    'title'       => 'HAM - Hearing Aid Manager',
                    'description' => 'Cloud service application for the hearing aid company. This application provides inventory management in real time for arbitrarily large branch systems, auto insurance billing, accounting system, track of the product / logs.',
                    'language'    => 'PHP, MySQL, JavaScript, AJAX, JQuery, HTML, CSS'
                ],
                [
                    'title'       => 'DocOffice',
                    'description' => 'Application for doctors. This is an easy-to-use, web-based EHR software that promotes convenient and secure access of patient records while addressing the frustrations of adopting a digital approach to record keeping. It has accounting system and calendar embeded on the application to help work much easier.',
                    'language'    => 'PHP, MySQL, CouchDB, JWebSocket, JavaScript, AJAX, JQuery, HTML, CSS'
                ],
                [
                    'title'       => 'Aionio',
                    'description' => 'A web application for aionio.com. This application has admin office also that manage products, customers, inventory and accounting.',
                    'language'    => 'PHP, MySQL, JavaScript, AJAX, JQuery, HTML, CSS'
                ],
                [
                    'title'       => 'Genie',
                    'description' => 'Application to manage Indiansummer company that supplies accessories for export. This application manage employees, products, customers, suppliers, inventory and accounting system (payroll, invoice and billings).',
                    'language'    => 'PHP, MySQL, JavaScript, AJAX, JQuery, HTML, CSS'
                ]
            ]
        ];

        $list[] = [
            'title'   => 'Web Developer',
            'from'    => '2014-05-01',
            'to'      => '2014-07-31',
            'company' => 'Kodenta Inc.',
            'street'  => '2nd Floor, I2 Bldg.',
            'address' => 'Cebu IT Park, Lahug Cebu City 6000 Philippines',
            'job'     => ['Web Applications Developer using PHP / CodeIgniter, MySQL, JQuery, Bootstrap CSS, HTML.']
        ];

        $list[] = [
            'title'    => 'Senior Web Application Developer',
            'from'     => ['2013-02-20', '2016-02-15'],
            'to'       => ['2015-05-30', '2016-05-31'],
            'company'  => 'GreenWire Global Outsourcing, Inc.',
            'street'   => 'Unit 606 Keppel Center, Samar Loop cor. Cardinal Rosales Ave.,',
            'address'  => 'Cebu Business Park, Cebu City 6000 Philippines',
            'job'      => ['I am part of an agile team and mostly assigned on the back-end of the applications development.'],
            'projects' => [
                [
                    'title'       => 'VerticalOps',
                    'description' => 'Used to monitor the sales of the agents. Has a tool also to populate prospects to Vicidial from Limelight and process order.',
                    'language'    => 'PHP / Laravel PHP Framework, MySQL, Jquery, Websocket, Bootstrap, CSS, HTML / HTML5'
                ],
                [
                    'title'       => 'CRM',
                    'description' => 'Used by agents to manage clients and billings.',
                    'language'    => 'PHP, MySQL, CodeIgniter PHP framework, Jquery, Bootstrap CSS, HTML.'
                ],
                [
                    'title'       => 'Livewell',
                    'description' => 'An online application where desease managers can manage their patients, and diabetic patients can monitor their blood glucose, blood pressure, and weight.',
                    'language'    => 'PHP, MySQL, Laravel PHP framework, MySQL, Jquery, Bootstrap CSS, HTML. We are using GIT for revision control and source code management, Jenkins for continous integration and JIRA to manage the project.'
                ],
                [
                    'title'       => 'FallingWater',
                    'description' => 'An ongoing project which manage claims and insurance eligibility of patients and is integrated with SalesForce.',
                    'language'    => 'Python, MySQL, Cherrypy Python HTTP framework, Django ORM, PyVows - Unit Testing, Cucumber - using Ruby for Behavior Driven Development.'
                ]
            ]
        ];
        $list[] = [
            'title'   => 'Senior Web Application Developer',
            'from'    => '2015-05-01',
            'to'      => '2015-11-30',
            'company' => 'NST Pictures',
            'job'     => [
                'Full Stack Web Applications Developer.',
                'Responsible for creating core logic, databases, data and application integration, API and other back-end processes of an application or website. I also perform the testing and debugging of any back-end application. I do front-end sometimes.',
                'PHP, MySQL, Laravel PHP Framework, Jquery, Vuejs, Bootstrap, HTML.'
            ],
        ];

        $list[] = [
            'title'   => 'Senior Web Application Developer',
            'from'    => '2016-03-01',
            'to'      => '2018-07-31',
            'company' => 'Plus Telecom',
            'job'     => [
                'Full Stack Web Applications Developer and Package Developer.',
                'Responsible for creating packages ready to use for company related Web Applications.',
                'Create server scripts that are usefull for the applications.',
                'PHP, MySQL, Laravel PHP Framework, Python, Jquery, VueJS, Bootstrap, HTML.'
            ],
        ];
        $list[] = [
            'title'   => 'Web Application Developer',
            'from'    => '2018-11-01',
            'to'      => '2020-01-15',
            'company' => 'GO Virtual Assistants Inc.,',
            'job'     => [
                'Full Stack Web Applications Developer.',
                'Create a super awesome web application.',
            ],
        ];

        return $list;

    }

}

$profile = new Profile();
$profile->init();
?>
