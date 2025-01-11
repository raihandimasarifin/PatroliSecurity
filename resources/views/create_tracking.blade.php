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
    <title>Scan Barcode</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  </head>
  <body>
    <div class="flex justify-center min-h-screen bg-background">
      <div class="bg-white dark:bg-card rounded-lg shadow-lg p-8 max-w-lg w-full">
        <h2 class="text-center text-2xl font-bold text-primary mb-6">PORTAL SECURITY</h2>
        <button onclick="window.history.back()" class="mb-4 mt-4 bg-secondary text-secondary-foreground hover:bg-secondary/80 p-3 rounded-md text-lg flex items-center justify-center">
          <span aria-hidden="true" class="mr-2">🔙</span> Kembali
        </button>

        <div class="container">
          <h1 class="text-xl font-semibold text-primary mb-4">Form Tracking</h1>

          @if(session('error'))
            <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded-md">
              {{ session('error') }}
            </div>
          @endif

          @if(session('success'))
            <div class="alert alert-success mb-4 p-4 bg-green-500 text-white rounded-md">
              {{ session('success') }}
            </div>
          @endif

          <form action="{{ route('tracking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
              <label for="room" class="form-label text-lg font-medium">Room</label>
              <input type="text" class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="room" name="room" value="{{ $room->room }}" readonly>
              <input type="hidden" name="room_id" value="{{ $room->id }}">
            </div>

            <div class="mb-4">
              <label for="floor" class="form-label text-lg font-medium">Floor</label>
              <input type="text" class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="floor" name="floor" value="{{ $room->floor }}" readonly>
            </div>

            <div class="mb-4">
              <label for="date" class="form-label text-lg font-medium">Date</label>
              <input type="text" class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="date" name="date" value="{{ $currentDate }}" readonly>
            </div>

            <div class="mb-4">
              <label for="situasi" class="form-label text-lg font-medium">Situasi</label>
              <textarea class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="situasi" name="situasi" required></textarea>
            </div>

            <div class="mb-4">
              <label for="foto" class="form-label text-lg font-medium">Foto</label>
              <input type="file" class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="foto" name="foto" accept="image/*" required>
            </div>

            <div class="mb-4">
              <label for="name" class="form-label text-lg font-medium">Name User</label>
              <input type="text" class="form-control p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-primary" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary w-full py-3 mt-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/80">Submit</button>
          </form>
        </div>
  </body>
</html>
