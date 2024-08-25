<x-guest-layout>
<div class="login-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg login-container">
    
    <style>
        .login-bg {
        background-image: url('{{ asset('/build/assets/img/dswd.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
            }

    .login-container {
        margin-top: 200px; /* Adjust this value as needed */}
    </style>
    </div>
</div>
</x-guest-layout>