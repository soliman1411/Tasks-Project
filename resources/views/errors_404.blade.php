{{-- resources/views/errors/404-simple.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f7fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 24px;
            padding: 48px 32px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .icon {
            font-size: 64px;
            color: #fbbf24;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 96px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 16px;
            letter-spacing: 4px;
        }

        h2 {
            font-size: 24px;
            color: #334155;
            margin-bottom: 16px;
            font-weight: 600;
        }

        p {
            color: #64748b;
            margin-bottom: 32px;
            line-height: 1.6;
            font-size: 16px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #fbbf24;
            color: #1e293b;
        }

        .btn-primary:hover {
            background: #f59e0b;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
            transform: translateY(-2px);
        }

        .btn-icon {
            font-size: 14px;
        }

        .footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #94a3b8;
        }

        .footer a {
            color: #fbbf24;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <i class="fas fa-map-signs"></i>
        </div>

        <h1>404</h1>

        <h2>{{ __('messages.Page not found') }}</h2>

       

        <div class="buttons">
            @if(auth()->check())
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt btn-icon"></i>
                         {{ __('messages.Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">
                        <i class="fas fa-tasks btn-icon"></i>
                        {{ __('messages.tasks') }}
                    </a>
                @endif
            @else
                <a href="{{ route('login.form') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt btn-icon"></i>
                    {{ __('messages.login') }}
                </a>
            @endif

            <button onclick="history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-right btn-icon"></i>
                {{ __('messages.cancel') }}
            </button>
        </div>


    </div>
</body>
</html>
