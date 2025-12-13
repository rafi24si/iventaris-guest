<!-- CSS Start-->
<link rel="stylesheet" href="{{ asset('assets-guest/css/bootstrap-5.0.0-beta2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets-guest/css/LineIcons.2.0.css') }}" />
<link rel="stylesheet" href="{{ asset('assets-guest/css/main.css') }}" />
<link rel="shortcut icon" href="{{ asset('assets-guest/images/logo/logo.png') }}" type="image/x-icon">
<style>
    .container-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .warga-card {
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        margin-bottom: 25px;
        height: 100%;
    }

    .warga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .warga-header {
        background: linear-gradient(135deg, #36ccdf 0%, #36ccdf 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }

    .warga-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .warga-info {
        padding: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 30px;
        color: #667eea;
        font-size: 1.1rem;
    }

    .info-content {
        flex: 1;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .action-buttons {
        border-top: 1px solid #f0f0f0;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    .search-box {
        background: white;
        border-radius: 50px;
        padding: 15px 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .stats-card {
        background: linear-gradient(135deg, #36ccdf 0%, #36ccdf 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        margin-bottom: 25px;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 30px;
        right: 30px;
        background-color: #25D366;
        /* Warna hijau WhatsApp */
        color: #FFF;
        border-radius: 50%;
        text-align: center;
        font-size: 30px;
        /* Ukuran icon */
        line-height: 60px;
        /* Pusatkan icon secara vertikal */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 100;
        transition: 0.3s;
    }

    .whatsapp-float:hover {
        background-color: #128C7E;
        /* Warna hijau lebih gelap */
        color: #FFF;
    }
</style>
</head>
{{-- CSS End --}}
