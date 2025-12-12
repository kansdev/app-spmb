<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ID Card</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 242.5pt;
            height: 153.1pt;
            font-family: sans-serif;
            background-image: url("{{ public_path('assets/img/backgrounds/21.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .id-card {
            width: 100%;
            max-width: 188px;
            height: 100%;
            color: white;
            padding: 6pt;
            border-radius: 10pt;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .header {
            font-size: 26pt;
            font-weight: bold;
            margin-top: 2pt;
            text-align: center;
        }

        .subheader {
            font-size: 10pt;
            margin-bottom: 4pt;
        }

        .photo {
            width: 100%;
            height: 100pt;
            object-fit: cover;
            border-radius: 6pt;

            margin-top: 10px;
            margin-bottom: 8px
        }

        .name {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 2pt;
            text-align: center;
        }

        .kelas {
            width: 172px;
            height: 50pt;
            background: white;
            color: black;
            font-size: 12pt;
            font-weight: bold;
            border-radius: 6pt;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            /* ✅ Untuk multi-line center */
            text-align: center;
            padding: 2pt 6pt;
            box-sizing: border-box;
            word-break: break-word;
            line-height: 1.2;
            /* ✅ Atur agar tidak terlalu tinggi */
        }
    </style>
</head>

<body>
    <div class="id-card">
        <div class="header">ID CARD</div>
        <img class="photo" src="{{ public_path('storage/' . $item->foto_path) }}" alt="Foto">
        <div class="name">{{ strtoupper($item->nama) }}</div>
        @if ($item->jurusan == 'PPLG')
            {{-- <div class="kelas">
                <p style="padding: 15px; font-size: 28px;">Animasi</p>
            </div> --}}
            {{-- <div class="kelas">Manajemen Perkantoran dan Layanan Bisnis</div> --}}
            <div class="kelas">Pengembangan Perangkat Lunak dan Gim</div>
        @endif
    </div>

</body>

</html>
