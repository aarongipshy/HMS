@extends('frontlayout')
@section('content')
<style>
    .about-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .about-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .about-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }
    
    .about-header h1:after {
        content: '';
        position: absolute;
        width: 70%;
        height: 3px;
        background: linear-gradient(90deg, #ff4d4d, transparent);
        bottom: -10px;
        left: 15%;
        border-radius: 2px;
    }
    
    .about-header p {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .about-content {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 50px;
    }
    
    .about-text {
        padding: 40px;
    }
    
    .about-text h2 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }
    
    .about-text p {
        color: #6c757d;
        line-height: 1.8;
        margin-bottom: 20px;
    }
    
    .team-section {
        padding: 50px 0;
    }
    
    .team-header {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .team-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }
    
    .team-header p {
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .team-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .team-img {
        position: relative;
        height: 250px;
        overflow: hidden;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .team-img img {
        width: 150px;
        height: 150px;
        transition: transform 0.5s ease;
    }
    
    .team-card:hover .team-img img {
        transform: scale(1.1);
    }
    
    .team-info {
        padding: 25px;
        text-align: center;
    }
    
    .team-info h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }
    
    .team-info p.position {
        color: #ff4d4d;
        font-weight: 500;
        margin-bottom: 15px;
    }
    
    .team-info p.bio {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    
    .social-links a {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        background: #ff4d4d;
        color: white;
    }
    
    .stats-section {
        background: linear-gradient(45deg, #333 0%, #222 100%);
        padding: 60px 0;
        color: white;
        text-align: center;
        border-radius: 15px;
        margin: 50px 0;
    }
    
    .stat-item {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        background: linear-gradient(45deg, #ff4d4d, #ff8080);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.8;
    }
    
    .cta-section {
        text-align: center;
        padding: 50px 0;
    }
    
    .cta-button {
        display: inline-block;
        background: #ff4d4d;
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.3);
    }
    
    .cta-button:hover {
        background: #ff3333;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 77, 77, 0.4);
        color: white;
    }
    
    @media (max-width: 768px) {
        .about-section, .team-section {
            padding: 50px 0;
        }
        
        .about-header h1 {
            font-size: 2rem;
        }
        
        .team-card {
            margin-bottom: 30px;
        }
    }
</style>
<br>
<section class="about-section">
    <div class="container">
        <div class="about-header">
            <h1>អំពីយើង</h1>
            <p>ស្វាគមន៍មកកាន់ក្រុមអ្នកអភិវឌ្ឍន៍របស់យើង ដែលបង្កើតបទពិសោធន៍ឌីជីថលដ៏អស្ចារ្យ</p>
        </div>
        
        <div class="about-content">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="about-text">
                        <h2>បេសកកម្មរបស់យើង</h2>
                        <p>យើងជាក្រុមអ្នកអភិវឌ្ឍន៍ដែលមានចំណង់ចំណូលចិត្ត អ្នករចនា និងអ្នកច្នៃប្រឌិតដែលប្តេជ្ញាចិត្តក្នុងការបង្កើតបទពិសោធន៍ឌីជីថលដ៏ល្អឥតខ្ចោះ។ ជាមួយនឹងជំនាញរួមគ្នាជាច្រើនឆ្នាំក្នុងការអភិវឌ្ឍន៍វេបសាយ កម្មវិធីទូរស័ព្ទចល័ត និងបច្ចេកវិទ្យាទំនើបបំផុត យើងបំប្លែងគំនិតទៅជាការពិត។</p>
                        <p>បេសកកម្មរបស់យើងគឺដើម្បីបំពេញគម្លាតរវាងបច្ចេកវិទ្យាស្មុគស្មាញ និងដំណោះស្រាយដែលងាយស្រួលប្រើប្រាស់។ យើងជឿលើកូដស្អាត ការរចនាដែលងាយយល់ និងអំណាចនៃកិច្ចសហការដើម្បីផ្តល់ជូននូវផលិតផលដែលមិនត្រឹមតែបំពេញតាមការរំពឹងទុកប៉ុណ្ណោះទេ ប៉ុន្តែលើសពីការរំពឹងទុក។</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-text">
                        <h2>ចក្ខុវិស័យរបស់យើង</h2>
                        <p>ចាប់តាំងពីការចាប់ផ្តើមរហូតដល់ដំណោះស្រាយសហគ្រាស យើងបានជួយអតិថិជនរាប់មិនអស់ឱ្យសម្រេចបាននូវគោលដៅឌីជីថលរបស់ពួកគេតាមរយៈការគិតច្នៃប្រឌិត វិធីសាស្ត្រ agile និងការប្តេជ្ញាចិត្តចំពោះភាពឧត្តមភាពដែលជំរុញអ្វីៗគ្រប់យ៉ាងដែលយើងធ្វើ។</p>
                        <p>យើងប្រើប្រាស់បច្ចេកវិទ្យាទំនើបបំផុត និងការអនុវត្តល្អបំផុតដើម្បីបង្កើតដំណោះស្រាយដែលមិនត្រឹមតែដំណើរការល្អប៉ុណ្ណោះទេ ប៉ុន្តែថែមទាំងមានភាពទាក់ទាញ និងងាយស្រួលប្រើប្រាស់ផងដែរ។ ក្រុមរបស់យើងប្តេជ្ញាចិត្តក្នុងការរៀនសូត្រ និងអភិវឌ្ឍជាបន្តបន្ទាប់ ដើម្បីធានាថាយើងនៅតែនាំមុខគេក្នុងឧស្សាហកម្មដែលផ្លាស់ប្តូរយ៉ាងឆាប់រហ័ស។</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number">១៥០+</div>
                            <div class="stat-label">គម្រោងបានបញ្ចប់</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number">៥០+</div>
                            <div class="stat-label">អតិថិជនពេញចិត្ត</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number">៥+</div>
                            <div class="stat-label">ឆ្នាំបទពិសោធន៍</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number">២៤/៧</div>
                            <div class="stat-label">ការគាំទ្រ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <div class="team-header">
            <h2>ជួបជាមួយក្រុមអ្នកដឹកនាំរបស់ Snak Nov Hotel</h2>
            <p>ក្រុមអ្នកមានទេពកោសល្យដែលធ្វើឱ្យអ្វីៗគ្រប់យ៉ាងកើតឡើង</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-img">
                        <img style="border-radius: 100%" src="{{ asset('img/profile.jpg') }}" alt="Developer">
                    </div>
                    <div class="team-info">
                        <h3>តុប ឡៃហៀង</h3>
                        <p class="position">Lead Developer</p>
                        <p class="bio">អ្នកអភិវឌ្ឍន៍ដែលមានបទពិសោធន៍ជាង ៥ ឆ្នាំក្នុងការបង្កើតកម្មវិធីវេប និងកម្មវិធីទូរស័ព្ទចល័ត។</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-github"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-img">
                        <img style="border-radius: 100%" src="{{ asset('img/profile.jpg') }}" alt="Developer">
                    </div>
                    <div class="team-info">
                        <h3>តុប ឡៃហៀង</h3>
                        <p class="position">UX/UI Designer</p>
                        <p class="bio">អ្នករចនាដែលមានចិត្តចង់ដឹងចង់ឃើញ និងមានទេពកោសល្យក្នុងការបង្កើតចំណុចប្រទាក់អ្នកប្រើប្រាស់ដែលទាក់ទាញ និងងាយស្រួលប្រើប្រាស់។</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-img">
                        <img style="border-radius: 100%" src="{{ asset('img/profile.jpg') }}" alt="Developer">
                    </div>
                    <div class="team-info">
                        <h3>តុប ឡៃហៀង</h3>
                        <p class="position">Backend Developer</p>
                        <p class="bio">អ្នកអភិវឌ្ឍន៍ខាងក្រោយដែលមានជំនាញក្នុងការបង្កើតសេវាកម្មដែលមានល្បឿនលឿន និងអាចពង្រីកបាន។</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-github"></i></a>
                            <a href="#"><i class="fab fa-stack-overflow"></i></a>
                            <a href="#"><i class="fab fa-dev"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-img">
                        <img style="border-radius: 100%" src="{{ asset('img/profile.jpg') }}" alt="Developer">
                    </div>
                    <div class="team-info">
                        <h3>តុប ឡៃហៀង</h3>
                        <p class="position">Project Manager</p>
                        <p class="bio">អ្នកគ្រប់គ្រងគម្រោងដែលមានបទពិសោធន៍ក្នុងការដឹកនាំក្រុមដើម្បីបញ្ចប់គម្រោងទាន់ពេលវេលា និងក្នុងថវិកា។</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="cta-section">
            <h3>ត្រៀមខ្លួនរួចរាល់ដើម្បីចាប់ផ្តើមគម្រោងរបស់អ្នក?</h3>
            <p>សូមធ្វើការជាមួយយើងដើម្បីនាំយកចក្ខុវិស័យរបស់អ្នកទៅកាន់ជីវិត</p>
            <a href="{{ url('page/contact-us') }}" class="cta-button">ទំនាក់ទំនងមកយើង</a>
        </div>
    </div>
</section>
@endsection