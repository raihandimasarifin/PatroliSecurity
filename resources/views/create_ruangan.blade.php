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
    <div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">TAMBAH RUANGAN</h1>
  <form action="{{ route('rooms.store') }}" method="post" class="bg-white border border-border rounded-lg p-4">
	@csrf
    <div class="mb-4">
      <label for="" class="block text-sm font-medium text-muted">Room</label>
      <input type="text" name="room" placeholder="Masukkan ruangan" class="border border-border rounded-lg px-4 py-2 w-full" value="{{ old('name') }}" required/>
    </div>
    <div class="mb-4">
      <label for="" class="block text-sm font-medium text-muted">Lantai</label>
      <input type="number" name="floor" placeholder="Masukkan lantai" class="border border-border rounded-lg px-4 py-2 w-full" value="{{ old('floor') }}" required />
    </div>
    <button type="submit" class="bg-primary text-primary-foreground hover:bg-primary/80 px-4 py-2 rounded-lg">Simpan</button>
  </form>
</div>

  </body>
</html>