<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5.9% 10%;
                --radius: 0.5rem;
            }

            .dark {
                --background: 240 10% 3.9%;
                --foreground: 0 0% 98%;
                --card: 240 10% 3.9%;
                --card-foreground: 0 0% 98%;
                --popover: 240 10% 3.9%;
                --popover-foreground: 0 0% 98%;
                --primary: 0 0% 98%;
                --primary-foreground: 240 5.9% 10%;
                --secondary: 240 3.7% 15.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 240 3.7% 15.9%;
                --muted-foreground: 240 5% 64.9%;
                --accent: 240 3.7% 15.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 3.7% 15.9%;
                --input: 240 3.7% 15.9%;
                --ring: 240 4.9% 83.9%;
            }
        }
    </style>
</head>

<body class="bg-background text-foreground">
    <div class="mt-8 space-y-4">
        <a href="/dashboard"
            class="flex items-center justify-center w-full bg-secondary text-secondary-foreground p-4 rounded-lg hover:bg-secondary/80">
            <img aria-hidden="true" class="mr-2" />
            PATROLI SECURITY
        </a>
    <div class="container mx-auto p-6">
        <button onclick="window.history.back()" class="mb-4 bg-secondary text-secondary-foreground p-2 rounded-md">🔙 Kembali</button>
        <h1 class="text-2xl font-bold mb-4 text-center">EDIT PROFILE USER</h1>
        <form action="{{ route('profile.update') }}" method="POST" class="bg-white border border-border rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-muted">Nama</label>
                <input type="text" id="name" name="name" class="border border-border rounded-lg px-4 py-2 w-full"
                    value="{{ old('name', auth()->user()->name) }}" placeholder="Masukkan nama" required>
                @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-muted">Username</label>
                <input type="text" id="username" name="username" class="border border-border rounded-lg px-4 py-2 w-full"
                    value="{{ old('username', auth()->user()->username) }}" placeholder="Masukkan username" required>
                @error('username')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-muted">Posisi</label>
                <p id="role" class="border border-border rounded-lg px-4 py-2 w-full">
                    @if (auth()->user()->role == 'kepala')
                        Kepala
                    @elseif (auth()->user()->role == 'satpam')
                        Satpam
                    @else
                        Tidak Diketahui
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-muted">Password Baru (Opsional)</label>
                <input type="password" id="password" name="password" class="border border-border rounded-lg px-4 py-2 w-full"
                    placeholder="Masukkan password baru / kosongkan jika tidak ingin mengganti">
                @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-muted">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="border border-border rounded-lg px-4 py-2 w-full"
                    placeholder="Konfirmasi password baru / kosongkan jika tidak ingin mengganti">
                @error('password_confirmation')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-primary text-primary-foreground hover:bg-primary/80 px-4 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('dashboard') }}" class="bg-destructive text-destructive-foreground hover:bg-destructive/80 px-4 py-2 rounded-lg">Batal</a>
        </form>
    </div>
</body>

</html>
