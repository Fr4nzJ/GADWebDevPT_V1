@extends('layouts.bulma')

@section('title', 'Contact Us - CatSu GAD')

@section('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    <style>
        /* ===== HERO WITH BACKGROUND IMAGE ===== */
        .hero-with-image {
            position: relative;
            width: 100%;
            height: 65vh;
            background-image: url("{{ asset('images/GAD Main page BG.gif') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(59, 10, 99, 0.65);
            backdrop-filter: blur(2px);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            animation: fadeInDown 0.8s ease-out;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            letter-spacing: -1px;
        }

        .hero-content .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatingAnimation {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .hero-content {
            animation: fadeInDown 0.8s ease-out, floatingAnimation 4s ease-in-out 1s infinite;
        }

        /* ===== PURPLE GRADIENT SECTIONS ===== */
        .section-purple-gradient {
            background: linear-gradient(135deg, #3b0a63 0%, #7b2cbf 50%, #5a189a 100%);
            color: white;
        }

        .section-purple-gradient .section-title {
            color: white;
        }

        .section-purple-gradient .section-title::after {
            background: linear-gradient(90deg, #c77dff, #e0aaff);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #2c3e50;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* ===== CONTACT CHANNEL CARDS ===== */
        .contact-channel-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
            height: 100%;
        }

        .contact-channel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .contact-channel-icon {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 1rem;
            display: inline-block;
        }

        #map {
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .leaflet-popup-content {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            max-width: 300px;
        }
        
        .leaflet-popup-content h4 {
            margin-top: 0;
            color: #667eea;
            font-weight: 600;
        }

        /* ===== RESPONSIVE ===== */
        @media screen and (max-width: 768px) {
            .hero-with-image {
                height: 60vh;
                background-attachment: scroll;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content .subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
@endsection

@section('content')

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Contact Us</h1>
        <p class="subtitle">We're Here to Help & Listen to You</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('contact') }}" style="color: #ffffff;" aria-current="page">Contact</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== CONTACT CHANNELS OVERVIEW ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Quick Contact Methods</h2>
        
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-3-desktop">
                <div class="contact-channel-card">
                    <div class="contact-channel-icon"><i class="fas fa-envelope"></i></div>
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 0.5rem;">Email</h4>
                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">Send us your inquiries</p>
                    <p style="color: #667eea; font-weight: 600; font-size: 0.9rem;"><a href="mailto:gad@gov.ph">gad@gov.ph</a></p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="contact-channel-card" style="border-left-color: #764ba2;">
                    <div class="contact-channel-icon" style="color: #764ba2;"><i class="fas fa-phone"></i></div>
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 0.5rem;">Phone</h4>
                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">Call our main office</p>
                    <p style="color: #764ba2; font-weight: 600; font-size: 0.9rem;">( 632) 811-5678</p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="contact-channel-card" style="border-left-color: #48c774;">
                    <div class="contact-channel-icon" style="color: #48c774;"><i class="fas fa-map-marker-alt"></i></div>
                    <h4 class="title is-5" style="color: #48c774; margin-bottom: 0.5rem;">Visit Us</h4>
                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">Gender and Development Services Office</p>
                    <p style="color: #48c774; font-weight: 600; font-size: 0.85rem;">Calatagan, VIrac, Catanduanes/Catanduanes State University </p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="contact-channel-card" style="border-left-color: #f0ad4e;">
                    <div class="contact-channel-icon" style="color: #f0ad4e;"><i class="fas fa-watch"></i></div>
                    <h4 class="title is-5" style="color: #f0ad4e; margin-bottom: 0.5rem;">Hotline</h4>
                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">24/7 VAWC Support</p>
                    <p style="color: #f0ad4e; font-weight: 600; font-size: 0.9rem;">Ext. 2540</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <div class="columns is-multiline">
            <!-- CONTACT FORM -->
            <div class="column is-full-mobile is-full-tablet is-7-desktop">
                <div class="box">
                    <h2 class="title is-4 mb-4">Send us a Message</h2>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="notification is-success">
                            <button class="delete"></button>
                            <strong>Thank you!</strong> Your message has been sent successfully. We'll get back to you within 24 hours.
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="notification is-error mb-4">
                            <button class="delete"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- Name Field -->
                        <div class="field">
                            <label class="label">Full Name <span style="color: #f14668;">*</span></label>
                            <div class="control has-icons-left">
                                <input class="input @error('name') is-danger @enderror" 
                                       type="text" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Juan Dela Cruz" 
                                       value="{{ old('name') }}" 
                                       required>
                                <span class="icon is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            @error('name')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="field">
                            <label class="label">Email Address <span style="color: #f14668;">*</span></label>
                            <div class="control has-icons-left">
                                <input class="input @error('email') is-danger @enderror" 
                                       type="email" 
                                       id="email" 
                                       name="email" 
                                       placeholder="juan.delacruz@email.com" 
                                       value="{{ old('email') }}" 
                                       required>
                                <span class="icon is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            @error('email')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Field -->
                        <div class="field">
                            <label class="label">Subject <span style="color: #f14668;">*</span></label>
                            <div class="control has-icons-left">
                                <input class="input @error('subject') is-danger @enderror" 
                                       type="text" 
                                       id="subject" 
                                       name="subject" 
                                       placeholder="Inquiry about GAD Programs" 
                                       value="{{ old('subject') }}" 
                                       required>
                                <span class="icon is-left">
                                    <i class="fas fa-comment"></i>
                                </span>
                            </div>
                            @error('subject')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div class="field">
                            <label class="label">Message <span style="color: #f14668;">*</span></label>
                            <div class="control">
                                <textarea class="textarea @error('message') is-danger @enderror" 
                                          id="message" 
                                          name="message" 
                                          placeholder="Please share your inquiry or feedback..." 
                                          rows="6" 
                                          required>{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-primary is-medium" type="submit">
                                    <span class="icon"><i class="fas fa-paper-plane"></i></span>
                                    <span>Send Message</span>
                                </button>
                            </div>
                            <div class="control">
                                <button class="button is-light is-medium" type="reset">
                                    <span>Clear Form</span>
                                </button>
                            </div>
                        </div>

                        <p class="is-size-7 has-text-grey mt-3">
                            <span style="color: #f14668;">*</span> Required fields
                        </p>
                    </form>
                </div>
            </div>

            <!-- CONTACT INFORMATION -->
            <div class="column is-full-mobile is-full-tablet is-5-desktop">
                <!-- Office Address -->
                <div class="box mb-4">
                    <h3 class="title is-5">
                        <span class="icon"><i class="fas fa-map-marker-alt" style="color: #667eea;"></i></span>
                        <span>Office Address</span>
                    </h3>
                    <p>
                        <strong>Gender and Development (GAD) Office</strong><br>
                        15 Development Avenue<br>
                        Quezon City 1101<br>
                        Philippines
                    </p>
                    <p style="margin-top: 1rem; color: #666;">
                        Building A, 2nd Floor<br>
                        Ground Floor: Information Desk<br>
                        Parking available for visitors
                    </p>
                </div>

                <!-- Phone -->
                <div class="box mb-4">
                    <h3 class="title is-5">
                        <span class="icon"><i class="fas fa-phone" style="color: #667eea;"></i></span>
                        <span>Phone & Fax</span>
                    </h3>
                    <p>
                        <strong>Main Office:</strong><br>
                        (632) 811-5678 Ext. 2500
                    </p>
                    <ul style="margin: 1rem 0;">
                        <li><strong>General Inquiries:</strong> Ext. 2510</li>
                        <li><strong>Programs & Events:</strong> Ext. 2520</li>
                        <li><strong>Research & Publications:</strong> Ext. 2530</li>
                        <li><strong>Violence Against Women Hotline:</strong> Ext. 2540 (24/7)</li>
                    </ul>
                    <p>
                        <strong>Fax:</strong> (632) 811-5600
                    </p>
                </div>

                <!-- Email -->
                <div class="box mb-4">
                    <h3 class="title is-5">
                        <span class="icon"><i class="fas fa-envelope" style="color: #667eea;"></i></span>
                        <span>Email</span>
                    </h3>
                    <p>
                        <strong>General Email:</strong><br>
                        <a href="mailto:gad@gov.ph">gad@gov.ph</a>
                    </p>
                    <ul style="margin: 1rem 0;">
                        <li><a href="mailto:info@gad.gov.ph">info@gad.gov.ph</a> - General Information</li>
                        <li><a href="mailto:programs@gad.gov.ph">programs@gad.gov.ph</a> - Program Enrollment</li>
                        <li><a href="mailto:research@gad.gov.ph">research@gad.gov.ph</a> - Research Requests</li>
                        <li><a href="mailto:vawc@gad.gov.ph">vawc@gad.gov.ph</a> - VAWC Support</li>
                    </ul>
                </div>

                <!-- Office Hours -->
                <div class="box mb-4">
                    <h3 class="title is-5">
                        <span class="icon"><i class="fas fa-clock" style="color: #667eea;"></i></span>
                        <span>Office Hours</span>
                    </h3>
                    <p>
                        <strong>Monday - Friday:</strong><br>
                        8:00 AM - 5:00 PM
                    </p>
                    <p style="margin-top: 1rem;">
                        <strong>Saturday & Sunday:</strong><br>
                        Closed
                    </p>
                    <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">
                        Note: VAWC Hotline operates 24/7
                    </p>
                </div>

                <!-- Social Media -->
                <div class="box">
                    <h3 class="title is-5">
                        <span class="icon"><i class="fas fa-share-alt" style="color: #667eea;"></i></span>
                        <span>Follow Us</span>
                    </h3>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <a href="#" title="Facebook" class="button is-primary is-outlined">
                            <span class="icon"><i class="fab fa-facebook-f"></i></span>
                        </a>
                        <a href="#" title="Twitter" class="button is-info is-outlined">
                            <span class="icon"><i class="fab fa-twitter"></i></span>
                        </a>
                        <a href="#" title="YouTube" class="button is-danger is-outlined">
                            <span class="icon"><i class="fab fa-youtube"></i></span>
                        </a>
                        <a href="#" title="LinkedIn" class="button is-dark is-outlined">
                            <span class="icon"><i class="fab fa-linkedin-in"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== OPENSTREETMAP WITH LEAFLET ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Location Map</h2>
        <div class="box">
            <div id="map" style="width: 100%; height: 450px; border-radius: 4px; overflow: hidden;"></div>
        </div>
    </div>
</section>

<!-- ===== DEPARTMENTS & FOCAL PERSONS ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Department Contacts</h2>

        <div class="columns">
            <!-- Department 1 -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">
                            <i class="fas fa-gavel" style="color: #667eea; margin-right: 0.5rem;"></i>
                            Policy & Planning Division
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <p><strong>Director:</strong><br>Ms. Clara Gonzales</p>
                            <p><strong>Email:</strong><br><a href="mailto:clara.gonzales@gad.gov.ph">clara.gonzales@gad.gov.ph</a></p>
                            <p><strong>Phone:</strong><br>(632) 811-5678 Ext. 2502</p>
                            <hr>
                            <p class="is-size-7">Focuses on policy advocacy, gender mainstreaming, and strategic planning</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department 2 -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">
                            <i class="fas fa-project-diagram" style="color: #667eea; margin-right: 0.5rem;"></i>
                            Programs & Projects Division
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <p><strong>Director:</strong><br>Engr. Rebecca Torres</p>
                            <p><strong>Email:</strong><br><a href="mailto:rebecca.torres@gad.gov.ph">rebecca.torres@gad.gov.ph</a></p>
                            <p><strong>Phone:</strong><br>(632) 811-5678 Ext. 2503</p>
                            <hr>
                            <p class="is-size-7">Oversees program implementation, monitoring, and evaluation</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department 3 -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">
                            <i class="fas fa-chart-bar" style="color: #667eea; margin-right: 0.5rem;"></i>
                            Operations & Finance Division
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <p><strong>Director:</strong><br>Mr. Ramon Cruz</p>
                            <p><strong>Email:</strong><br><a href="mailto:ramon.cruz@gad.gov.ph">ramon.cruz@gad.gov.ph</a></p>
                            <p><strong>Phone:</strong><br>(632) 811-5678 Ext. 2504</p>
                            <hr>
                            <p class="is-size-7">Handles budget, finance, and administrative operations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FAQ ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Frequently Asked Questions</h2>

        <div class="content" x-data="{ openFaq: null }">
            <!-- FAQ 1 -->
            <div class="box mb-3" style="background-color: rgba(255, 255, 255, 0.95); border-left: 4px solid #c77dff;">
                <div style="cursor: pointer; padding: 1rem;" @click="openFaq = openFaq === 1 ? null : 1">
                    <h4 class="title is-6 mb-0">
                        <span class="icon"><i class="fas" :class="openFaq === 1 ? 'fa-chevron-down' : 'fa-chevron-right'" style="color: #7b2cbf;"></i></span>
                        <span style="color: #2c3e50;">How can I enroll in GAD programs?</span>
                    </h4>
                </div>
                <div x-show="openFaq === 1" class="mt-2 pl-4 pb-2">
                    <p style="color: #555;">You can enroll in our programs by contacting our Programs & Projects Division at programs@gad.gov.ph or calling (632) 811-5678 Ext. 2503. Different programs have different requirements and enrollment periods.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="box mb-3" style="background-color: rgba(255, 255, 255, 0.95); border-left: 4px solid #c77dff;">
                <div style="cursor: pointer; padding: 1rem;" @click="openFaq = openFaq === 2 ? null : 2">
                    <h4 class="title is-6 mb-0">
                        <span class="icon"><i class="fas" :class="openFaq === 2 ? 'fa-chevron-down' : 'fa-chevron-right'" style="color: #7b2cbf;"></i></span>
                        <span style="color: #2c3e50;">Where can I access published reports and research?</span>
                    </h4>
                </div>
                <div x-show="openFaq === 2" class="mt-2 pl-4 pb-2">
                    <p style="color: #555;">All our publications are available on the <a href="{{ route('reports') }}" style="color: #7b2cbf;">Reports page</a>. You can download PDFs directly or contact research@gad.gov.ph for hard copies.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="box mb-3" style="background-color: rgba(255, 255, 255, 0.95); border-left: 4px solid #c77dff;">
                <div style="cursor: pointer; padding: 1rem;" @click="openFaq = openFaq === 3 ? null : 3">
                    <h4 class="title is-6 mb-0">
                        <span class="icon"><i class="fas" :class="openFaq === 3 ? 'fa-chevron-down' : 'fa-chevron-right'" style="color: #7b2cbf;"></i></span>
                        <span style="color: #2c3e50;">How do I report cases of violence against women?</span>
                    </h4>
                </div>
                <div x-show="openFaq === 3" class="mt-2 pl-4 pb-2">
                    <p style="color: #555;">Please call our 24/7 VAWC Hotline at (632) 811-5678 Ext. 2540 or email vawc@gad.gov.ph. Our trained counselors can provide immediate support and connect you with local authorities and shelters.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="box mb-3" style="background-color: rgba(255, 255, 255, 0.95); border-left: 4px solid #c77dff;">
                <div style="cursor: pointer; padding: 1rem;" @click="openFaq = openFaq === 4 ? null : 4">
                    <h4 class="title is-6 mb-0">
                        <span class="icon"><i class="fas" :class="openFaq === 4 ? 'fa-chevron-down' : 'fa-chevron-right'" style="color: #7b2cbf;"></i></span>
                        <span style="color: #2c3e50;">Can I request a speaker or workshop for my organization?</span>
                    </h4>
                </div>
                <div x-show="openFaq === 4" class="mt-2 pl-4 pb-2">
                    <p style="color: #555;">Yes! We offer workshops and training sessions on gender mainstreaming. Please submit your request at least 3 months in advance through our contact form or email clara.gonzales@gad.gov.ph.</p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="box" style="background-color: rgba(255, 255, 255, 0.95); border-left: 4px solid #c77dff;">
                <div style="cursor: pointer; padding: 1rem;" @click="openFaq = openFaq === 5 ? null : 5">
                    <h4 class="title is-6 mb-0">
                        <span class="icon"><i class="fas" :class="openFaq === 5 ? 'fa-chevron-down' : 'fa-chevron-right'" style="color: #7b2cbf;"></i></span>
                        <span style="color: #2c3e50;">How can I become a Gender Focal Person?</span>
                    </h4>
                </div>
                <div x-show="openFaq === 5" class="mt-2 pl-4 pb-2">
                    <p style="color: #555;">Government agencies and LGUs can nominate Gender Focal Persons through their respective secretaries. Contact clara.gonzales@gad.gov.ph for the nomination process and requirements.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== LEAFLET MAP SCRIPT ===== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map centered on Catanduanes
        const map = L.map('map').setView([13.7942, 124.4387], 10);
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);
        
        // Add marker for CatSu GAD Office at Faculty Center
        // Catanduanes State University - Faculty Center, Virac, Catanduanes
        const gadMarker = L.marker([13.58439, 124.21057], {
            title: 'CatSu GAD Office - Faculty Center'
        }).addTo(map);
        
        // Add popup content
        gadMarker.bindPopup(`
            <div>
                <h4>CatSu Gender and Development Office</h4>
                <p><strong>Location:</strong> Catanduanes State University<br>
                Faculty Center, Virac, Catanduanes 4800, Philippines</p>
                <p><strong>Phone:</strong> (021) 123-4567<br>
                <strong>Email:</strong> gad@catsu.edu.ph</p>
                <p style="color: #667eea; font-size: 0.9rem; margin-top: 0.5rem;">
                    <i class="fas fa-heart"></i> Advancing Gender Equality & Development
                </p>
            </div>
        `).openPopup();
        
        // Optional: Add more markers for other offices if needed
        // Example: Regional offices or partner organizations
    });
</script>

@endsection
