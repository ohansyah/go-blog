<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class HelloWorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = "
        <h2>My name is Ohansyah</h2>
        <h3>Backend Developer</h3>
        <br>
        <h3>Summary:</h3>
        <p>Experienced Backend Developer with 4+ years of expertise in building web applications, specializing in Node.js and Laravel. Proven track record of delivering high-impact solutions that enhance business efficiency. Passionate about staying current with the latest technologies and dedicated to continuous learning.</p>

        <h3>Experience:</h3>
        <p><strong>Backend Developer | Weekend Inc, Jakarta - Indonesia | 01/08/2019 - Present</strong></p>
        <ul>
            <li>Spearheaded the development of the main API for a leading e-commerce company in Indonesia.</li>
            <li>Successfully implemented key features, including full-text search, online order processing, secure payment systems, and real-time delivery tracking.</li>
            <li>Orchestrated integrations with Elasticsearch, Payment Gateway, Logistic Gateway, and other support services, optimizing overall system performance.</li>
            <li>Collaborated in building and maintaining an AWS Microservices Ecosystem, ensuring scalability and reliability for the platform.</li>
            <li>Achieved improvement in order processing speed, leading to increased customer satisfaction and higher sales revenue.</li>
        </ul>

        <h3>Projects:</h3>
        <ol>
            <li>
                <strong>eDot Nabati</strong>
                <p>Description: E-commerce in the form of mobile applications (mobile apps) and desktop web. The main services provided by eDOT are Sales/Purchase and Distribution of fast-moving consumer goods involving Brand Owners (Principles), Distributors, Wholesalers, to Retailers.</p>
                <ul>
                    <li>Helped build a secure and efficient backend system for order processing, inventory management, and customer authentication.</li>
                    <li>Improved website performance, resulting in an increase in user engagement and a boost in conversion rates.</li>
                    <li>Switched tech-stack from monolith Laravel to Node.js and integrated it into Dev Mobile and Dev Web App.</li>
                    <li>Coordinated seamless integrations with Elasticsearch, Payment Gateway, Logistic Gateway, and various support services, resulting in significant enhancements to system performance and efficiency.</li>
                </ul>
            </li>
            <li>
                <strong>AYO SRC (Student Resource Center)</strong>
                <p>Description: Platform provided by Sampoerna Group that helps users complete their daily goods/services. SRC Consumers can fulfill their needs at affordable prices, indirectly contributing to driving Indonesia’s economy.</p>
                <ul>
                    <li>Collaborated closely with frontend and mobile developers to design and implement robust RESTful APIs, facilitating smooth data flow and real-time updates.</li>
                    <li>Played a pivotal role in achieving improvement in user satisfaction through backend optimizations.</li>
                    <li>Orchestrated integrations with Elasticsearch, Payment Gateway, Logistic Gateway, and other support services, optimizing overall system performance.</li>
                    <li>Integration with Elasticsearch, Payment Gateway, Logistic Gateway making the system work better and smoother for everyone.</li>
                </ul>
            </li>
        </ol>

        <h3>Skills:</h3>
        <ul>
            <li>Proficient in Node.js, CodeIgniter, and Laravel</li>
            <li>Strong problem-solving and debugging skills</li>
            <li>RESTful API design and development</li>
            <li>Database management (MySQL)</li>
            <li>Agile and Scrum methodologies</li>
            <li>Git version control</li>
        </ul>

        <h3>Professional Development:</h3>
        <ul>
            <li>Specialized focus on Node.js and Laravel Backend development</li>
            <li>Ongoing studies in WordPress plugin development</li>
            <li>Ongoing studies in Laravel Fullstack development</li>
        </ul>

        <h3>Strengths:</h3>
        <ul>
            <li>Passionate about exploring new technologies and frameworks</li>
            <li>Committed to delivering impactful features that enhance productivity</li>
            <li>Thrive in complex project environments</li>
        </ul>

        <h3>Education:</h3>
        <p>Bachelor's Degree in Computer Science<br>
        Pamulang University, South Tangerang - Indonesia | 2019</p>

        <h3>Contact Information:</h3>
        <ul>
            <li>Email: ohan.ohansyah@gmail.com</li>
            <li>LinkedIn: Ohansyah</a></li>
        </ul>
        ";

        $post = Post::Create([
            'category_id' => 3,
            'slug' => 'hello-world',
            'title' => 'Hello World',
            'content' => $content,
        ]);

        $post->postTags()->create([
            'tag_id' => 1,
        ]);

        $post->userPost()->create([
            'user_id' => 0,
        ]);
    }
}
