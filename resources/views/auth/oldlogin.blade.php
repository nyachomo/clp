<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaturaFresh Organics - Complete Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css">
   <style>
    img{
    height: 100%;
    width: 100%;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Header & Navigation */
header {
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
    color: white;
    font-size: 24px;
}

.company-name {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    margin-left: 15px;
}

.navbar-nav .nav-link {
    color: #2c3e50;
    font-weight: 500;
    transition: color 0.3s;
    padding: 2rem 1rem;
}

.navbar-nav .nav-link:hover {
    color: #4caf50;
}

.navbar .dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 10px;
}

.navbar .dropdown-item {
    border-radius: 5px;
    padding: 10px 15px;
    transition: all 0.3s;
}

.navbar .dropdown-item:hover {
    background-color: #f1f8e9;
    color: #4caf50;
}

.cart-icon {
    position: relative;
    display: flex;
    align-items: center;
}

.cart-count {
    position: absolute;
    top: 23px;
    right: -8px;
    background-color: #4caf50;
    color: white;
    font-size: 12px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn {
    display: inline-block;
    background: #4caf50;
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
    border: none;
}

.btn:hover {
    background: #3d8b40;
    transform: translateY(-2px);
}

/* Hero Section */
.hero {
    padding: 100px 0;
    background: linear-gradient(rgba(249, 251, 248, 0.9), rgba(241, 248, 233, 0.9)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center/cover;
    text-align: center;
}

.hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: 48px;
    color: #2c3e50;
    margin-bottom: 20px;
}

.hero p {
    font-size: 20px;
    color: #7f8c8d;
    max-width: 700px;
    margin: 0 auto 30px;
}

/* Services Section */
.services {
    padding: 80px 0;
    background: linear-gradient(135deg, #f9fbf8 0%, #f1f8e9 100%);
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.section-header p {
    font-size: 18px;
    color: #7f8c8d;
    max-width: 600px;
    margin: 0 auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
    justify-content: center;
}

.col-sm-4 {
    padding: 15px;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}

.card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    height: 100%;
    position: relative;
    border: none;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #4caf50, #8bc34a);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}

.card:hover::before {
    transform: scaleX(1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.card-body {
    padding: 40px 30px;
    text-align: center;
}

.card i {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin-bottom: 25px;
    transition: all 0.3s ease;
}

.card:hover i {
    transform: scale(1.1);
}

.fa-leaf {
    background-color: rgba(76, 175, 80, 0.15);
    color: #4caf50;
}

.fa-truck {
    background-color: rgba(33, 150, 243, 0.15);
    color: #2196f3;
}

.fa-heart {
    background-color: rgba(244, 67, 54, 0.15);
    color: #f44336;
}

.card h4 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #2c3e50;
}

.card p {
    color: #7f8c8d;
    line-height: 1.6;
    font-size: 16px;
}

/* Products Section */
.products {
    padding: 80px 0;
    background: white;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-img {
    height: 200px;
    background-color: #f1f8e9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img i {
    font-size: 70px;
    color: #4caf50;
}

.product-info {
    padding: 20px;
}

.product-info h3 {
    font-size: 20px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.product-info p {
    color: #7f8c8d;
    margin-bottom: 15px;
}

.product-price {
    font-size: 22px;
    font-weight: 700;
    color: #4caf50;
    margin-bottom: 15px;
}

/* Testimonials Section */
.testimonials {
    padding: 80px 0;
    background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e9 100%);
}

.testimonial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.testimonial-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.testimonial-text {
    font-style: italic;
    color: #555;
    margin-bottom: 20px;
    position: relative;
    padding-left: 30px;
}

.testimonial-text::before {
    content: "";
    font-family: sans-serif;
    font-size: 60px;
    color: #4caf50;
    position: absolute;
    left: 0;
    top: -20px;
    opacity: 0.2;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.author-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #bbdefb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #1976d2;
    font-weight: bold;
}

.author-info h4 {
    color: #2c3e50;
    margin-bottom: 5px;
}

.author-info p {
    color: #7f8c8d;
    font-size: 14px;
}

/* About Section */
.about {
    padding: 80px 0;
    background: white;
}

.about-content {
    display: flex;
    align-items: center;
    gap: 50px;
}

.about-text {
    flex: 1;
}

.about-text h2 {
    font-size: 36px;
    color: #2c3e50;
    margin-bottom: 20px;
}

.about-text p {
    color: #7f8c8d;
    margin-bottom: 15px;
}

.about-img {
    flex: 1;
    background: #f1f8e9;
    border-radius: 20px;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-img i {
    font-size: 100px;
    color: #4caf50;
}

/* Newsletter Section */
.newsletter {
    padding: 80px 0;
    background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
    color: white;
    text-align: center;
}

.newsletter h2 {
    font-size: 36px;
    margin-bottom: 20px;
}

.newsletter p {
    max-width: 600px;
    margin: 0 auto 30px;
    font-size: 18px;
}

.newsletter-form {
    display: flex;
    max-width: 500px;
    margin: 0 auto;
}

.newsletter-form input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: 30px 0 0 30px;
    font-size: 16px;
}

.newsletter-form button {
    background: #2c3e50;
    color: white;
    border: none;
    padding: 0 25px;
    border-radius: 0 30px 30px 0;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
}

.newsletter-form button:hover {
    background: #1a252f;
}

/* Footer */
footer {
    background: #2c3e50;
    color: white;
    padding: 60px 0 30px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-column h3 {
    font-size: 20px;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: #4caf50;
}

.footer-column p {
    margin-bottom: 15px;
    opacity: 0.8;
}

.footer-column ul {
    list-style: none;
}

.footer-column ul li {
    margin-bottom: 10px;
}

.footer-column ul li a {
    color: white;
    opacity: 0.8;
    text-decoration: none;
    transition: opacity 0.3s;
}

.footer-column ul li a:hover {
    opacity: 1;
    color: #4caf50;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: white;
    transition: background 0.3s;
}

.social-links a:hover {
    background: #4caf50;
}

.footer-bottom {
    text-align: center;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    opacity: 0.8;
    font-size: 14px;
}


    
    
   </style>

   <style>
       
      

       body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background: linear-gradient(rgba(249, 251, 248, 0.9), rgba(241, 248, 233, 0.9)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center/cover;
    }
    
        
    /* Main Content */
    .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }
    
    /* Login Container */
    .login-container {
        display: flex;
        width: 1150px;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .login-image {
        flex: 1;
        background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        color: white;
        text-align: center;
    }
    
    .login-image i {
        font-size: 100px;
        margin-bottom: 30px;
        opacity: 0.9;
    }
    
    .login-image h2 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        margin-bottom: 20px;
    }
    
    .login-image p {
        opacity: 0.9;
        line-height: 1.6;
    }
    
    .login-form {
        flex: 1;
        padding: 50px;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .form-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .form-header p {
        color: #7f8c8d;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2c3e50;
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .form-input {
        width: 100%;
        padding: 15px 15px 15px 45px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        border-color: #4caf50;
        outline: none;
        box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #7f8c8d;
    }
    
    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
    }
    
    .checkbox-input {
        margin-right: 8px;
        width: 16px;
        height: 16px;
        accent-color: #4caf50;
    }
    
    .checkbox-label {
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .forgot-link {
        color: #4caf50;
        text-decoration: none;
        font-size: 14px;
    }
    
    .forgot-link:hover {
        text-decoration: underline;
    }
    
    .login-btn {
        width: 100%;
        padding: 15px;
        font-size: 16px;
        margin-bottom: 25px;
    }
    
    .divider {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: #e0e0e0;
    }
    
    .divider-text {
        padding: 0 15px;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .social-login {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .social-btn {
        flex: 1;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .social-btn:hover {
        background: #f5f5f5;
    }
    
    .social-btn i {
        font-size: 18px;
    }
    
    .google-btn {
        color: #DB4437;
    }
    
    .facebook-btn {
        color: #4267B2;
    }
    
    .signup-link {
        text-align: center;
        color: #7f8c8d;
    }
    
    .signup-link a {
        color: #4caf50;
        text-decoration: none;
        font-weight: 500;
    }
    
    .signup-link a:hover {
        text-decoration: underline;
    }
    
   
    /* Responsive Design */
    @media (max-width: 992px) {
        .login-container {
            flex-direction: column;
            width: 100%;
            max-width: 500px;
        }
        
        .login-image {
            padding: 30px;
        }
        
        .login-image i {
            font-size: 80px;
            margin-bottom: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }
        
        .login-form {
            padding: 30px;
        }
        
        .social-login {
            flex-direction: column;
        }
        
        .remember-forgot {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

</head>
<body>

    
    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="logo-container">
                    <div class="logo">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="company-name">TECHSPHERE</div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <!--<li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.html">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                My Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="login.html">Login</a></li>
                                <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
                            </ul>
                        </li>
                        <li class="nav-item cart-icon">
                            <a class="nav-link" href="cart.html">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count">3</span>
                            </a>
                        </li>
                    </ul>-->
                    <a href="products.html" class="btn ms-3 d-none d-lg-block">Shop Now</a>
                </div>
            </nav>
        </div>
    </header>

   
 <!-- Main Content -->
 <div class="main-content">
    <div class="container">
        <div class="login-container">
            <div class="login-image">
                <i class="fas fa-leaf"></i>
                <h2>Welcome Back to Techsphere</h2>
                <p>Sign in to access your account, track orders, and manage your preferences for the freshest organic experience.</p>
            </div>
            
            <div class="login-form">
                <div class="form-header">
                    <h1>Sign In</h1>
                    <p>Enter your details to access your account</p>
                </div>
                
                <form id="login-form">
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" class="form-input" placeholder="Your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" class="form-input" placeholder="Your password" required>
                        </div>
                    </div>
                    
                    <div class="remember-forgot">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" class="checkbox-input">
                            <label for="remember" class="checkbox-label">Remember me</label>
                        </div>
                        <a href="forgot-password.html" class="forgot-link">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn login-btn">Sign In</button>
                </form>
                
               <!-- <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">or continue with</div>
                    <div class="divider-line"></div>
                </div>
                
                <div class="social-login">
                    <button class="social-btn google-btn">
                        <i class="fab fa-google"></i>
                    </button>
                    <button class="social-btn facebook-btn">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                </div>
                
                <div class="signup-link">
                    Don't have an account? <a href="signup.html">Sign up now</a>
                </div>-->
            </div>
        </div>
    </div>
</div>



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>NaturaFresh</h3>
                    <p>Pure organic goodness delivered to your door. We're committed to providing the freshest organic produce while supporting sustainable farming.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Organic Way, Green City</p>
                    <p><i class="fas fa-phone"></i> (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> info@naturafresh.com</p>
                </div>
                
                <div class="footer-column">
                    <h3>Opening Hours</h3>
                    <p>Monday-Friday: 8:00 AM - 8:00 PM</p>
                    <p>Saturday: 9:00 AM - 6:00 PM</p>
                    <p>Sunday: 10:00 AM - 4:00 PM</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2023 NaturaFresh Organics. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Form validation
        const loginForm = document.getElementById('login-form');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Simple validation
            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }
            
            // Email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return;
            }
            
            // In a real application, you would send this data to the server
            console.log('Login attempt with:', { email, password });
            
            // Simulate successful login
            alert('Login successful! Redirecting to your account...');
            // window.location.href = 'account.html';
        });
        
        // Social login buttons
        document.querySelector('.google-btn').addEventListener('click', function() {
            alert('Redirecting to Google authentication...');
        });
        
        document.querySelector('.facebook-btn').addEventListener('click', function() {
            alert('Redirecting to Facebook authentication...');
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>