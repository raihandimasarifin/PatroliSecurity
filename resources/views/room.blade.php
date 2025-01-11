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
  <body>

  <div class="mt-8 space-y-4">
    <a href="/dashboard" class="flex items-center justify-center w-full bg-secondary text-secondary-foreground p-4 rounded-lg hover:bg-secondary/80">
      <img aria-hidden="true" class="mr-2" />
      PATROLI SECURITY
    </a>
    <button onclick="window.history.back()" class="mb-4 ml-4 bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded-md"><span aria-hidden="true">🔙</span> Kembali</button>
<div class="bg-background text-foreground min-h-screen p-4">
  <h1 class="text-2xl font-bold mb-4 text-center">DAFTAR RUANGAN</h1>
  <div class="flex items-center mb-4">
    <a href="/room/create" class="bg-secondary text-secondary-foreground hover:bg-secondary/80 px-4 py-2 rounded-lg">Tambah Ruangan</a>
	<!-- <button class="ml-4 px-4 py-2 bg-accent text-accent-foreground hover:bg-accent/80 p-2 rounded-md"><span aria-hidden="true">⬇️</span> Download Excel</button> -->
	<a href="{{ route('rooms.export-pdf') }}" class="ml-4 px-4 py-2 bg-accent text-accent-foreground hover:bg-accent/80 p-2 rounded-md">
    <span aria-hidden="true">⬇️</span> Download PDF</a>
    </div>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-card rounded-lg">
      <thead class="bg-primary text-primary-foreground">
        <tr>
          <th class="px-6 py-3 text-left">No</th>
          <th class="px-6 py-3 text-left">Ruangan</th>
          <th class="px-6 py-3 text-left">Lantai</th>
          <th class="px-6 py-3 text-left">Barcode</th>
          <th class="px-6 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-primary-foreground">
      @foreach ($rooms as $room)
        <tr>
          <td class="px-6 py-4">{{$loop->iteration}}</td>
          <td class="px-6 py-4">{{$room->room}}</td>
          <td class="px-6 py-4">{{$room->floor}}</td>
          <td class="px-6 py-4">
		  <img src="{{ asset('qr_codes/' . $room->room_code . '.png') }}" alt="QR Code" width="100" height="100">
		  {{ $room->room_code }}
          </td>
          <td class="py-6 px-4">
          <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
            @csrf
            @method('DELETE') <!-- Metode DELETE -->
            <a href="{{ route('rooms.edit', $room->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</a>
            <button type="submit" class="mt-4 bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
        </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
  </body>
</html>
