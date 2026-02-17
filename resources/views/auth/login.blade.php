<x-guest-layout>

<style>
    /* Import font Inter */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 45px 35px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.15);
        width: 100%;
        max-width: 400px;
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .brand-title {
        font-weight: 700;
        color: #111827;
        font-size: 1.8rem;
        letter-spacing: 0.5px;
    }

    .brand-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
        margin-top: 4px;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
        padding: 0 15px;
        border: 1.5px solid #e2e8f0;
        transition: all 0.3s;
        background-color: #f8fafc;
    }

    .form-control:focus {
        border-color: #111827;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .btn-login {
        height: 48px;
        border-radius: 12px;
        background-color: #111827;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        color: #ffffff;
        transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(17,24,39,0.2);
    }

    .btn-login:hover {
        background-color: #0a0f1c;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(17,24,39,0.25);
    }

    .login-footer {
        font-size: 13px;
        color: #9ca3af;
        text-align: center;
        margin-top: 20px;
    }

    a {
        text-decoration: none;
        color: #1e293b;
        font-weight: 500;
    }

    a:hover {
        color: #000;
    }
</style>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="login-card">

        <div class="text-center mb-4">
            <h2 class="brand-title">KondoMarket</h2>
            <div class="brand-subtitle">Admin Dashboard Access</div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="form-control mt-1"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="form-control mt-1"
                    type="password"
                    name="password"
                    required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Remember -->
            <div class="form-check mb-3">
                <input class="form-check-input"
                       type="checkbox"
                       name="remember"
                       id="remember_me">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Log in
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-3">
                    <a class="small" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
            @endif
        </form>

        <div class="login-footer">
            © {{ date('Y') }} KondoMarket — Secure Admin Access
        </div>
    </div>
</div>

</x-guest-layout>
