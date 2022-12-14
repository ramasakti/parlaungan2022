<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match uk-margin-top-small" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                {!! $dataQR !!}
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body" id="card">
                <p class="uk-margin-remove uk-position-top-right"><a href="/profile" class="uk-margin-small-right" uk-icon="user"></a></p>
                <div class="uk-panel">
                    <img class="uk-border-circle uk-align-left uk-margin-small-right uk-margin-small-bottom" width="35%" height="35%" src="img/default-user.jpg">
                    <h5 class="uk-card-title uk-margin-remove ">
                        @switch(session('status'))
                            @case('Siswa')
                                {{ $detailUser[0]->nama_siswa }}
                                @break
                            @case('Walmur')
                                {{ $detailUser[0]->nama_walmur }}
                                @break
                            @default
                                {{ $detailUser[0]->nama_guru }}
                        @endswitch
                    </h5>
                    <p class="uk-margin-remove"><span class="uk-margin-small-right" uk-icon="calendar"></span>{{ $detailUser[0]->tempat_lahir }}, {{ $detailUser[0]->tanggal_lahir }}</p>
                    <p class="uk-margin-remove"><span class="uk-margin-small-right" uk-icon="location"></span>{{ $detailUser[0]->alamat }}</p>
                    <p class="uk-margin-remove"><span class="uk-margin-small-right" uk-icon="whatsapp"></span>{{ $detailUser[0]->telp }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Siswa</h3>
                <p>Jumlah siswa saat ini {{ $dataSiswa }} siswa</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Guru</h3>
                <p>Jumlah guru dan staf saat ini {{ $dataGuru }} orang</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Kelas</h3>
                <p>Jumlah kelas saat ini {{ $dataKelas }} kelas</p>
            </div>
        </div>
    </div>
    <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-padding-small">
                <h3 class="uk-card-title">Diagram Presensi Siswa Hari Ini</h3>
                <canvas class="uk-height-max-medium" id="absenChart"></canvas>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-padding-small">
                <h3 class="uk-card-title">Grafik Keterlambatan Siswa Minggu Ini</h3>
                <canvas class="uk-height-max-medium" id="terlambatChart"></canvas>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //Data Diagram
        const dataAbsen = {!! json_encode($dataAbsen) !!}
        const rangeTanggal = {!! json_encode(array_column($dataTerlambat, 'tanggal')) !!}
        const dataTerlambat = {!! json_encode(array_column($dataTerlambat, 'terlambat')) !!}
    </script>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    <script>
        //QR Code
        const svg = document.getElementsByTagName('svg')[0]
        svg.setAttribute('class', 'uk-align-center')
        svg.setAttribute('height', '40%')
        svg.setAttribute('width', '40%')
    </script>
    <script>
        //Print Card
        function printDiv() {
            const card = document.getElementById('card').innerHTML
            card.print()
        }
    </script>
</x-admintemplate>