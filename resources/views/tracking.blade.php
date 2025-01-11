<html>

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
<!-- <body class="bg-center bg-no-repeat bg-cover" style="background-image: url('/logo.png'); background-size: 70%;"> -->

<body>
    <div class="mt-8 space-y-4">
        <a href="/dashboard"
            class="flex items-center justify-center w-full bg-secondary text-secondary-foreground p-4 rounded-lg hover:bg-secondary/80">
            <img aria-hidden="true" class="mr-2" />
            PATROLI SECURITY
        </a>
        <div class="p-6 text-foreground relative">
            <button onclick="window.location.href='/dashboard'"
                class="mb-4 bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded-md"><span
                    aria-hidden="true">🔙</span> Kembali</button>
            <h2 class="text-xl font-semibold mb-4">DATA TRACKING PATROLI SECURITY RUMAH SAKIT WIJAYA KUSUMA</h2>

            <form method="GET" action="{{ route('tracking.index') }}">
                <div class="mb-4">
                    <label class="block mb-1" for="start-date">Tanggal Awal</label>
                    <input type="date" id="start-date" name="start_date"
                        class="border border-border p-2 rounded w-full" placeholder="masukkan tanggal Awal"
                        value="{{ request('start_date') }}">
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="end-date">Tanggal Akhir</label>
                    <input type="date" id="end-date" name="end_date" class="border border-border p-2 rounded w-full"
                        placeholder="masukkan tanggal Akhir" value="{{ request('end_date') }}">
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="search">Cari Ruangan atau Satpam</label>
                    <input type="text" name="search" class="border border-border p-2 rounded w-full"
                        value="{{ request('search') }}">
                    </select>
                </div>
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded">Cari</button>
            </form>

            <a href="{{ route('tracking.export', request()->query()) }}">
                <button class="mt-4 bg-accent text-accent-foreground hover:bg-accent/80 p-2 rounded-md">
                    <span aria-hidden="true">⬇️</span> Download Excel
                </button>
            </a>
            <table class="min-w-full mt-6 border border-border">
                <thead>
                    <tr class="bg-muted">
                        <th class="border border-border p-2">No</th>
                        <th class="border border-border p-2">Ruangan</th>
                        <th class="border border-border p-2">Lantai</th>
                        <th class="border border-border p-2">Situasi</th>
                        <th class="border border-border p-2">Tanggal</th>
                        <th class="border border-border p-2">Foto</th>
                        <th class="border border-border p-2">Satpam</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trackings->sortByDesc('date') as $tracking)
                        <tr style="text-align: center;">
                            <td>{{ $loop->iteration + ($trackings->currentPage() - 1) * $trackings->perPage() }}</td>
                            <td>{{ $tracking->room->room }}</td>
                            <td>{{ $tracking->room->floor }}</td>
                            <td>{{ $tracking->situasi }}</td>
                            <td>{{ $tracking->date }}</td>
                            <td>
                                @if ($tracking->foto)
                                    <a href="{{ asset('storage/' . $tracking->foto) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $tracking->foto) }}" alt="Foto Situasi"
                                            width="50">
                                    </a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td>{{ $tracking->user->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data tracking.</td>
                        </tr>
                    @endforelse
                    <div class="mt-4">
                        {{ $trackings->links() }}
                    </div>
                </tbody>
            </table>
        </div>
</body>

</html>
