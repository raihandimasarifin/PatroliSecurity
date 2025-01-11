<!DOCTYPE html>
<html>
<head>
    <title>Room List PDF</title>
    <style>
        .cart {
            display: flex;
            flex-wrap: wrap;
            gap: 16px; /* Menambahkan jarak antar kolom */
        }
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            width: calc(33.333% - 16px);
            box-sizing: border-box;
            text-align: center;
            margin-bottom: 16px; /* Menambahkan jarak antar baris */
        }
        .cart-item img {
            display: block;
            margin: 0 auto 8px;
            max-width: 100%;
            height: auto;
        }
        .cart-item h3 {
            margin: 8px 0;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="cart">
        @foreach ($rooms as $room)
        <div class="cart-item">
            <img src="{{ public_path('qr_codes/' . $room->room_code . '.png') }}" alt="QR Code" width="100" height="100">
            <h3>{{$room->room}}</h3>
            <h3>Lantai {{ $room->floor }}</h3>
        </div>
        @endforeach
    </div>
</body>
</html>
