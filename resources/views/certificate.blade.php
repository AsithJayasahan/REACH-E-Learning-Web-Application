<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
    <title>Digital Literacy Training - Certificate of Completion</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: landscape;
            margin: 0;
        }
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .certificate {
            width: 10in;
            height: 7.1in;
            margin: 0 auto;
            padding: 20px;
            border: 10px solid transparent;
            border-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"%3E%3Cpath d="M0 0 L20 0 A20 20 0 0 1 40 20 L60 20 A20 20 0 0 0 80 0 H100 V100 H80 A20 20 0 0 0 60 80 L40 80 A20 20 0 0 1 20 100 H0 V0 Z" fill="none" stroke="%2306BBCC" stroke-width="2"/%3E%3C/svg%3E') 30 stretch;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(6,187,204,0.05), rgba(255,255,255,0.2));
            z-index: -1;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-family: 'Playfair Display', serif;
            font-size: 80px;
            color: rgba(6, 187, 204, 0.1);
            font-weight: bold;
            z-index: 0;
            text-transform: uppercase;
        }
        .header {
            margin-bottom: 20px;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 15px;
        }
        .title {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            color: #06BBCC;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .subtitle {
            font-family: 'Roboto', sans-serif;
            font-size: 20px;
            color: #555;
            margin-bottom: 20px;
        }
        .awarded-to {
            margin: 20px 0;
        }
        .name {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 700;
            color: #06BBCC;
            margin: 15px 0;
            padding: 0 20px;
        }
        .course {
            font-family: 'Roboto', sans-serif;
            font-size: 24px;
            color: #333;
            margin: 15px 0;
            font-weight: 500;
        }
        .details {
            margin: 20px auto;
            width: 80%;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            border-top: 1px solid rgba(6, 187, 204, 0.3);
            border-bottom: 1px solid rgba(6, 187, 204, 0.3);
            padding: 10px 0;
        }
        .details p {
            margin: 0;
            padding: 8px 15px;
            color: #333;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 0 60px;
        }
        .signature {
            width: 200px;
            text-align: center;
        }
        .signature-text {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            font-style: italic;
            color: #059ba8;
            transform: rotate(-2deg);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 8px;
            padding: 5px 10px;
            display: inline-block;
        }
        .signature-title {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
        }
        .certificate-id {
            position: absolute;
            bottom: 15px;
            right: 20px;
            font-size: 12px;
            color: #666;
            font-family: 'Roboto', sans-serif;
        }
        @media print {
            body {
                background: none;
            }
            .certificate {
                margin: 0;
                box-shadow: none;
            }
            .signature-text {
                transform: rotate(-2deg);
            }
        }
        @media screen and (max-width: 768px) {
            .certificate {
                width: 100%;
                height: auto;
                padding: 15px;
                border-width: 8px;
            }
            .title {
                font-size: 32px;
            }
            .subtitle {
                font-size: 18px;
            }
            .name {
                font-size: 28px;
            }
            .course {
                font-size: 20px;
            }
            .details {
                flex-direction: column;
                text-align: center;
            }
            .details p {
                padding: 5px 10px;
            }
            .signatures {
                flex-direction: column;
                gap: 15px;
                padding: 0 15px;
            }
            .signature {
                width: 100%;
            }
            .signature-text {
                font-size: 1.4rem;
            }
            .watermark {
                font-size: 60px;
            }
            .certificate-id {
                font-size: 10px;
                bottom: 10px;
                right: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="watermark">Certified</div>
        <div class="header">
            <h2>REACH</h2>
            <div class="title">Certificate of Completion</div>
            <div class="subtitle">This is to certify that</div>
        </div>

        <div class="awarded-to">`
            <div class="name">{{ $name }}</div>
            <div class="course">has successfully completed the course</div>
            <div class="name">{{ $course }}</div>
        </div>

        <div class="details">
            <p>Duration: {{ $duration }}</p>
            <p>Date of Completion: {{ $completionDate }}</p>
        </div>

        <div class="signatures">
            {{-- <div class="signature">Instructor</div> --}}
            <div class="signature">
                <div class="signature-text">Elena Martinez</div>
                <p class="signature-title">Program Director</p>
            </div>
        </div>

        <div class="certificate-id">Certificate ID: {{ $certificateId }}</div>
    </div>
</body>
</html>
