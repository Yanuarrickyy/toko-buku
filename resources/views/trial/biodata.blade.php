<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $biodata['nama'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #70a0d0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-image {
            width: 150px; 
            height: 150px;
            border-radius: 50%; 
            margin: 0 auto 1.5rem; 
            border: 4px solid #007bff; 
            padding: 2px; 
            object-fit: cover; 
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .profile-role {
            color: #007bff;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .profile-bio {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .social-links a {
            color: #007bff;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #007bff, transparent);
            margin: 1.5rem 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card">
                    <img src="img/dilaa.jpg" alt="Profile" class="profile-image">

                    <h1 class="profile-name">{{ $biodata['nama'] }}</h1>
                    <div class="profile-role">{{ $biodata['role'] }}</div>

                    <div class="divider"></div>

                    <p class="profile-bio">{{ $biodata['bio'] }}</p>

                    <div class="social-links">
                        @foreach($biodata['social_media'] as $social)
                            <a href="{{ $social['url'] }}" target="_blank" title="{{ $social['name'] }}">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
