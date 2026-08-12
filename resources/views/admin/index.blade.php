<!DOCTYPE html>
<html>
<head>
    <title>Daftar Links - Microsite</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        h1 { color: #333; margin-bottom: 20px; border-bottom: 2px solid #4CAF50; padding-bottom: 10px; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #4CAF50; text-decoration: none; }
        .link-item { background: white; padding: 15px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .link-item h3 { color: #333; margin-bottom: 8px; }
        .link-item .url { color: #666; margin-bottom: 8px; }
        .link-item .url a { color: #4CAF50; text-decoration: none; }
        .link-item .url a:hover { text-decoration: underline; }
        .status-active { color: #4CAF50; font-weight: bold; }
        .status-inactive { color: #f44336; font-weight: bold; }
        .clicks { color: #666; font-size: 14px; margin-top: 5px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        .badge.active { background: #4CAF50; color: white; }
        .badge.inactive { background: #f44336; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Daftar Links</h1>
        <a href="{{ url('/') }}" class="back-link">← Kembali ke Home</a>
        
        @if($links->isEmpty())
            <p style="color: #666; text-align: center; padding: 40px;">Belum ada link. Silahkan tambahkan!</p>
        @else
            @foreach($links as $link)
                <div class="link-item">
                    <h3>{{ $link->title }}</h3>
                    <div class="url">
                        🔗 <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                    </div>
                    <div style="margin: 8px 0;">
                        Status: 
                        <span class="badge {{ $link->is_active ? 'active' : 'inactive' }}">
                            {{ $link->is_active ? '✅ Aktif' : '❌ Tidak Aktif' }}
                        </span>
                    </div>
                    <div class="clicks">👆 Klik: {{ $link->clicks }}</div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>

